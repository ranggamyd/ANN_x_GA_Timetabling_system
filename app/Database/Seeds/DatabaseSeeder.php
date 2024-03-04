<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('DosenSeeder');
        // $this->call('JadwalDosenSeeder');
        // $this->call('JadwalSeeder');
        // $this->call('KelasSeeder');
        // $this->call('MataKuliahSeeder');
        $this->call('AllActiveMataKuliahSeeder');
        // $this->call('AllActiveMataKuliahITSeeder');
        // $this->call('PengampuSeeder');
        $this->call('DosenMataKuliahSeeder');
        $this->call('ProdiSeeder');
        $this->call('RuangSeeder');
        $this->call('RuangProdiSeeder');
        $this->call('SettingSeeder');
        $this->call('UserSeeder');
        $this->call('WaktuSeeder');
        // $this->call('HistoriPeminatSeeder');
        $this->call('AllHistoriPeminatSeeder');
        // $this->call('AngkatanProdiSeeder');
    }
}
