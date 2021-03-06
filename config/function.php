<?php
	// Koneksi Database
	date_default_timezone_set('Asia/Jakarta');
	$host = "localhost";
	$user = "root";
	$pass = "";
	$db = "sysperpus";
	$conn = mysqli_connect($host,$user,$pass,$db);

	function query($query) {
		global $conn;
		$result = mysqli_query($conn, $query);
		$rows = [];
		while ( $row = mysqli_fetch_assoc($result) ) {
				$rows[]  = $row;
		}
		return $rows;
	}

	function tambahbuku($databuku) {
		global $conn;
		$kode = htmlspecialchars($databuku["kode"]);
		$judul = htmlspecialchars($databuku["judul"]);
		$penulis = htmlspecialchars($databuku["penulis"]);
		$penerbit = htmlspecialchars($databuku["penerbit"]);
		$tahun = htmlspecialchars($databuku["tahun"]);
		$jumlah = htmlspecialchars($databuku["jumlah"]);
		$jenis = htmlspecialchars($databuku["jenis"]);

		$query = "INSERT INTO tblbuku VALUES ('','$kode','$judul','$penulis','$penerbit','$tahun','$jumlah','$jenis')";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	function hapusbuku($id) {
		global $conn;
		$query = "DELETE FROM tblbuku WHERE id = $id";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	function ubahbuku($databuku) {
		global $conn;
		$id = $databuku["id"];
		$kode = htmlspecialchars($databuku["kode"]);
		$judul = htmlspecialchars($databuku["judul"]);
		$penulis = htmlspecialchars($databuku["penulis"]);
		$penerbit = htmlspecialchars($databuku["penerbit"]);
		$jumlah = htmlspecialchars($databuku["jumlah"]);
		$tahun = htmlspecialchars($databuku["tahun"]);
		$jenis = htmlspecialchars($databuku["jenis"]);

		$query = "UPDATE tblbuku SET
					judul = '$judul',
					penulis = '$penulis',
					penerbit = '$penerbit',
					tahun = '$tahun',
					jumlah = $jumlah,
					jenis = '$jenis'
				   WHERE id = $id";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	function pencarian($keyword) {
		$query = "SELECT * FROM tblbuku WHERE
					judul LIKE '%$keyword%'
				 ";
		return query($query);
	}

	function registrasi($datauser) {
		global $conn;

		$nama = $datauser["nama"];
		$username = strtolower(stripslashes($datauser["username"]));
		$password = mysqli_real_escape_string($conn, $datauser["password"]);
		$email = $datauser["email"];
		$jenis_kelamin = $datauser["jenis_kelamin"];
		if ($jenis_kelamin == 'laki-laki') {
			$pict = 'default.png';
		} elseif ($jenis_kelamin == 'perempuan') {
			$pict = 'defaultwoman.png';
		}

		// encrypt password
		$passencrypted = password_hash($password, PASSWORD_DEFAULT);

		// Cek username
		$cekuser = mysqli_query($conn, "SELECT username FROM tbluser WHERE username = '$username'");
		if ( mysqli_fetch_assoc($cekuser) ) {
			echo "
				<script>
					alert('Username sudah ada!')
				</script>
			";
			return false;
		}

		mysqli_query($conn, "INSERT INTO tbluser VALUES('','$nama','$username','$passencrypted','$email','User','$pict','$jenis_kelamin', 'Pending')");
		return mysqli_affected_rows($conn);
	}

	function uploadfoto($data) {
		global $conn;

		// Ambil ID
		$id = $data['id'];


		// Ambil Gambar
		$namafile = $_FILES['pict']['name'];
		$ukuranfile = $_FILES['pict']['size'];
		$error = $_FILES['pict']['error'];
		$tmp = $_FILES['pict']['tmp_name'];




		// Cek apakah di upload
		if ( $error === 4 ) {
			echo "
		        <script>
		          alert('Pilih Gambar!');
		          window.location = '?page=changephoto';
		        </script>
		      ";
		    return false;
		}

		// Cek apakah di upload itu adalah gambar.
		$ekstensivalid = ['jpg', 'jpeg', 'png'];
		$ekstensifile = explode('.', $namafile);
		$ekstensifile = strtolower(end($ekstensifile));
		if ( !in_array($ekstensifile, $ekstensivalid) ) {
			echo "
		        <script>
		          alert('Gambar hanya boleh ber-ekstensi .jpg, .jpeg, .png');
		          window.location = '?page=changephoto';
		        </script>
		      ";
		    return false;
		}

		// Cek ukuran gambar harus <2jt byte
		if ( $ukuranfile > 2000000 ) {
			echo "
		        <script>
		          alert('Ukuran gambar terlalu besar!');
		          window.location = '?page=changephoto';
		        </script>
		      ";
		    return false;
		}

		// Generate nama file random
		$fixfile = uniqid();
		$fixfile .= '.';
		$fixfile .= $ekstensifile;

		// Upload Gambar
		move_uploaded_file($tmp, '../assets/img/avatar/'.$fixfile);


		// Eksekusi Gambar
		$pict = $fixfile;

		if ( !$pict ) {
		     return false;
		} else {
			$query = "UPDATE tbluser SET pict = '$pict' WHERE id = $id";
			mysqli_query($conn, $query);
		}

		return mysqli_affected_rows($conn);

	}

	function edituser($datauser) {
		global $conn;
		$id = $datauser["id"];
		$nama = htmlspecialchars($datauser["nama"]);
		$email = htmlspecialchars($datauser["email"]);

		$query = "UPDATE tbluser SET  nama = '$nama', email = '$email' WHERE id = $id";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	function editpassworduser($datauser) {
		global $conn;
		$id = $datauser["id"];
		$password = htmlspecialchars($datauser["passbaru"]);

		// Encrypt Password
		$passencrypted = password_hash($password, PASSWORD_DEFAULT);

		$query = "UPDATE tbluser SET password = '$passencrypted' WHERE id = $id";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	function pinjambuku($databuku) {
		global $conn;

		$kode = $databuku['kode'];
		$nama = $databuku['nama'];
		$tanggal = $databuku['tanggal'];
		$jumlah = $databuku['jumlah'] - 1;

		
		$query = mysqli_query($conn,"UPDATE tblbuku SET jumlah='$jumlah' WHERE kode = '$kode'");

		$query = mysqli_query($conn,"SELECT judul FROM tblbuku WHERE kode = '$kode'");
		$result = mysqli_fetch_assoc($query);
		$judul = $result["judul"];

		$exe = mysqli_query($conn, "INSERT INTO tblpinjam VALUES('','$kode','$judul','$nama','$tanggal','Pending','1')");
		return mysqli_affected_rows($conn);
	}

	function kembalikanbuku($databuku) {
		global $conn;
		
		$id = $databuku['id'];
		$kode = $databuku['kode'];
		$nama = $databuku['nama'];
		$tanggalpinjam = $databuku['tanggalpinjam'];
		$tanggalkembalikan = $databuku['tanggalkembalikan'];
		$jmlpinjam = $databuku['jmlpinjam'];

		$query = mysqli_query($conn, "SELECT * FROM tblpinjam WHERE kode = '$kode'");
		$result = mysqli_fetch_assoc($query);
		$judul = $result['judul'];

		$exe = mysqli_query($conn, "INSERT INTO tblrequestkembali VALUES
							('','$kode','$judul','$nama','$tanggalpinjam','$tanggalkembalikan','$jmlpinjam')");
		$exe2 = mysqli_query($conn, "UPDATE tblpinjam SET status = 'Kembali' WHERE id = '$id' AND nama = '$nama'");
		return mysqli_affected_rows($conn);
	}

	function konfirmasikembalibuku($data) {
		global $conn;
		$id = $data['id'];
		$kode = $data['kode'];
		$nama = $data['nama'];
		$tanggalpinjam = $data['tanggalpinjam'];
		$tanggalkembalikan = $data['tanggalkembalikan'];
		$jmlkembali = $data['jmlkembali'];

		$query = mysqli_query($conn, "SELECT judul FROM tblpinjam WHERE kode = '$kode'");
		$result = mysqli_fetch_assoc($query);
		$judul = $result['judul'];

		$query2 = mysqli_query($conn, "SELECT kode,jumlah FROM tblbuku where kode = '$kode'");
		$result2 = mysqli_fetch_assoc($query2);
		$jumlah = $result2['jumlah'] + $jmlkembali;

		$exe = mysqli_query($conn, "DELETE FROM tblrequestkembali WHERE id = '$id' AND nama = '$nama'");
		$exe2 = mysqli_query($conn, "UPDATE tblpinjam SET status = 'Diterima' WHERE kode = '$kode' AND nama = '$nama'");
		$exe3 = mysqli_query($conn, "UPDATE tblbuku SET jumlah = '$jumlah' WHERE kode = '$kode'");

		return mysqli_affected_rows($conn);
	}

		function konfir($data) {
			global $conn;
			$id = $data['konfirmasikan'];
			mysqli_query($conn, "UPDATE tblpinjam SET status = 'Dibaca' WHERE id = '$id'");

			return mysqli_affected_rows($conn);
		}

	function pencarianuser($keyword) {
		$query = "SELECT * FROM tblrequestkembali WHERE
					nama LIKE '%$keyword%'
				 ";
		return query($query);
	}

	function cariuser($keyword) {
		$query = "SELECT * FROM tbluser WHERE
					nama LIKE '%$keyword%'
					AND status = 'Active'
					AND lvl = 'User'
				 ";
		return query($query);
	}

	function cariuserpending($keyword) {
		$query = "SELECT * FROM tbluser WHERE
					nama LIKE '%$keyword%'
					AND status = 'Pending'
					AND lvl = 'User'
				 ";
		return query($query);
	}

	function hapususer($data) {
		global $conn;

		$id = $data['id'];

		$query = "DELETE FROM tbluser WHERE id = $id";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	function blockuser($data) {
		global $conn;

		$id = $data['id'];

		$query = "UPDATE tbluser SET status = 'Pending' WHERE id = '$id'";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	function aktifkanuser($data) {
		global $conn;

		$id = $data['id'];

		$query = "UPDATE tbluser SET status = 'Active' WHERE id = '$id'";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	function kirimpesan($datapesan) {
		global $conn;

		$judul = $datapesan['judul'];
		$penerima = $datapesan['penerima'];
		$isi = $datapesan['pesan'];
		$pengirim = $datapesan['nama'];
		$username = $datapesan['username'];

		// Cek Username
		$cekuser = mysqli_query($conn, "SELECT username FROM tbluser WHERE username = '$penerima'");
		if ( !mysqli_fetch_assoc($cekuser) ) {
			echo "
				<script>
					alert('Username tidak ada!')
				</script>
			";
			return false;
		} else {
			$query = "INSERT INTO tblpesan VALUES ('','$judul','$isi','$pengirim','$username','$penerima')";
			mysqli_query($conn, $query);

			return mysqli_affected_rows($conn);
		}
	}

	function hapuspesan($datapesan) {
		global $conn;
		$id = $datapesan['hapus'];
		$query = "DELETE FROM tblpesan WHERE id = $id";

		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	function daftaradmin($datauser) {
		global $conn;

		$nama = $datauser["nama"];
		$lvl = $datauser["lvl"];
		$username = strtolower(stripslashes($datauser["username"]));
		$password = mysqli_real_escape_string($conn, $datauser["password"]);
		$email = $datauser["email"];
		$jenis_kelamin = $datauser["jenis_kelamin"];
		if ($jenis_kelamin == 'laki-laki') {
			$pict = 'default.png';
		} elseif ($jenis_kelamin == 'perempuan') {
			$pict = 'defaultwoman.png';
		}

		// encrypt password
		$passencrypted = password_hash($password, PASSWORD_DEFAULT);

		// Cek username
		$cekuser = mysqli_query($conn, "SELECT username FROM tbluser WHERE username = '$username'");
		if ( mysqli_fetch_assoc($cekuser) ) {
			echo "
				<script>
					alert('Username sudah ada!')
				</script>
			";
			return false;
		}

		mysqli_query($conn, "INSERT INTO tbluser VALUES('','$nama','$username','$passencrypted','$email','$lvl','$pict','$jenis_kelamin', 'Active')");
		return mysqli_affected_rows($conn);
	}
?>
