<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>
<div class="content">
    <div class="panel-header bg-light">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="pb-2 fw-bold"><?= $title ?></h2>
                    <h5 class="op-7 mb-2">Selamat datang kembali, <?= session()->get('username') ?>!</h5>
                </div>
                <div class="ml-md-auto py-2 py-md-0">
                    <a href="/profile" class="btn btn-primary btn-border btn-round mr-2">Profil Saya</a>
                    <a href="/logout" class="btn btn-primary btn-round">Keluar<i class="fas fa-sign-out-alt ml-2"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="page-inner mt--5">
        <div class="row row-card-no-pd">
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-graduation-cap text-muted"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Program Studi</p>
                                    <h4 class="card-title"><?= $total_prodi ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-book text-muted"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Mata Kuliah</p>
                                    <h4 class="card-title"><?= $total_matkul_aktif ?>/<?= $total_matkul ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-id-badge text-muted"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Dosen</p>
                                    <h4 class="card-title"><?= $total_dosen ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-building text-muted"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Ruang</p>
                                    <h4 class="card-title"><?= $total_ruang ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                        <h4 class="card-title fw-bold">Jadwal Kuliah</h4>
                        <form action="/dashboard" method="get" class="form-inline">
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