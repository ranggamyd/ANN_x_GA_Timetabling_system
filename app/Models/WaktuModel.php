<?php

namespace App\Models;

class WaktuModel extends \CodeIgniter\Model
{
    protected $table            = 'waktu';
    protected $primaryKey       = 'id_waktu';
    protected $allowedFields    = ['hari', 'jam_mulai', 'jam_selesai'];
}
