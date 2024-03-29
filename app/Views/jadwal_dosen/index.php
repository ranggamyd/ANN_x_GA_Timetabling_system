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
                        <a href="/jadwal_dosen">Jadwal Dosen</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a>Index</a>
                    </li>
                </ul>
            </div>
            <div class="ml-md-auto py-2 py-md-0" style="margin-bottom: 20px;">
                <!-- <a href="/dosen/create" class="btn btn-primary btn-round"><i class="fas fa-plus-circle mr-2"></i>Tambah Dosen</a> -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title fw-bold"><?= $title ?></h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="display table table-striped table-hover">
                                <thead class="text-center thead-light">
                                    <tr>
                                        <th>No.</th>
                                        <th>NIDN</th>
                                        <th>Nama Dosen</th>
                                        <th>Total</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tfoot class="text-center thead-light">
                                    <tr>
                                        <th>No.</th>
                                        <th>NIDN</th>
                                        <th>Nama Dosen</th>
                                        <th>Total</th>
                                        <th>Opsi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($dosen as $item) :
                                    ?>
                                        <tr>
                                            <th class="text-center"><?= $i++ ?></th>
                                            <td class="text-center"><?= $item['nidn'] ?></td>
                                            <td><?= $item['nama_dosen'] ?></td>
                                            <td class="text-center">
                                                <?php
                                                $jdm = new \App\Models\JadwalDosenModel();
                                                $jd = $jdm->where('id_dosen', $item['id_dosen'])->find();
                                                $total = 0;
                                                foreach ($jd as $value) {
                                                    $total++;
                                                }

                                                echo $total;
                                                ?>
                                            </td>
                                            <td class="text-center" style="width: 100px;">
                                                <a href="/jadwal_dosen/edit/<?= $item['id_dosen'] ?>" class="btn btn-secondary btn-sm"><i class="fas fa-clock mr-2"></i> Lihat Jadwal</a>
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