<?php

namespace App\Models;

class HistoriPeminatModel extends \CodeIgniter\Model
{
    protected $table            = 'histori_peminat';
    protected $primaryKey       = 'id_histori_peminat';
    protected $allowedFields    = ['id_mata_kuliah', 'tahun', 'jumlah_peminat'];
}
