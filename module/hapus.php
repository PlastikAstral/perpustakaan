<?php
	include 'ceklogin.php';
	include '../config/function.php';

	$id = $_GET["id"];

	if ( hapusbuku($id) > 0 ) {
		echo "
			<script>
          		alert('Buku Berhasil Dihapus!');
          		window.location = 'index.php?page=managebuku';
        	</script>
		";
	} else {
		echo "
			<script>
          		alert('Buku Berhasil Ditambah!');
          		window.location = 'index.php?page=managebuku';
        	</script>
		";
	}
?>
