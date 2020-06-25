<?php

require '../functionsales.php';

$id = $_GET["no_penawaran"];


    if (deletepenawaran($_POST) > 0) {
        echo "<script>alert('data berhasil dihapus!');
			  document.location.href= 'view_penawaran.php';
			  </script>";
    } else {
        echo "<script>alert('system error, silahkan hubungi admin!');
			  document.location.href= 'view_penawaran.php';
			  </script>";
    }

