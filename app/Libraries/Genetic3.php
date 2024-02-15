<?php

namespace App\Libraries;

ini_set('max_execution_time', 0);
ini_set('memory_limit', -1);

class Genetic3
{
    var $prodi = null;
    var $kelas = null;
    var $ruang = null;
    var $waktu = null;
    var $setting = null;
    var $pc = null;
    var $pm = null;
    var $min_prosen_capacity = null;
    
    var $timespace = null;
    var $kromosom = [];
    var $populasi = [];

    var $populasi_breeding = [];
    var $total_fitness = 0;

    var $populasi_breeding_selected = [];

    var $individu_breed = [];

    var $individu_update_calon = [];

    var $populasi_baru = [];

    var $aturan_jadwal;

    public function __construct()
    {
        $this->aturan_jadwal = new \App\Libraries\SchedulingRules2();
    }

    //===================================================================================================================

    public function initialize($prodi, $kelas, $ruang, $waktu, $setting)
    {
        $this->prodi = $prodi;
        $this->kelas = $kelas;
        $this->ruang = $ruang;
        $this->waktu = $waktu;
        $this->setting = $setting;
        $this->pc = $setting['crossover'];
        $this->pm = $setting['mutasi'];
        $this->min_prosen_capacity = 50;

        // INITIALIZE TIMESPACE
        $i = 0;
        foreach ($this->ruang as $ruang) {
            foreach ($this->waktu as $waktu) {
                $this->timespace[] = array(
                    'id_timespace' => $i++,
                    'id_ruang' => $ruang['id_ruang'],
                    'kapasitas' => $ruang['kapasitas'],
                    'id_waktu' => $waktu['id_waktu'],
                    'hari' => $waktu['hari'],
                    'jam_mulai' => $waktu['jam_mulai'],
                    'label' => $ruang['nama_ruang'] . ', ' . $waktu['hari'] . ' ' . $waktu['jam_mulai'] . '-',
                    'status' => '',
                );
            }
        }
    }

    //===================================================================================================================

    // Kromosom = kelas
    // Individu = kromosom + timespace
    // Populasi = kumpulan individu
    public function generate_population()
    {
        $this->kromosom = $this->create_information_class();

        $this->populasi = [];
        for ($i = 0; $i < $this->setting['populasi']; $i++) {
            $individu = $this->create_individu();

            $this->populasi[] = $individu;
        }
    }

    public function create_information_class()
    {
        $class = [];

        $id_individu = 0;
        foreach ($this->kelas as $kelas) {
            $sks = $kelas['sks'];
            $data = $this->make_class(compact('class', 'sks', 'kelas', 'id_individu'));

            extract($data);
        }

        return $class;
    }

    public function make_class($data)
    {
        // 'class', 'sks', 'kelas', 'id_individu'
        extract($data);

        $class[] = array(
            'id_individu' => $id_individu,
            'id_kelas' => $kelas['id_kelas'],
            'nama_kelas' => $kelas['nama_kelas'],
            'prediksi_peserta' => $kelas['prediksi_peserta'],
            'kelas_prodi' => $kelas['id_prodi'],
            'id_mata_kuliah' => $kelas['id_mata_kuliah'],
            'sks' => $sks,
            'semester' => $kelas['semester'],
            'sifat' => $kelas['sifat'],
            'dosen' => [['id_dosen' => $kelas['id_dosen']]],
            'alternatif_waktu_ajar' => !empty($kelas['alternatif_waktu_ajar']) ? implode('|', array_column($kelas['alternatif_waktu_ajar'], 'id_waktu')) : null,
            'ruang_blok_prodi' => !empty($kelas['ruang_prodi']) ? implode('|', array_column($kelas['ruang_prodi'], 'id_ruang')) : null,
        );

        $id_individu++;

        return compact('class', 'sks', 'kelas', 'id_individu');
    }

    public function create_individu()
    {
        $individu = [];

        $timespace = $this->timespace;
        $reset = false;

        foreach ($this->kromosom as $kromosom) {
            $data = $this->get_feasible_individu(compact('timespace', 'individu', 'kromosom', 'reset'));

            if ($reset) {
                unset($individu);
                unset($timespace);

                return $this->create_individu();
            }

            extract($data);
        }

        return $individu;
    }

    public function get_feasible_individu($data)
    {
        // 'timespace', 'individu', 'kromosom', 'reset'
        extract($data);

        $sks = $kromosom['sks'];
        $individu_classprodi = $this->break_individu_prodi($individu);

        $id_timespace = $this->getRandomTimespace($individu_classprodi, $individu, $kromosom, $timespace, $sks, 0);

        if ($id_timespace !== 'nochance') {
            $jam_selesai = $this->get_jam_selesai_kelas($timespace[$id_timespace]['jam_mulai'], $sks);

            $individu[] = array(
                'id_kromosom' => $kromosom['id_individu'],
                'nama_kelas' => $kromosom['nama_kelas'],
                'sks' => $kromosom['sks'],
                'id_timespace' => $timespace[$id_timespace]['id_timespace'],
                'id_ruang' => $timespace[$id_timespace]['id_ruang'],
                'kapasitas' => $timespace[$id_timespace]['kapasitas'],
                'id_waktu' => $timespace[$id_timespace]['id_waktu'],
                'hari' => $timespace[$id_timespace]['hari'],
                'jam_mulai' => $timespace[$id_timespace]['jam_mulai'],
                'jam_selesai' => $jam_selesai,
                'label_timespace' => $timespace[$id_timespace]['label'] . $jam_selesai,
            );

            for ($t = 0; $t < $sks; $t++) {
                $id_timespace += $t;
                $timespace[$id_timespace]['status'] = 1;
            }
        } else $reset = true;

        return compact('timespace', 'individu', 'kromosom', 'reset');
    }

    public function break_individu_prodi($individu)
    {
        $p = null;
        foreach ($individu as $t => $ind) {
            foreach ($this->prodi as $t => $pr) {
                $kelas_prodi = explode('|', $this->kromosom[$ind['id_kromosom']]['kelas_prodi']);

                if (!empty($kelas_prodi) and in_array($pr['id_prodi'], $kelas_prodi)) $p[$t][] = $ind;
            }
        }

        return ["pro" => $p];
    }

    function getRandomTimespace($individu_classprodi, $individu, $kromosom, $timespace, $sks, $iteration, $id_ts = null)
    {
        $iteration++;
        if ($iteration == 10000) return 'nochance';

        $id_timespace = mt_rand(0, count($timespace) - 1);
        if ($id_ts != null) $id_timespace = $id_ts;

        $sts = true;
        for ($t = 0; $t < $sks; $t++) {
            $ts_ok = true;

            $id_ts = $id_timespace + $t;
            if (!isset($timespace[$id_ts]) or $timespace[$id_ts]['status'] == 1) $ts_ok = false;

            $sts = $sts && $ts_ok;
        }

        if ($sts) {
            $rule_ok = $this->check_on_hardrule($individu_classprodi, $individu, $kromosom, $id_timespace, $timespace, $sks);

            if ($rule_ok) {
                return $id_timespace;
            } else return $this->getRandomTimespace($individu_classprodi, $individu, $kromosom, $timespace, $sks, $iteration);
        } else return $this->getRandomTimespace($individu_classprodi, $individu, $kromosom, $timespace, $sks, $iteration);
    }

    public function check_on_hardrule($individu_classprodi, $individu, $kromosom, $id_timespace, $timespace, $sks)
    {
        $rule_1 = $this->aturan_jadwal->check_time_notover_limit($id_timespace, $timespace, $sks);
        $rule_2 = $this->aturan_jadwal->check_timespace_class_samepacket_not_sametime($this->kromosom, $this->timespace, $individu_classprodi, $kromosom, $id_timespace, $timespace, $this->prodi);
        $rule_3 = $this->aturan_jadwal->check_capacity_class_ok($id_timespace, $timespace, $kromosom);
        $rule_4 = $this->aturan_jadwal->check_lecture_class_not_sametime($this->kromosom, $this->timespace, $individu, $kromosom, $id_timespace, $timespace);
        $rule_5 = true; // $this->aturan_jadwal->check_separatesameclass_not_sameday($this->kromosom, $this->timespace, $individu, $kromosom, $id_timespace, $timespace);
        $rule_6 = true; // $this->aturan_jadwal->check_neighborpacketclass_not_sametime($this->kromosom, $this->timespace, $individu_classprodi, $kromosom, $id_timespace, $timespace, $this->prodi);
        $rule_7 = $this->aturan_jadwal->check_kelas_on_ruangblokprodi($id_timespace, $timespace, $kromosom);
        $rule_8 = $this->aturan_jadwal->check_ruang_not_sametime($individu, $id_timespace, $timespace);

        return $rule_1 && $rule_2 && $rule_3 && $rule_4 && $rule_5 && $rule_6 && $rule_7 && $rule_8;
    }

    public function get_jam_selesai_kelas($jam_mulai, $sks)
    {
        return date('H:i:s', strtotime('+' . $sks * 50 . ' minutes', strtotime($jam_mulai)));
    }

    //===================================================================================================================

    public function count_fitness()
    {
        $this->transform_populasi();

        $this->total_fitness = 0;
        foreach ($this->populasi as $i => $individu) {
            $populasi[$i]['fitness_rule_1'] = 0; // $this->count_fitness_based_rule_kelasmakul_pilihan_wajib_not_sametime($individu);
            $populasi[$i]['fitness_rule_2'] = $this->count_fitness_based_rule_kelasmakul_on_ruangblokprodi($individu);
            $populasi[$i]['fitness_rule_3'] = 0; // $this->count_fitness_based_rule_kelasmakulsepaket_max_8_sks_sehari($individu);
            $populasi[$i]['fitness_rule_4'] = $this->count_fitness_based_rule_kelas_filled_min_prosen_capacity($individu);
            $populasi[$i]['fitness_rule_5'] = $this->count_fitness_based_rule_kelas_dosen_choose_their_time($individu);

            $populasi[$i]['fitness'] = 1 - (($populasi[$i]['fitness_rule_1'] + $populasi[$i]['fitness_rule_2'] + $populasi[$i]['fitness_rule_3'] + $populasi[$i]['fitness_rule_4'] + $populasi[$i]['fitness_rule_5']) / 5);

            $this->populasi_breeding[$i]['fitness'] = $populasi[$i]['fitness'];
            $this->total_fitness += $populasi[$i]['fitness'];
        }

        unset($populasi);
    }

    public function transform_populasi()
    {
        foreach ($this->populasi as $key => $individu) {
            $this->populasi_breeding[$key]['fitness'] = 0;

            foreach ($individu as $i => $gen) {
                $this->populasi_breeding[$key]['arr_gen'][$i] = $gen;
            }
        }
    }

    // public function count_fitness_based_rule_kelasmakul_pilihan_wajib_not_sametime($individu)
    // {
    //     $ind_classprodi = $this->break_individu_prodi($individu);

    //     foreach ($ind_classprodi['pro'] as $i => $arr_kromosom) {
    //         foreach ($arr_kromosom as $k => $kr_pr) {
    //             $data_perprod[$i][] = $kr_pr;
    //         }
    //     }

    //     $jumlah_perprod = 0;
    //     $jumlah_makulpil = 0;
    //     foreach ($data_perprod as $key => $indi_pr) {
    //         $separate_makul = $this->separate_kelas_makul_wajib_pil($indi_pr);

    //         $jumlah = 0;
    //         foreach ($separate_makul['pilihan'] as $i => $pil) {
    //             $smt_neighbor = $this->aturan_jadwal->get_neighbor_sametype_semester($this->kromosom[$pil['id_kromosom']]['semester']);

    //             $bentrok[$i] = 0;
    //             $bentrok_ket[$i] = '';

    //             $sts_bentrok = false;
    //             foreach ($separate_makul['wajib'] as $j => $wjb) {
    //                 if (in_array($this->kromosom[$wjb['id_kromosom']]['semester'], $smt_neighbor) and ($this->bentrok_sametime($pil, $wjb))) {
    //                     $bentrok[$i]++;
    //                     $bentrok_ket[$i] .= $this->kromosom[$wjb['id_kromosom']]['id_kelas'] . ', ';

    //                     $sts_bentrok = true;
    //                 }
    //             }

    //             $separate_makul['pilihan'][$i]['bentrok'] = $bentrok[$i];
    //             $separate_makul['pilihan'][$i]['bentrok_ket'] = $bentrok_ket[$i];

    //             if ($sts_bentrok) $jumlah++;
    //         }
    //         $jumlah_makulpil = $jumlah_makulpil + count($separate_makul['pilihan']);
    //         $jumlah_perprod = $jumlah_perprod + $jumlah;
    //     }

    //     return $jumlah_perprod / $jumlah_makulpil;
    // }

    public function separate_kelas_makul_wajib_pil($individu)
    {
        $wajib = [];
        $pilihan = [];
        foreach ($individu as $value) {
            if ($this->kromosom[$value['id_kromosom']]['sifat'] == 'Wajib') $wajib[] = $value;
            if ($this->kromosom[$value['id_kromosom']]['sifat'] == 'Pilihan') $pilihan[] = $value;
        }

        return ['wajib' => $wajib, 'pilihan' => $pilihan];
    }

    function bentrok_sametime($kls, $kls_compare)
    {
        $sts = $this->timespace[$kls['id_timespace']]['hari'] == $this->timespace[$kls_compare['id_timespace']]['hari'];

        $start_time = strtotime($this->timespace[$kls['id_timespace']]['jam_mulai']);
        $jam_selesai = $this->get_jam_selesai_kelas($this->timespace[$kls['id_timespace']]['jam_mulai'], $this->kromosom[$kls['id_kromosom']]['sks']);
        $end_time = strtotime($jam_selesai);

        $start_compare_time = strtotime($this->timespace[$kls_compare['id_timespace']]['jam_mulai']);
        $jam_selesai_compare = $this->get_jam_selesai_kelas($this->timespace[$kls_compare['id_timespace']]['jam_mulai'], $this->kromosom[$kls_compare['id_kromosom']]['sks']);
        $end_compare_time = strtotime($jam_selesai_compare);

        $sts_time_between = ((($start_time >= $start_compare_time) && ($start_time <= $end_compare_time) or (($end_time >= $start_compare_time) && ($end_time <= $end_compare_time))));
        $sts = $sts && $sts_time_between;

        return $sts;
    }

    public function count_fitness_based_rule_kelasmakul_on_ruangblokprodi($individu)
    {
        $score = 0;
        $i = 0;
        foreach ($individu as $key => $value) {
            $ruang_blok_prodi[$key] = explode('|', $this->kromosom[$value['id_kromosom']]['ruang_blok_prodi']);

            if (
                !empty($ruang_blok_prodi[$key]) &&
                !in_array($this->timespace[$value['id_timespace']]['id_ruang'], $ruang_blok_prodi[$key])
            ) $score++;

            if (!empty($ruang_blok_prodi[$key])) $i++;
        }

        return $score / $i;
    }

    // public function count_fitness_based_rule_kelasmakulsepaket_max_8_sks_sehari($individu)
    // {
    //     $arr_hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', "Jum'at"];

    //     $total_langgar = 0;
    //     foreach ($arr_hari as $i => $hari) {
    //         $arr_grup_hari[$i] = [
    //             'hari' => $hari,
    //             'data_prodi' => []
    //         ];

    //         $jml_prodi_langgar = 0;
    //         foreach ($this->prodi as $j => $prodi) {
    //             $arr_grup_hari[$i]['data_prodi'][$j] = [
    //                 'id_prodi' => $prodi['id_prodi'],
    //                 'data_semester' => []
    //             ];

    //             $jml_smt_langgar = 0;
    //             for ($l = 1; $l <= 8; $l++) {
    //                 $arr_grup_hari[$i]['data_prodi'][$j]['data_semester'][$l] = [
    //                     'paket_semester' => $l,
    //                     'data_kelas' => []
    //                 ];

    //                 $total_sks = 0;
    //                 foreach ($individu as $k => $kelas_terjadwal) {
    //                     $arr_kelas_prodi = explode('|', $this->kromosom[$kelas_terjadwal['id_kromosom']]['kelas_prodi']);
    //                     if (
    //                         $hari == $this->timespace[$kelas_terjadwal['id_timespace']]['hari'] &&
    //                         in_array($prodi['id_prodi'], $arr_kelas_prodi) &&
    //                         $this->kromosom[$kelas_terjadwal['id_kromosom']]['semester'] == $l
    //                     ) {
    //                         $total_sks += $this->kromosom[$kelas_terjadwal['id_kromosom']]['sks'];
    //                         $arr_grup_hari[$i]['data_prodi'][$j]['data_semester'][$l]['data_kelas'][] = $kelas_terjadwal;
    //                     }
    //                 }

    //                 $arr_grup_hari[$i]['data_prodi'][$j]['data_semester'][$l]['total_sks'] = $total_sks;

    //                 if ($total_sks > 8) $jml_smt_langgar++;
    //             }

    //             $arr_grup_hari[$i]['data_prodi'][$j]['jml_smt_langgar'] = $jml_smt_langgar;
    //             if ($jml_smt_langgar > 0) $jml_prodi_langgar++;
    //         }

    //         $arr_grup_hari[$i]['jml_prodi_langgar'] = $jml_prodi_langgar;
    //         $total_langgar += $jml_prodi_langgar;
    //     }

    //     $jml_semesta_himp = count($arr_hari) * count($this->prodi);
    //     return $total_langgar / $jml_semesta_himp;
    // }

    public function count_fitness_based_rule_kelas_filled_min_prosen_capacity($individu)
    {
        $melanggar = 0;
        foreach ($individu as $key => $value) {
            $harapan_jml = ($this->min_prosen_capacity / 100) * $this->timespace[$value['id_timespace']]['kapasitas'];
            $individu[$key]['harapan_jml'] = ceil($harapan_jml);
            $individu[$key]['melanggar'] = 0;

            if ($this->kromosom[$value['id_kromosom']]['prediksi_peserta'] < ceil($harapan_jml)) {
                $individu[$key]['melanggar'] = 1;
                $melanggar++;
                d($this->kromosom[$value['id_kromosom']]['prediksi_peserta']);
                d($individu[$key]);
            }
        }

        return $melanggar / count($individu);
    }

    public function count_fitness_based_rule_kelas_dosen_choose_their_time($individu)
    {
        $jml_langgar = 0;
        foreach ($individu as $value) {
            $alternatif_waktu_ajar = explode('|', $this->kromosom[$value['id_kromosom']]['alternatif_waktu_ajar']);

            if (in_array($this->timespace[$value['id_timespace']]['id_waktu'], $alternatif_waktu_ajar)) $jml_langgar++;
        }

        return $jml_langgar / count($individu);
    }

    //===================================================================================================================

    public function roulette_wheel_selection()
    {
        $populasi_breeding = $this->populasi_breeding;

        foreach ($populasi_breeding as $key => $value) {
            $prob = $value['fitness'] / $this->total_fitness;
            $populasi_breeding[$key]['idx'] = $key;
            $populasi_breeding[$key]['prob'] = round($prob, 5);

            $rentangan[$key]['awal'] = 0;

            if ($key != 0) $rentangan[$key]['awal'] = $rentangan[($key - 1)]['akhir'] + 0.00001;

            $rentangan[$key]['akhir'] = $rentangan[$key]['awal'] + $populasi_breeding[$key]['prob'];
            $random_number[$key] = mt_rand(0, 100000) / 100000;
        }

        $pick_individu = [];
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
    }

    //===================================================================================================================

    public function crossover()
    {
        $populasi_breeding_crossover_selected = [];

        foreach ($this->populasi_breeding_selected as $value) {
            if ($value['val_random'] <= $this->pc) $populasi_breeding_crossover_selected[] = $value;
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
            $offspring[$key]['fitness_rule_1'] = 0; // $this->count_fitness_based_rule_kelasmakul_pilihan_wajib_not_sametime($value['offspring']);
            $offspring[$key]['fitness_rule_2'] = $this->count_fitness_based_rule_kelasmakul_on_ruangblokprodi($value['offspring']);
            $offspring[$key]['fitness_rule_3'] = 0; // $this->count_fitness_based_rule_kelasmakulsepaket_max_8_sks_sehari($value['offspring']);
            $offspring[$key]['fitness_rule_4'] = $this->count_fitness_based_rule_kelas_filled_min_prosen_capacity($value['offspring']);
            $offspring[$key]['fitness_rule_5'] = $this->count_fitness_based_rule_kelas_dosen_choose_their_time($value['offspring']);

            $offspring[$key]['fitness'] = 1 - (($offspring[$key]['fitness_rule_1'] + $offspring[$key]['fitness_rule_2'] + $offspring[$key]['fitness_rule_3'] + $offspring[$key]['fitness_rule_4'] + $offspring[$key]['fitness_rule_5']) / 5);
            $offspring[$key]['randvalmut'] = mt_rand(0, 1);
        }

        $this->individu_breed[] = $offspring;
    }

    //===================================================================================================================

    public function mutation()
    {
        foreach ($this->individu_breed as $key => $value) {
            foreach ($value as $i => $item) {
                if ($item['randvalmut'] < $this->pm) {
                    $this->individu_breed[$key][$i]['offspring'] = $this->mutasi_kromosom($item['offspring']);
                }

                $this->individu_update_calon[] = $this->individu_breed[$key][$i];
            }
        }

        $this->individu_breed = null;
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
        $individu_temp = [];

        $timespace = $this->timespace;

        foreach ($this->kromosom as $kromosom) {
            $individu_classprodi = $this->break_individu_prodi($individu_temp);

            $sks = $kromosom['sks'];

            $id_timespace = $this->getRandomTimespace($individu_classprodi, $individu_temp, $kromosom, $timespace, $sks, 0, $individu[$kromosom['id_individu']]['id_timespace']);

            if ($id_timespace !== 'nochance') {
                $jam_selesai = $this->get_jam_selesai_kelas($timespace[$id_timespace]['jam_mulai'], $sks);

                $individu_temp[] = array(
                    'id_kromosom' => $kromosom['id_individu'],
                    'nama_kelas' => $kromosom['nama_kelas'],
                    'sks' => $kromosom['sks'],
                    'id_timespace' => $timespace[$id_timespace]['id_timespace'],
                    'id_ruang' => $timespace[$id_timespace]['id_ruang'],
                    'kapasitas' => $timespace[$id_timespace]['kapasitas'],
                    'id_waktu' => $timespace[$id_timespace]['id_waktu'],
                    'hari' => $timespace[$id_timespace]['hari'],
                    'jam_mulai' => $timespace[$id_timespace]['jam_mulai'],
                    'jam_selesai' => $jam_selesai,
                    'label_timespace' => $timespace[$id_timespace]['label'] . $jam_selesai,
                );

                for ($t = 0; $t < $sks; $t++) {
                    $id_timespace += $t;
                    $timespace[$id_timespace]['status'] = 1;
                }
            } else {
                unset($individu_temp);
                unset($timespace);

                $individu_temp = $this->create_individu();

                break;
            }
        }

        return $individu_temp;
    }

    //===================================================================================================================

    public function update_selection()
    {
        $populasi_breeding = $this->populasi_breeding;

        $this->populasi_breeding = [];
        foreach ($populasi_breeding as $value) {
            $this->populasi_breeding[] = [
                'fitness' => $value['fitness'],
                'arr_gen' => $value['arr_gen']
            ];
        }

        foreach ($this->individu_update_calon as $value) {
            $this->populasi_breeding[] = [
                'fitness' => $value['fitness'],
                'arr_gen' => $value['offspring']
            ];
        }

        $this->total_fitness = $this->count_total_fitness_populasi_breeding();

        $this->roulette_wheel_selection();

        foreach ($this->populasi_breeding_selected as $value) {
            $this->populasi_baru[] = $value['arr_gen'];
        }

        $this->individu_update_calon = null;
    }

    public function count_total_fitness_populasi_breeding()
    {
        $total = 0;
        foreach ($this->populasi_breeding as $value) {
            $total += $value['fitness'];
        }

        return $total;
    }

    //===================================================================================================================

    public function update_population()
    {
        $this->populasi = [];
        foreach ($this->populasi_baru as $value) {
            $this->populasi[] = $value;
        }

        $this->populasi_baru = null;
    }

    //===================================================================================================================

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
            $this->populasi_breeding_selected[$idx]['arr_gen'][$key]['sks'] = $this->kromosom[$value['id_kromosom']]['sks'];

            $jam_selesai = $this->get_jam_selesai_kelas($this->timespace[$value['id_timespace']]['jam_mulai'], $this->kromosom[$value['id_kromosom']]['sks']);

            $this->populasi_breeding_selected[$idx]['arr_gen'][$key]['jam_selesai'] = $jam_selesai;
            $this->populasi_breeding_selected[$idx]['arr_gen'][$key]['label_timespace'] = $this->timespace[$value['id_timespace']]['label'] . $jam_selesai;
        }

        return $this->populasi_breeding_selected[$idx];
    }
}
