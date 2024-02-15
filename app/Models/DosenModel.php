<?php

namespace App\Models;

class DosenModel extends \CodeIgniter\Model
{
    protected $table            = 'dosen';
    protected $primaryKey       = 'id_dosen';
    protected $allowedFields    = ['nidn', 'nama_dosen', 'email', 'no_hp'];
}
