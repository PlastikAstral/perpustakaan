<?php
    $tanggalsekarang = Date("Y-m-d");

    if ( isset($_GET["kembalikan"]) ) {

        if ( kembalikanbuku($_GET) > 0 ) {
        echo "
            <script>
            alert('Tunggu pengelola perpus konfirmasi!');
            window.location = '?page=listpeminjaman';
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

?>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Buku Yang Sedang Dibaca</h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-stripped tabble-sm">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Judul Buku</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Jumlah Pinjam</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php
                                            $namausernow = $datauser['nama'];
                                            $kueri = query("SELECT * FROM tblpinjam WHERE nama = '$namausernow' AND status = 'Dibaca'");
                                        ?>
                                        <?php foreach ( $kueri as $data ) : ?>
                                            <?php
                                                $id = $data["id"];
                                                $kode = $data["kode"];
                                                $judul = $data["judul"];
                                                $tanggal = $data["tanggal"];
                                                $status = $data["status"];
                                                $jmlpinjam = $data["jml_pinjam"];
                                            ?>
                                            <tr>
                                                <td><?= $kode; ?></td>
                                                <td><?= $judul; ?></td>
                                                <td><?= $tanggal; ?></td>
                                                <td><?= $status; ?></td>
                                                <td><?= $jmlpinjam; ?></td>
                                                <td><a class="btn btn-primary" href="?page=listpeminjaman&kembalikan=&id=<?= $id; ?>&kode=<?= $kode; ?>&nama=<?= $datauser['nama']; ?>&tanggalpinjam=<?= $tanggal; ?>&tanggalkembalikan=<?= $tanggalsekarang; ?>&jmlpinjam=<?= $jmlpinjam; ?>">Kembalikan</a></td>
                                            </tr>
                                        <?php endforeach; ?>
                                </tbody>
                            <table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<br><br><br>
    <div class="row">
        <div class="col col-lg-12">
            <h5>Peminjaman Yang Pending</h5>
        </div>

        <div class="row">
            <div class="table-responsive">
                <table class="table table-stripped tabble-sm">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Judul Buku</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Jumlah Pinjam</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $namausernow = $datauser['nama'];
                            $kueri = query("SELECT * FROM tblpinjam WHERE nama = '$namausernow' AND status = 'Pending'");
                        ?>
                        <?php foreach ( $kueri as $data ) : ?>
                            <?php
                                $id = $data["id"];
                                $kode = $data["kode"];
                                $judul = $data["judul"];
                                $tanggal = $data["tanggal"];
                                $status = $data["status"];
                                $jmlpinjam = $data["jml_pinjam"];
                            ?>
                            <tr>
                                <td><?= $kode; ?></td>
                                <td><?= $judul; ?></td>
                                <td><?= $tanggal; ?></td>
                                <td><?= $status; ?></td>
                                <td><?= $jmlpinjam; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                <table>
            </div>
        </div>
    </div>





