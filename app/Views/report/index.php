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
                        <a href="/report">Laporan</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a>Index</a>
                    </li>
                </ul>
            </div>
            <!-- <div class="ml-md-auto py-2 py-md-0" style="margin-bottom: 20px;">
                <a href="/dosen/create" class="btn btn-primary btn-round"><i class="fas fa-plus-circle mr-2"></i>Tambah Dosen</a>
            </div> -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title fw-bold"><?= $title ?></h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="reporttable" class="display table table-striped table-hover">
                                <thead class="text-center thead-light">
                                    <tr>
                                        <th>No.</th>
                                        <th>NIDN</th>
                                        <th>Nama Dosen</th>
                                        <th>Prodi</th>
                                        <th>Total SKS</th>
                                        <th style="max-width: 280px;">Kelas</th>
                                    </tr>
                                </thead>
                                <tfoot class="text-center thead-light">
                                    <tr>
                                        <th>No.</th>
                                        <th>NIDN</th>
                                        <th>Nama Dosen</th>
                                        <th>Prodi</th>
                                        <th>Total SKS</th>
                                        <th>Kelas</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($dosen as $item) :
                                        $kelasModel = new \App\Models\KelasModel();
                                        $kelas = $kelasModel->where('id_dosen', $item['id_dosen'])
                                            ->join('pengampu', 'kelas.id_kelas = pengampu.id_kelas', 'left')
                                            ->join('mata_kuliah', 'kelas.id_mata_kuliah = mata_kuliah.id_mata_kuliah', 'left')
                                            ->orderBy('kode_mata_kuliah')
                                            ->orderBy('nama_kelas')
                                            ->find();

                                        $total_sks = 0;
                                        foreach ($kelas as $value) {
                                            $total_sks += $value['sks'];
                                        }
                                    ?>
                                        <tr>
                                            <th class="text-center"><?= $i++ ?></th>
                                            <td class="text-center"><?= $item['nidn'] ?></td>
                                            <td><?= $item['nama_dosen'] ?></td>
                                            <td class="text-center"><span class="badge badge-<?= ($item['id_prodi'] == '1') ? 'success' : (($item['id_prodi'] == '2') ? 'warning' : (($item['id_prodi'] == '3') ? 'secondary' : 'light')) ?>"><?= $item['nama_prodi'] ?></td>
                                            <td class="text-center"><?= $total_sks ?></td>
                                            <td class="text-center">
                                                <?php foreach ($kelas as $value) : ?>
                                                    <span class="badge badge-sm badge-light" data-toggle="tooltip" data-placement="bottom" title="<?= $value['nama_mata_kuliah'] ?> <?= substr($value['nama_kelas'], 4, 2) ?>, Semester <?= $value['semester'] ?>, <?= $value['sks'] ?> SKS"><?= $value['nama_kelas'] ?></span>
                                                <?php endforeach ?>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>