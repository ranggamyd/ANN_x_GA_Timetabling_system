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
                        <a>Index</a>
                    </li>
                </ul>
            </div>
            <div class="ml-md-auto py-2 py-md-0" style="margin-bottom: 20px;">
                <a href="/dosen/create" class="btn btn-primary btn-round"><i class="fas fa-plus-circle mr-2"></i>Tambah Dosen</a>
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
                            <table id="dosentable" class="display table table-striped table-hover">
                                <thead class="text-center thead-light">
                                    <tr>
                                        <th>No.</th>
                                        <th>NIDN</th>
                                        <th>Nama Dosen</th>
                                        <th>Prodi</th>
                                        <th style="max-width: 100px;">Matakuliah</th>
                                        <th>E-Mail</th>
                                        <th>No. Telepon</th>
                                        <th style="min-width: 75px;">Opsi</th>
                                    </tr>
                                </thead>
                                <tfoot class="text-center thead-light">
                                    <tr>
                                        <th>No.</th>
                                        <th>NIDN</th>
                                        <th>Nama Dosen</th>
                                        <th>Prodi</th>
                                        <th>Matakuliah</th>
                                        <th>E-Mail</th>
                                        <th>No. Telepon</th>
                                        <th>Opsi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($dosen as $item) :
                                    ?>
                                        <tr>
                                            <th class="text-center"><?= $i++ ?></th>
                                            <td class="text-center"><?= $item['nidn'] ?></td>
                                            <td><?= $item['nama_dosen'] ?></td>
                                            <td class="text-center"><span class="badge badge-<?= ($item['id_prodi'] == '1') ? 'success' : (($item['id_prodi'] == '2') ? 'warning' : (($item['id_prodi'] == '3') ? 'secondary' : 'light')) ?>"><?= $item['nama_prodi'] ?: 'UNIVERSAL' ?></td>
                                            <td class="text-center">
                                                <?php
                                                $dmm = new \App\Models\DosenMataKuliahModel();
                                                $dm = $dmm->where('id_dosen', $item['id_dosen'])->join('mata_kuliah', 'dosen_mata_kuliah.id_mata_kuliah = mata_kuliah.id_mata_kuliah', 'left')->find();

                                                foreach ($dm as $value) :
                                                ?>
                                                    <span class="badge badge-sm badge-light"><?= $value['nama_mata_kuliah'] ?></span>
                                                <?php endforeach ?>
                                            </td>
                                            <td><?= $item['email'] ?></td>
                                            <td><?= $item['no_hp'] ?></td>
                                            <td class="text-center" style="width: 100px;">
                                                <a href="/dosen/edit/<?= $item['id_dosen'] ?>" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i></a>
                                                <form action="/dosen/delete/<?= $item['id_dosen'] ?>" method="post" class="d-inline">
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