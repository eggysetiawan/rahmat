<?php
require '../koneksi/koneksi.php';
require '../functionsales.php';
session_start();
$username = $_SESSION['username'];
$result = mysqli_query($conn, "SELECT * FROM sales_targeting INNER JOIN sales_modality ON sales_targeting.pk_mod_targeting = sales_modality.pk_mod WHERE username = '$username' AND approve = 'approved' ");
// $row = mysqli_fetch_assoc($result);
// $pk_mod_funnel = $row['pk_mod_funnel'];
$result3 = mysqli_query($conn, "SELECT * FROM inti_user WHERE username = '$username'");
$row3 = mysqli_fetch_assoc($result3);
$name3 = $row3['name'];
$approve_target3 = $row3['approve_target'];
$target3 = $row3['targett'];
$result5 = mysqli_query($conn, "SELECT SUM(harga_po_targeting) AS totalsum FROM sales_targeting WHERE approve = 'approved' AND username = '$username'");
$rows = mysqli_fetch_assoc($result5);
$total = $rows['totalsum'];

// $row = mysqli_fetch_assoc($result);
// $pk_mod_funnel = $row['pk_mod_funnel'];
// $result2 = mysqli_query($conn, "SELECT * FROM sales_modality WHERE pk_mod = '$pk_mod_funnel'");
// $row2 = mysqli_fetch_assoc($result2);
if ($_SESSION['level'] == "sales") {
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Kunjungan Harian</title>
        <?php include('head.php'); ?>
    </head>

    <body>
        <?php include('menu-bar.php'); ?>
        <div class="container-footer">
            <!-- buat footer -->
            <div class="bc-icons-2">
                <?php include('breadcrumb.php'); ?>
                <li class="breadcrumb-item"><a href="index.php">Home</a><i class="fas fa-angle-right mx-2" aria-hidden="true"></i></li>
                <li class="breadcrumb-item active">Targeting</li>
                </ol>
                </nav>
            </div>

            <div class="container-fluid content1">
                <!-- class content buat footer -->
                <div class="justify-content-md-center">
                    <div class="ket-target">
                        <table>
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>&nbsp;<?= $name3; ?></td>
                            </tr>
                            <?php if ($target3 == NULL and $approve_target3 == NULL) { ?>
                                <tr>
                                    <td>Target</td>
                                    <td>:</td>
                                    <td>&nbsp;<?php echo "Masukkan Target Anda Di Profile" ?></td>
                                </tr>
                            <?php } else if ($approve_target3 == NULL) { ?>
                                <tr>
                                    <td>Target</td>
                                    <td>:</td>
                                    <td>&nbsp;<?php echo "Target Anda Belum Di Approve" ?></td>
                                </tr>
                            <?php } else if ($approve_target3 == 'rejected') { ?>
                                <tr>
                                    <td>Target</td>
                                    <td>:</td>
                                    <td>&nbsp;<?php echo "Target Anda Di REJECT, Input Kembali Target Anda" ?></td>
                                </tr>
                            <?php } else { ?>
                                <tr>
                                    <td>Target</td>
                                    <td>:</td>
                                    <td>&nbsp;<?php echo rupiah($target3); ?></td>
                                </tr>
                                <tr>
                                    <td>Target yang sudah di capai&nbsp;&nbsp;</td>
                                    <td>:</td>
                                    <td>&nbsp;<?php echo rupiah($total); ?></td>
                                </tr>
                                <tr>
                                    <td>Sisa Target&nbsp;&nbsp;</td>
                                    <td>:</td>
                                    <td>&nbsp;<?php
                                                        $hasil = $target3 - $total;
                                                        if ($total >= $target3) {
                                                            echo 'Target sudah Tercapai';
                                                        } else {
                                                            echo rupiah($hasil);
                                                        }
                                                        ?>
                                    </td>
                                </tr>

                                <?php
                                        $hasil = $target3 - $total;
                                        if ($total >= $target3) {
                                            $hasil313 = $total - $target3;
                                            ?>
                                    <tr>
                                        <td>Lebih Target&nbsp;&nbsp;</td>
                                        <td>:</td>
                                        <td>&nbsp;<?php echo rupiah($hasil3); ?></td>
                                    </tr>
                                <?php
                                        }
                                        ?>
                            <?php } ?>
                        </table>
                    </div><br>
                    <div class="col-md-12 table-box" style="overflow-x:auto;">
                        <table id="example" class="table_kunjungan" style="margin-top: 0px;" border="1" cellpadding="8" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Rumah Sakit</th>
                                    <th>Kota</th>
                                    <th>No. Penawaran</th>
                                    <th>Nama Barang</th>
                                    <th>Type</th>
                                    <th>Qty</th>
                                    <th>Harga Penawaran</th>
                                    <th>Harga PO</th>
                                    <th>Diskon</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tr>
                                <?php
                                    $no = 1;
                                    while ($row = mysqli_fetch_assoc($result)) : ?>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $row['rs_targeting']; ?></td>
                                    <td><?php echo $row['kota_targeting']; ?></td>
                                    <td><?php echo $row['no_targeting']; ?></td>
                                    <td><?php echo $row['nama_mod_targeting']; ?></td>
                                    <td><?php echo $row['model_targeting']; ?></td>
                                    <td><?php echo $row['qty_targeting']; ?></td>
                                    <td><?php echo rupiah($row['harga_penawaran_targeting']); ?></td>
                                    <td><?php echo rupiah($row['harga_po_targeting']); ?></td>
                                    <?php
                                            $hasil111 = ($row['harga_mod'] * $row['qty_targeting']) - $row['harga_po_targeting'];
                                            $hasil222 = ($hasil111 / ($row['harga_mod'] * $row['qty_targeting'])) * 100;

                                            if ($hasil222 <= 0) { ?>
                                        <td>Tidak Diskon</td>
                                    <?php } else {
                                                ?>
                                        <td><?php echo $hasil222 . '%' ?></td>
                                        <td><?= $row['approve']; ?></td>
                                    <?php }

                                            $no++; ?>
                            </tr>
                        <?php endwhile; ?>
                        </table>
                    </div>
                </div>
            </div>

            <!-- The Modal -->
            <div class="modal" id="myModal">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <!-- <h1 class="modal-title">Modal Heading</h1> -->
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <h3>Keterangan</h3>
                            <p><?php echo $row['pk']; ?></p>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>
            <!-- End The Modal -->

            <?php include('footer.php'); ?>



        </div><!-- end of container footer -->


        <?php include('script-footer.php'); ?>
        <script>
            // untuk menampilkan data popup
            $(function() {
                $(document).on('click', '.edit-record', function(e) {
                    e.preventDefault();
                    $("#myModal").modal('show');
                    $.post('hasil2.php', {
                            pk: $(this).attr('data-id')
                        },
                        function(html) {
                            $(".modal-body").html(html);
                        }
                    );
                });
            });
            // end untuk menampilkan data popup
        </script>
    </body>

    </html>

<?php } else {
    header("location:../index.php");
} ?>