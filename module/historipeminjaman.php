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


<div class="card">
    <div class="card-header">
        <h5>Riwayat Peminjaman Buku</h5>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>KODE</th>
                        <th>JUDUL</th>
                        <th>TANGGAL</th>
                        <th>STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $namausernow = $datauser['nama'];
                        $kueri = query("SELECT * FROM tblpinjam WHERE nama = '$namausernow' AND status = 'Diterima'");
                    ?>
                    <?php foreach ( $kueri as $data ) : ?>
                        <?php
                            $kode = $data["kode"];
                            $judul = $data["judul"];
                            $tanggal = $data["tanggal"];
                            $status = $data["status"];
                        ?>
                        <tr>
                            <td><?= $kode; ?></td>
                            <td><?= $judul; ?></td>
                            <td><?= $tanggal; ?></td>
                            <td><?= $status; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>