<?php

namespace App\Models;

class PrediksiModel extends \CodeIgniter\Model
{
    function get_recap_by_id($id_mata_kuliah)
    {
        $query =
            "SELECT
                histori_peminat.id_histori_peminat AS id,
                mata_kuliah.kode_mata_kuliah AS kode,
                mata_kuliah.nama_mata_kuliah AS nama,
                histori_peminat.tahun AS tahun,
                histori_peminat.jumlah_peminat AS jml_peminat,
                (SELECT MAX(jumlah_peminat) FROM histori_peminat) AS maks,
                (SELECT MIN(jumlah_peminat) FROM histori_peminat) AS mins,
                (SELECT MAX(jumlah_peminat) FROM histori_peminat) - (SELECT MIN(jumlah_peminat) FROM histori_peminat) AS selisih,
                (0.8 * (jumlah_peminat - (SELECT MIN(jumlah_peminat) FROM histori_peminat))) / ((SELECT MAX(jumlah_peminat) FROM histori_peminat) - (SELECT MIN(jumlah_peminat) FROM histori_peminat)) + 0.1 AS interpolasi,  
                ((jumlah_peminat - (SELECT MIN(jumlah_peminat) FROM histori_peminat))) / ((SELECT MAX(jumlah_peminat) FROM histori_peminat) - (SELECT MIN(jumlah_peminat) FROM histori_peminat)) AS interpolasi_0,
                (SELECT MAX(jumlah_peminat) FROM histori_peminat hp WHERE hp.id_mata_kuliah = histori_peminat.id_mata_kuliah) AS max_lokal,
                (SELECT MIN(jumlah_peminat) FROM histori_peminat hp WHERE hp.id_mata_kuliah = histori_peminat.id_mata_kuliah) AS min_lokal
            FROM histori_peminat
            LEFT JOIN mata_kuliah ON histori_peminat.id_mata_kuliah = mata_kuliah.id_mata_kuliah
            WHERE histori_peminat.id_mata_kuliah = '$id_mata_kuliah'
            ORDER BY histori_peminat.tahun ASC";

        return $this->db->query($query)->getResultArray();
    }

    function get_maxmin_jml_peminat_recap()
    {
        $query =
            "SELECT
                (SELECT MAX(jumlah_peminat) FROM histori_peminat) AS maks,
                (SELECT MIN(jumlah_peminat) FROM histori_peminat) AS mins";

        return $this->db->query($query)->getResultArray();
    }
}
