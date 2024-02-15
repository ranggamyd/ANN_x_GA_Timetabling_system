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
                        <a href="/ruang">Ruang</a>
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
                <a href="/ruang/create" class="btn btn-primary btn-round"><i class="fas fa-plus-circle mr-2"></i>Tambah Ruang</a>
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
                            <table id="datatable" class="display table table-striped table-hover">
                                <thead class="text-center thead-light">
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode Ruang</th>
                                        <th>Nama Ruang</th>
                                        <th>Kapasitas</th>
                                        <th>Prodi</th>
                                        <!-- <th>Lantai</th>
                                        <th>Gedung</th> -->
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tfoot class="text-center thead-light">
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode Ruang</th>
                                        <th>Nama Ruang</th>
                                        <th>Kapasitas</th>
                                        <th>Prodi</th>
                                        <!-- <th>Lantai</th>
                                        <th>Gedung</th> -->
                                        <th>Opsi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($ruang as $item) :
                                    ?>
                                        <tr>
                                            <th class="text-center"><?= $i++ ?></th>
                                            <td class="text-center"><?= $item['kode_ruang'] ?></td>
                                            <td class="text-center"><?= $item['nama_ruang'] ?></td>
                                            <td class="text-center"><?= $item['kapasitas'] ?></td>
                                            <td class="text-center">
                                                <?php
                                                $ruangProdi = model('RuangProdiModel')
                                                    ->where('id_ruang', $item['id_ruang'])
                                                    ->join('prodi', 'ruang_prodi.id_prodi = prodi.id_prodi', 'left')
                                                    ->find();

                                                foreach ($ruangProdi as $rp) :
                                                ?>
                                                    <span class="badge badge-<?= ($rp['id_prodi'] == '1') ? 'success' : (($rp['id_prodi'] == '2') ? 'warning' : (($rp['id_prodi'] == '3') ? 'secondary' : 'light')) ?>"><?= $rp['nama_prodi'] ?></span>
                                                <?php endforeach ?>
                                            </td>
                                            <td class="text-center" style="width: 100px;">
                                                <a href="/ruang/edit/<?= $item['id_ruang'] ?>" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i></a>
                                                <form action="/ruang/delete/<?= $item['id_ruang'] ?>" method="post" class="d-inline">
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