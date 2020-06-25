<?php
require '../koneksi/koneksi.php';
require '../functionsales.php';
session_start();
if (isset($_POST["from"])) {

    $username = $_SESSION['username'];
    $from = $_POST["from"];
    $username = $_POST['username'];

    // result sales
    $result = mysqli_query($conn, "SELECT * FROM sales_targeting 
INNER JOIN sales_funnel ON sales_targeting.funnel_fk = sales_funnel.pk 
INNER JOIN sales_order ON sales_funnel.penawaran_fk = sales_order.fk_penawaran 
INNER JOIN sales_modality ON sales_order.pk_mod_order = sales_modality.pk_mod
INNER JOIN inti_user ON inti_user.username = sales_funnel.username
INNER JOIN sales_customer ON sales_customer.pk_cust = sales_targeting.customer_fk 
INNER JOIN inti_rs ON sales_customer.fk_rs = inti_rs.pk_rs
WHERE sales_targeting.approve = 'approved' 
AND sales_funnel.tujuan_funnel = 'sales'
AND tahun_targeting IN ('" . $_POST["from"] . "')
AND sales_targeting.username = '$username'
GROUP BY sales_order.fk_penawaran
ORDER BY sales_targeting.pk ASC ");

    // result distributor



    $result3 = mysqli_query($conn, "SELECT * FROM inti_user");
    $row3 = mysqli_fetch_assoc($result3);
    $name3 = $row3['name'];

    $resultName = mysqli_query($conn, "SELECT * FROM inti_user WHERE username =  '$username'");
    $rowNama = mysqli_fetch_assoc($resultName);

?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Print Report!</title>
        <?php include('head.php'); ?>
    </head>

    <body>

        <div class="container-fluid content1">
        <?php
        $result313 = mysqli_query($conn, "SELECT SUM(harga_po_targeting) AS totalsum313 FROM sales_targeting WHERE approve = 'approved' AND pengiriman = 'terkirim' AND tahun_targeting IN ('" . $_POST["from"] . "')");
        $row313 = mysqli_fetch_assoc($result313);
        $total313 = $row313['totalsum313'];
    }
        ?>




        <!-- class content buat footer -->
        <div class="mt-2">
            <div class="justify-content-md-center">
                <div class="ket-target">

                </div><br>
                <div class="fill" id="div-id-name">
                    <div class="container-fluid logo-ipi">
                        <center><img src="../image/logoipi.png" style="width: 220px"></center>
                    </div>
                    Nama Sales : <?= $rowNama['name']; ?><br>
                    Email : <?= $rowNama['email']; ?><br><br>
                    <div class="col-md-12" style="overflow-x:auto;">
                        <table id="" class="table_kunjungan" style="margin-top: 0px;" border="1" cellpadding="8" cellspacing="0">
                            <thead>


                                <tr>
                                    <th>No</th>
                                    <th>No. Penawaran</th>
                                    <th>Rumah Sakit</th>
                                    <th>Kota</th>
                                    <!-- <th>Targeting Detail</th> -->
                                    <th>Total Penawaran</th>
                                    <th>Harga PO</th>
                                    <th>Nama Sales</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tr>
                                <?php
                                $no = 1;
                                while ($row = mysqli_fetch_assoc($result)) : ?>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $row['no_targeting']; ?></td>
                                    <td><?php echo $row['nama_rs']; ?></td>
                                    <td><?php echo $row['kota_rs']; ?></td>
                                    <!-- modal -->
                                    <!-- <td>
                                    <a href="#" class="edit-record" data-id="<?= $row['penawaran_fk'];  ?>"><button class="btn btn-fnl btn-info" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fas fa-info-circle"></i></button></a>
                                 



                                    <?php $pk_penawaran = $row['penawaran_fk']; ?>
                                    <?php $result323 = mysqli_query($conn, "SELECT * FROM sales_order WHERE fk_penawaran = '$pk_penawaran' "); ?>
                                    <?php while ($row323 = mysqli_fetch_assoc($result323)) : ?>

                                     

                                    <?php endwhile; ?>



                                </td> -->
                                    <td>
                                        <?php
                                        $resultharga = mysqli_query($conn, "SELECT SUM(total_order) AS totalharga FROM sales_order WHERE fk_penawaran = '$pk_penawaran' "); ?>

                                        <?php while ($row332 = mysqli_fetch_assoc($resultharga)) : ?>
                                            <?= rupiah($row332['totalharga']); ?>
                                            <?php @$tot += $row332['totalharga']; ?>
                                        <?php endwhile; ?>
                                    </td>
                                    <td><?php echo rupiah($row['harga_po_targeting']); ?>
                                        <?php @$tot_po += $row['harga_po_targeting']; ?>
                                    </td>
                                    <td><?= $row['name']; ?></td>
                                    <td><?php if ($row['approve'] == 'approved') { ?>
                                            <div class="btn-success">Order Sukses!</div>
                                        <?php } ?></td>



                                    <?php $no++; ?>
                            </tr>
                        <?php endwhile; ?>
                        <tfoot>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th><?= rupiah(@$tot); ?></th>
                            <th><?= rupiah(@$tot_po); ?></th>
                            <th></th>
                        </tfoot>
                        </table>

                    </div>
                    <div>
                        <h3>

                        </h3>
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


            </div>
        </div>




        <!-- </div> -->



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

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>

        <!-- <?php include('footer.php'); ?> -->



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

    <script>
        // untuk menampilkan data popup
        $(function() {
            $(document).on('click', '.edit-record1', function(e) {
                e.preventDefault();
                $("#myModal").modal('show');
                $.post('hasil10.php', {
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
    </body>


    </html>