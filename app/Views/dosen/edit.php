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
                        <a href="/dosen">Dosen</a>
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
                    <form action="/dosen/update/<?= $dosen['id_dosen'] ?>" method="post">
                        <input type="hidden" name="_method" value="PUT">
                        <?= csrf_field(); ?>

                        <div class="card-body">
                            <?php
                            $validation = \Config\Services::validation();
                            if (session()->getFlashdata('validation')) {
                                $validation = session()->getFlashdata('validation');
                            }
                            ?>

                            <div class="form-group <?= $validation->hasError('nidn') ? 'has-error has-feedback' : '' ?>">
                                <label for="nidn" class="form-label">NIDN <span class="text-danger">*</span></label>
                                <input type="text" name="nidn" value="<?= set_value('nidn', $dosen['nidn']) ?>" class="form-control" id="nidn" autofocus required>
                                <small class="form-text text-muted"><?= $validation->getError('nidn') ?></small>
                            </div>
                            <div class="form-group <?= $validation->hasError('nama_dosen') ? 'has-error has-feedback' : '' ?>">
                                <label for="nama_dosen" class="form-label">Nama Dosen <span class="text-danger">*</span></label>
                                <input type="text" name="nama_dosen" value="<?= set_value('nama_dosen', $dosen['nama_dosen']) ?>" class="form-control" id="nama_dosen" required>
                                <small class="form-text text-muted"><?= $validation->getError('nama_dosen') ?></small>
                            </div>
                            <div class="form-group <?= $validation->hasError('id_prodi') ? 'has-error has-feedback' : '' ?>">
                                <label for="id_prodi" class="form-label">Program Studi</label>
                                <select name="id_prodi" class="form-control <?= $validation->hasError('id_prodi') ? 'is-invalid' : '' ?>" id="id_prodi">
                                    <option hidden></option>
                                    <?php foreach ($prodi as $item) : ?>
                                        <option value="<?= $item['id_prodi'] ?>" <?= set_select('id_prodi', $item['id_prodi'], $dosen['id_prodi'] === $item['id_prodi']) ?>><?= $item['nama_prodi'] ?></option>
                                    <?php endforeach ?>
                                </select>
                                <small class="form-text text-muted"><?= $validation->getError('id_prodi') ?></small>
                            </div>
                            <div class="form-group <?= $validation->hasError('mata_kuliah') ? 'has-error has-feedback' : '' ?>">
                                <label for="mata_kuliah" class="form-label">Mata Kuliah Diampu</label>
                                <select name="mata_kuliah[]" multiple class="form-control <?= $validation->hasError('mata_kuliah') ? 'is-invalid' : '' ?>" id="mata_kuliah">
                                    <option hidden></option>
                                    <?php foreach ($mata_kuliah as $item) : ?>
                                        <option value="<?= $item['id_mata_kuliah'] ?>" <?= set_select('mata_kuliah[]', $item['id_mata_kuliah']) ?>><?= $item['nama_mata_kuliah'] ?></option>
                                    <?php endforeach ?>
                                </select>
                                <small class="form-text text-muted"><?= $validation->getError('mata_kuliah') ?></small>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group <?= $validation->hasError('email') ? 'has-error has-feedback' : '' ?>">
                                        <label for="email" class="form-label">E-Mail</label>
                                        <input type="email" name="email" value="<?= set_value('email', $dosen['email']) ?>" class="form-control" id="email">
                                        <small class="form-text text-muted"><?= $validation->getError('email') ?></small>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group <?= $validation->hasError('no_hp') ? 'has-error has-feedback' : '' ?>">
                                        <label for="number" class="form-label">No. Telepon</label>
                                        <input type="no_hp" name="no_hp" value="<?= set_value('no_hp', $dosen['no_hp']) ?>" min="10" max="15" class="form-control" id="no_hp">
                                        <small class="form-text text-muted"><?= $validation->getError('no_hp') ?></small>
                                    </div>
                                </div>
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