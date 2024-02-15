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
                        <a href="/ruang">Ruang</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a>Create</a>
                    </li>
                </ul>
            </div>
            <div class="ml-md-auto py-2 py-md-0" style="margin-bottom: 20px;">
                <button type="button" onclick="window.history.go(-1); return false;" class="btn btn-outline-secondary btn-round mr-2"><i class="fas fa-angle-left mr-2 fa-sm"></i>Kembali</button>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title fw-bold"><?= $title ?></h4>
                    </div>
                    <form action="/ruang/store" method="post">
                        <?= csrf_field(); ?>

                        <div class="card-body">
                            <?php
                            $validation = \Config\Services::validation();
                            if (session()->getFlashdata('validation')) {
                                $validation = session()->getFlashdata('validation');
                            }
                            ?>

                            <div class="form-group <?= $validation->hasError('kode_ruang') ? 'has-error has-feedback' : '' ?>">
                                <label for="kode_ruang" class="form-label">Kode Ruang <span class="text-danger">*</span></label>
                                <input type="text" name="kode_ruang" value="<?= set_value('kode_ruang') ?>" class="form-control" id="kode_ruang" autofocus required>
                                <small class="form-text text-muted"><?= $validation->getError('kode_ruang') ?></small>
                            </div>
                            <div class="form-group <?= $validation->hasError('nama_ruang') ? 'has-error has-feedback' : '' ?>">
                                <label for="nama_ruang" class="form-label">Nama Ruang <span class="text-danger">*</span></label>
                                <input type="text" name="nama_ruang" value="<?= set_value('nama_ruang') ?>" class="form-control" id="nama_ruang" required>
                                <small class="form-text text-muted"><?= $validation->getError('nama_ruang') ?></small>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group <?= $validation->hasError('kapasitas') ? 'has-error has-feedback' : '' ?>">
                                        <label for="kapasitas" class="form-label">Kapasitas <span class="text-danger">*</span></label>
                                        <input type="number" name="kapasitas" value="<?= set_value('kapasitas') ?>" class="form-control" id="kapasitas" required>
                                        <small class="form-text text-muted"><?= $validation->getError('kapasitas') ?></small>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-label">Program Studi <span class="text-danger">*</span></label><br>
                                        <div class="selectgroup selectgroup-pills">
                                            <?php foreach ($prodi as $item) : ?>
                                                <label class="selectgroup-item">
                                                    <input type="checkbox" name="id_prodi[]" value="<?= $item['id_prodi'] ?>" class="selectgroup-input" <?= set_checkbox('id_prodi', $item['id_prodi']) ?>>
                                                    <span class="selectgroup-button"><?= $item['nama_prodi'] ?></span>
                                                </label>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-action text-right">
                            <button type="reset" class="btn btn-outline-secondary"><i class="fas fa-sync mr-2 fa-sm"></i>Reset</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2 fa-sm"></i>Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>