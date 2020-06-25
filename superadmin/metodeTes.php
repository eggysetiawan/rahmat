<?php
require '../functionsales.php';
session_start();
$username = $_POST['username'];

$nowyear = date('Y');
$resultView = mysqli_query($conn, "SELECT (tahun_targeting) FROM sales_targeting WHERE username = '$username' AND NOT tahun_targeting = '$nowyear' GROUP BY tahun_targeting");
$countTahun = mysqli_num_rows($resultView);

$result14 = mysqli_query($conn, "SELECT SUM(harga_po_targeting) AS total14 FROM sales_targeting WHERE tahun_targeting = '2014' AND username = '$username'");
$row14 = mysqli_fetch_assoc($result14);

$result15 = mysqli_query($conn, "SELECT SUM(harga_po_targeting) AS total15 FROM sales_targeting WHERE tahun_targeting = '2015' AND username = '$username'");
$row15 = mysqli_fetch_assoc($result15);

$result16 = mysqli_query($conn, "SELECT SUM(harga_po_targeting) AS total16 FROM sales_targeting WHERE tahun_targeting = '2016' AND username = '$username'");
$row16 = mysqli_fetch_assoc($result16);

$result17 = mysqli_query($conn, "SELECT SUM(harga_po_targeting) AS total17 FROM sales_targeting WHERE tahun_targeting = '2017' AND username = '$username'");
$row17 = mysqli_fetch_assoc($result17);

$result18 = mysqli_query($conn, "SELECT SUM(harga_po_targeting) AS total18 FROM sales_targeting WHERE tahun_targeting = '2018' AND username = '$username'");
$row18 = mysqli_fetch_assoc($result18);

$result19 = mysqli_query($conn, "SELECT SUM(harga_po_targeting) AS total19 FROM sales_targeting WHERE tahun_targeting = '2019' AND username = '$username'");
$row19 = mysqli_fetch_assoc($result19);

$total14 = $row14['total14'];
$total15 = $row15['total15'];
$total16 = $row16['total16'];
$total17 = $row17['total17'];
$total18 = $row18['total18'];
$total19 = $row19['total19'];

$totalPO = [$total14, $total15, $total16, $total17, $total18, $total19];


@$tahunTarget = $_POST['tahun1'];

$valueTahun = explode(',', $tahunTarget);
@$tahunTarget1 = $valueTahun[0];
@$tahunTarget2 = $valueTahun[1];

// echo $tahunTarget1;
// echo $tahunTarget2;

// $tahunTarget = 7;
@$myTarget = $_POST['ycTarget'];








if ($_SESSION['level'] == "superadmin") {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Straight Line Method</title>
        <?php include('head.php'); ?>
    </head>

    <body>
        <?php include('menu-bar.php'); ?>
        <div class="container-footer">
            <!-- buat footer -->
            <div class="bc-icons-2">
                <?php include('breadcrumb.php'); ?>
                <li class="breadcrumb-item"><a href="index.php">Home</a><i class="fas fa-angle-right mx-2" aria-hidden="true"></i></li>

                <li class="breadcrumb-item active" aria-current="page">My Method</li>
                </ol>
                </nav>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-md-12 mt-2">
                        <h3 style="text-align: center">Estimasi target yang harus di capai.</h3>
                        <table class="table_kunjungan">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tahun</th>
                                    <th scope="col">Purchase Order(Y)</th>
                                    <th scope="col">X</th>
                                    <th scope="col">X2</th>
                                    <th scope="col">XY</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (mysqli_num_rows($resultView) < 1) { ?>

                                <?php } else { ?>
                                    <tr>
                                        <?php
                                        $i = 1;
                                        $j = 0;
                                        $l = (((@$countTahun / 2) * (-2)) + 1);
                                        while ($row = mysqli_fetch_assoc($resultView)) : ?>
                                            <td><?= $i; ?></td>
                                            <td><?= $row['tahun_targeting']; ?></td>
                                            <td>
                                                <?= rupiah(@$totalPO[$j]); ?>

                                                <?php @$sigmaY += @$totalPO[$j]; ?>
                                            </td>
                                            <td><?= $l;
                                                ?></td>
                                            <td>
                                                <?php $l2 = ($l * $l);
                                                @$sigmaX2 += $l2;
                                                ?>
                                                <?= $l2; ?>

                                            </td>
                                            <td>
                                                <?php
                                                @$xy = ($totalPO[$j] * $l);
                                                ?>
                                                <?= angka($xy); ?>

                                                <?php @$sigmaXy += $xy; ?>

                                            </td>
                                            <?php $j++ ?>
                                            <?php $i++ ?>
                                            <?php $l += 2 ?>
                                    </tr>
                                <?php endwhile; ?>
                            <?php } ?>

                            </tbody>

                            <tfoot class="thead-dark">
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"><?= rupiah(@$sigmaY); ?></th>
                                <th scope="col"></th>
                                <th scope="col"><?= @$sigmaX2; ?></th>
                                <th scope="col"><?= angka(@$sigmaXy); ?></th>
                            </tfoot>
                        </table>

                        <?php
                        $tahunYc = ['2020', '2021', '2022', '2023', '2024', '2025'];
                        ?>
                        <br>
                        <br>
                        <h3 style="text-align: center">Projected Value (Yc)</h3>

                        <table class="table_kunjungan">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tahun</th>
                                    <th>X</th>
                                    <th>Projected Value(Yc)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php $index = 0; ?>
                                <?php $xx = ($countTahun + 1) ?>
                                <?php for ($h = 0; $h <= 5; $h++) : ?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td><?= $tahunYc[$index]; ?></td>
                                        <td><?= $xx; ?></td>
                                        <td><?php
                                            @$a = (@$sigmaY / @$countTahun);
                                            @$b = (@$sigmaXy / @$sigmaX2);

                                            $yc = $a + ($b * $xx);
                                            echo angka($yc);

                                            $ycTarget = $a + ($b * $tahunTarget1);
                                            ?>

                                        </td>
                                    </tr>
                            </tbody>
                            <?php $no++; ?>
                            <?php $xx += 2; ?>
                            <?php $index++; ?>
                        <?php endfor; ?>

                        </table>
                    </div>


                </div>
            </div>

            <?php include('script-footer.php'); ?>
    </body>

    </html>


    <?php
    if ($tahunTarget > 0) {
        echo "
    <script>
    document.location.href = 'profile.php?tahun=$tahunTarget1&target=$ycTarget&tahun1=$tahunTarget2';
    </script>
    ";
    }

    ?>

<?php } else {
    header("location:../index.php");
} ?>