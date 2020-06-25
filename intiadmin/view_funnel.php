<?php
require '../functionsales.php';

session_start();
$username = $_SESSION['username'];
$result = mysqli_query($conn, "SELECT
sales_funnel.pk, 

sales_funnel.penawaran_fk,
sales_penawaran.no_penawaran,
sales_funnel.harga_po,
sales_customer.pk_cust,
sales_customer.rs_cust,
sales_customer.nama_cust,
sales_customer.kota_cust,
sales_customer.alamat_cust,
sales_funnel.month_funnel, 
sales_modality.stock_mod,
sales_modality.pk_mod, 
sales_funnel.budget_funnel,
sales_funnel.tanggal_kirim,
sales_funnel.tanggal_terima,
sales_funnel.buy_funnel, 
sales_funnel.status_funnel, 
sales_funnel.username,  
sales_funnel.approve,
sales_funnel.approve2,
sales_funnel.gambar,
sales_funnel.cancel,
sales_funnel.tgl_upload,
sales_funnel.tgl_presentasi,
sales_funnel.kirim,
sales_order.pk_order,
sales_order.fk_penawaran,
sales_order.pk_mod_order,
sales_order.model_mod_order,
sales_order.merk_mod_order,
sales_order.spek_mod_order,
sales_order.harga_order,
sales_order.qty_order,
inti_user.name,
inti_user.username,
inti_user.level
FROM sales_funnel 
INNER JOIN inti_user ON inti_user.username = sales_funnel.username
INNER JOIN sales_penawaran ON sales_penawaran.pk_penawaran = sales_funnel.penawaran_fk 
INNER JOIN sales_order ON sales_order.fk_penawaran = sales_funnel.penawaran_fk
INNER JOIN sales_modality ON sales_modality.pk_mod = sales_order.pk_mod_order 
INNER JOIN sales_customer ON sales_funnel.customer_fk = sales_customer.pk_cust
GROUP BY pk ORDER BY buy_funnel DESC ");
// $pk_mod_funnel = $row['pk_mod_funnel'];
// $result2 = mysqli_query($conn, "SELECT * FROM sales_modality WHERE pk_mod = '$pk_mod_funnel'");
// $row2 = mysqli_fetch_assoc($result2);



if ($_SESSION['level'] == "intiadmin") {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Funnel</title>
        <?php include('head.php'); ?>
    </head>

    <body>
        <?php include('menu-bar.php'); ?>
        <div class="container-footer">
            <!-- buat footer -->
            <div class="bc-icons-2">
                <?php include('breadcrumb.php'); ?>
                <li class="breadcrumb-item"><a href="index.php">Home</a><i class="fas fa-angle-right mx-2" aria-hidden="true"></i></li>
                <li class="breadcrumb-item active">View Funnel</li>


                </ol>
                </nav>
            </div>

            <div class="container-fluid content1">
                <!-- class content buat footer -->
                <div class="justify-content-md-center">
                    <div class="col-md-12 table-box" style="overflow-x:auto;">
                        <table id="example" class="table_kunjungan table-paginate" style="margin-top: 0px;" border="1" cellpadding="8" cellspacing="0">
                            <thead>
                                <h2>Sales</h2>
                                <tr>
                                    <th>No</th>
                                    <th>No. Penawaran</th>
                                    <th>Rumah Sakit</th>
                                    <th>Kota</th>
                                    <th>Funnel Detail</th>
                                    <th>Harga PO</th>
                                    <th>Month/Q</th>
                                    <th>Pengiriman</th>
                                    <th>Nama Sales</th>
                                    <th>PDF</th>
                                    <th>Tanggal Kirim</th>
                                    <th>Tanggal Terima</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tr>
                                <?php
                                $no = 1;
                                while ($row = mysqli_fetch_assoc($result)) : ?>
                                    <td><?php echo $no; ?></td>
                                    <td>
                                        <?= $row['no_penawaran']; ?>

                                    </td>
                                    <td><?php echo $row['rs_cust']; ?></td>
                                    <td>
                                        <?php if ($row['kota_cust'] == NULL) { ?>
                                            Indonesia
                                        <?php } else { ?>
                                            <?php echo $row['kota_cust']; ?>
                                        <?php } ?>
                                    </td>
                                    <td>


                                        <a href="#" class="edit-record1" data-id="<?= $row['penawaran_fk'];  ?>">&nbsp;Detail Funnel</a></td>





                                    </td>
                                    <!-- <td>
                                        <?php
                                        $resultharga = mysqli_query($conn, "SELECT SUM(total_order) AS totalharga FROM sales_order WHERE fk_penawaran = '$pk_penawaran' "); ?>

                                        <?php while ($row332 = mysqli_fetch_assoc($resultharga)) : ?>
                                            <?= rupiah($row332['totalharga']); ?>
                                        <?php endwhile; ?>
                                    </td> -->
                                    <td>
                                        <?php $row['harga_po']; ?>
                                        <?php if ($row['harga_po'] == "") { ?>
                                            <?php echo "<i style='color: #a8978e;' class='fas fa-clock'></i>" ?>
                                        <?php } else { ?>
                                            <?= rupiah($row['harga_po']); ?>
                                        <?php } ?>
                                    </td>
                                    <td><?php echo $row['month_funnel']; ?></td>
                                    <!--     -->
                                    <!-- <td><?php echo $row['budget_funnel']; ?></td> -->
                                    <td>
                                        <?php $row['kirim']; ?>
                                        <?php if ($row['kirim'] == NULL) { ?>
                                            <?php echo "<i style='color: #a8978e;' class='fas fa-clock'></i>" ?>
                                        <?php } else { ?>
                                            <?= $row['kirim']; ?>
                                        <?php } ?></td>
                                    <td><?php echo $row['name']; ?></td>


                                    <td><a class="penawaran-a" href="../pdf/pdf_funnel.php?pk=<?= $row['pk'];  ?>" target="_blank">PDF </a></td>
                                    <!-- <td>
                                        <?php $row['tgl_upload']; ?>
                                        <?php if ($row['tgl_upload'] == "") { ?>
                                            <?php echo "<i style='color: #a8978e;' class='fas fa-clock'></i>" ?>
                                        <?php } else { ?>
                                            <?= $row['tgl_upload']; ?>
                                        <?php } ?>
                                    </td> -->
                                    <td>
                                        <?php $row['tanggal_kirim']; ?>
                                        <?php if ($row['tanggal_kirim'] == "") { ?>
                                            <?php echo "<i style='color: #a8978e;' class='fas fa-clock'></i>" ?>
                                        <?php } else { ?>
                                            <a class="penawaran-a" href="../pdf/pdf_funnel_kirim.php?pk=<?= $row['pk'];  ?>" target="_blank"> <?= $row['tanggal_kirim']; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php $row['tanggal_terima']; ?>
                                        <?php if ($row['tanggal_terima'] == "") { ?>
                                            <?php echo "<i style='color: #a8978e;' class='fas fa-clock'></i>" ?>
                                        <?php } else { ?>
                                            <a class="penawaran-a" href="../pdf/pdf_funnel_terima.php?pk=<?= $row['pk'];  ?>" target="_blank"> <?= $row['tanggal_terima']; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td><?php if ($row['approve'] == "approved" && $row['buy_funnel'] == "100%" && $row['kirim'] == "100%") { ?>
                                            Order Sukses!
                                        <?php } elseif ($row['approve'] == "approved" && $row['buy_funnel'] == "100%" && $row['approve2'] == "approved") { ?>
                                            <a href="edit_funnel.php?penawaran_fk=<?= $row['penawaran_fk']; ?> "> Pengiriman</a>

                                        <?php } elseif ($row['approve'] == "rejected") { ?>
                                            <?php echo "Rejected" ?>

                                        <?php } else { ?>
                                            <?php echo "<i style='color: #a8978e;' class='fas fa-clock'></i>" ?>
                                        <?php } ?>
                                    </td>

                                    <?php $no++; ?>
                            </tr>
                        <?php endwhile; ?>
                        </table>
                    </div>
                </div>
            </div>



            <div class="modal" id="myModal1">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h3>Detail Funnel</h3>
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <p><?php $row['penawaran_fk']; ?></p>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>
            <!-- End The Modal -->



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

            <div class="modal" id="myModal2">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h3>Detail Order</h3>
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
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

        <script>
            // untuk menampilkan data popup
            $(function() {
                $(document).on('click', '.edit-record2', function(e) {
                    e.preventDefault();
                    $("#myModal2").modal('show');
                    $.post('hasil6.php', {
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

        <script>
            // untuk menampilkan data popup
            $(function() {
                $(document).on('click', '.edit-record1', function(e) {
                    e.preventDefault();
                    $("#myModal1").modal('show');
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