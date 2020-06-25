<?php

require '../functionsales.php';

$id = $_GET["pk_penawaran"];

if (hapus($id) > 0) {

    echo "
    <script>
    alert('delete successful!');
    document.location.href = 'view_penawaran.php';
    </script>
    ";
} else {
    echo "
    <script>
    alert('delete failure!');
    document.location.href = 'view_penawaran.php';
    </script>";
}
