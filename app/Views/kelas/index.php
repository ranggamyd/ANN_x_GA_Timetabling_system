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
                        <a href="/kelas">Kelas</a>
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
                <button type="button" class="btn btn-outline-secondary btn-round mr-2" data-toggle="modal" data-target="#tambahKelas" <?= !$kelas ? 'disabled' : '' ?>><i class="fas fa-plus-circle mr-2 fa-sm"></i>Tambah Kelas</button>
                <button type="button" id="generateClassBtn" class="btn btn-primary btn-round"><i class="fas fa-signature mr-2"></i>Bangkitkan Kelas</button>
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
                    <div class="card-header">
                        <h4 class="card-title fw-bold"><?= $title ?></h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="display table table-hover">
                                <thead class="text-center thead-light">
                                    <tr>
                                        <th>No.</th>
                                        <th>Kelas</th>
                                        <th>Mata Kuliah</th>
                                        <th>Semester</th>
                                        <th>Prodi</th>
                                        <th>Peserta</th>
                                        <th>Pengampu</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tfoot class="text-center thead-light">
                                    <tr>
                                        <th>No.</th>
                                        <th>Kelas</th>
                                        <th>Mata Kuliah</th>
                                        <th>Semester</th>
                                        <th>Prodi</th>
                                        <th>Peserta</th>
                                        <th>Pengampu</th>
                                        <th>Opsi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    $style = 'background: #e9ecef;';
                                    $prevMataKuliah = '';
                                    foreach ($kelas as $item) :
                                        if ($item['id_mata_kuliah'] != $prevMataKuliah) $style = ($style == '') ? 'background: #e9ecef;' : '';
                                    ?>
                                        <tr style="<?= $style ?>">
                                            <th class="text-center"><?= $i++ ?></th>
                                            <td class="text-center text-nowrap"><?= $item['nama_kelas'] ?></td>
                                            <td><?= $item['nama_mata_kuliah'] ?></td>
                                            <td class="text-center"><?= $item['semester'] ?></td>
                                            <td class="text-center text-nowrap">
                                                <span class="badge badge-<?= ($item['id_prodi'] == '1') ? 'success' : (($item['id_prodi'] == '2') ? 'warning' : (($item['id_prodi'] == '3') ? 'secondary' : 'light')) ?>"><?= $item['nama_prodi'] ?></span>
                                            </td>
                                            <td class="text-center fw-bold text-danger"><?= $item['prediksi_peserta'] ?></td>
                                            <?php $pengampu = model('PengampuModel')->join('dosen', 'pengampu.id_dosen = dosen.id_dosen', 'left')->where(['id_kelas' => $item['id_kelas']])->first() ?>
                                            <td <?= isset($pengampu['nama_dosen']) ? 'style="width: 100px;"' : 'class="text-center fw-bold text-danger"' ?>>
                                                <?= isset($pengampu['nama_dosen']) ? $pengampu['nama_dosen'] : '-' ?>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-outline-secondary btn-sm mr-2" data-toggle="modal" data-target="#editPengampu-<?= $item['id_kelas'] ?>">
                                                        <i class="fas fa-edit mr-2"></i>Edit Pengampu
                                                    </button>
                                                    <form action="/kelas/delete/<?= $item['id_kelas'] ?>" method="post" class="d-inline">
                                                        <?= csrf_field() ?>
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Hapus"><i class="fas fa-trash-alt"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                        $prevMataKuliah = $item['id_mata_kuliah'];
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="tambahKelas" tabindex="-1" role="dialog" aria-labelledby="tambahKelasLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fw-bold ml-1 text-dark" id="tambahKelasLabel">Tambah Kelas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/kelas/store" method="post">
                <?= csrf_field(); ?>

                <div class="modal-body">
                    <?php
                    $validation = \Config\Services::validation();
                    if (session()->getFlashdata('validation')) {
                        $validation = session()->getFlashdata('validation');
                    }
                    ?>

                    <div class="form-group <?= $validation->hasError('id_mata_kuliah') ? 'has-error has-feedback' : '' ?>">
                        <label for="id_mata_kuliah" class="form-label">Mata Kuliah <span class="text-danger">*</span></label>
                        <select name="id_mata_kuliah" class="form-control <?= $validation->hasError('id_mata_kuliah') ? 'is-invalid' : '' ?>" id="id_mata_kuliah" required>
                            <option value="" selected disabled></option>
                            <?php foreach ($mata_kuliah as $item) : ?>
                                <option value="<?= $item['id_mata_kuliah'] ?>" <?= set_select('id_mata_kuliah', $item['id_mata_kuliah']) ?>><?= $item['nama_mata_kuliah'] ?></option>
                            <?php endforeach ?>
                        </select>
                        <small class="form-text text-muted"><?= $validation->getError('id_mata_kuliah') ?></small>
                    </div>
                    <div class="form-group <?= $validation->hasError('prediksi_peserta') ? 'has-error has-feedback' : '' ?>">
                        <label for="prediksi_peserta" class="form-label">Peserta <span class="text-danger">*</span></label>
                        <input type="number" name="prediksi_peserta" value="<?= set_value('prediksi_peserta') ?>" class="form-control" id="prediksi_peserta" required>
                        <small class="form-text text-muted"><?= $validation->getError('prediksi_peserta') ?></small>
                    </div>
                    <div class="form-group <?= $validation->hasError('nama_kelas') ? 'has-error has-feedback' : '' ?>">
                        <label for="nama_kelas" class="form-label">Nama Kelas <span class="text-danger">*</span></label>
                        <input type="text" name="nama_kelas" value="<?= set_value('nama_kelas') ?>" class="form-control" id="nama_kelas" required>
                        <!-- <small class="form-text text-muted">* Nama kelas menyesuaikan otomatis dengan kelas yang sudah tersedia.</small> -->
                        <small class="form-text text-muted"><?= $validation->getError('nama_kelas') ?></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-outline-secondary"><i class="fas fa-sync mr-2 fa-sm"></i>Reset</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2 fa-sm"></i>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php
$i = 1;
foreach ($kelas as $item) :
?>
    <!-- Modal -->
    <div class="modal fade" id="editPengampu-<?= $item['id_kelas'] ?>" tabindex="-1" role="dialog" aria-labelledby="editPengampu-<?= $item['id_kelas'] ?>Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fw-bold ml-1 text-dark" id="editPengampu-<?= $item['id_kelas'] ?>Label">Edit Pengampu</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/kelas/updatePengampu/<?= $item['id_kelas'] ?>" method="post">
                    <input type="hidden" name="_method" value="PUT">
                    <?= csrf_field(); ?>

                    <div class="modal-body">
                        <?php
                        $validation = \Config\Services::validation();
                        if (session()->getFlashdata('validation')) {
                            $validation = session()->getFlashdata('validation');
                        }
                        ?>

                        <div class="form-group <?= $validation->hasError('nama_kelas') ? 'has-error has-feedback' : '' ?>">
                            <label for="nama_kelas" class="form-label">Nama Kelas <span class="text-danger">*</span></label>
                            <input type="text" name="nama_kelas" value="<?= set_value('nama_kelas', $item['nama_kelas']) ?>" class="form-control" id="nama_kelas" required readonly>
                            <small class="form-text text-muted"><?= $validation->getError('nama_kelas') ?></small>
                        </div>
                        <div class="form-group <?= $validation->hasError('id_dosen') ? 'has-error has-feedback' : '' ?>">
                            <label for="id_dosen" class="form-label">Nama Dosen <span class="text-danger">*</span></label>
                            <select name="id_dosen" class="form-control <?= $validation->hasError('id_dosen') ? 'is-invalid' : '' ?>" id="id_dosen" autofocus required>
                                <option value="" selected disabled></option>
                                <?php foreach ($dosen as $item) : ?>
                                    <option value="<?= $item['id_dosen'] ?>" <?= set_select('id_dosen', $item['id_dosen']) ?>><?= $item['nama_dosen'] ?></option>
                                <?php endforeach ?>
                            </select>
                            <small class="form-text text-muted"><?= $validation->getError('id_dosen') ?></small>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" name="semua_mata_kuliah" value="1" class="form-check-input">
                                <span class="form-check-sign">Set untuk semua kelas dengan mata kuliah yang sama</span>
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-outline-secondary"><i class="fas fa-sync mr-2 fa-sm"></i>Reset</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2 fa-sm"></i>Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach ?>
<?php $this->endSection(); ?>