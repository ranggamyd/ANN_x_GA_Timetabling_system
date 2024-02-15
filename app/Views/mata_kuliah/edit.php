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
                        <a href="/mata_kuliah">Mata Kuliah</a>
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
                    <form action="/mata_kuliah/update/<?= $mata_kuliah['id_mata_kuliah'] ?>" method="post">
                        <input type="hidden" name="_method" value="PUT">
                        <?= csrf_field(); ?>

                        <div class="card-body">
                            <?php
                            $validation = \Config\Services::validation();
                            if (session()->getFlashdata('validation')) {
                                $validation = session()->getFlashdata('validation');
                            }
                            ?>

                            <div class="form-group <?= $validation->hasError('kode_mata_kuliah') ? 'has-error has-feedback' : '' ?>">
                                <label for="kode_mata_kuliah" class="form-label">Kode Mata Kuliah <span class="text-danger">*</span></label>
                                <input type="text" name="kode_mata_kuliah" value="<?= set_value('kode_mata_kuliah', $mata_kuliah['kode_mata_kuliah']) ?>" class="form-control" id="kode_mata_kuliah" autofocus required>
                                <small class="form-text text-muted"><?= $validation->getError('kode_mata_kuliah') ?></small>
                            </div>
                            <div class="form-group <?= $validation->hasError('nama_mata_kuliah') ? 'has-error has-feedback' : '' ?>">
                                <label for="nama_mata_kuliah" class="form-label">Nama Mata Kuliah <span class="text-danger">*</span></label>
                                <input type="text" name="nama_mata_kuliah" value="<?= set_value('nama_mata_kuliah', $mata_kuliah['nama_mata_kuliah']) ?>" class="form-control <?= $validation->hasError('nama_mata_kuliah') ? 'is-invalid' : '' ?>" id="nama_mata_kuliah" required>
                                <small class="form-text text-muted"><?= $validation->getError('nama_mata_kuliah') ?></small>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group <?= $validation->hasError('sks') ? 'has-error has-feedback' : '' ?>">
                                        <label for="sks" class="form-label">SKS <span class="text-danger">*</span></label>
                                        <input type="number" name="sks" value="<?= set_value('sks', $mata_kuliah['sks']) ?>" min="1" max="8" class="form-control <?= $validation->hasError('sks') ? 'is-invalid' : '' ?>" id="sks" required>
                                        <small class="form-text text-muted"><?= $validation->getError('sks') ?></small>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group <?= $validation->hasError('semester') ? 'has-error has-feedback' : '' ?>">
                                        <label for="semester" class="form-label">Semester <span class="text-danger">*</span></label>
                                        <input type="number" name="semester" value="<?= set_value('semester', $mata_kuliah['semester']) ?>" min="1" max="8" class="form-control <?= $validation->hasError('semester') ? 'is-invalid' : '' ?>" id="semester" required>
                                        <small class="form-text text-muted"><?= $validation->getError('semester') ?></small>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-check <?= $validation->hasError('sifat') ? 'has-error has-feedback' : '' ?>">
                                        <label>Sifat <span class="text-danger">*</span></label><br>
                                        <label class="form-radio-label">
                                            <input type="radio" name="sifat" class="form-radio-input" value="Wajib" <?= set_radio('sifat', 'Wajib', $mata_kuliah['sifat'] === 'Wajib') ?>>
                                            <span class="form-radio-sign">Wajib</span>
                                        </label>
                                        <label class="form-radio-label">
                                            <input type="radio" name="sifat" class="form-radio-input" value="Pilihan" <?= set_radio('sifat', 'Pilihan', $mata_kuliah['sifat'] === 'Pilihan') ?>>
                                            <span class="form-radio-sign">Pilihan</span>
                                        </label>
                                        <small class="form-text text-muted"><?= $validation->getError('sifat') ?></small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group <?= $validation->hasError('id_prodi') ? 'has-error has-feedback' : '' ?>">
                                <label for="id_prodi" class="form-label">Program Studi <span class="text-danger">*</span></label>
                                <select name="id_prodi" class="form-control <?= $validation->hasError('id_prodi') ? 'is-invalid' : '' ?>" id="id_prodi" required>
                                    <option hidden></option>
                                    <?php foreach ($prodi as $item) : ?>
                                        <option value="<?= $item['id_prodi'] ?>" <?= set_select('id_prodi', $item['id_prodi'], $mata_kuliah['id_prodi'] === $item['id_prodi']) ?>><?= $item['nama_prodi'] ?></option>
                                    <?php endforeach ?>
                                </select>
                                <small class="form-text text-muted"><?= $validation->getError('id_prodi') ?></small>
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