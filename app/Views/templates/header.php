<div class="main-header">
  <div class="logo-header" data-background-color="red2">
    <a href="/" class="logo d-flex align-items-center justify-content-start" style="height: 130%;">
      <img src="/assets/img/logo.png" alt="navbar brand" class="navbar-brand" style="height: 28px;">
    </a>
    <div class="nav-toggle">
      <button class="btn btn-toggle toggle-sidebar">
        <i class="icon-menu"></i>
      </button>
    </div>
  </div>

  <nav class="navbar navbar-header navbar-expand-lg" data-background-color="red2">
    <div class="container-fluid">
      <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
        <li class="nav-item dropdown hidden-caret">
          <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
            <div class="avatar-sm">
              <img src="/assets/img/<?= session()->get('avatar') ?>" alt="Avatar" class="avatar-img rounded-circle">
            </div>
          </a>
          <ul class="dropdown-menu dropdown-user animated fadeIn">
            <div class="dropdown-user-scroll scrollbar-outer">
              <li>
                <div class="user-box">
                  <div class="avatar"><img src="/assets/img/<?= session()->get('avatar') ?>" alt="Avatar" class="avatar-img rounded"></div>
                  <div class="u-text">
                    <h4><?= session()->get('username') ?></h4>
                    <p class="text-muted"><?= session()->get('role') ?></p>
                  </div>
                </div>
              </li>
              <li>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/users/show/<?= session()->get('id_user') ?>">Profil Saya</a>
                <a class="dropdown-item" href="/users/edit/<?= session()->get('id_user') ?>">Edit Profil</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/logout">Keluar</a>
              </li>
            </div>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</div>