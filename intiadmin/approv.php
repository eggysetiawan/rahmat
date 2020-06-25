<?php

require '../functionsales.php';

session_start();

$no_penawaran = $_GET['no_penawaran'];

if (approve($no_penawaran) > 0) {
    echo "
    <script>
         alert('data approved!');
         document.location.href = 'view_funnel.php';
         </script>
         ";
} else {
    echo "
         <script>
         alert('data gagal disetujui!');
         document.location.href = 'view_penawaran.php';
         </script>
         ";
}

if (reject($no_penawaran) > 0) {
    echo "
    <script>
         alert('data rejected!');
         document.location.href = 'view_funnel.php';
         </script>
         ";
} else {
    echo "
         <script>
         alert('data gagal disetujui!');
         document.location.href = 'view_penawaran.php';
         </script>
         ";
}
