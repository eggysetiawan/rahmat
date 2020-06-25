<?php
require '../functionsales.php';

session_start();

if (isset($_POST["from"])) {

    $from = $_POST["from"];
    $username = $_POST['username'];
    $result = mysqli_query($conn, "SELECT *
FROM sales_funnel2 
INNER JOIN inti_user ON inti_user.username = sales_funnel2.username 
INNER JOIN sales_order2 ON sales_order2.fk_funnel2 = sales_funnel2.pk
INNER JOIN sales_modality ON sales_modality.pk_mod = sales_order2.pk_mod_order 
WHERE sales_funnel2.username = '$username' AND sales_order2.tujuan_order = 'sales'
AND tahun_funnel2 IN ('" . $_POST["from"] . "')
 GROUP BY pk ");
}


// Nama Sales
$resultName = mysqli_query($conn, "SELECT * FROM inti_user WHERE username =  '$username'");
$rowNama = mysqli_fetch_assoc($resultName);


if ($_SESSION['level'] == "sales") {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Print </title>
        <?php include('head.php'); ?>
    </head>

    <body>

        <div class="fill" id="div-id-name">
            <div class="container-fluid logo-ipi">
                <center><img src="../image/logoipi.png" style="width: 220px"></center>
            </div>

            <div class="justify-content-md-center">
                Nama Sales : <?= $rowNama['name']; ?><br>
                Email : <?= $rowNama['email']; ?><br><br>
                <div class="col-md-12 table-box mt-1" style="overflow-x:auto;" id="purchase_order">
                    <table id="example" class="table_kunjungan table-paginate" style="margin-top: 0px;" border="1" cellpadding="8" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tahun Funnel</th>
                                <th>Rumah Sakit</th>
                                <th>Kota</th>
                                <th>Perkiraan Harga</th>
                                <th>Progress</th>
                            </tr>
                        </thead>

                        <tr>
                            <?php
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($result)) : ?>
                                <td><?php echo $no; ?></td>
                                <td><?= $row['tahun_funnel2']; ?></td>
                                <td><?php echo $row['rs_funnel2']; ?></td>
                                <td><?php echo $row['kota_funnel2']; ?></td>


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


                                <?php $no++; ?>
                        </tr>
                    <?php endwhile; ?>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th><?= rupiah(@$totalHarga); ?></th>
                    <th></th>
                    </table>
                </div>
            </div>
            <div align="center">

                <?php
                date_default_timezone_set('Asia/Jakarta');
                $datePrint = date('Y-m-d H:i');
                echo "Printed on : $datePrint"
                ?>
            </div>
        </div>
        <center> <a href="#" name="printTime" id="print" onclick="javascript: printlayer('div-id-name')" class="btn btn-warning">Print Report!</a></center>

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

        <!-- <?php include('footer.php'); ?> -->



        </div><!-- end of container footer -->


        <!-- <?php include('script-footer.php'); ?> -->

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
        <script type="text/javascript">
            function printlayer(layer) {
                var generator = window.open(",'name',")
                var layertext = document.getElementById(layer);
                generator.document.write(layertext.innerHTML.replace("Print Me"));

                generator.document.close();
                generator.print();
                generator.close();
            }
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