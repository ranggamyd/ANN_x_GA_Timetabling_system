<?php

namespace App\Models;

class PengampuModel extends \CodeIgniter\Model
{
    protected $table            = 'pengampu';
    protected $primaryKey       = 'id_pengampu';
    protected $allowedFields    = ['id_dosen', 'id_kelas'];
}
