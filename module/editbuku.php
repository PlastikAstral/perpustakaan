<?php
	$id = $_GET["id"];
	$data = query("SELECT * FROM tblbuku WHERE id = $id ")[0];
	$kode = $data["kode"];
	$judul = $data["judul"];
	$penulis = $data["penulis"];
	$penerbit = $data["penerbit"];
	$jumlah = $data["jumlah"];
    $jenis = $data["jenis"];
	$tahun = $data["tahun"];



	if ( !isset($_GET["id"]) ) {
		header('location: ?page=managebuku');
	} else {
		if ( isset($_POST["submit"]) ) {
			if ( ubahbuku($_POST) > 0 ) {
				echo "
				<script>
				  alert('Buku Berhasil Diubah!');
				  window.location = '?page=managebuku';
				</script>
				";
			} else {
				echo "
					<script>
					  alert('Buku Gagal Diubah!');
					  window.location  = '?page=managebuku';
					</script>
				";
			}
		}
	}


?>

<div class="row match-height">
    <div class="col-md-6 col-12">
        <div class="card">
            <div class="card-header">
                <h5>Edit Informasi Buku</h5>
            </div>

            <div class="card-body">
                <form action="" class="form form-horizontal" method="post">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" name="id" value="<?= $id; ?>" readonly class="form-control form-control-success">
                            </div>
                            <div class="col-md-4">
                                <label for="kode">Kode Buku</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input id="kode" type="text" class="form-control form-control-success" name="kode" value="<?= $kode; ?>" readonly>
                            </div>

                            <div class="col-md-4">
                                <label for="judul">Judul Buku</label>
                            </div>

                            <div class="col-md-8 form-group">
                                <input id="judul" type="text" class="form-control form-control-success" name="judul" value="<?= $judul; ?>" required autocomplete="off">
                            </div>

                            <div class="col-md-4">
                                <label for="penulis">Penulis Buku</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input id="penulis" type="text" class="form-control form-control-success" name="penulis" value="<?= $penulis; ?>" required autocomplete="off">
                            </div>

                            <div class="col-md-4">
                                <label for="penerbit">Penerbit Buku</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input id="penerbit" type="text" class="form-control form-control-success" name="penerbit" value="<?= $penerbit; ?>" required autocomplete="off">
                            </div>

                            <div class="col-md-4">
                                <label for="jenis">Jenis Buku</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input id="jenis" type="text" class="form-control form-control-success" name="jenis" value="<?= $jenis; ?>" required autocomplete="off">
                            </div>

                            <div class="col-md-4">
                                <label for="tahun">Tahun</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input id="tahun" type="text" class="form-control form-control-success" name="tahun" value="<?= $tahun; ?>" required autocomplete="off">
                            </div>

                            <div class="col-md-4">
                                <label for="jumlah">Jumlah</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input id="jumlah" type="text" class="form-control form-control-success" name="jumlah" value="<?= $jumlah; ?>" required autocomplete="off">
                            </div>

                            <div class="col-4">
                            <button type="submit" name="submit" class="btn btn-primary">Ubah Data</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>