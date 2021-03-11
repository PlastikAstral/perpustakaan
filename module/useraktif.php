    <?php

    $kueri = query("SELECT * FROM tbluser WHERE id !='$_SESSION[iduser]'");

    $tanggal = Date("Y-m-d");

    // Cek tombol submit pencarian
    if ( isset($_POST["cari"]) ) {
        $kueri = cariuser($_POST["keyword"]);
    }

    // Cek aksi hapus
    if ( isset($_GET["hapus"]) ) {

        if ( hapususer($_GET) > 0 ) {
        echo "
            <script>
            alert('User sudah dihapus');
            window.location = '?page=useraktif';
            </script>
        ";
        } else {
        echo "
            <script>
            alert('Gagal!');
            </script>
        ";
        }
    }

    // Cek aksi block
    if ( isset($_GET["block"]) ) {

        if ( blockuser($_GET) > 0 ) {
        echo "
            <script>
            alert('User sudah di block. ');
            window.location = '?page=useraktif';
            </script>
        ";
        } else {
        echo "
            <script>
            alert('Gagal!');
            </script>
        ";
        }
    }

    // Cek aksi unBlock

    if ( isset($_GET["unblock"]) ) {

        if ( aktifkanuser($_GET) > 0 ) {
        echo "
            <script>
            alert('User sudah di aktifkan.');
            window.location = '?page=useraktif';
            </script>
        ";
        } else {
        echo "
            <script>
            alert('User sudah aktif sebelumnya!');
            </script>
        ";
        }
    }
    ?>

<div class="card">
    <div class="card-header">
        <h5>List User</h5>
    </div>
    <div class="card-body">
        
        <div class="row">
            <div class="col-md-3">
                <form class="input-group" method="post" action="">
                <input type="text" class="form-control" <?php if (isset($_POST['keyword'])) {
                  echo "value='$_POST[keyword]'";
                } ?> name="keyword" placeholder="Cari Nama User" autocomplete="off">
                    <button type="submit" class="btn btn-primary input-group-append" name="cari">Cari</button>
                </form>
            </div>
            <div class="col-md-5">
                <a href="?page=useraktif" class="btn btn-primary">Tampilkan Semua User</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>NAMA</th>
                                <th>USERNAME</th>
                                <th>EMAIL</th>
                                <th>Jenis Kelamin</th>
                                <th>LEVEL</th>
                                <th>Status</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ( $kueri as $data ) : ?>
                                <?php
                                $id = $data["id"];
                                $nama = $data["nama"];
                                $username = $data["username"];
                                $email = $data["email"];
                                $jenis_kelamin = $data["jenis_kelamin"];
                                $status = $data["status"];
                                $lvl = $data["lvl"];
                                ?>
                                <tr>
                                <td><?= $nama; ?></td>
                                <td><?= $username; ?></td>
                                <td><?= $email; ?></td>
                                <td><?= $jenis_kelamin; ?></td>
                                <td><?= $lvl; ?></td>
                                <td><?= $status; ?></td>
                                <td>
                                <a class="btn btn-danger" href="?page=useraktif&hapus=&id=<?= $id; ?>" onclick="return confirm('Apakah user ini akan dihapus ?');">Hapus</a>
                                <a class="btn btn-warning" href="?page=useraktif&block=&id=<?= $id; ?>" onclick="return confirm('Apakah user ini akan di block ?');">Block</a>
                                <a class="btn btn-success" href="?page=useraktif&unblock=&id=<?= $id; ?>" onclick="return confirm('Apakah user ini akan di aktifkan ?');">Unblock</a>
                                </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>