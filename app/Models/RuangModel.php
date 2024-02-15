<?php

namespace App\Models;

class RuangModel extends \CodeIgniter\Model
{
    protected $table            = 'ruang';
    protected $primaryKey       = 'id_ruang';
    protected $allowedFields    = ['kode_ruang', 'nama_ruang', 'kapasitas'];
}
