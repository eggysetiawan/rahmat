<?php
require '../koneksi/koneksi.php';
require '../functionsales.php';
session_start();
$username = $_SESSION['username'];
$result = mysqli_query($conn, "SELECT * FROM sales_targeting 
INNER JOIN sales_funnel ON sales_targeting.funnel_fk = sales_funnel.pk 
INNER JOIN sales_order ON sales_funnel.penawaran_fk = sales_order.fk_penawaran 
INNER JOIN sales_modality ON sales_order.pk_mod_order = sales_modality.pk_mod 
INNER JOIN inti_user ON sales_funnel.username = inti_user.username 
WHERE sales_targeting.approve = 'rejected' GROUP BY sales_order.fk_penawaran ");;
$result3 = mysqli_query($conn, "SELECT * FROM inti_user");
$row3 = mysqli_fetch_assoc($result3);
$name3 = $row3['name'];
// $row = mysqli_fetch_assoc($result);
// $pk_mod_funnel = $row['pk_mod_funnel'];
// $result2 = mysqli_query($conn, "SELECT * FROM sales_modality WHERE pk_mod = '$pk_mod_funnel'");
// $row2 = mysqli_fetch_assoc($result2);


if ($_SESSION['level'] == "intiadmin") {
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Targeting Sales</title>
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
                        <!-- <table>
							<tr>
								<td>Nama</td>
								<td>:</td>
								<td>&nbsp;<?= $name3; ?></td>

							</tr>
							<tr>
								<td>Target</td>
								<td>:</td>
								<td>&nbsp;2 Miliar</td>
							</tr>
							<tr>
								<td>Sisa Target&nbsp;&nbsp;</td>
								<td>:</td>
								<td>&nbsp;500jt</td>
							</tr>
						</table> -->
                    </div><br>
                    <div class="col-md-12 table-box" style="overflow-x:auto;">
                        <table id="example" class="table_kunjungan" style="margin-top: 0px;" border="1" cellpadding="8" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No. Penawaran</th>
                                    <th>Rumah Sakit</th>
                                    <th>Kota</th>
                                    <th>Targeting Detail</th>
                                    <th>Total Penawaran</th>
                                    <th>Harga PO</th>
                                    <th>Nama Sales</th>
                                </tr>
                            </thead>
                            <tr>
                                <?php
                                    $no = 1;
                                    while ($row = mysqli_fetch_assoc($result)) : ?>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $row['no_targeting']; ?></td>
                                    <td><?php echo $row['rs_targeting']; ?></td>
                                    <td><?php echo $row['kota_targeting']; ?></td>
                                    <!-- modal -->
                                    <td>
                                        <a href="#" class="edit-record" data-id="<?= $row['penawaran_fk'];  ?>">&nbsp;Detail</a>
                                        <!-- Modal -->



                                        <?php $pk_penawaran = $row['penawaran_fk']; ?>
                                        <?php $result323 = mysqli_query($conn, "SELECT * FROM sales_order WHERE fk_penawaran = '$pk_penawaran' "); ?>
                                        <?php while ($row323 = mysqli_fetch_assoc($result323)) : ?>

                                            <!-- modal detail -->

                                        <?php endwhile; ?>



                                    </td>
                                    <td>
                                        <?php
                                                $resultharga = mysqli_query($conn, "SELECT SUM(total_order) AS totalharga FROM sales_order WHERE fk_penawaran = '$pk_penawaran' "); ?>

                                        <?php while ($row332 = mysqli_fetch_assoc($resultharga)) : ?>
                                            <?= rupiah($row332['totalharga']); ?>
                                        <?php endwhile; ?>
                                    </td>
                                    <td><?php echo rupiah($row['harga_po_targeting']); ?></td>
                                    <td><?= $row['name']; ?></td>
                                    <!-- <td><?php echo rupiah($row['harga_order']); ?></td> -->

                                    <!-- <?php
                                                    $hasil111 = ($row['harga_mod'] * $row['qty_targeting']) - $row['harga_po_targeting'];
                                                    $hasil222 = ($hasil111 / ($row['harga_mod'] * $row['qty_targeting'])) * 100;

                                                    if ($hasil222 <= 0) { ?> -->
                                    <!-- <td>Tidak Diskon</td> -->
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
                            <h3>Detail Targeting</h3>
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <p><?php echo $row['penawaran_fk']; ?></p>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>

            <?php include('footer.php'); ?>



        </div><!-- end of container footer -->


        <?php include('script-footer.php'); ?>
        <script>
            // untuk menampilkan data popup
            $(function() {
                $(document).on('click', '.edit-record', function(e) {
                    e.preventDefault();
                    $("#myModal").modal('show');
                    $.post('hasil4.php', {
                            penawaran_fk: $(this).attr('data-id')
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