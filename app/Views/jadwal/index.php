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
                        <a href="/jadwal">Jadwal</a>
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
                <a href="/jadwal/timetable" class="btn btn-outline-secondary btn-round mr-2"><i class="fas fa-info-circle mr-2 fa-sm"></i>Lihat Jadwal</a>
                <button type="button" id="generateScheduleBtn" class="btn btn-primary btn-round"><i class="fas fa-signature mr-2"></i>Generate Jadwal</button>
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
                        <form action="/jadwal" method="get" class="form-inline">
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
                            <table id="jadwaltable" class="display table table-striped table-hover">
                                <thead class="text-center thead-light">
                                    <tr>
                                        <th>No.</th>
                                        <th>Hari</th>
                                        <th>Waktu</th>
                                        <th>Kelas</th>
                                        <th>Mata Kuliah</th>
                                        <th>Semester</th>
                                        <th>SKS</th>
                                        <th>Prodi</th>
                                        <th>Pengampu</th>
                                        <th>Ruang</th>
                                    </tr>
                                </thead>
                                <tfoot class="text-center thead-light">
                                    <tr>
                                        <th>No.</th>
                                        <th>Hari</th>
                                        <th>Waktu</th>
                                        <th>Kelas</th>
                                        <th>Mata Kuliah</th>
                                        <th>Semester</th>
                                        <th>SKS</th>
                                        <th>Prodi</th>
                                        <th>Pengampu</th>
                                        <th>Ruang</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($jadwal as $item) :
                                    ?>
                                        <tr>
                                            <th class="text-center"><?= $i++ ?></th>
                                            <td class="text-center"><?= $item['hari'] ?></td>
                                            <td class="text-center"><?= date('H:i', strtotime($item['jam_mulai'])) ?> - <?= date('H:i', strtotime($item['jam_selesai'])) ?></td>
                                            <td class="text-center text-nowrap"><?= $item['nama_kelas'] ?></td>
                                            <td><?= $item['nama_mata_kuliah'] ?></td>
                                            <td class="text-center"><?= $item['semester'] ?></td>
                                            <td class="text-center"><?= $item['sks'] ?></td>
                                            <td class="text-center text-nowrap">
                                                <span class="badge badge-<?= ($item['id_prodi'] == '1') ? 'success' : (($item['id_prodi'] == '2') ? 'warning' : (($item['id_prodi'] == '3') ? 'secondary' : 'light')) ?>"><?= $item['nama_prodi'] ?></span>
                                            </td>
                                            <?php $pengampu = model('PengampuModel')->join('dosen', 'pengampu.id_dosen = dosen.id_dosen', 'left')->where(['id_kelas' => $item['id_kelas']])->first() ?>
                                            <td <?= isset($pengampu['nama_dosen']) ? 'style="width: 100px;"' : 'class="text-center fw-bold text-danger"' ?>>
                                                <?= isset($pengampu['nama_dosen']) ? $pengampu['nama_dosen'] : '-' ?>
                                            </td>
                                            <td><?= $item['nama_ruang'] ?></td>
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