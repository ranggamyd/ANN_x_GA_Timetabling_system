<?php

namespace App\Libraries;

ini_set('max_execution_time', 0);

use App\Libraries\SchedulingRules;

class Genetic
{
    var $prodi;
    var $kelas;
    var $ruang;
    var $waktu;
    var $setting;
    var $min_prosen_capacity;

    var $timespace;
    var $kromosom;
    var $individu;
    var $populasi;

    var $populasi_breeding;
    var $total_fitness;

    var $populasi_breeding_selected;

    var $individu_breed;

    var $individu_update_calon;

    var $populasi_baru;

    var $aturan_jadwal;

    var $dump = false;

    public function __construct()
    {
        $this->aturan_jadwal = new SchedulingRules();
    }

    // === INISIALISASI

    public function initialize($prodi, $kelas, $ruang, $waktu, $setting)
    {
        $this->prodi = $prodi;
        $this->kelas = $kelas;
        $this->ruang = $ruang;
        $this->waktu = $waktu;
        $this->setting = $setting;
        // persentase minimal kapasitas ruangan ditempati
        $this->min_prosen_capacity = 75;

        $this->initialize_timespace();
        echo "<b>== ALOKASI RUANG WAKTU ==</b>";
        if ($this->dump) d($this->timespace);
    }

    public function initialize_timespace()
    {
        $i = 0;
        foreach ($this->ruang as $r) {
            foreach ($this->waktu as $w) {
                $this->timespace[] = [
                    'id_timespace' => $i++,
                    'id_waktu' => $w['id_waktu'],
                    'hari' => $w['hari'],
                    'jam_mulai' => $w['jam_mulai'],
                    'id_ruang' => $r['id_ruang'],
                    'nama_ruang' => $r['nama_ruang'],
                    'ruang_prodi' => !empty($r['prodi']) ? implode('|', array_column($r['prodi'], 'id_prodi')) : null,
                    'kapasitas' => $r['kapasitas'],
                    'label' => $r['nama_ruang'] . ', ' . $w['hari'] . ' ' . $w['jam_mulai'] . '-',
                    'status' => '',
                ];
            }
        }
    }

    // === POPULASI AWAL

    public function generate_population()
    {
        $this->kromosom = $this->create_information_class();
        echo "<b>== KROMOSOM ==</b>";
        if ($this->dump) d($this->kromosom);

        $this->populasi = [];
        for ($i = 0; $i < $this->setting['populasi']; $i++) {
            $individu = $this->create_individu();

            $this->populasi[] = $individu;
        }
        echo "<b>== POPULASI ==</b>";
        if ($this->dump) d($this->populasi);
    }

    public function create_information_class()
    {
        $class = array();
        $id_individu = 0;
        foreach ($this->kelas as $key => $value) {
            $period_waktu = $value['sks'];
            $arr_data = compact('class', 'period_waktu', 'value', 'id_individu');
            $ret_data = $this->make_class($arr_data);

            extract($ret_data);
        }

        return $class;
    }

    public function make_class($arr_data)
    {
        extract($arr_data);

        $class[] = array(
            'id_individu' => $id_individu,
            'id_kelas' => $value['id_kelas'],
            'nama_kelas' => $value['nama_kelas'],
            'peserta' => $value['prediksi_peserta'],
            'id_mata_kuliah' => $value['id_mata_kuliah'],
            'period' => $period_waktu,
            'semester' => $value['semester'],
            'sifat' => $value['sifat'],
            'id_prodi' => $value['id_prodi'],
            'ruang_prodi' => !empty($value['prodi']) ? implode('|', array_column($value['prodi'], 'id_prodi')) : null,
            'id_dosen' => $value['id_dosen'],
            'alternatif_waktu_ajar' => !empty($value['alternatif_waktu_ajar']) ? implode('|', array_column($value['alternatif_waktu_ajar'], 'id_waktu')) : null,
        );

        $id_individu++;

        $ret_data = compact('class', 'period_waktu', 'value', 'id_individu');

        return $ret_data;
    }

    /*
    Aturan umum : 
    1. Kelas mata kuliah yang sama harus waktu yang sama.
    2. Kelas mata kuliah yang satu paket harus beda waktu.
    3. Kapasitas ruang >= jumlah peserta.
    4. Dosen tidak mengajar kelas pada waktu yang sama.
    5. kelas makul sama yg dipecah sks nya diadakan pada hari yang berbeda.
    6. Kelas makul paket wajib berdekatan jenis smt harus beda waktu.
    */
    public function create_individu()
    {
        $individu = array();
        $timespace = $this->timespace;
        $status_reset_individu = false;

        foreach ($this->kromosom as $key => $value) {
            $arr_data = compact('timespace', 'individu', 'value', 'status_reset_individu');

            $ret_data = $this->get_feasible_individu($arr_data);

            if ($status_reset_individu) {
                unset($individu);
                unset($timespace);

                return $this->create_individu();
            }

            extract($ret_data);
        }

        return $individu;
    }

    public function get_feasible_individu($arr_data)
    {
        extract($arr_data);

        /*
        menentukan jadwal ruang & waktu untuk kelas diwakili oleh id_timespace
        cek apakah kelas makul yang sama sudah ada sebelumnya di kelas terjadwal
        kelas makul yang sama adalah kelas paralel yang makulnya sama
        jika tidak maka id_timespace bisa diambil dari matriks ruang & waktu 
        jika iya maka id_timespace diambil dari matriks ruang & waktu yg lebih spesifik, 
        yakni yg waktunya sama dgn kls terjdwal sebelumnya yg makul sama. Karna ada aturan
        kelas paralel diadakan dalam waktu yg sama.
        */
        $period_waktu = $value['period'];

        $individu_classprodi = $this->break_individu_prodi($individu);

        $id_timespace = $this->get_random_local($individu_classprodi, $individu, $value, $timespace, $period_waktu);

        if ($id_timespace == 'nochance') {
            $status_reset_individu = true;
        } else {
            $jam_selesai = date('H:i:s', strtotime('+' . $period_waktu * 50 . ' minutes', strtotime($timespace[$id_timespace]['jam_mulai'])));
            $individu[] = array(
                'id_kromosom' => $value['id_individu'],
                'id_timespace' => $timespace[$id_timespace]['id_timespace'],
                'id_waktu' => $timespace[$id_timespace]['id_waktu'],
                'hari' => $timespace[$id_timespace]['hari'],
                'jam_mulai' => $timespace[$id_timespace]['jam_mulai'],
                'jam_selesai' => $jam_selesai,
                'nama_kelas' => $value['nama_kelas'],
                'period' => $value['period'],
                'id_ruang' => $timespace[$id_timespace]['id_ruang'],
                'kapasitas' => $timespace[$id_timespace]['kapasitas'],
                'label_timespace' => $timespace[$id_timespace]['label'] . $jam_selesai,
            );


            // menghapus index beserta nilainya untuk data ruang & waktu yg dipakai kelas untuk jadwal
            for ($t = 0; $t < $period_waktu; $t++) {
                $id_timespace += $t;
                $timespace[$id_timespace]['status'] = 1;
            }
        }

        return compact('timespace', 'individu', 'value', 'status_reset_individu');
    }

    function break_individu_prodi($individu)
    {
        $p = null;
        foreach ($individu as $t => $ind) {
            foreach ($this->prodi as $t => $pr) {
                $id_prodi = explode('|', $this->kromosom[$ind['id_kromosom']]['id_prodi']);
                if (!empty($id_prodi) and in_array($pr['id_prodi'], $id_prodi)) {
                    $p[$t][] = $ind;
                }
            }
        }

        return array("pro" => $p);
    }

    function get_random_local($individu_classprodi, $individu, $kelas, $timespace, $period_waktu, $id_ts = null)
    {
        $period_waktu = $kelas['period'];

        if ($id_ts != null) {
            $id_timespace = $this->getRandomTimespace($individu_classprodi, $individu, $kelas, $timespace, $period_waktu, 0, $id_ts);
        } else {
            $id_timespace = $this->getRandomTimespace($individu_classprodi, $individu, $kelas, $timespace, $period_waktu, 0);
        }

        return $id_timespace;
    }

    function getRandomTimespace($individu_classprodi, $individu, $value, $timespace, $period_waktu, $iteration, $id_ts = null)
    {
        $iteration++;

        if ($iteration == 10000) return 'nochance';

        if ($id_ts == null) {
            $id_timespace = mt_rand(0, (count($timespace) - 1));
        } else {
            $id_timespace = $id_ts;
        }

        $sts = true;
        for ($t = 0; $t < $period_waktu; $t++) {
            $ts_ok = true;
            $id_ts = $id_timespace + $t;
            if (!isset($timespace[$id_ts]) or $timespace[$id_ts]['status'] == 1) $ts_ok = false;

            $sts = $sts && $ts_ok;
        }

        /*kondisi apakah cari timespace lokal atau global*/
        if (!$sts) {
            return $this->getRandomTimespace($individu_classprodi, $individu, $value, $timespace, $period_waktu, $iteration);
        } else {
            $rule_ok = $this->check_on_hardrule($individu_classprodi, $individu, $value, $id_timespace, $timespace, $period_waktu, $iteration);
            if ($rule_ok) {
                return $id_timespace;
            } else {
                return $this->getRandomTimespace($individu_classprodi, $individu, $value, $timespace, $period_waktu, $iteration);
            }
        }
    }

    public function check_on_hardrule($individu_classprodi, $individu, $value, $id_timespace, $timespace, $period_waktu, $iteration = null)
    {
        $stsrule_1 = $this->aturan_jadwal->check_time_notover_limit($id_timespace, $timespace, $period_waktu);
        $stsrule_2 = $this->aturan_jadwal->check_timespace_class_samepacket_not_sametime($this->kromosom, $this->timespace, $individu_classprodi, $value, $id_timespace, $timespace, $this->prodi);
        $stsrule_3 = $this->aturan_jadwal->check_capacity_class_ok($id_timespace, $timespace, $value);
        $stsrule_4 = $this->aturan_jadwal->check_lecture_class_not_sametime($this->kromosom, $this->timespace, $individu, $value, $id_timespace, $timespace);
        $stsrule_5 = $this->aturan_jadwal->check_separatesameclass_not_sameday($this->kromosom, $this->timespace, $individu, $value, $id_timespace, $timespace);
        $stsrule_6 = $this->aturan_jadwal->check_neighborpacketclass_not_sametime($this->kromosom, $this->timespace, $individu_classprodi, $value, $id_timespace, $timespace, $this->prodi);

        return $stsrule_1 && $stsrule_2 && $stsrule_3 && $stsrule_4 && $stsrule_5 && $stsrule_6;
    }

    // === HITUNG NILAI FITNESS

    public function count_fitness()
    {
        $this->transform_populasi();

        $this->total_fitness = 0;
        foreach ($this->populasi as $i => $individu) {
            $populasi[$i]['fitness_rule_1'] = $this->count_fitness_based_rule_kelasmakul_pilihan_wajib_not_sametime($individu);
            $populasi[$i]['fitness_rule_2'] = $this->count_fitness_based_rule_kelasmakul_on_ruangblokprodi($individu);
            $populasi[$i]['fitness_rule_3'] = $this->count_fitness_based_rule_kelasmakulsepaket_max_8_sks_sehari($individu);
            $populasi[$i]['fitness_rule_4'] = $this->count_fitness_based_rule_kelas_filled_min_prosen_capacity($individu);
            $populasi[$i]['fitness_rule_5'] = $this->count_fitness_based_rule_kelas_dosen_choose_their_time($individu);

            $populasi[$i]['fitness'] = 1 - (($populasi[$i]['fitness_rule_1'] + $populasi[$i]['fitness_rule_2'] + $populasi[$i]['fitness_rule_3'] + $populasi[$i]['fitness_rule_4'] + $populasi[$i]['fitness_rule_5']) / 5);

            $this->populasi_breeding[$i]['fitness'] = $populasi[$i]['fitness'];
            $this->total_fitness += $populasi[$i]['fitness'];
        }

        if ($this->dump) d($populasi);
        if ($this->dump) d($this->populasi_breeding);

        unset($populasi);
    }

    public function transform_populasi()
    {
        foreach ($this->populasi as $key => $individu) {
            foreach ($individu as $i => $gen) {
                $this->populasi_breeding[$key]['arr_gen'][$i] = $gen;
            }
            $this->populasi_breeding[$key]['fitness'] = 0;
        }
    }

    public function count_fitness_based_rule_kelasmakul_pilihan_wajib_not_sametime($individu)
    {
        $ind_classprodi = $this->break_individu_prodi($individu);

        foreach ($ind_classprodi['pro'] as $i => $arr_kromosom) {
            foreach ($arr_kromosom as $k => $kr_pr) {
                $data_perprod[$i][] = $kr_pr;
            }
        }

        $jumlah_perprod = 0;
        $jumlah_makulpil = 0;
        foreach ($data_perprod as $key => $indi_pr) {
            $separate_makul = $this->separate_kelas_makul_wajib_pil($indi_pr);

            $jumlah = 0;
            foreach ($separate_makul['pilihan'] as $i => $pil) {
                $smt_neighbor = $this->aturan_jadwal->get_neighbor_sametype_semester($this->kromosom[$pil['id_kromosom']]['semester']);

                $bentrok[$i] = 0;
                $bentrok_ket[$i] = '';

                $sts_bentrok = false;
                foreach ($separate_makul['wajib'] as $j => $wjb) {
                    if (
                        in_array($this->kromosom[$wjb['id_kromosom']]['semester'], $smt_neighbor)
                        and ($this->bentrok_sametime($pil, $wjb))
                    ) {
                        $bentrok[$i]++;
                        $bentrok_ket[$i] .= $this->kromosom[$wjb['id_kromosom']]['id_kelas'] . ', ';
                        $sts_bentrok = true;
                    }
                }

                $separate_makul['pilihan'][$i]['bentrok'] = $bentrok[$i];
                $separate_makul['pilihan'][$i]['bentrok_ket'] = $bentrok_ket[$i];

                if ($sts_bentrok) $jumlah++;
            }

            $jumlah_makulpil = $jumlah_makulpil + count($separate_makul['pilihan']);
            $jumlah_perprod = $jumlah_perprod + $jumlah;
        }

        $fitness = 1;
        if ($jumlah_perprod != 0 && $jumlah_makulpil != 0) $fitness = $jumlah_perprod / $jumlah_makulpil;

        return $fitness;
    }

    public function separate_kelas_makul_wajib_pil($individu)
    {
        $wajib = [];
        $pilihan = [];

        foreach ($individu as $key => $value) {
            if (strtolower($this->kromosom[$value['id_kromosom']]['sifat']) == 'wajib') $wajib[] = $value;
            if (strtolower($this->kromosom[$value['id_kromosom']]['sifat']) == 'pilihan') $pilihan[] = $value;
        }

        return array(
            'wajib' => $wajib,
            'pilihan' => $pilihan
        );
    }

    function bentrok_sametime($kls, $kls_compare)
    {
        $sts = $this->timespace[$kls['id_timespace']]['hari'] == $this->timespace[$kls_compare['id_timespace']]['hari'];

        $start_time = strtotime($this->timespace[$kls['id_timespace']]['jam_mulai']);
        $waktu_jam_selesai_kls = date('H:i:s', strtotime('+' . $this->kromosom[$kls['id_kromosom']]['period'] * 50 . ' minutes', strtotime($this->timespace[$kls['id_timespace']]['jam_mulai'])));
        $end_time = strtotime($waktu_jam_selesai_kls);

        $start_compare_time = strtotime($this->timespace[$kls_compare['id_timespace']]['jam_mulai']);
        $waktu_jam_selesai_kls_compare = date('H:i:s', strtotime('+' . $this->kromosom[$kls_compare['id_kromosom']]['period'] * 50 . ' minutes', strtotime($this->timespace[$kls_compare['id_timespace']]['jam_mulai'])));
        $end_compare_time = strtotime($waktu_jam_selesai_kls_compare);

        $sts_time_between = ((($start_time >= $start_compare_time) && ($start_time <= $end_compare_time) or (($end_time >= $start_compare_time) && ($end_time <= $end_compare_time))));
        $sts = $sts && $sts_time_between;

        return $sts;
    }

    public function count_fitness_based_rule_kelasmakul_on_ruangblokprodi($individu)
    {
        $score = 0;
        $i = 0;
        foreach ($individu as $key => $value) {
            $arr_ruangblokprodi[$key] = explode('|', $this->kromosom[$value['id_kromosom']]['ruang_prodi']);
            if (
                !empty($arr_ruangblokprodi[$key])
                and !in_array($this->timespace[$value['id_timespace']]['id_ruang'], $arr_ruangblokprodi[$key])
            ) $score++;

            if (!empty($arr_ruangblokprodi[$key])) $i++;
        }

        $fitness = $score / $i;

        return $fitness;
    }

    public function count_fitness_based_rule_kelasmakulsepaket_max_8_sks_sehari($individu)
    {
        $arr_hari = array('Senin', 'Selasa', 'Rabu', 'Kamis', "Jum'at");

        $total_langgar = 0;
        foreach ($arr_hari as $i => $hari) {
            $arr_grup_hari[$i] = array(
                'hari' => $hari,
                'prodi' => array()
            );

            $jml_prodi_langgar = 0;
            foreach ($this->prodi as $j => $prodi) {
                $arr_grup_hari[$i]['prodi'][$j] = array(
                    'id_prodi' => $prodi['id_prodi'],
                    'semester' => array()
                );

                $jml_smt_langgar = 0;
                for ($l = 1; $l <= 8; $l++) {
                    $arr_grup_hari[$i]['prodi'][$j]['semester'][$l] = array(
                        'semester' => $l,
                        'kelas' => array()
                    );

                    $total_sks = 0;
                    foreach ($individu as $k => $kelas_terjadwal) {
                        $arr_kelas_prodi = explode('|', $this->kromosom[$kelas_terjadwal['id_kromosom']]['id_prodi']);
                        if (
                            $hari == $this->timespace[$kelas_terjadwal['id_timespace']]['hari']
                            and in_array($prodi['id_prodi'], $arr_kelas_prodi)
                            and $this->kromosom[$kelas_terjadwal['id_kromosom']]['semester'] == $l
                        ) {
                            $total_sks += $this->kromosom[$kelas_terjadwal['id_kromosom']]['period'];
                            $arr_grup_hari[$i]['prodi'][$j]['semester'][$l]['kelas'][] = $kelas_terjadwal;
                        }
                    }

                    $arr_grup_hari[$i]['prodi'][$j]['semester'][$l]['total_sks'] = $total_sks;
                    if ($total_sks > 8) $jml_smt_langgar++;
                }

                $arr_grup_hari[$i]['prodi'][$j]['jml_smt_langgar'] = $jml_smt_langgar;
                if ($jml_smt_langgar > 0) $jml_prodi_langgar++;
            }

            $arr_grup_hari[$i]['jml_prodi_langgar'] = $jml_prodi_langgar;
            $total_langgar += $jml_prodi_langgar;
        }

        $jml_semesta_himp = count($arr_hari) * count($this->prodi);

        $fitness = $total_langgar / $jml_semesta_himp;

        return $fitness;
    }

    public function count_fitness_based_rule_kelas_filled_min_prosen_capacity($individu)
    {
        $melanggar = 0;
        foreach ($individu as $key => $value) {
            $harapan_jml = ($this->min_prosen_capacity / 100) * $this->timespace[$value['id_timespace']]['kapasitas'];
            $individu[$key]['harapan_jml'] = ceil($harapan_jml);
            $individu[$key]['melanggar'] = 0;
            if ($this->kromosom[$value['id_kromosom']]['peserta'] < ceil($harapan_jml)) {
                $individu[$key]['melanggar'] = 1;
                $melanggar++;
            }
        }

        $fitness = $melanggar / count($individu);

        return $fitness;
    }

    public function count_fitness_based_rule_kelas_dosen_choose_their_time($individu)
    {
        $jml_langgar = 0;
        foreach ($individu as $key => $value) {
            $arr_alternatif_waktu_ajar = explode('|', $this->kromosom[$value['id_kromosom']]['alternatif_waktu_ajar']);

            if (!in_array($this->timespace[$value['id_timespace']]['id_waktu'], $arr_alternatif_waktu_ajar)) $jml_langgar++;
        }

        $fitness = $jml_langgar / count($individu);

        return $fitness;
    }

    // === SELEKSI RODA ROULETTE

    public function roulette_wheel_selection()
    {
        $populasi_breeding = $this->populasi_breeding;

        $rentangan = [];
        foreach ($populasi_breeding as $key => $value) {
            $prob = $value['fitness'] / $this->total_fitness;
            $populasi_breeding[$key]['idx'] = $key;
            $populasi_breeding[$key]['prob'] = round($prob, 5);

            $key == 0 ? $rentangan[$key]['awal'] = 0 : $rentangan[$key]['awal'] = $rentangan[($key - 1)]['akhir'] + 0.00001;

            $rentangan[$key]['akhir'] = $rentangan[$key]['awal'] + $populasi_breeding[$key]['prob'];
            $random_number[$key] = mt_rand(0, 100000) / 100000;
        }

        $pick_individu = array();
        foreach ($random_number as $i => $val) {
            foreach ($rentangan as $j => $vale) {
                if ($val >= $vale['awal'] and $val <= $vale['akhir']) $pick_individu[] = $j;
            }
        }

        for ($i = 0; $i < $this->setting['populasi']; $i++) {
            $populasi_breeding_selected[] = $populasi_breeding[$pick_individu[$i]];
        }

        foreach ($populasi_breeding_selected as $key => $value) {
            $populasi_breeding_selected[$key]['val_random'] = mt_rand(0, 100000) / 100000; // for selecting on crossover
        }

        $this->total_fitness = 0; // set total fitness 0 karna sudah digunakan 
        $this->populasi_breeding_selected = $populasi_breeding_selected;

        if ($this->dump) d($this->populasi_breeding_selected);
    }

    // === KAWIN SILANG

    public function crossover()
    {
        $populasi_breeding_crossover_selected = array();
        foreach ($this->populasi_breeding_selected as $key => $value) {
            if ($value['val_random'] <= $this->setting['crossover']) $populasi_breeding_crossover_selected[] = $value;
        }

        if (empty($populasi_breeding_crossover_selected)) {
            echo "tidak ada nilai lebih kecil dari Pc";

            exit();
        }

        $n_gen = count($populasi_breeding_crossover_selected[0]['arr_gen']);
        $n_ind = count($populasi_breeding_crossover_selected);

        $point_random = array(mt_rand(2, $n_gen - 1), mt_rand(2, $n_gen - 1));
        for ($i = 0; $i < $n_ind - 1; $i++) {
            $this->build_offspring_population_crossover_twopoint($populasi_breeding_crossover_selected[$i], $populasi_breeding_crossover_selected[$i + 1], $point_random);
        }

        $this->build_offspring_population_crossover_twopoint($populasi_breeding_crossover_selected[($n_ind - 1)], $populasi_breeding_crossover_selected[0], $point_random);
        if ($this->dump) d($this->individu_breed);
    }

    public function build_offspring_population_crossover_twopoint($parent_1, $parent_2, $point_random)
    {
        $jumlah_gen = count($parent_1['arr_gen']);
        $i = 0;

        $arr_gen_1 = $parent_1['arr_gen'];
        $arr_gen_2 = $parent_2['arr_gen'];
        while ($jumlah_gen > 0) {
            if (!in_array($i, $point_random)) {
                $off_1[] = $arr_gen_1[$i];
                $off_2[] = $arr_gen_2[$i];

                $i++;
                $jumlah_gen--;
            } else {
                $point_random = array_diff($point_random, array($i));
                $point_random = array_values($point_random);

                $temp_1 = $arr_gen_1;
                $temp_2 = $arr_gen_2;
                $arr_gen_1 = $temp_2;
                $arr_gen_2 = $temp_1;
            }
        }

        $offspring[] = array(
            'parent' => $parent_1,
            'offspring' => $off_1
        );

        $offspring[] = array(
            'parent' => $parent_2,
            'offspring' => $off_2
        );

        foreach ($offspring as $key => $value) {
            $offspring[$key]['fitness_rule_1'] = $this->count_fitness_based_rule_kelasmakul_pilihan_wajib_not_sametime($value['offspring']);
            $offspring[$key]['fitness_rule_2'] = $this->count_fitness_based_rule_kelasmakul_on_ruangblokprodi($value['offspring']);
            $offspring[$key]['fitness_rule_3'] = $this->count_fitness_based_rule_kelasmakulsepaket_max_8_sks_sehari($value['offspring']);
            $offspring[$key]['fitness_rule_4'] = $this->count_fitness_based_rule_kelas_filled_min_prosen_capacity($value['offspring']);
            $offspring[$key]['fitness_rule_5'] = $this->count_fitness_based_rule_kelas_dosen_choose_their_time($value['offspring']);


            $offspring[$key]['fitness'] = 1 - (($offspring[$key]['fitness_rule_1'] + $offspring[$key]['fitness_rule_2'] + $offspring[$key]['fitness_rule_3'] + $offspring[$key]['fitness_rule_4'] + $offspring[$key]['fitness_rule_5']) / 5);
            $offspring[$key]['randvalmut'] = mt_rand(0, 1);
        }

        $this->individu_breed[] = $offspring;
    }

    // === MUTASI

    public function mutation()
    {
        foreach ($this->individu_breed as $key => $value) {
            foreach ($value as $i => $item) {
                if ($item['randvalmut'] < $this->setting['mutasi']) $this->individu_breed[$key][$i]['offspring'] = $this->mutasi_kromosom($item['offspring']);

                $this->individu_update_calon[] = $this->individu_breed[$key][$i];
            }
        }

        $this->individu_breed = null;
        if ($this->dump) d($this->individu_update_calon);
    }

    public function mutasi_kromosom($individu)
    {
        $timespace = $this->timespace;

        $pos_mutasi = mt_rand(0, count($individu) - 1);
        $id_timespace = mt_rand(0, (count($timespace) - 1));

        $gen = $individu[$pos_mutasi];

        $individu[$pos_mutasi] = array(
            'id_kromosom' => $gen['id_kromosom'],
            'id_timespace' => $timespace[$id_timespace]['id_timespace']
        );

        return $this->repair_kelas_on_hardrule($individu);
    }

    public function repair_kelas_on_hardrule($individu)
    {
        $individu_temp = array(); // untuk menampung sejumlah individu yang mewakili jadwal
        $timespace = $this->timespace; // matriks data ruang, hari, dan waktu

        foreach ($this->kromosom as $key => $value) {
            $period_waktu = $value['period'];

            $individu_classprodi = $this->break_individu_prodi($individu_temp);

            $id_timespace = $this->get_random_local($individu_classprodi, $individu_temp, $value, $timespace, $period_waktu, $individu[$value['id_individu']]['id_timespace']);

            if ($id_timespace == 'nochance') {
                unset($individu_temp);
                unset($timespace);

                $individu_temp = $this->create_individu();

                break;
            } else {
                $jam_selesai = date('H:i:s', strtotime('+' . $period_waktu * 50 . ' minutes', strtotime($timespace[$id_timespace]['jam_mulai'])));
                $individu_temp[] = array(
                    'id_kromosom' => $value['id_individu'],
                    'id_timespace' => $timespace[$id_timespace]['id_timespace'],
                    'id_waktu' => $timespace[$id_timespace]['id_waktu'],
                    'hari' => $timespace[$id_timespace]['hari'],
                    'jam_mulai' => $timespace[$id_timespace]['jam_mulai'],
                    'jam_selesai' => $jam_selesai,
                    'nama_kelas' => $value['nama_kelas'],
                    'period' => $value['period'],
                    'id_ruang' => $timespace[$id_timespace]['id_ruang'],
                    'kapasitas' => $timespace[$id_timespace]['kapasitas'],
                    'label_timespace' => $timespace[$id_timespace]['label'] . $jam_selesai,
                );

                for ($t = 0; $t < $period_waktu; $t++) {
                    $id_timespace += $t;
                    $timespace[$id_timespace]['status'] = 1;
                }
            }
        }

        return $individu_temp;
    }

    // === PEMBARUAN SELEKSI

    public function update_selection()
    {
        $populasi_breeding = $this->populasi_breeding;
        $this->populasi_breeding = array();
        foreach ($populasi_breeding as $key => $value) {
            $this->populasi_breeding[] = array(
                'arr_gen' => $value['arr_gen'],
                'fitness' => $value['fitness'],
            );
        }

        foreach ($this->individu_update_calon as $key => $value) {
            $this->populasi_breeding[] = array(
                'arr_gen' => $value['offspring'],
                'fitness' => $value['fitness'],
            );
        }

        $this->total_fitness = $this->count_total_fitness_populasi_breeding();

        $this->roulette_wheel_selection();

        foreach ($this->populasi_breeding_selected as $key => $value) {
            $this->populasi_baru[] = $value['arr_gen'];
        }

        $this->individu_update_calon = null;
        if ($this->dump) d($this->populasi_baru);
    }

    public function count_total_fitness_populasi_breeding()
    {
        $total = 0;
        foreach ($this->populasi_breeding as $key => $value) {
            $total += $value['fitness'];
        }

        return $total;
    }

    // === UPDATE POPULASI BARU

    public function update_population()
    {
        $this->populasi = array();
        foreach ($this->populasi_baru as $key => $value) {
            $this->populasi[] = $value;
        }

        $this->populasi_baru = null;
        if ($this->dump) d($this->populasi_baru);
    }

    // === DAPATKAN SOLUSI

    public function get_solution()
    {
        $max_fitness = 0;
        $idx = null;
        foreach ($this->populasi_breeding_selected as $key => $value) {
            if ($value['fitness'] > $max_fitness) {
                $max_fitness = $value['fitness'];
                $idx = $key;
            }
        }

        foreach ($this->populasi_breeding_selected[$idx]['arr_gen'] as $key => $value) {
            $this->populasi_breeding_selected[$idx]['arr_gen'][$key]['id_kelas'] = $this->kromosom[$value['id_kromosom']]['id_kelas'];
            $this->populasi_breeding_selected[$idx]['arr_gen'][$key]['id_waktu'] = $this->timespace[$value['id_timespace']]['id_waktu'];
            $this->populasi_breeding_selected[$idx]['arr_gen'][$key]['id_ruang'] = $this->timespace[$value['id_timespace']]['id_ruang'];
            $this->populasi_breeding_selected[$idx]['arr_gen'][$key]['period'] = $this->kromosom[$value['id_kromosom']]['period'];

            $jam_selesai = date('H:i:s', strtotime('+' . $this->kromosom[$value['id_kromosom']]['period'] * 50 . ' minutes', strtotime($this->timespace[$value['id_timespace']]['jam_mulai'])));
            $this->populasi_breeding_selected[$idx]['arr_gen'][$key]['jam_selesai'] = $jam_selesai;
            $this->populasi_breeding_selected[$idx]['arr_gen'][$key]['label_timespace'] = $this->timespace[$value['id_timespace']]['label'] . $jam_selesai;
        }

        return $this->populasi_breeding_selected[$idx];
    }
}
