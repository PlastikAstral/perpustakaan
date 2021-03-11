<?php
  $user = $_SESSION["datauser"];
  $queryuser = mysqli_query($conn, "SELECT * FROM tbluser WHERE username = '$user'");
  $datauser = mysqli_fetch_array($queryuser);
?>


<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
    <div class="row page-heading">
        <h2 class="col-md-8 header align-items-center">Sistem Informasi Perpustakaan</h2>
        <a class="btn btn-danger col-md-1 offset-3 " style="height: 39px;" href="logout.php">Logout</a>
        
    </div>
</header>