<?php

require '../functionsales.php';

$id_mod = $_GET["pk_mod"];

if (hapusmod($id_mod) > 0) {

    echo "
    <script>
    alert('delete successful!');
    document.location.href = 'view_mod.php';
    </script>
    ";
} else {
    echo "
    <script>
    alert('delete failure!');
    document.location.href = 'view_mod.php';
    </script>";
}
