<?php

namespace App\Models;

class JadwalModel extends \CodeIgniter\Model
{
    protected $table            = 'jadwal';
    protected $primaryKey       = 'id_jadwal';
    protected $allowedFields    = ['id_waktu', 'jam_selesai', 'id_kelas', 'id_ruang'];
}
