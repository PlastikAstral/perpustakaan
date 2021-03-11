<?php
    if ( isset($_POST["submitinfo"]) ) {
        $id = $_POST["id"];
        $data = query("SELECT * FROM tbluser WHERE id = $id")[0];
        $nama = $data["nama"];
        $email = $data["email"];
        $password = $data["password"];

        if ( password_verify($_POST["password"],$data["password"]) ) {
        if ( edituser($_POST) > 0 ) {
            echo "
            <script>
            alert('Profil Telah diterapkan!');
            window.location = 'index.php';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Profil Gagal diterapkan!');
                window.location  = '?page=changeinformation';
            </script>
            ";
        }
        } else {
        echo "
            <script>
            alert('Password Salah!');
            window.location = '?page=changeinformation';
            </script>
            ";
        }
    }

    // Update Password User
    if ( isset($_POST["submitpassword"]) ) {
        $id = $_POST["id"];
        $passlama = $_POST["passlama"];
        $passbaru = $_POST["passbaru"];
        $data = query("SELECT * FROM tbluser WHERE id = $id")[0];
        $nama = $data["nama"];
        $email = $data["email"];
        $password = $data["password"];

        if ( password_verify($passlama,$password) ) {
        if ( editpassworduser($_POST) > 0 ) {
            echo "
            <script>
            alert('Password Telah Diubah!');
            window.location = 'index.php';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Password Gagal Diubah!');
                window.location  = '?page=changeinformation';
            </script>
            ";
        }
        } else {
        echo "
            <script>
            alert('Password Salah!');
            window.location = '?page=changeinformation';
            </script>
            ";
        }
    }

?>
<div class="row match-height">
    <div class="col-md-6 col-12">
        <div class="card">
            <div class="card-header">
                <h5>Ganti Informasi Profil</h5>
            </div>

            <div class="card-body">
                <form action="" method="post" class="form form-horizontal">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <input class="form-control" name="id" value="<?= $datauser["id"]; ?>" hidden>
                        </div>
                        <div class="col-md-4">
                            <label for="nama">Nama</label>
                        </div>

                        <div class="col-md-8 form-group">
                            <input class="form-control" type="text" id="nama" name="nama" required autocomplete="off" value="<?= $datauser["nama"]; ?>">
                        </div>

                        <div class="col-md-4">
                            <label for="email">Email</label>
                        </div>

                        <div class="col-md-8 form-group">
                            <input class="form-control" type="email" id="email" name="email" required autocomplete="off" value="<?= $datauser["email"]; ?>">
                        </div>

                        <div class="col-md-4">
                            <label for="password">Masukan Password</label>
                        </div>

                        <div class="col-md-8 form-group">
                        <input class="form-control" type="password" id="password" name="password">
                        </div>

                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-primary" name="submitinfo">Ganti</button>
                        </div>
                    </div>
                </form>
            </div>

                <div class="card-header">
                    <div class="col-sm-4 ">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#inlineForm">
                            Ganti Password
                        </button>
                    </div>
                </div>
        </div>
    </div>

        <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">Ganti Password</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                        </button>
                    </div>
                    <form method="post" action="">
                        <div class="modal-body">
                            <input type="text" name="id" value="<?= $datauser['id']; ?>" hidden>

                                <label for="passlama">Password Lama</label>
                            <div class="form-group">
                                <input placeholder="Password Lama" class="form-control" id="passlama" type="password" name="passlama" autocomplete="off" required>
                            </div>

                            <label for="passbaru">Password Lama</label>
                            <div class="form-group">
                                <input placeholder="Password Baru" class="form-control" id="passbaru" type="password" name="passbaru" autocomplete="off" required>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                            </button>
                            <button type="submit" name="submitpassword" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Ganti Password</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>