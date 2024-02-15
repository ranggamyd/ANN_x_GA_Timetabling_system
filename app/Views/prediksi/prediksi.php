<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>
<div class="content">
    <div class="page-inner py-4">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div class="page-header d-flex align-items-center">
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="/">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="/prediksi">Prediksi</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a>Prediksi Peserta</a>
                    </li>
                </ul>
            </div>
            <div class="ml-md-auto py-2 py-md-0" style="margin-bottom: 20px;">
                <button type="button" onclick="window.history.go(-1); return false;" class="btn btn-outline-secondary btn-round mr-2"><i class="fas fa-angle-left mr-2 fa-sm"></i>Kembali</button>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="alert alert-primary shadow" role="alert">
                    <div class="row">
                        <div class="col-1">
                            <a href="/setting" class="btn btn-primary btn-block h-100 d-flex justify-content-center align-items-center"><i class="fas fa-wrench fa-2x"></i></a>
                        </div>
                        <div class="col pt-2">
                            <dl class="row mb-0">
                                <dt class="col-sm-2">Tahun Akademik</dt>
                                <dd class="col-sm-10">: <?= $setting['tahun_akademik'] ?></dd>
                                <dt class="col-sm-2">Paket Semester</dt>
                                <dd class="col-sm-10">: <?= $setting['paket_semester'] ?></dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card shadow-none">
                    <form action="/prediksi/lakukan_prediksi" method="post" id="predictForm">
                        <?= csrf_field() ?>

                        <div class="card-header p-0">
                            <div class="card shadow p-3 m-0 flex-row justify-content-between align-items-center">
                                <h4 class="card-title fw-bold"><?= $title ?></h4>
                                <div>
                                    <button type="reset" class="btn btn-outline-secondary"><i class="fas fa-sync mr-2 fa-sm"></i>Reset</button>
                                    <button type="button" class="btn btn-primary" id="predictBtn"><i class="fas fa-signature mr-2 fa-sm"></i>Prediksi</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body bg-light px-0">
                            <!-- <div class="card">
                                <div class="card-header align-middle">
                                    <h4 class="card-title fw-bold"># Histori Angkatan</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="" class="display table table-hover">
                                            <thead class="text-center thead-light">
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Kode</th>
                                                    <th>Prodi</th>
                                                    <th>Fakultas</th>
                                                    <?php foreach ($tahun as $item) : ?>
                                                        <th style="width: 50px;"><?= $item ?></th>
                                                    <?php endforeach ?>
                                                </tr>
                                            </thead>
                                            <tfoot class="text-center thead-light">
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Kode</th>
                                                    <th>Prodi</th>
                                                    <th>Fakultas</th>
                                                    <?php foreach ($tahun as $item) : ?>
                                                        <th style="width: 50px;"><?= $item ?></th>
                                                    <?php endforeach ?>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                foreach ($prodi as $item) :
                                                ?>
                                                    <tr>
                                                        <th class="text-center"><?= $i++ ?></th>
                                                        <td class="text-center"><?= $item['kode_prodi'] ?></td>
                                                        <td><?= $item['nama_prodi'] ?></td>
                                                        <td class="text-center"><?= $item['fakultas'] ?></td>
                                                        <?php foreach ($tahun as $t) : ?>
                                                            <th style="padding: 0!important;">
                                                                <?php
                                                                // $angkatanProdiModel = model('AngkatanProdiModel');
                                                                // $jumlah_mahasiswa = 0;
                                                                // $rekap = $angkatanProdiModel->where(['id_prodi' => $item['id_prodi'], 'tahun' => $t])->first();
                                                                // if ($rekap) {
                                                                //     $jumlah_mahasiswa = $rekap['jumlah_mahasiswa'];
                                                                // }
                                                                ?>
                                                                <input type="number" name="jumlah_mahasiswa[<?= $item['id_prodi'] ?>][<?= $t ?>]" value="<?= $jumlah_mahasiswa ?>" min="0" class="form-control text-right" id="jumlah_mahasiswa[<?= $item['id_prodi'] ?>][<?= $t ?>]" <?= $jumlah_mahasiswa < 1 ? 'autofocus' : '' ?> required>
                                                            </th>
                                                        <?php endforeach ?>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> -->
                            <div class="card mb-0">
                                <div class="card-header">
                                    <h4 class="card-title fw-bold"># Histori Peserta</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="" class="display table table-hover">
                                            <thead class="text-center thead-light">
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Kode</th>
                                                    <th>Mata Kuliah</th>
                                                    <th>Semester</th>
                                                    <th>Prodi</th>
                                                    <?php foreach ($tahun as $item) : ?>
                                                        <th style="width: 50px;"><?= $item ?></th>
                                                    <?php endforeach ?>
                                                </tr>
                                            </thead>
                                            <tfoot class="text-center thead-light">
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Kode</th>
                                                    <th>Mata Kuliah</th>
                                                    <th>Semester</th>
                                                    <th>Prodi</th>
                                                    <?php foreach ($tahun as $item) : ?>
                                                        <th style="width: 50px;"><?= $item ?></th>
                                                    <?php endforeach ?>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                foreach ($mata_kuliah as $item) :
                                                ?>
                                                    <tr>
                                                        <th class="text-center"><?= $i++ ?></th>
                                                        <td class="text-center"><?= $item['kode_mata_kuliah'] ?></td>
                                                        <td><?= $item['nama_mata_kuliah'] ?></td>
                                                        <td class="text-center"><?= $item['semester'] ?></td>
                                                        <td class="text-center"><span class="badge badge-<?= ($item['id_prodi'] == '1') ? 'success' : (($item['id_prodi'] == '2') ? 'warning' : (($item['id_prodi'] == '3') ? 'secondary' : 'light')) ?>"><?= $item['nama_prodi'] ?></td>
                                                        <?php foreach ($tahun as $t) : ?>
                                                            <th style="padding: 0!important;" class="text-center">
                                                                <?php
                                                                $historiPeminatModel = model('HistoriPeminatModel');
                                                                $jumlah_peminat = 0;
                                                                $rekap = $historiPeminatModel->where(['id_mata_kuliah' => $item['id_mata_kuliah'], 'tahun' => $t])->first();
                                                                if ($rekap) {
                                                                    $jumlah_peminat = $rekap['jumlah_peminat'];
                                                                    $persentase = $rekap['persentase'];
                                                                }
                                                                ?>
                                                                <input type="number" name="jumlah_peminat[<?= $item['id_mata_kuliah'] ?>][<?= $t ?>]" value="<?= $jumlah_peminat ?>" min="0" class="form-control text-right" id="jumlah_peminat[<?= $item['id_mata_kuliah'] ?>][<?= $t ?>]" <?= $jumlah_peminat < 1 ? 'autofocus' : '' ?> required>
                                                                <!-- <small class="text-primary"><?= number_format($persentase, 2) ?>%</small> -->
                                                            </th>
                                                        <?php endforeach ?>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>