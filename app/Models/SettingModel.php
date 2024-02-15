<?php

namespace App\Models;

class SettingModel extends \CodeIgniter\Model
{
    protected $table            = 'setting';
    protected $primaryKey       = 'id_setting';
    protected $allowedFields    = ['tahun_akademik', 'paket_semester', 'learning_rate', 'epochs', 'momentum', 'threshold', 'min_peserta', 'max_peserta', 'populasi', 'generasi', 'crossover', 'mutasi'];
}
