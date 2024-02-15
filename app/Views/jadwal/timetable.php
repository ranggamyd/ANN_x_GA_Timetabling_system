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
                        <a href="/jadwal">Penjadwalan</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a>Timetable</a>
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-md-flex justify-content-between align-items-center">
                        <h4 class="card-title fw-bold"><?= $title ?></h4>
                        <form action="/jadwal/timetable" method="get" class="form-inline">
                            <div class="form-group mr-2">
                                <label for="id_prodi" class="mr-1">Prodi:</label>
                                <select name="id_prodi" id="id_prodi" class="form-control">
                                    <option value="">Semua Prodi</option>
                                    <?php foreach ($prodi as $item) : ?>
                                        <option value="<?= $item['id_prodi'] ?>" <?= ($id_prodi == $item['id_prodi']) ? 'selected' : '' ?>>
                                            <?= $item['nama_prodi'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group mr-2">
                                <label for="semester" class="mr-1">Semester:</label>
                                <select name="semester" id="semester" class="form-control">
                                    <option value="">Semua Semester</option>
                                    <?php foreach ($semester_list as $item) : ?>
                                        <option value="<?= $item['semester'] ?>" <?= ($semester == $item['semester']) ? 'selected' : '' ?>>
                                            <?= $item['semester'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group mr-2">
                                <label for="kelas" class="mr-1">Kelas:</label>
                                <select name="kelas" id="kelas" class="form-control">
                                    <option value="">Semua Kelas</option>
                                    <?php foreach ($kelas_list as $item) : ?>
                                        <option value="<?= $item['kelas'] ?>" <?= ($kelas == $item['kelas']) ? 'selected' : '' ?>>
                                            <?= $item['kelas'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-outline-danger"><i class="fas fa-filter mr-2"></i> Filter</button>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" style="max-width:1000%; width:600%;">
                                <?= $table_header ?>
                                <?= $table_body ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>