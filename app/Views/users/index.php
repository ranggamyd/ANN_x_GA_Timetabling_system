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
                        <a href="/users">Users</a>
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
                <a href="/users/create" class="btn btn-primary btn-round"><i class="fas fa-plus-circle mr-2"></i>Tambah Pengguna</a>
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
                                        <th>Avatar</th>
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tfoot class="text-center thead-light">
                                    <tr>
                                        <th>No.</th>
                                        <th>Avatar</th>
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th>Opsi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($users as $item) :
                                    ?>
                                        <tr>
                                            <th class="text-center"><?= $i++ ?></th>
                                            <td class="text-center">
                                                <img src="/assets/img/<?= $item['avatar'] ?>" alt="Avatar" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                            </td>
                                            <td><?= $item['username'] ?></td>
                                            <td class="text-center"><span class="badge badge-<?= $item['role'] == 'Administrator' ? 'primary' : 'warning' ?>"><?= $item['role'] ?></span></td>
                                            <td class="text-center">
                                                <a href="/users/show/<?= $item['id_user'] ?>" class="btn btn-warning btn-sm mr-2"><i class="fas fa-eye"></i></a>
                                                <a href="/users/edit/<?= $item['id_user'] ?>" class="btn btn-secondary btn-sm mr-2"><i class="fas fa-edit"></i></a>
                                                <form action="/users/delete/<?= $item['id_user'] ?>" method="post" class="d-inline">
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