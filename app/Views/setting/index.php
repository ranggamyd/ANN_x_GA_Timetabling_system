<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>
<div class="content">
    <div class="page-inner py-4">
        <form action="/setting/update/<?= $setting['id_setting'] ?>" method="post">
            <input type="hidden" name="_method" value="PUT">
            <?= csrf_field(); ?>

            <?php
            $validation = \Config\Services::validation();
            if (session()->getFlashdata('validation')) {
                $validation = session()->getFlashdata('validation');
            }
            ?>
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
                            <a>Settings</a>
                        </li>
                    </ul>
                </div>
                <div class="ml-md-auto py-2 py-md-0" style="margin-bottom: 20px;">
                    <button type="submit" class="btn btn-primary btn-round"><i class="fas fa-save mr-2"></i>Simpan Perubahan</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title fw-bold"># App Setting</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group <?= $validation->hasError('tahun_akademik') ? 'has-error has-feedback' : '' ?>">
                                        <label for="tahun_akademik" class="form-label">Tahun Akademik <span class="text-danger">*</span></label>
                                        <input type="number" step="any" name="tahun_akademik" value="<?= set_value('tahun_akademik', $setting['tahun_akademik']) ?>" min="2010" max="2030" class="form-control" id="tahun_akademik" required>
                                        <small class="form-text text-muted"><?= $validation->getError('tahun_akademik') ?></small>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-check <?= $validation->hasError('paket_semester') ? 'has-error has-feedback' : '' ?>">
                                        <label>Paket Semester <span class="text-danger">*</span></label><br>
                                        <label class="form-radio-label">
                                            <input type="radio" name="paket_semester" class="form-radio-input" value="Ganjil" <?= set_radio('paket_semester', 'Ganjil', $setting['paket_semester'] === 'Ganjil') ?>>
                                            <span class="form-radio-sign">Ganjil</span>
                                        </label>
                                        <label class="form-radio-label">
                                            <input type="radio" name="paket_semester" class="form-radio-input" value="Genap" <?= set_radio('paket_semester', 'Genap', $setting['paket_semester'] === 'Genap') ?>>
                                            <span class="form-radio-sign">Genap</span>
                                        </label>
                                        <small class="form-text text-muted"><?= $validation->getError('paket_semester') ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title fw-bold"># JST Backpropagation</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group <?= $validation->hasError('learning_rate') ? 'has-error has-feedback' : '' ?>">
                                        <label for="learning_rate" class="form-label">Learning Rate <span class="text-danger">*</span></label>
                                        <input type="number" step="0.1" name="learning_rate" value="<?= set_value('learning_rate', $setting['learning_rate']) ?>" class="form-control" id="learning_rate" required>
                                        <small class="form-text text-muted"><?= $validation->getError('learning_rate') ?></small>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group <?= $validation->hasError('epochs') ? 'has-error has-feedback' : '' ?>">
                                        <label for="epochs" class="form-label">Epochs <span class="text-danger">*</span></label>
                                        <input type="number" step="any" name="epochs" value="<?= set_value('epochs', $setting['epochs']) ?>" class="form-control" id="epochs" required>
                                        <small class="form-text text-muted"><?= $validation->getError('epochs') ?></small>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group <?= $validation->hasError('momentum') ? 'has-error has-feedback' : '' ?>">
                                        <label for="momentum" class="form-label">Momentum <span class="text-danger">*</span></label>
                                        <input type="number" step="0.1" name="momentum" value="<?= set_value('momentum', $setting['momentum']) ?>" class="form-control" id="momentum" required>
                                        <small class="form-text text-muted"><?= $validation->getError('momentum') ?></small>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group <?= $validation->hasError('threshold') ? 'has-error has-feedback' : '' ?>">
                                        <label for="threshold" class="form-label">threshold <span class="text-danger">*</span></label>
                                        <input type="number" step="0.0000001" name="threshold" value="<?= set_value('threshold', $setting['threshold']) ?>" class="form-control" id="threshold" required>
                                        <small class="form-text text-muted"><?= $validation->getError('threshold') ?></small>
                                    </div>
                                </div>
                            </div>
                            <small class="form-text text-muted">* Formasi Layer yang digunakan berpola 3-3-1 dengan 1 neuron bias untuk input layer dan hidden layer.</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title fw-bold"># Pembangkitan Kelas</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group <?= $validation->hasError('min_peserta') ? 'has-error has-feedback' : '' ?>">
                                        <label for="min_peserta" class="form-label">Peserta Minimal <span class="text-danger">*</span></label>
                                        <input type="number" step="any" name="min_peserta" value="<?= set_value('min_peserta', $setting['min_peserta']) ?>" class="form-control" id="min_peserta" required>
                                        <small class="form-text text-muted"><?= $validation->getError('min_peserta') ?></small>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group <?= $validation->hasError('max_peserta') ? 'has-error has-feedback' : '' ?>">
                                        <label for="max_peserta" class="form-label">Peserta Maksimal <span class="text-danger">*</span></label>
                                        <input type="number" step="any" name="max_peserta" value="<?= set_value('max_peserta', $setting['max_peserta']) ?>" class="form-control" id="max_peserta" required>
                                        <small class="form-text text-muted"><?= $validation->getError('max_peserta') ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title fw-bold"># Genetic Algorithm</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group <?= $validation->hasError('populasi') ? 'has-error has-feedback' : '' ?>">
                                        <label for="populasi" class="form-label">Populasi <span class="text-danger">*</span></label>
                                        <input type="number" step="any" name="populasi" value="<?= set_value('populasi', $setting['populasi']) ?>" class="form-control" id="populasi" required>
                                        <small class="form-text text-muted"><?= $validation->getError('populasi') ?></small>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group <?= $validation->hasError('generasi') ? 'has-error has-feedback' : '' ?>">
                                        <label for="generasi" class="form-label">Generasi <span class="text-danger">*</span></label>
                                        <input type="number" step="any" name="generasi" value="<?= set_value('generasi', $setting['generasi']) ?>" class="form-control" id="generasi" required>
                                        <small class="form-text text-muted"><?= $validation->getError('generasi') ?></small>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group <?= $validation->hasError('crossover') ? 'has-error has-feedback' : '' ?>">
                                        <label for="crossover" class="form-label">Probabilitas Crossover <span class="text-danger">*</span></label>
                                        <input type="number" step="0.1" name="crossover" value="<?= set_value('crossover', $setting['crossover']) ?>" class="form-control" id="crossover" required>
                                        <small class="form-text text-muted"><?= $validation->getError('crossover') ?></small>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group <?= $validation->hasError('mutasi') ? 'has-error has-feedback' : '' ?>">
                                        <label for="mutasi" class="form-label">Probabilitas Mutasi <span class="text-danger">*</span></label>
                                        <input type="number" step="0.1" name="mutasi" value="<?= set_value('mutasi', $setting['mutasi']) ?>" class="form-control" id="mutasi" required>
                                        <small class="form-text text-muted"><?= $validation->getError('mutasi') ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title fw-bold"># Misc</h4>
                        </div>
                        <div class="card-body">
                            <a href="/setting/setDevelopment" class="btn btn-outline-primary mr-2">Development Mode</a>
                            <a href="/setting/setProduction" class="btn btn-outline-primary">Production Mode</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $this->endSection(); ?>