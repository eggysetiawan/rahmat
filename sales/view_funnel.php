<?php
require '../functionsales.php';

session_start();
$username = $_SESSION['username'];
$nowyear = date('Y');
$result = mysqli_query($conn, "SELECT 
sales_funnel.pk, 
sales_funnel.penawaran_fk,
sales_penawaran.no_penawaran, 
sales_funnel.harga_po,
sales_funnel.month_funnel, 
sales_modality.stock_mod,
sales_modality.pk_mod, 
sales_funnel.budget_funnel,
sales_funnel.kirim,
sales_funnel.buy_funnel, 
sales_funnel.status_funnel, 
sales_funnel.username,  
sales_funnel.approve,
sales_funnel.approve2,
sales_funnel.gambar,
sales_funnel.cancel,
sales_funnel.tgl_upload,
sales_funnel.tgl_presentasi,
sales_funnel.tanggal_kirim,
sales_funnel.tanggal_terima,
sales_funnel.delete_funnel,
sales_funnel.tahun_funnel,
sales_customer.pk_cust,
sales_customer.nama_cust,
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
inti_user.username,
inti_rs.pk_rs,
inti_rs.nama_rs,
inti_rs.kota_rs,
inti_rs.alamat_rs  
FROM sales_funnel 
INNER JOIN inti_user ON inti_user.username = sales_funnel.username 
INNER JOIN sales_order ON sales_order.fk_penawaran = sales_funnel.penawaran_fk
INNER JOIN sales_modality ON sales_modality.pk_mod = sales_order.pk_mod_order 
INNER JOIN sales_customer ON sales_funnel.customer_fk = sales_customer.pk_cust
INNER JOIN sales_penawaran ON sales_penawaran.pk_penawaran = sales_funnel.penawaran_fk
INNER JOIN inti_rs ON sales_customer.fk_rs = inti_rs.pk_rs
WHERE sales_funnel.username = '$username' AND sales_funnel.delete_funnel = 'ada' 
GROUP BY pk ORDER BY pk ASC ");


if (isset($_POST['terkirim'])) {
    if (barangterkirim($_POST) > 0) {
        echo "<script>alert('selamat barang telah berhasil dikirim!');
			  document.location.href= 'view_funnel.php';
			  </script>";
    } else {
        echo "<script>alert('system error, silahkan hubungi admin!');
			  document.location.href= 'view_funnel.php';
			  </script>";
    }
}

if ($_SESSION['level'] == "sales") {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Lihat Funnel</title>
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
            <?php
            date_default_timezone_set('Asia/Jakarta');
            $today = date("d-m-Y");
            $day = time() + (1 * 24 * 60 * 60);
            $besok = date('d-m-Y', $day);
            ?>


            <div class="container-fluid content1">
                <form action="" method="POST">
                    <div class="form-row">
                        <div class="col-2">
                            <?php $nowyear = date('Y'); ?>
                            <!-- <label for="from">Pilih </label> -->
                            <select class="form-control" id="from" name="from">
                                <option value="" selected disabled>
                                    <center>Pilih Tahun</center>
                                </option>
                                <?php
                                $resTahun = mysqli_query($conn, "SELECT tahun_funnel FROM sales_funnel WHERE username = '$username' GROUP BY tahun_funnel");
                                ?>
                                <?php while ($rowTahun = mysqli_fetch_assoc($resTahun)) : ?>
                                    <option value="<?= $rowTahun['tahun_funnel']; ?>"><?= $rowTahun['tahun_funnel']; ?></option>
                                <?php endwhile; ?>
                            </select>
                            <!-- <input class="form-control" type="text" name="from" id="from" placeholder="From"> -->
                        </div>
                        <div class="col-1">
                            <button class="btn btn-spr btn-sm btn-info" type="button" name="range" id="range">Search</button>
                        </div>
                    </div>
                </form>
                <!-- class content buat footer -->
                <div class="justify-content-md-center" id="purchase_order">
                    <div class="col-md-12 table-box" style="overflow-x:auto;">
                        <table id="example" class="table_kunjungan table-paginate" style="margin-top: 0px;" border="1" cellpadding="8" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No. Penawaran</th>
                                    <th>Rumah Sakit</th>
                                    <th>Kota
                                    </th>
                                    <th>Funnel Detail</th>
                                    <th>Total Harga
                                    </th>
                                    <th>Harga PO</th>
                                    <th>Month/Q</th>
                                    <th>Budget Sources</th>
                                    <th>%Buy</th>
                                    <th>W/L/H/OP/C</th>
                                    <th>Nama Sales</th>
                                    <th>PDF</th>
                                    <th>Waktu Upload</th>
                                    <!-- <th>Waktu Pengiriman</th>
                                    <th>Waktu Penerimaan</th> -->
                                    <th>Status Funnel</th>
                                </tr>
                            </thead>
                            <?php if (mysqli_num_rows($result) < 1) { ?>

                            <?php } else { ?>
                                <tr>
                                    <?php
                                    $no = 1;
                                    while ($row = mysqli_fetch_assoc($result)) : ?>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $row['no_penawaran']; ?></td>
                                        <td><?php echo $row['nama_rs']; ?></td>
                                        <td><?php echo $row['kota_rs']; ?></td>

                                        <td>
                                            <a href="#" class="edit-record1" data-id="<?= $row['penawaran_fk'];  ?>">&nbsp;Detail Funnel</a></td>

                                        </td>
                                        <td>
                                            <?php $pk_penawaran = $row['fk_penawaran']; ?>
                                            <?php
                                            $resultharga = mysqli_query($conn, "SELECT SUM(total_order) AS totalharga FROM sales_order WHERE fk_penawaran = '$pk_penawaran' "); ?>

                                            <?php while ($row332 = mysqli_fetch_assoc($resultharga)) : ?>
                                                <?= rupiah($row332['totalharga']); ?>
                                                <?php @$tot += $row332['totalharga']; ?>
                                            <?php endwhile; ?>
                                        </td>
                                        <td>
                                            <?php $row['harga_po']; ?>
                                            <?php if ($row['harga_po'] == "") { ?>
                                                <?php echo "<i style='color: #a8978e;' class='fas fa-clock'></i>" ?>
                                            <?php } else { ?>
                                                <?= rupiah($row['harga_po']); ?>
                                            <?php } ?>
                                            <?php @$tot_po += $row['harga_po']; ?>
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
                                    <!-- <td>
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
                                </td> -->
                                    <td><?php $row['approve']; ?>
                                        <?php $row['approve2']; ?>

                                        <?php if ($row['cancel'] == "CANCEL") { ?>
                                            <?php echo "CANCELED!!!"; ?>

                                        <?php } elseif ($row['approve2'] == "rejected" && $row['buy_funnel'] == "100%") { ?>
                                            <?php echo "Rejected to Targeting"; ?>

                                        <?php } elseif ($row['buy_funnel'] == "100%") { ?>
                                            <?php echo "<div style='color: grey;'>Waiting for Approval</div>"; ?>



                                        <?php } elseif ($row['approve'] == "approved") { ?>
                                            <a href="edit_funnel.php?no_penawaran=<?= $row['no_penawaran']; ?> ">Edit</a>
                                            <?php echo "<i style='color: green;' class='fas fa-check-circle'></i>";  ?>

                                        <?php } elseif ($row['approve'] == "rejected") { ?>
                                            <?php echo "Rejected" ?>

                                        <?php } else { ?>
                                            <?php echo "<i style='color: #a8978e;' class='fas fa-clock'></i>" ?>
                                        <?php } ?>
                                    </td>
                                    <?php $no++; ?>
                                <?php endwhile; ?>
                                </tr>
                            <?php } ?>
                            <tfoot>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th><?= rupiah(@$tot); ?></th>
                                <th><?= rupiah(@$tot_po); ?></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <!-- <th></th>
                            <th></th> -->
                            </tfoot>
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

            <div class="modal" id="myModal2">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h3>Detail Estimasi</h3>
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <p><?php echo $row['penawaran_fk']; ?></p>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <!-- <button type="button" name="terkirim" class="btn btn-success" onclick="return confirm('Apakah anda yakin?')">Barang Terkirim</button> -->
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
                    $("#myModal2").modal('show');
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

        <script>
            $(document).ready(function() {

                // $('.cboxtombol').click(function() {
                //     $('.cbox').prop('checked', this.checked);
                // });

                // $('.cboxtombolpay').click(function() {
                //     $('.cboxpay').prop('checked', this.checked);
                // });
                $('#range').click(function() {
                    $('#purchase_order').html("<div class='preloader-css'><span></span><span></span><span></span><span></span><span></span></div>");
                    var from = $('#from').val();
                    // var to = $('#to').val();
                    // var keyword = $('#keyword').val();
                    if (from != '') {
                        $.ajax({
                            url: "prosescariviewfunnel.php",
                            method: "POST",
                            data: {
                                from: from

                                // keyword: keyword
                            },
                            success: function(data) {
                                $('#purchase_order').html(data);
                            }
                        });
                    } else {
                        alert("Please Select Date");
                    }
                });
            });
        </script>
    </body>

    </html>

<?php } else {
    header("location:../index.php");
} ?>