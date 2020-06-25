<?php

require '../functionsales.php';

$id = $_GET["pk_penawaran"];

if (restore($id) > 0) {

    echo "
    <script>
    alert('restore successful!');
    document.location.href = 'recycle.php';
    </script>
    ";
} else {
    echo "
    <script>
    alert('restore failure!');
    document.location.href = 'view_penawaran.php';
    </script>";
}
