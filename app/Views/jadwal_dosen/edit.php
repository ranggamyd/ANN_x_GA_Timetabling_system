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
                        <a>Edit</a>
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
                    <dl class="row mb-0">
                        <dt class="col-sm-2">NIDN</dt>
                        <dd class="col-sm-10">: <?= $dosen['nidn'] ?></dd>
                        <dt class="col-sm-2">Nama Dosen</dt>
                        <dd class="col-sm-10">: <?= $dosen['nama_dosen'] ?></dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card shadow-lg">
                    <div class="card-header">
                        <h4 class="card-title fw-bold"><?= $title ?></h4>
                    </div>
                    <form action="/jadwal_dosen/update/<?= $dosen['id_dosen'] ?>" method="post">
                        <input type="hidden" name="_method" value="PUT">
                        <?= csrf_field(); ?>

                        <div class="card-body">
                            <?php
                            $validation = \Config\Services::validation();
                            if (session()->getFlashdata('validation')) {
                                $validation = session()->getFlashdata('validation');
                            }
                            ?>

                            <div class="table-responsive">
                                <table id="datatable" class="display table table-striped table-hover">
                                    <thead class="text-center thead-light">
                                        <tr>
                                            <th>No.</th>
                                            <th>Hari</th>
                                            <th>Jam Mulai</th>
                                            <th>Jam Selesai</th>
                                            <th>Ketersediaan Mengajar</th>
                                        </tr>
                                    </thead>
                                    <tfoot class="text-center thead-light">
                                        <tr>
                                            <th>No.</th>
                                            <th>Hari</th>
                                            <th>Jam Mulai</th>
                                            <th>Jam Selesai</th>
                                            <th>Ketersediaan Mengajar</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($waktu as $item) :
                                            if ($item['hari'] !== 'Jumat' && ($item['jam_mulai'] !== '11:30' || $item['jam_mulai'] !== '12:30')) :
                                        ?>
                                                <tr>
                                                    <th class="text-center"><?= $i++ ?></th>
                                                    <td><?= $item['hari'] ?></td>
                                                    <td class="text-center"><?= $item['jam_mulai'] ?></td>
                                                    <td class="text-center"><?= $item['jam_selesai'] ?></td>
                                                    <td class="text-center">
                                                        <div class="form-group">
                                                            <div class="selectgroup selectgroup-primary selectgroup-pills">
                                                                <label class="selectgroup-item">
                                                                    <input type="radio" name="ketersediaan[<?= $item['id_waktu'] ?>]" value="1" class="selectgroup-input" checked>
                                                                    <span class="selectgroup-button selectgroup-button-icon"><i class="far fa-check-circle mr-2"></i>Bersedia</span>
                                                                </label>
                                                                <label class="selectgroup-item">
                                                                    <input type="radio" name="ketersediaan[<?= $item['id_waktu'] ?>]" value="0" class="selectgroup-input" <?= isset($jadwal_dosen[$item['id_waktu']]) ? 'checked' : '' ?>>
                                                                    <span class="selectgroup-button selectgroup-button-icon"><i class="far fa-times-circle mr-2"></i>Tidak Bersedia </span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                        <?php
                                            endif;
                                        endforeach;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-action text-right"">
                            <button type=" reset" class="btn btn-outline-secondary"><i class="fas fa-sync mr-2 fa-sm"></i>Reset</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2 fa-sm"></i>Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>