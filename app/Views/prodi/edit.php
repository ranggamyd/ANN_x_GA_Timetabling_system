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
                        <a href="/prodi">Prodi</a>
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
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title fw-bold"><?= $title ?></h4>
                    </div>
                    <form action="/prodi/update/<?= $prodi['id_prodi'] ?>" method="post">
                        <input type="hidden" name="_method" value="PUT">
                        <?= csrf_field(); ?>

                        <div class="card-body">
                            <?php
                            $validation = \Config\Services::validation();
                            if (session()->getFlashdata('validation')) {
                                $validation = session()->getFlashdata('validation');
                            }
                            ?>
                            <div class="form-group <?= $validation->hasError('kode_prodi') ? 'has-error has-feedback' : '' ?>">
                                <label for="kode_prodi" class="form-label">Kode Prodi <span class="text-danger">*</span></label>
                                <input type="text" name="kode_prodi" value="<?= set_value('kode_prodi', $prodi['kode_prodi']) ?>" class="form-control" id="kode_prodi" autofocus required>
                                <small class="form-text text-muted"><?= $validation->getError('kode_prodi') ?></small>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group <?= $validation->hasError('nama_prodi') ? 'has-error has-feedback' : '' ?>">
                                        <label for="nama_prodi" class="form-label">Nama Prodi <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_prodi" value="<?= set_value('nama_prodi', $prodi['nama_prodi']) ?>" class="form-control" id="nama_prodi" required>
                                        <small class="form-text text-muted"><?= $validation->getError('nama_prodi') ?></small>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group <?= $validation->hasError('fakultas') ? 'has-error has-feedback' : '' ?>">
                                        <label for="fakultas" class="form-label">Fakultas <span class="text-danger">*</span></label>
                                        <select name="fakultas" class="form-control <?= $validation->hasError('fakultas') ? 'is-invalid' : '' ?>" id="fakultas" required>
                                            <!-- <option hidden></option> -->
                                            <?php foreach ($fakultas as $item) : ?>
                                                <option value="<?= $item ?>" <?= set_select('fakultas', $item, $prodi['fakultas'] === $item) ?> <?= $item != 'Teknik' ? 'disabled' : '' ?>><?= $item ?></option>
                                            <?php endforeach ?>
                                        </select>
                                        <small class="form-text text-muted"><?= $validation->getError('fakultas') ?></small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group <?= $validation->hasError('deskripsi') ? 'has-error has-feedback' : '' ?>">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" id="deskripsi"><?= set_value('deskripsi', $prodi['deskripsi']) ?></textarea>
                                <small class="form-text text-muted"><?= $validation->getError('deskripsi') ?></small>
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