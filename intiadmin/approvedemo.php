<?php
require '../functionsales.php';

session_start();
$username = $_SESSION['username'];
$result = mysqli_query($conn, "SELECT 
sales_funnel.pk, 
sales_funnel.rs_funnel, 
sales_funnel.kota_funnel,
sales_funnel.penawaran_fk,
sales_funnel.no_penawaran, 
sales_funnel.harga_po,
sales_funnel.month_funnel, 
sales_modality.stock_mod,
sales_modality.pk_mod, 
sales_funnel.approve_presentasi,
sales_funnel.budget_funnel, 
sales_funnel.buy_funnel, 
sales_funnel.status_funnel, 
sales_funnel.username,  
sales_funnel.approve,
sales_funnel.approve2,
sales_funnel.gambar,
sales_funnel.cancel,
sales_funnel.tgl_upload,
sales_funnel.tgl_presentasi,
sales_funnel.delete_funnel,
sales_order.pk_order,
sales_order.fk_penawaran,
sales_order.pk_mod_order,
sales_order.nama_mod_order,
sales_order.model_mod_order,
sales_order.merk_mod_order,
sales_order.spek_mod_order,
sales_order.harga_order,
sales_order.qty_order,
inti_user.name,
inti_user.username  
FROM sales_funnel 
INNER JOIN inti_user ON inti_user.username = sales_funnel.username 
INNER JOIN sales_order ON sales_order.fk_penawaran = sales_funnel.penawaran_fk
INNER JOIN sales_modality ON sales_modality.pk_mod = sales_order.pk_mod_order 
WHERE sales_funnel.delete_funnel = 'ada'AND NOT approve_presentasi = '' GROUP BY pk ");

if (isset($_POST['approve_presentasi'])) {
    if (approvedemo($_POST) > 0) {
        echo "<script>alert('data disetujui!');
			  document.location.href= 'view_funnel.php';
			  </script>";
    } else {
        echo "<script>alert('system error, silahkan hubungi admin!');
			  document.location.href= 'view_funnel.php';
			  </script>";
    }
}

if (isset($_POST['reject_presentasi'])) {
    if (rejectdemo($_POST) > 0) {
        echo "<script>alert('demo ditolak!');
			  document.location.href= 'view_funnel.php';
			  </script>";
    } else {
        echo "<script>alert('system error, silahkan hubungi admin!');
			  document.location.href= 'view_funnel.php';
			  </script>";
    }
}

if ($_SESSION['level'] == "supervisorsales") {
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Approve Demo</title>
        <?php include('head.php'); ?>
    </head>

    <body>
        <?php include('menu-bar.php'); ?>
        <div class="container-footer">
            <!-- buat footer -->
            <div class="bc-icons-2">
                <?php include('breadcrumb.php'); ?>
                <li class="breadcrumb-item"><a href="index.php">Home</a><i class="fas fa-angle-right mx-2" aria-hidden="true"></i></li>
                <li class="breadcrumb-item active">Approve Demo</li>
                </ol>
                </nav>
            </div>
            <?php
                date_default_timezone_set('Asia/Jakarta');
                $today = date("d-m-Y");
                $day = time() + (1 * 24 * 60 * 60);
                $besok = date('d-m-Y', $day);
                ?>


            <div class="container-fluid content1">
                <!-- class content buat footer -->
                <div class="justify-content-md-center">
                    <div class="col-md-12 table-box" style="overflow-x:auto;">
                        <table id="example" class="table_kunjungan table-paginate" style="margin-top: 0px;" border="1" cellpadding="8" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No. Penawaran</th>
                                    <th>Rumah Sakit</th>
                                    <th>Kota</th>

                                    <th>Funnel Detail</th>
                                    <th>Demo Detail</th>
                                    <th>Total Harga
                                    </th>
                                    <!-- <th>Type</th> -->
                                    <!-- <th>Stock/Indent</th> -->
                                    <!-- <th>Qty</th> -->
                                    <!-- <th>Harga Satuan</th> -->
                                    <th>Harga PO</th>
                                    <th>Month/Q</th>
                                    <th>Budget Sources</th>
                                    <th>%Buy</th>
                                    <th>W/L/H/OP/C</th>
                                    <th>Nama Sales</th>
                                    <th>PDF</th>
                                    <th>Waktu Upload</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tr>
                                <?php
                                    $no = 1;
                                    while ($row = mysqli_fetch_assoc($result)) : ?>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $row['no_penawaran']; ?></td>
                                    <td><?php echo $row['rs_funnel']; ?></td>
                                    <td><?php echo $row['kota_funnel']; ?></td>

                                    <td>
                                        <a href="#" class="edit-record1" data-id="<?= $row['penawaran_fk'];  ?>">&nbsp;Detail Funnel</a></td>
                                    </td>
                                    <td>
                                        <a href="#" class="edit-record2" data-id="<?= $row['penawaran_fk'];  ?>">&nbsp; Detail</a></td>
                                    </td>
                                    <td>
                                        <?php $pk_penawaran = $row['fk_penawaran']; ?>
                                        <?php
                                                $resultharga = mysqli_query($conn, "SELECT SUM(total_order) AS totalharga FROM sales_order WHERE fk_penawaran = '$pk_penawaran' "); ?>

                                        <?php while ($row332 = mysqli_fetch_assoc($resultharga)) : ?>
                                            <?= rupiah($row332['totalharga']); ?>
                                        <?php endwhile; ?>
                                    </td>
                                    <td>
                                        <?php $row['harga_po']; ?>
                                        <?php if ($row['harga_po'] == "") { ?>
                                            <?php echo "<i style='color: #a8978e;' class='fas fa-clock'></i>" ?>
                                        <?php } else { ?>
                                            <?= rupiah($row['harga_po']); ?>
                                        <?php } ?>
                                    </td>
                                    <td><?php echo $row['month_funnel']; ?></td>

                                    <td><?php echo $row['budget_funnel']; ?></td>
                                    <td><?php echo $row['buy_funnel']; ?></td>
                                    <td><?php echo $row['status_funnel']; ?><a href="#" class="edit-record" data-id="<?= $row['pk'];  ?>">&nbsp;Keterangan</a></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td>
                                        <?php $row['gambar']; ?>
                                        <?php if ($row['gambar'] == "") { ?>
                                            <?php echo "<i style='color: #a8978e;' class='fas fa-clock'></i>" ?>
                                        <?php } else { ?>
                                            <a class="penawaran-a" href="../pdf/pdf_funnel.php?pk=<?= $row['pk'];  ?>" target="_blank"><i style="color: #e73e33;" class="fas fa-file-pdf"></i> </a></td>
                                <?php } ?>
                                <td>
                                    <?php $row['tgl_upload']; ?>
                                    <?php if ($row['tgl_upload'] == "") { ?>
                                        <?php echo "<i style='color: #a8978e;' class='fas fa-clock'></i>" ?>
                                    <?php } else { ?>
                                        <?= $row['tgl_upload']; ?>
                                    <?php } ?>
                                </td>
                                <td>
                                    <form id=order name=order method=post action="">

                                        <input name="no_penawaran" type="hidden" value="<?= $row['no_penawaran']; ?>">
                                        <input name="username" type="hidden" value="<?= $row['username']; ?>">

                                        <input type="hidden" class="form-control" id="pk" name="pk" value="<?php echo $row['pk']; ?>">


                                        <?php $row['approve_presentasi']; ?>
                                        <?php if ($row['approve_presentasi'] == "approved") { ?>
                                            <?php echo "<div style='color: green;'>Demo Approved!</div>" ?>
                                        <?php } elseif ($row['approve_presentasi'] == "rejected") { ?>
                                            <?php echo "<div style='color: red;'>Demo Rejected</div>" ?>
                                        <?php } else { ?>
                                            <button type="submit" name="approve_presentasi" class="btn btn-fnl btn-primary btn-sm" onclick="return confirm('Apakah anda yakin?')"><i class="fas fa-check"></i></button>
                                            <button type="submit" name="reject_presentasi" class="btn btn-fnl btn-danger btn-sm" onclick="return confirm('Apakah anda yakin?')"><i class="fas fa-times"></i></button>
                                        <?php } ?>
                                    </form>
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
                            <h3>Demo Request Detail</h3>
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
        <script>
            // untuk menampilkan data popup
            $(function() {
                $(document).on('click', '.edit-record2', function(e) {
                    e.preventDefault();
                    $("#myModal1").modal('show');
                    $.post('hasil5.php', {
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