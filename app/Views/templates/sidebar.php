<!-- Sidebar -->
<div class="sidebar sidebar-style-2">
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <div class="user">
        <div class="avatar-sm float-left mr-2">
          <img src="/assets/img/<?= session()->get('avatar') ?>" alt="Avatar" class="avatar-img rounded-circle">
        </div>
        <div class="info">
          <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
            <span>
              <?= session()->get('username') ?>
              <span class="user-level"><?= session()->get('role') ?></span>
              <span class="caret"></span>
            </span>
          </a>
          <div class="clearfix"></div>

          <div class="collapse in" id="collapseExample">
            <ul class="nav">
              <li><a href="/users/show/<?= session()->get('id_user') ?>"><span class="link-collapse">Profil Saya</span></a></li>
              <li><a href="/users/edit/<?= session()->get('id_user') ?>"><span class="link-collapse">Edit Profil</span></a></li>
              <li><a href="/logout"><span class="link-collapse">Keluar</span></a></li>
            </ul>
          </div>
        </div>
      </div>
      <ul class="nav nav-primary">
        <li class="nav-item <?= (service('uri')->getSegment(1) == 'dashboard') || (service('uri')->getSegment(1) == '') ? 'active' : ''; ?>">
          <a href="/">
            <i class="fas fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-section">
          <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
          </span>
          <h4 class="text-section">Master Data</h4>
        </li>
        <li class="nav-item <?= (service('uri')->getSegment(1) == 'prodi') ? 'active' : ''; ?>">
          <a href="/prodi">
            <i class="fas fa-graduation-cap"></i>
            <p>Program Studi</p>
          </a>
        </li>
        <li class="nav-item <?= (service('uri')->getSegment(1) == 'mata_kuliah') ? 'active' : ''; ?>">
          <a href="/mata_kuliah">
            <i class="fas fa-book"></i>
            <p>Mata Kuliah</p>
          </a>
        </li>
        <li class="nav-item <?= (service('uri')->getSegment(1) == 'dosen') ? 'active' : ''; ?>">
          <a href="/dosen">
            <i class="fas fa-id-badge"></i>
            <p>Dosen</p>
          </a>
        </li>
        <li class="nav-item <?= (service('uri')->getSegment(1) == 'ruang') ? 'active' : ''; ?>">
          <a href="/ruang">
            <i class="fas fa-building"></i>
            <p>Ruang</p>
          </a>
        </li>
        <li class="nav-item <?= (service('uri')->getSegment(1) == 'jadwal_dosen') ? 'active' : ''; ?>">
          <a href="/jadwal_dosen">
            <i class="fas fa-clock"></i>
            <p>Jadwal Dosen</p>
          </a>
        </li>
        <li class="nav-section">
          <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
          </span>
          <h4 class="text-section">Main Program</h4>
        </li>
        <li class="nav-item <?= (service('uri')->getSegment(1) == 'prediksi') ? 'active' : ''; ?>">
          <a href="/prediksi">
            <i class="fas fa-chart-line"></i>
            <p>Prediksi Peserta</p>
          </a>
        </li>
        <li class="nav-item <?= (service('uri')->getSegment(1) == 'kelas') ? 'active' : ''; ?>">
          <a href="/kelas">
            <i class="fas fa-tags"></i>
            <p>Kelas Kuliah</p>
          </a>
        </li>
        <li class="nav-item <?= (service('uri')->getSegment(1) == 'jadwal') ? 'active' : ''; ?>">
          <a href="/jadwal">
            <i class="fas fa-calendar"></i>
            <p>Jadwal Kuliah</p>
          </a>
        </li>
        <li class="nav-section">
          <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
          </span>
          <h4 class="text-section">Management</h4>
        </li>
        <li class="nav-item <?= (service('uri')->getSegment(1) == 'users') ? 'active' : ''; ?>">
          <a href="/users">
            <i class="fas fa-users-cog"></i>
            <p>Pengguna</p>
          </a>
        </li>
        <li class="nav-section">
          <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
          </span>
          <h4 class="text-section">Additional</h4>
        </li>
        <li class="nav-item <?= (service('uri')->getSegment(1) == 'setting') ? 'active' : ''; ?>">
          <a href="/setting">
            <i class="fas fa-cog"></i>
            <p>Settings</p>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>
<!-- End Sidebar -->