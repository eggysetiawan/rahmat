<?php
require '../functionsales.php';

session_start();
$username = $_SESSION['username'];
$result = mysqli_query($conn, "SELECT *
FROM sales_funnel2 
INNER JOIN inti_user ON inti_user.username = sales_funnel2.username 
INNER JOIN sales_order2 ON sales_order2.fk_funnel2 = sales_funnel2.pk
INNER JOIN sales_modality ON sales_modality.pk_mod = sales_order2.pk_mod_order 
WHERE sales_funnel2.username = '$username' AND sales_order2.tujuan_order = 'sales' GROUP BY pk ");




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
                        <div class="col-1">
                            <?php $nowyear = date('Y'); ?>
                            <!-- <label for="from">Pilih </label> -->
                            <select class="form-control" id="from" name="from">
                                <option disabled selected>
                                    <center>Pilih Tahun</center>
                                </option>
                                <?php $resTahun = mysqli_query($conn, "SELECT tahun_funnel2 FROM sales_funnel2 WHERE username = '$username' GROUP BY tahun_funnel2") ?>
                                <?php while ($rowTahun = mysqli_fetch_assoc($resTahun)) : ?>
                                    <option value="<?= $rowTahun['tahun_funnel2']; ?>"><?= $rowTahun['tahun_funnel2']; ?></option>
                                <?php endwhile; ?>

                            </select>


                        </div>

                        <div class="col-1">
                            <button class="btn btn-spr btn-sm btn-info" type="button" name="range" id="range">Search</button>
                        </div>
                    </div>
                </form>
                <!-- class content buat footer -->
                <div class="justify-content-md-center">
                    <div class="col-md-12 table-box" style="overflow-x:auto;" id="purchase_order">
                        <table id="example" class="table_kunjungan table-paginate" style="margin-top: 0px;" border="1" cellpadding="8" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun Funnel</th>
                                    <th>Rumah Sakit</th>
                                    <th>Kota</th>
                                    <th>Funnel Detail</th>
                                    <th>Perkiraan Harga</th>
                                    <th>Progress</th>
                                    <th>Keterangan Funnel</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <?php if (mysqli_num_rows($result) < 1) { ?>

                            <?php } else { ?>
                                <tr>
                                    <?php
                                    $no = 1;
                                    while ($row = mysqli_fetch_assoc($result)) : ?>
                                        <td><?php echo $no; ?></td>
                                        <td><?= $row['tahun_funnel2']; ?></td>
                                        <td><?php echo $row['rs_funnel2']; ?></td>
                                        <td><?php echo $row['kota_funnel2']; ?></td>

                                        <td>
                                            <a href="#" class="edit-record5" data-id="<?= $row['pk'];  ?>"><button class="btn btn-fnl btn-info" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fas fa-info-circle"></i></button></a></td>

                                        </td>
                                        <td>
                                            <?php $pk = $row['pk']; ?>
                                            <?php

                                            $resultharga = mysqli_query($conn, "SELECT SUM(total_order) AS totalharga FROM sales_order2 WHERE fk_funnel2 = '$pk' "); ?>

                                            <?php while ($row332 = mysqli_fetch_assoc($resultharga)) : ?>
                                                <?= rupiah($row332['totalharga']); ?>
                                                <?php @$totalHarga += $row332['totalharga']; ?>
                                            <?php endwhile; ?>
                                        </td>
                                        <td><?= $row['progress_funnel2']; ?></td>
                                        <td><a href="#" class="edit-record" data-id="<?= $row['pk'];  ?>"><button class="btn btn-fnl btn-info" data-toggle="tooltip" data-placement="top" title="Keterangan"><i class="fas fa-info-circle"></i></button></a></td>
                                        <td><a href="edit_funnel2.php?pk=<?= $row['pk'];  ?>"><button class="btn btn-fnl btn-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></button></a>
                                            <?php if ($row['progress_funnel2'] == '100%') { ?>
                                                <a href="forwardOrder.php?pk=<?= $row['pk'];  ?>"><button class="btn btn-fnl btn-info" data-toggle="tooltip" data-placement="top" title="Forward to Order"><i class="fas fa-share-square"></i></button></a>
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
                                <th><?= rupiah(@$totalHarga); ?></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal" id="myModal5">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h3>Detail Funnel</h3>
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
            $(document).ready(function() {
                $('#range').click(function() {
                    $('#purchase_order').html("<div class='preloader-css'><span></span><span></span><span></span><span></span><span></span></div>");
                    var from = $('#from').val();
                    var username = $('#username').val();
                    // var keyword = $('#keyword').val();
                    if (from != '') {
                        $.ajax({
                            url: "prosescariviewfunnel2.php",
                            method: "POST",
                            data: {
                                from: from,
                                username: username
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
        <script>
            // untuk menampilkan data popup
            $(function() {
                $(document).on('click', '.edit-record', function(e) {
                    e.preventDefault();
                    $("#myModal").modal('show');
                    $.post('hasil7.php', {
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
                $(document).on('click', '.edit-record5', function(e) {
                    e.preventDefault();
                    $("#myModal5").modal('show');
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
    </body>

    </html>

<?php } else {
    header("location:../index.php");
} ?>