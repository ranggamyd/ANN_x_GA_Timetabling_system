<?php

namespace App\Libraries;

class SchedulingRules
{
    public function check_time_notover_limit($id_timespace, $timespace, $period_waktu)
    {
        $sts = true;
        if (!isset($timespace[$id_timespace])) {
            $sts = false;

            return $sts;
        }

        $jam_mulai = strtotime($timespace[$id_timespace]['jam_mulai']);
        $jam_selesai = date('H:i:s', strtotime('+' . $period_waktu * 50 . ' minutes', $jam_mulai));

        if (
            strtotime($jam_selesai) > strtotime('17:20:00')
            or (($timespace[$id_timespace]['hari']) == "Jum'at"
                and ($jam_mulai) < strtotime('11:20:00')
                and strtotime($jam_selesai) > strtotime('11:20:00'))
        ) {
            $sts = false;
        }

        return $sts;
    }

    public function check_timespace_class_samepacket_not_sametime($kromosom, $timespace_utama, $individu_classprodi, $value, $id_timespace, $timespace, $prodi)
    {
        $sts = true;
        if (!isset($timespace[$id_timespace])) {
            $sts = false;

            return $sts;
        }

        $value_prodi = explode('|', $value['id_prodi']);

        if (!empty($individu_classprodi['pro'])) {
            foreach ($prodi as $t => $pr) {
                if (
                    isset($individu_classprodi['pro'][$t])
                    && !empty($individu_classprodi['pro'][$t])
                    and in_array($pr['id_prodi'], $value_prodi)
                ) {
                    foreach ($individu_classprodi['pro'][$t] as $i => $item) {
                        if (
                            $kromosom[$item['id_kromosom']]['semester'] == $value['semester']
                            and $timespace_utama[$item['id_timespace']]['id_waktu'] == $timespace[$id_timespace]['id_waktu']
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

    public function check_capacity_class_ok($id_timespace, $timespace, $value)
    {
        $sts = true;
        if (!isset($timespace[$id_timespace])) {
            $sts = false;

            return $sts;
        }

        if ($value['peserta'] > $timespace[$id_timespace]['kapasitas']) $sts = false;

        return $sts;
    }

    public function check_lecture_class_not_sametime($kromosom, $timespace_utama, $individu, $value, $id_timespace, $timespace)
    {
        $sts = true;
        if (!isset($timespace[$id_timespace])) {
            $sts = false;

            return $sts;
        }

        foreach ($individu as $i => $item) {
            $sama = 0;

            if ($kromosom[$item['id_kromosom']]['id_dosen'] == $value['id_dosen']) $sama++;

            // Jika mata kuliah paralel dosen sama, maka aplikasi error
            if (
                $timespace_utama[$item['id_timespace']]['id_waktu'] == $timespace[$id_timespace]['id_waktu']
            ) {
                $sts = false;

                break;
            }
        }

        return $sts;
    }

    public function check_separatesameclass_not_sameday($kromosom, $timespace_utama, $individu, $value, $id_timespace, $timespace)
    {
        $sts = true;
        if (!isset($timespace[$id_timespace])) {
            $sts = false;

            return $sts;
        }

        foreach ($individu as $i => $item) {
            if (
                $kromosom[$item['id_kromosom']]['id_kelas'] == $value['id_kelas']
                and $timespace_utama[$item['id_timespace']]['hari'] == $timespace[$id_timespace]['hari']
            ) {
                $sts = false;

                break;
            }
        }

        return $sts;
    }

    public function check_neighborpacketclass_not_sametime($kromosom, $timespace_utama, $individu_classprodi, $value, $id_timespace, $timespace, $prodi)
    {
        $sts = true;
        if (!isset($timespace[$id_timespace])) {
            $sts = false;

            return $sts;
        }

        $smt_neighbor = $this->get_neighbor_sametype_semester($value['semester']);

        $value_prodi = explode('|', $value['id_prodi']);

        if (!empty($individu_classprodi['pro'])) {
            foreach ($prodi as $t => $pr) {
                if (
                    isset($individu_classprodi['pro'][$t])
                    && !empty($individu_classprodi['pro'][$t])
                    and in_array($pr['id_prodi'], $value_prodi)
                ) {
                    foreach ($individu_classprodi['pro'][$t] as $i => $item) {
                        if (
                            $kromosom[$item['id_kromosom']]['sifat'] == $value['sifat']
                            and $value['sifat'] == 'Wajib'
                            and (in_array($kromosom[$item['id_kromosom']]['semester'], $smt_neighbor))
                            and $timespace_utama[$item['id_timespace']]['id_waktu'] == $timespace[$id_timespace]['id_waktu']
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

    function get_neighbor_sametype_semester($smt)
    {
        $arr_smt_ganjil = array(1, 3, 5, 7);
        $arr_smt_genap = array(2, 4, 6, 8);
        $arr_neighbor = array();

        if (in_array($smt, $arr_smt_ganjil)) {
            foreach ($arr_smt_ganjil as $key => $value) {
                if (($smt == $value)) {
                    if (isset($arr_smt_ganjil[$key - 1])) {
                        $arr_neighbor[] = $arr_smt_ganjil[$key - 1];
                    }
                    if (isset($arr_smt_ganjil[$key + 1])) {
                        $arr_neighbor[] = $arr_smt_ganjil[$key + 1];
                    }
                }
            }
        } else {
            foreach ($arr_smt_genap as $key => $value) {
                if (($smt == $value)) {
                    if (isset($arr_smt_genap[$key - 1])) {
                        $arr_neighbor[] = $arr_smt_genap[$key - 1];
                    }
                    if (isset($arr_smt_genap[$key + 1])) {
                        $arr_neighbor[] = $arr_smt_genap[$key + 1];
                    }
                }
            }
        }

        return $arr_neighbor;
    }

    // public function check_timespace_paralelclass_is_sametime($kromosom, $timespace_utama, $individu, $value, $id_timespace, $timespace)
    // {
    //     $sts = false;

    //     // trapping jika undefined maka lgsg false, cari id_timespace yg lain
    //     if (!isset($timespace[$id_timespace])) {
    //         $sts = false;
    //         return $sts;
    //     }

    //     foreach ($individu as $i => $item) {

    //         if (
    //             $kromosom[$item['id_kromosom']]['id_mkkur'] == $value['id_mkkur']
    //             and $timespace_utama[$item['id_timespace']]['id_waktu'] == $timespace[$id_timespace]['id_waktu']
    //         ) {
    //             $sts = true;
    //             break;
    //         }
    //     }

    //     return $sts;
    // }
}
