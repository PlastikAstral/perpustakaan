<?php
  $user = $_SESSION["datauser"];
  $queryuser = mysqli_query($conn, "SELECT * FROM tbluser WHERE username = '$user'");
  $datauser = mysqli_fetch_array($queryuser);
  $statusakun = $datauser["status"];

  if ( $statusakun === 'Pending' ) {
    echo "
      <script>
        alert('Akun anda belum aktif! Minta pengelola perpus untuk mengaktifkannya!');
      </script>
    ";
    session_destroy();
    echo "
      <script>
        window.location = 'login.php';
      </script>
    ";
  }
?>


  <div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
      
      <div class="sidebar-header active">
        <div class="d-flex justify-content-between align-items-center">

          <div class="avatar avatar-xl">
            <img style="height: 60px !important;" src="../assets/images/faces/<?= $datauser["pict"]; ?>" alt="avatar">
          </div>

          <div class="ms-3 name">
            <h5 class="font-bold"><?= $datauser["nama"]; ?></h5>
            <h6 class="text-muted mb-0"><?= $datauser["username"] ?></h6>
          </div>

          <div class="toggler">
            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
          </div>
        </div>
      </div>

      <hr class="garis">
      
      <!--Sidebar Menu-->

      <div class="sidebar-menu">
          <ul class="menu">
              <li class="sidebar-title"><h5>Menu</h5></li>
              

              <!--Menu Aktif-->
              <li class="sidebar-item">
              <a href="index.php" class='sidebar-link'> <i class="bi bi-grid-fill"></i>
              <span>Dashboard</span>
              </a>

              <!--Menu Non-Aktif-->
              <li class="sidebar-item  ">
                  <a href="?page=listbuku" class='sidebar-link'>
                  <i class="bi bi-book-fill"></i>
                  <span>List Buku</span>
                  </a>
              </li>

              <li class="sidebar-item  has-sub">
                  <a href="#" class='sidebar-link'>
                  <i class="bi bi-pen-fill"></i>
                  <span>List Peminjaman</span>
                  </a>
                      <ul class="submenu ">
                          <li class="submenu-item ">
                              <a href="?page=listpeminjaman">Peminjaman</a>
                          </li>

                          <li class="submenu-item ">
                              <a href="?page=historipeminjaman">Riwayat</a>
                          </li>
                      </ul>
              </li>

              <li class="sidebar-item  has-sub">
                  <a href="#" class='sidebar-link'>
                  <i class="bi bi-person-fill"></i>
                  <span>Konfigurasi Akun</span>
                  </a>
                      <ul class="submenu ">
                          <li class="submenu-item ">
                              <a href="?page=changeinformation">Ganti Informasi Profil</a>
                          </li>
                          <!--
                          <li class="submenu-item ">
                              <a href="?page=changephoto">Ganti Foto Profil</a>
                          </li>
                          -->
                      </ul>
              </li>
          </ul>
      </div>

      <?php if ( $datauser["lvl"] === 'Admin' ) : ?>
      <ul class="menu">
        <li class="sidebar-title"><h5>Menu Admin</h5></li>

        <li class="sidebar-item  has-sub">
                  <a href="#" class='sidebar-link'>
                  <i class="bi bi-person-badge-fill"></i>
                  <span>Manage User</span>
                  </a>
                      <ul class="submenu ">
                          <li class="submenu-item ">
                              <a href="?page=useraktif">List User</a>
                          </li>

                          <li class="submenu-item ">
                              <a href="?page=tambahadmin">Tambah User</a>
                          </li>
                      </ul>
        </li>

        <li class="sidebar-item  ">
                  <a href="?page=managebuku" class='sidebar-link'>
                  <i class="bi bi-stack"></i>
                  <span>Manajemen Buku</span>
                  </a>
        </li>

        <li class="sidebar-item  ">
                  <a href="?page=peminjam" class='sidebar-link'>
                  <i class="bi bi-basket-fill"></i>
                  <span>Peminjaman</span>
                  </a>
        </li>

        <li class="sidebar-item  ">
                  <a href="?page=pengembalian" class='sidebar-link'>
                  <i class="bi bi-reply-fill"></i>
                  <span>Pengembalian</span>
                  </a>
        </li>

      </ul>
      <?php endif; ?>

      <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>

    </div>
  </div>