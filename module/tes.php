
    <div id="sidebar" class="active">
        <div class="sidebar-wrapper active">
            <div class="sidebar-header">
                          <div class="d-flex align-items-center">
                              <div class="avatar avatar-xl">
                                  <img style="height: 60px !important;" src="../assets/images/faces/<?= $datauser["pict"]; ?>" alt="avatar">
                              </div>
                              <div class="ms-3 name">
                                  <h5 class="font-bold"><?= $datauser["nama"]; ?></h5>
                                  <h6 class="text-muted mb-0"><?= $datauser["username"] ?></h6>
                              </div>
                          </div>
            </div>
            <div class="sidebar-menu">
              <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item active ">
                    <a href="index.php" class='sidebar-link'>
                      <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item  ">
                    <a href="?page=listbuku" class='sidebar-link'>
                      <i class="bi bi-book-fill"></i>
                      <span>File Uploader</span>
                    </a>
                </li>

            </ul>
            </div>
        </div>
    </div>    





    
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6">
                <p></p>
            </div>
            <div class="col-sm-6 offset-3">
                <h3>Sistem Informasi Perpustakaan</h3>
            </div>
            <div class="col-sm-1 offset-2">
            <ol class="breadcrumb text-center">
                <li class="breadcrumb-item"><a href="logout.php">Logout</a></li>
            </ol>
            </div>                
        </div>
    </div>
</div>