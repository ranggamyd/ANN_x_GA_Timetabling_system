<?php

namespace App\Libraries;

ini_set('max_execution_time', 0);
ini_set('memory_limit', -1);

class SchedulingRules2
{
    public function check_time_notover_limit($id_timespace, $timespace, $sks)
    {
        $sts = true;

        if (!isset($timespace[$id_timespace])) return false;

        $hari = ($timespace[$id_timespace]['hari']);
        $jam_mulai = strtotime($timespace[$id_timespace]['jam_mulai']);
        $durasi = $sks * 50;
        $jam_selesai = strtotime(date('H:i:s', strtotime('+' . $durasi . ' minutes', $jam_mulai)));

        if (
            ($jam_selesai > strtotime('17:20:00')) ||
            ($hari == "Jum'at" &&
                ($jam_mulai < strtotime('11:20:00')) &&
                ($jam_selesai > strtotime('11:20:00'))
            )
        ) $sts = false;

        return $sts;
    }

    public function check_timespace_class_samepacket_not_sametime($kromosom_utama, $timespace_utama, $individu_classprodi, $kromosom, $id_timespace, $timespace, $prodi)
    {
        $sts = true;

        if (!isset($timespace[$id_timespace])) return false;

        $kelas_prodi = explode('|', $kromosom['kelas_prodi']);

        if (!empty($individu_classprodi['pro'])) {
            foreach ($prodi as $t => $pr) {
                if (
                    isset($individu_classprodi['pro'][$t]) &&
                    !empty($individu_classprodi['pro'][$t]) &&
                    in_array($pr['id_prodi'], $kelas_prodi)
                ) {
                    foreach ($individu_classprodi['pro'][$t] as $item) {
                        if (
                            ($kromosom_utama[$item['id_kromosom']]['semester'] == $kromosom['semester']) &&
                            ($timespace_utama[$item['id_timespace']]['id_waktu'] == $timespace[$id_timespace]['id_waktu'])
                        ) {
                            $sts = false;

                            break;
                        }
                    }
                }
            }
        }

        return $sts;
    }

    public function check_capacity_class_ok($id_timespace, $timespace, $kromosom)
    {
        $sts = true;

        if (!isset($timespace[$id_timespace])) return false;

        if ($kromosom['prediksi_peserta'] > $timespace[$id_timespace]['kapasitas']) $sts = false;

        return $sts;
    }

    public function check_lecture_class_not_sametime($kromosom_utama, $timespace_utama, $individu, $kromosom, $id_timespace, $timespace)
    {
        $sts = true;

        if (!isset($timespace[$id_timespace])) return false;

        foreach ($individu as $item) {
            if (!empty($kromosom_utama[$item['id_kromosom']]['dosen'])) {
                $sama = 0;
                foreach ($kromosom_utama[$item['id_kromosom']]['dosen'] as $item_dosen) {
                    if (!empty($kromosom['dosen'])) {
                        foreach ($kromosom['dosen'] as $item_dosen_current_class) {
                            if ($item_dosen == $item_dosen_current_class) $sama++;
                        }
                    }
                }

                if (count($kromosom_utama[$item['id_kromosom']]['dosen']) == $sama and $timespace_utama[$item['id_timespace']]['id_waktu'] == $timespace[$id_timespace]['id_waktu']) {
                    $sts = false;

                    break;
                }
            }
        }

        return $sts;
    }

    // public function check_separatesameclass_not_sameday($kromosom, $timespace_utama, $individu, $value, $id_timespace, $timespace)
    // {
    //     $sts = true;

    //     if (!isset($timespace[$id_timespace])) {
    //         $sts = false;
    //         return $sts;
    //     }

    //     foreach ($individu as $i => $item) {
    //         if (
    //             $kromosom[$item['id_kromosom']]['id_kelas'] == $value['id_kelas']
    //             and $timespace_utama[$item['id_timespace']]['hari'] == $timespace[$id_timespace]['hari']
    //         ) {
    //             $sts = false;
    //             break;
    //         }
    //     }

    //     return $sts;
    // }

    // public function check_neighborpacketclass_not_sametime($kromosom, $timespace_utama, $individu_classprodi, $value, $id_timespace, $timespace, $prodi)
    // {
    //     $sts = true;

    //     if (!isset($timespace[$id_timespace])) {
    //         $sts = false;
    //         return $sts;
    //     }

    //     $smt_neighbor = $this->get_neighbor_sametype_semester($value['semester']);

    //     $value_prodi = explode('|', $value['kelas_prodi']);

    //     if ($value['is_universal'] == '0' && !empty($individu_classprodi['pro'])) {
    //         foreach ($prodi as $t => $pr) {
    //             if (isset($individu_classprodi['pro'][$t]) && !empty($individu_classprodi['pro'][$t]) and in_array($pr['id_prodi'], $value_prodi)) {
    //                 foreach ($individu_classprodi['pro'][$t] as $i => $item) {
    //                     if (
    //                         ($kromosom[$item['id_kromosom']]['sifat'] == $value['sifat'])
    //                         && ($value['sifat'] == 'Wajib')
    //                         && (in_array($kromosom[$item['id_kromosom']]['semester'], $smt_neighbor))
    //                         && ($timespace_utama[$item['id_timespace']]['id_waktu'] == $timespace[$id_timespace]['id_waktu'])
    //                     ) {
    //                         $sts = false;
    //                         break;
    //                     }
    //                 }
    //             }
    //         }
    //     }

    //     return $sts;
    // }

    public function check_kelas_on_ruangblokprodi($id_timespace, $timespace, $kromosom)
    {
        $sts = true;

        if (!isset($timespace[$id_timespace])) return false;

        $ruang_blok_prodi = explode('|', $kromosom['ruang_blok_prodi']);
        if (!empty($ruang_blok_prodi) and !in_array($timespace[$id_timespace]['id_ruang'], $ruang_blok_prodi)) $sts = false;

        return $sts;
    }

    function check_ruang_not_sametime($individu, $id_timespace, $timespace)
    {
        $bentrok = true;

        if (!isset($timespace[$id_timespace])) return false;

        foreach ($individu as $jadwal1) {
            foreach ($individu as $jadwal2) {
                if ($jadwal1 != $jadwal2 && $this->isBentrok($jadwal1, $jadwal2)) {
                    $bentrok = false;

                    break 2;
                }
            }
        }

        return $bentrok;
    }

    function isBentrok($jadwal1, $jadwal2)
    {
        return (
            $jadwal1['id_ruang'] == $jadwal2['id_ruang'] &&
            $jadwal1['hari'] == $jadwal2['hari'] &&
            ($jadwal1['jam_mulai'] >= $jadwal2['jam_mulai'] &&
                $jadwal1['jam_mulai'] < $jadwal2['jam_selesai'] ||
                $jadwal2['jam_mulai'] >= $jadwal1['jam_mulai'] &&
                $jadwal2['jam_mulai'] < $jadwal1['jam_selesai'])
        );
    }

    //===================================================================================================================

    function get_neighbor_sametype_semester($semester)
    {
        $arr_ganjil = [1, 3, 5, 7];
        $arr_genap = [2, 4, 6, 8];
        $arr_neighbor = [];

        if (in_array($semester, $arr_ganjil)) {
            foreach ($arr_ganjil as $key => $value) {
                if (($semester == $value)) {
                    if (isset($arr_ganjil[$key - 1])) $arr_neighbor[] = $arr_ganjil[$key - 1];
                    if (isset($arr_ganjil[$key + 1])) $arr_neighbor[] = $arr_ganjil[$key + 1];
                }
            }
        } else {
            foreach ($arr_genap as $key => $value) {
                if (($semester == $value)) {
                    if (isset($arr_genap[$key - 1])) $arr_neighbor[] = $arr_genap[$key - 1];
                    if (isset($arr_genap[$key + 1])) $arr_neighbor[] = $arr_genap[$key + 1];
                }
            }
        }

        return $arr_neighbor;
    }
}
