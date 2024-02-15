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
                        <a>Index</a>
                    </li>
                </ul>
            </div>
            <div class="ml-md-auto py-2 py-md-0" style="margin-bottom: 20px;">
                <a href="/mata_kuliah/create" class="btn btn-primary btn-round"><i class="fas fa-plus-circle mr-2"></i>Tambah Mata Kuliah</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-md-flex justify-content-between align-items-center">
                        <h4 class="card-title fw-bold"><?= $title ?></h4>
                        <form action="/mata_kuliah" method="get" class="form-inline">
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
                                <label for="paket" class="mr-1">Paket Semester:</label>
                                <select name="paket" id="paket" class="form-control">
                                    <option value="">Semua Paket</option>
                                    <option value="Ganjil" <?= ($paket == 'Ganjil') ? 'selected' : '' ?>>Ganjil</option>
                                    <option value="Genap" <?= ($paket == 'Genap') ? 'selected' : '' ?>>Genap</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-outline-danger"><i class="fas fa-filter mr-2"></i> Filter</button>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="display table table-striped table-hover">
                                <thead class="text-center thead-light">
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode</th>
                                        <th>Mata Kuliah</th>
                                        <th>SKS</th>
                                        <th>Semester</th>
                                        <th>Sifat</th>
                                        <th>Prodi</th>
                                        <th>Status</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tfoot class="text-center thead-light">
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode</th>
                                        <th>Mata Kuliah</th>
                                        <th>SKS</th>
                                        <th>Semester</th>
                                        <th>Sifat</th>
                                        <th>Prodi</th>
                                        <th>Status</th>
                                        <th>Opsi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($mata_kuliah as $item) :
                                    ?>
                                        <tr>
                                            <th class="text-center"><?= $i++ ?></th>
                                            <td class="text-center"><?= $item['kode_mata_kuliah'] ?></td>
                                            <td><?= $item['nama_mata_kuliah'] ?></td>
                                            <td class="text-center"><?= $item['sks'] ?></td>
                                            <td class="text-center"><?= $item['semester'] ?></td>
                                            <td class="text-center"><?= $item['sifat'] ?></td>
                                            <td class="text-center"><span class="badge badge-<?= ($item['id_prodi'] == '1') ? 'success' : (($item['id_prodi'] == '2') ? 'warning' : (($item['id_prodi'] == '3') ? 'secondary' : 'light')) ?>"><?= $item['nama_prodi'] ?></td>
                                            <td class="text-center">
                                                <?php if ($item['is_active'] === "t") : ?>
                                                    <span class="badge badge-light"><i class="fas fa-circle fa-sm text-success mr-2"></i>Aktif</span>
                                                <?php else : ?>
                                                    <span class="badge badge-light"><i class="fas fa-circle fa-sm text-secondary mr-2"></i>Nonaktif</span>
                                                <?php endif ?>
                                            </td>
                                            <td class="text-center" style="width: 100px;">
                                                <a href="/mata_kuliah/edit/<?= $item['id_mata_kuliah'] ?>" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i></a>
                                                <form action="/mata_kuliah/delete/<?= $item['id_mata_kuliah'] ?>" method="post" class="d-inline">
                                                    <?= csrf_field() ?>
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Hapus"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </td>
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