<?php

namespace App\Models;

class MataKuliahModel extends \CodeIgniter\Model
{
    protected $table            = 'mata_kuliah';
    protected $primaryKey       = 'id_mata_kuliah';
    protected $allowedFields    = ['kode_mata_kuliah', 'nama_mata_kuliah', 'sks', 'semester', 'paket', 'sks', 'sifat', 'id_prodi', 'is_active', 'tahun_prediksi', 'prediksi_peminat', 'kapasitas_maksimal_kelas'];
}
