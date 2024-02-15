<?php

namespace App\Models;

class AngkatanProdiModel extends \CodeIgniter\Model
{
    protected $table            = 'angkatan_prodi';
    protected $primaryKey       = 'id_angkatan_prodi';
    protected $allowedFields    = ['id_prodi', 'tahun', 'jumlah_mahasiswa'];
}
