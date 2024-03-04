<?php

namespace App\Models;

class DosenMataKuliahModel extends \CodeIgniter\Model
{
    protected $table            = 'dosen_mata_kuliah';
    protected $primaryKey       = 'id_dosen_mata_kuliah';
    protected $allowedFields    = ['id_dosen', 'id_mata_kuliah'];
}
