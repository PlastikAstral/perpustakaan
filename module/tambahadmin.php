<?php

  // Cek Tombol
if ( isset($_POST["daftar"]) ) {

    if ( daftaradmin($_POST) > 0 ) {
    echo "
        <script>
            alert('User Berhasil Ditambahkan!');
            window.location = '?page=tambahadmin';
        </script>
    ";
    } else {
        echo "
        <script>
            alert('Gagal menambahkan User!');
        </script>
        ";
    }
}

?>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Tambah User</h5>
            </div>
            <div class="card-body">
                <form action="" method="post" class="form-horizontal">
                    <div class="col-sm-12 form-group">
                        <input class="form-control" type="text" name="nama" placeholder="Masukkan Nama Lengkap" required autocomplete="off">
                    </div>
                    <div class="col-sm-12 form-group">
                        <input class="form-control" type="text" name="username" placeholder="Masukkan Username (max.16 karakter)" required autocomplete="off" maxlength="16">
                    </div>
                    <div class="col-sm-12 form-group">
                        <input class="form-control" type="password" name="password" placeholder="Masukkan Password (max.16 karakter)" required autocomplete="off" maxlength="16">
                    </div>
                    <div class="col-sm-12 form-group">
                        <input class="form-control" type="email" name="email" placeholder="Masukkan Email" required autocomplete="off">
                    </div>
                    <div class="col-sm-12 form-group">
                        <select name="jenis_kelamin" class='form-select'>
                            <option value="laki-laki">Laki-Laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="col-sm-12 form-group">
                        <select name="lvl" class='form-select'>
                            <option value="Admin">Admin</option>
                            <option value="User">User</option>
                        </select>
                    </div>
                    </div>
                    <div class="col-sm-4 offset-1 form-group">
                        <button type="submit" class="btn btn-primary" name="daftar">Daftar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>