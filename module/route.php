<?php
if(isset($_GET["page"]))

{

    switch($_GET["page"])

    {

      case "listbuku"; include "listbuku.php"; break;
      case "listpeminjaman"; include "listpeminjaman.php"; break;
      case "historipeminjaman"; include "historipeminjaman.php"; break;
      case "changeinformation"; include "changeinformation.php"; break;
      case "changephoto"; include "changephoto.php"; break;
      case "useraktif"; include "useraktif.php"; break;
      case "userpending"; include "userpending.php"; break;
      case "tambahadmin"; include "tambahadmin.php"; break;
      case "managebuku"; include "managebuku.php"; break;
      case "editbuku"; include "editbuku.php"; break;
      case "peminjam"; include "peminjam.php"; break;
      case "pengembalian"; include "pengembalian.php"; break;
      case "tampilpesan"; include "tampilpesan.php"; break;


    }
}else{
    include "dashboard.php";
}

?>
