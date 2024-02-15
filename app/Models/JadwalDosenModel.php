<?php

namespace App\Models;

class JadwalDosenModel extends \CodeIgniter\Model
{
    protected $table            = 'jadwal_dosen';
    protected $primaryKey       = 'id_jadwal_dosen';
    protected $allowedFields    = ['id_dosen', 'id_waktu'];
}
