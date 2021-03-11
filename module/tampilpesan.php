<?php

  if ( !isset($_GET['show']) ) {
    header('location: index.php');
  } elseif ( !isset($_GET['id']) ) {
    header('location: index.php');
  }

  // Cek Tombol Hapus
  if ( isset($_GET['hapus']) ) {
    if ( hapuspesan($_GET) > 0 ) {
      echo "
        <script>
          alert('Pesan berhasil dihapus!');
          window.location = 'index.php';
        </script>
      ";
    } else {
      echo "
        <script>
          alert('Pesan gagal dihapus!');
          window.location = 'index.php';
        </script>
      ";
    }
  }

  // Cek Tombol Kirim
  if ( isset($_POST['kirim']) ) {
    if ( kirimpesan($_POST) > 0 ) {
      echo "
        <script>
          alert('Berhasil mengirim pesan!');
          window.location = 'index.php';
        </script>
      ";
    } else {
      echo "
        <script>
          alert('Gagal Mengirim Pesan!');
          window.location = 'index.php';
        </script>
      ";
    }
  }
?>

<?php
    $id = $_GET['id'];
    $myuname = $datauser["username"];
    $kueri = mysqli_query($conn, "SELECT * FROM tblpesan WHERE id= $id AND penerima = '$myuname'");
    $data = mysqli_fetch_array($kueri);
    $judul = $data['judul'];
    $pengirim = $data['pengirim'];
    $unamepengirim = $data['username'];
    $isi = $data['isi'];
?>

<div class="card">
    <div class="card-header">
    <h4><?= $judul ?></h4>
    <small><?= $pengirim; ?> - <?= $unamepengirim; ?></small><br>
    <a href="#" class="btn btn-primary block" data-bs-toggle="modal" data-bs-target="#default">Balas</a>
    <a href="?hapus=<?= $id; ?>" class="btn btn-danger" onclick="return confirm('Apakah pesan ini akan dihapus ?');">Hapus</a>
    </div>
    <div class="card-body">
        <?= $isi; ?>
    </div>
</div>

<div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Balas Pesan <?= $_GET['uname']; ?></h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            
            <form method="post" action="">
                <div class="modal-body">
                <input type="text" name="nama" value="<?= $datauser['nama']; ?>" hidden>
                <input type="text" name="username" value="<?= $datauser['username']; ?>" hidden>
                    <div class="form-group">
                        <input type="text" name="judul" class="form-control" id="basicInput" autocomplete="off" placeholder="Masukan Subject Pesan">
                    </div>
                    <div class="form-group">
                        <input type="text" name="penerima" class="form-control" id="basicInput" readonly required value="<?= $_GET['uname']; ?>">
                    </div>
                    <div class="form-group with-title mb-3">
                        <textarea class="form-control" name="pesan" rows="3">
                        </textarea>
                        <label>Isi Pesan</label>
                    </div>                                
                </div>

                <div class="modal-footer">
                    <button type="submit" name="kirim" class="btn btn-primary ml-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Balas</span>
                    </button>
                    <button type="button" class="btn" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Batal</span>
                    </button>
                    
                </div>
            </form>
        </div>
    </div>
</div>
