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
                        <a href="/users">Pengguna</a>
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
                    <form action="/users/update/<?= $users['id_user'] ?>" method="post">
                        <input type="hidden" name="_method" value="PUT">
                        <?= csrf_field(); ?>

                        <div class="card-body">
                            <?php
                            $validation = \Config\Services::validation();
                            if (session()->getFlashdata('validation')) {
                                $validation = session()->getFlashdata('validation');
                            }
                            ?>

                            <div class="form-group <?= $validation->hasError('username') ? 'has-error has-feedback' : '' ?>">
                                <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                                <input type="text" name="username" value="<?= set_value('username', $users['username']) ?>" class="form-control" id="username" autofocus required>
                                <small class="form-text text-muted"><?= $validation->getError('username') ?></small>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group <?= $validation->hasError('password') ? 'has-error has-feedback' : '' ?>">
                                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                        <input type="password" name="password" value="<?= set_value('password') ?>" class="form-control" id="password" required>
                                        <small class="form-text text-muted"><?= $validation->getError('password') ?></small>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group <?= $validation->hasError('password_conf') ? 'has-error has-feedback' : '' ?>">
                                        <label for="password_conf" class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                                        <input type="password" name="password_conf" value="<?= set_value('password_conf') ?>" class="form-control" id="password_conf" required>
                                        <small class="form-text text-muted"><?= $validation->getError('password_conf') ?></small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group <?= $validation->hasError('avatar') ? 'has-error has-feedback' : '' ?>">
                                <label for="avatar" class="form-label">Avatar</label>
                                <input type="file" name="avatar" value="<?= set_value('avatar') ?>" class="form-control" id="avatar">
                                <small class="form-text text-muted"><?= $validation->getError('avatar') ?></small>
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