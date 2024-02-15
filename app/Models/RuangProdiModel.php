<?php

namespace App\Models;

class RuangProdiModel extends \CodeIgniter\Model
{
    protected $table            = 'ruang_prodi';
    protected $primaryKey       = 'id_ruang';
    protected $allowedFields    = ['id_ruang', 'id_prodi'];
}
