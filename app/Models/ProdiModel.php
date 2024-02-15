<?php

namespace App\Models;

class ProdiModel extends \CodeIgniter\Model
{
    protected $table            = 'prodi';
    protected $primaryKey       = 'id_prodi';
    protected $allowedFields    = ['kode_prodi', 'nama_prodi', 'fakultas', 'deskripsi'];
}
