<?php
require '../functionsales.php';
session_start();
$username = $_SESSION['username'];
$result = mysqli_query($conn, "SELECT * 
FROM sales_funnel 
INNER JOIN sales_order3 ON sales_funnel.pk = sales_order3.fk_funnel3 
INNER JOIN sales_modality ON sales_order3.pk_mod_order = sales_modality.pk_mod
INNER JOIN sales_customer ON sales_funnel.customer_fk = sales_customer.pk_cust
 
WHERE sales_funnel.delete_funnel = 'ada' 
AND sales_funnel.username = '$username' 
AND tujuan_order = 'distributor' 
GROUP BY fk_funnel3 
ORDER BY pk 
ASC  ");



$result2 = mysqli_query($conn, "SELECT * FROM sales_order3 GROUP BY fk_funnel3");








if ($_SESSION['level'] == "distributor") {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Lihat Penawaran</title>
        <?php include('head.php'); ?>
    </head>

    <body>
        <?php include('menu-bar.php'); ?>
        <div class="container-footer">
            <!-- buat footer -->
            <div class="bc-icons-2">
                <?php include('breadcrumb.php'); ?>
                <li class="breadcrumb-item"><a href="index.php">Home</a><i class="fas fa-angle-right mx-2" aria-hidden="true"></i></li>
                <li class="breadcrumb-item"><a href="penawaran.php">Penawaran</a><i class="fas fa-angle-right mx-2" aria-hidden="true"></i></li>
                <li class="breadcrumb-item active" aria-current="page">View data Penawaran</li>
                </ol>
                </nav>
            </div>

            <div class="container-fluid content1">
                <!-- class content buat footer -->

                <a href="generate.php"><button class="btn_tambah">Tambah</button></a>

                <form action="" method="POST">
                    <div class="form-row">
                        <div class="col-1">
                            <input class="form-control" type="text" name="from" id="from" placeholder="From">
                        </div>
                        <div class="col-1">
                            <input class="form-control" type="text" name="to" id="to" placeholder="To">
                        </div>
                        <div class="col-1">
                            <input class="form-control" type="text" name="keyword" id="keyword" placeholder="Rumah Sakit....">
                        </div>
                        <div class="col-1">
                            <button class="btn btn-spr btn-sm btn-info" type="button" name="range" id="range">Search</button>
                        </div>
                    </div>
                </form>

                <div class="justify-content-md-center table-box" id="purchase_order">
                    <div class="customer-admin" style="overflow-x:auto;">
                        <table id="example" class="table_kunjungan table-paginate" style="margin-top: 0px;" border="1" cellpadding="8" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Instansi</th>
                                    <th>Kota</th>
                                    <th>Detail Order</th>
                                    <th>Total Harga Order</th>
                                    <th>Tgl Order</th>
                                    <!-- <th>Total Harga Penawaran</th> -->
                                    <!-- <th>Modality</th>
                                <th>Merk</th>
                                <th>Model</th>
                                <th>Spek</th>
                                <th>Penawaran</th>
                                <th>Qty</th> -->

                                    <!-- <th>Nilai Kontrak</th> -->

                                    <th>DPP</th>
                                    <th>PPN</th>
                                    <!-- <th>PPH</th> -->
                                    <!-- <th>Nett</th> -->
                                    <!-- <th>Ongkir</th> -->
                                    <th>Referensi</th>
                                    <TH>No. Invoince</TH>
                                    <th>Pembayaran</th>
                                    <!-- <th>Referensi</th> -->
                                    <!-- <th>Tgl Upload</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tr>
                                <?php
                                $i = 1;
                                while ($row = mysqli_fetch_assoc($result)) : ?>
                                    <td><?php echo $i; ?></td>


                                    <td>
                                        <?php if ($row['hide_rs_funnel'] == 'checked_hide') { ?>
                                            <div style="color:grey">Tidak diketahui.</div>
                                        <?php } else { ?>
                                            <?= $row['rs_cust']; ?>
                                        <?php } ?>
                                    </td>

                                    <td><?= $row['kota_cust']; ?>
                                    </td>
                                    <td>
                                        <a href="#" class="edit-record" data-id="<?= $row['pk'];  ?>"><button class="btn btn-fnl btn-info" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fas fa-info-circle"></i></button></a>
                                        <!-- Modal -->
                                    </td>

                                    <td>
                                        <?php $pk = $row['pk']; ?>
                                        <?php
                                        $resultharga = mysqli_query($conn, "SELECT SUM(total_order) AS totalharga FROM sales_order3 WHERE fk_funnel3 = '$pk' "); ?>

                                        <?php if ($row['referensi_funnel'] == 'E-Catalogue') { ?>

                                            <?php while ($row332 = mysqli_fetch_assoc($resultharga)) : ?>
                                                <?php $total_po = $row332['totalharga'];

                                                echo rupiah($total_po);

                                                @$total_order1 += $total_po; ?>
                                            <?php endwhile; ?>
                                        <?php } else { ?>
                                            <?php while ($row332 = mysqli_fetch_assoc($resultharga)) : ?>
                                                <?php

                                                $total_po1 = $row332['totalharga'];
                                                $ppn_po = ((10 / 100) * $total_po1);

                                                $total_po = $total_po1 + $ppn_po;

                                                echo rupiah($total_po);
                                                ?>

                                                <?php @$total_order1 += $total_po ?>
                                            <?php endwhile; ?>
                                        <?php } ?>
                                    </td>

                                    <td><?php echo $row['start_funnel']; ?></td>







                                    <td>
                                        <?php $pk = $row['pk']; ?>
                                        <?php
                                        $resultharga = mysqli_query($conn, "SELECT SUM(total_order) AS totalharga FROM sales_order3 WHERE fk_funnel3 = '$pk' "); ?>


                                        <?php if ($row['referensi_funnel'] == 'E-Catalogue') { ?>
                                            <?php while ($row332 = mysqli_fetch_assoc($resultharga)) : ?>
                                                <?php

                                                $total_order = $row332['totalharga'];

                                                $dpp_funnel = ($total_order / (110 / 100));

                                                echo rupiah($dpp_funnel);

                                                @$total_dpp_funnel += $dpp_funnel;

                                                ?>
                                            <?php endwhile; ?>

                                        <?php } else { ?>
                                            <?php while ($row332 = mysqli_fetch_assoc($resultharga)) : ?>
                                                <?php

                                                $dpp_funnel = $row332['totalharga'];



                                                echo rupiah($dpp_funnel);

                                                @$total_dpp_funnel += $dpp_funnel;

                                                ?>
                                            <?php endwhile; ?>
                                        <?php } ?>
                                    </td>

                                    <td>
                                        <?php $pk = $row['pk']; ?>
                                        <?php
                                        $resultharga = mysqli_query($conn, "SELECT SUM(total_order) AS totalharga FROM sales_order3 WHERE fk_funnel3 = '$pk' "); ?>

                                        <?php if ($row['referensi_funnel'] == 'E-Catalogue') { ?>

                                            <?php while ($row332 = mysqli_fetch_assoc($resultharga)) : ?>

                                                <?php
                                                $total_order = $row332['totalharga'];

                                                $dpp_funnel = ($total_order / (110 / 100));
                                                ?>

                                                <?php $ppn = ((10 / 100) * $dpp_funnel); ?>
                                                <?php if ($ppn == "") { ?>
                                                    <?php echo "<i style='color: #a8978e;' class='fas fa-clock'></i>" ?>
                                                <?php } else { ?>
                                                    <?= rupiah($ppn); ?>
                                                <?php } ?>
                                                <?php @$total_ppn += $ppn; ?>
                                            <?php endwhile; ?>

                                        <?php } else { ?>

                                            <?php while ($row332 = mysqli_fetch_assoc($resultharga)) : ?>

                                                <?php
                                                $total_order = $row332['totalharga'];


                                                $ppn_po = ((10 / 100) * $total_order);




                                                ?>


                                                <?php if ($ppn_po == "") { ?>
                                                    <?php echo "<i style='color: #a8978e;' class='fas fa-clock'></i>" ?>
                                                <?php } else { ?>
                                                    <?= rupiah($ppn_po); ?>
                                                <?php } ?>
                                                <?php @$total_ppn += $ppn_po; ?>
                                            <?php endwhile; ?>

                                        <?php } ?>
                                    </td>

                                    <!-- <td>
                                        <?php $pk = $row['pk']; ?>
                                        <?php
                                        $resultharga = mysqli_query($conn, "SELECT SUM(total_order) AS totalharga FROM sales_order3 WHERE fk_funnel3 = '$pk' "); ?>




                                        <?php if ($row['pph_funnel'] == 'pph22') { ?>

                                            <?php if ($row['referensi_funnel'] == 'E-Catalogue') { ?>
                                                <?php while ($row332 = mysqli_fetch_assoc($resultharga)) : ?>
                                                    <?php

                                                    $total_order = $row332['totalharga'];

                                                    $dpp_funnel = ($total_order / (110 / 100));

                                                    $pph = ((15 / 1000) * $dpp_funnel);

                                                    echo rupiah($pph);

                                                    @$total_pph += $pph;



                                                    ?>
                                                <?php endwhile; ?>

                                            <?php } else { ?>
                                                <?php while ($row332 = mysqli_fetch_assoc($resultharga)) : ?>
                                                    <?php

                                                    $dpp_funnel = $row332['totalharga'];


                                                    $pph = ((15 / 1000) * $dpp_funnel);

                                                    echo rupiah($pph);



                                                    @$total_pph += $pph;

                                                    ?>
                                                <?php endwhile; ?>
                                            <?php } ?>

                                        <?php } else { ?>

                                            <?php if ($row['referensi_funnel'] == 'E-Catalogue') { ?>
                                                <?php while ($row332 = mysqli_fetch_assoc($resultharga)) : ?>
                                                    <?php

                                                    $total_order = $row332['totalharga'];

                                                    $dpp_funnel = ($total_order / (110 / 100));

                                                    $pph = ((2 / 100) * $dpp_funnel);

                                                    echo rupiah($pph);

                                                    @$total_pph += $pph;



                                                    ?>
                                                <?php endwhile; ?>

                                            <?php } else { ?>
                                                <?php while ($row332 = mysqli_fetch_assoc($resultharga)) : ?>
                                                    <?php

                                                    $dpp_funnel = $row332['totalharga'];


                                                    $pph = ((2 / 100) * $dpp_funnel);
                                                    echo rupiah($pph);



                                                    @$total_pph += $pph;

                                                    ?>
                                                <?php endwhile; ?>
                                            <?php } ?>

                                        <?php } ?>


                                    </td> -->

                                    <!-- net -->
                                    <!-- <td>

                                        <?php $pk = $row['pk']; ?>
                                        <?php
                                        $resultharga = mysqli_query($conn, "SELECT SUM(total_order) AS totalharga FROM sales_order3 WHERE fk_funnel3 = '$pk' "); ?>

                                        <?php if ($row['referensi_funnel'] == 'E-Catalogue') { ?>
                                            <?php while ($row332 = mysqli_fetch_assoc($resultharga)) : ?>
                                                <?php

                                                $total_order = $row332['totalharga'];

                                                $dpp_funnel = ($total_order / (110 / 100));

                                                $ppn = ((10 / 100) * $dpp_funnel);

                                                $net = $dpp_funnel - $ppn;

                                                echo rupiah($net);

                                                @$total_net += $net;



                                                ?>
                                            <?php endwhile; ?>

                                        <?php } else { ?>
                                            <?php while ($row332 = mysqli_fetch_assoc($resultharga)) : ?>
                                                <?php

                                                $dpp_funnel = $row332['totalharga'];


                                                $pph = ((10 / 100) * $dpp_funnel);

                                                $net = $dpp_funnel - $pph;

                                                echo rupiah($net);

                                                @$total_net += $net;

                                                ?>
                                            <?php endwhile; ?>
                                        <?php } ?>
                                        <!-- </td>

                                    <!-- <td>
                                        <?php $pk = $row['pk']; ?>
                                        <?php
                                        $resultharga = mysqli_query($conn, "SELECT SUM(total_order) AS totalharga FROM sales_order3 WHERE fk_funnel3 = '$pk' "); ?>




                                        <?php if ($row['pph_funnel'] == 'pph22') { ?>

                                            <?php if ($row['referensi_funnel'] == 'E-Catalogue') { ?>
                                                <?php while ($row332 = mysqli_fetch_assoc($resultharga)) : ?>
                                                    <?php

                                                    $total_order = $row332['totalharga'];

                                                    $dpp_funnel = ($total_order / (110 / 100));

                                                    $pph = ((15 / 1000) * $dpp_funnel);

                                                    $net = $dpp_funnel - $pph;

                                                    echo rupiah($net);

                                                    @$total_net += $net;



                                                    ?>
                                                <?php endwhile; ?>

                                            <?php } else { ?>
                                                <?php while ($row332 = mysqli_fetch_assoc($resultharga)) : ?>
                                                    <?php

                                                    $dpp_funnel = $row332['totalharga'];


                                                    $pph = ((15 / 1000) * $dpp_funnel);

                                                    $net = $dpp_funnel - $pph;

                                                    echo rupiah($net);

                                                    @$total_net += $net;

                                                    ?>
                                                <?php endwhile; ?>
                                            <?php } ?>

                                        <?php } else { ?>

                                            <?php if ($row['referensi_funnel'] == 'E-Catalogue') { ?>
                                                <?php while ($row332 = mysqli_fetch_assoc($resultharga)) : ?>
                                                    <?php

                                                    $total_order = $row332['totalharga'];

                                                    $dpp_funnel = ($total_order / (110 / 100));

                                                    $pph = ((2 / 100) * $dpp_funnel);

                                                    $net = $dpp_funnel - $pph;

                                                    echo rupiah($net);

                                                    @$total_net += $net;




                                                    ?>
                                                <?php endwhile; ?>

                                            <?php } else { ?>
                                                <?php while ($row332 = mysqli_fetch_assoc($resultharga)) : ?>
                                                    <?php

                                                    $dpp_funnel = $row332['totalharga'];


                                                    $pph = ((2 / 100) * $dpp_funnel);
                                                    $net = $dpp_funnel - $pph;

                                                    echo rupiah($net);

                                                    @$total_net += $net;


                                                    ?>
                                                <?php endwhile; ?>
                                            <?php } ?>

                                        <?php } ?> -->

                                    </td>


                                    <!-- end net

                                    <!-- <td>
                                        <?php $row['ongkir_funnel']; ?>
                                        <?php if ($row['ongkir_funnel'] == "") { ?>
                                            <?php echo "<i style='color: #a8978e;' class='fas fa-clock'></i>" ?>
                                        <?php } else { ?>
                                            <?= rupiah($row['ongkir_funnel']); ?>
                                        <?php } ?>
                                    </td> -->

                                    <?php
                                    $username313 = $row['username'];
                                    $result2 = mysqli_query($conn, "SELECT * FROM inti_user WHERE username = '$username313' "); ?>
                                    <?php ($rownama = mysqli_fetch_assoc($result2)) ?>
                                    <td><?php echo $row['referensi_funnel']; ?></td>
                                    <td>
                                        <?php if ($row['invoice_funnel'] == NULL) { ?>
                                            <?php echo "<i style='color: #a8978e;' class='fas fa-clock'></i>" ?>
                                        <?php } else { ?>
                                            <?= $row['invoice_funnel']; ?>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($row['tgl_pembayaran'] == NULL) { ?>
                                            <?php echo "<i style='color: #a8978e;' class='fas fa-clock'></i>" ?>
                                        <?php } else { ?>
                                            <?= $row['tgl_pembayaran']; ?>
                                        <?php } ?>
                                    </td>
                                    <!-- <td>
                                        <?= $row['referensi_penawaran']; ?>
                                    </td> -->
                                    <!-- <td>
                                        <?php $row['tgl_upload']; ?>
                                        <?php if ($row['tgl_upload'] == "") { ?>
                                            <?php echo "<i style='color: #a8978e;' class='fas fa-clock'></i>" ?>
                                        <?php } else { ?>
                                            <?= $row['tgl_upload']; ?>
                                        <?php } ?>
                                    </td> -->
                                    <td>
                                        <?php if ($row['approve'] == "approved" && $row['approve2'] == 'rejected') { ?>
                                            <div class="btn-danger">Order Rejected!</div>
                                        <?php } elseif ($row['approve'] == "approved" && $row['approve2'] == 'approved') { ?>
                                            <div class="btn-success">Order Approved!</div>
                                        <?php } elseif ($row['approve'] == "approved") { ?>
                                            <div class="btn-info">Waiting for Approval</div>
                                        <?php } elseif ($row['approve'] == "rejected") { ?>
                                            <?php echo "<div class='ic-no'><i class='fas fa-times-circle'></i></div>" ?>
                                        <?php } elseif ($row['approve'] == "revisi") { ?>
                                            <div class="btn-warning">Silahkan Menghubungi Super Admin Untuk Diskusi Penawaran</div>
                                        <?php } ?>

                                    </td>
                                    <?php $i++;  ?>
                            </tr>
                        <?php endwhile; ?>
                        <tfoot>
                            <tr>
                                <th> </th>
                                <th> </th>
                                <th> </th>
                                <th> </th>
                                <th><?= rupiah(@$total_order1); ?></th>
                                <th> </th>
                                <!-- <th><?= rupiah($total_order1); ?> </th> -->
                                <th><?= rupiah(@$total_dpp_funnel); ?> </th>
                                <th><?= rupiah(@$total_ppn); ?> </th>
                                <!-- <th> <?= rupiah($total_pph); ?></th> -->
                                <!-- <th><?= rupiah(@$total_net); ?> </th> -->
                                <th></th>
                                <th> </th>
                                <th> </th>
                                <th></th>
                                <!-- <th> </th> -->


                            </tr>
                        </tfoot>
                        </table>



                        <!-- The Modal -->
                        <?php
                        $result1 = mysqli_query($conn, "SELECT * FROM inti_user WHERE username = '$username'");
                        $row1 = mysqli_fetch_assoc($result1);
                        ?>
                        <div class="modal" id="myModal">
                            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h3><?= $row1['name']; ?></h3>
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

                    </div>
                </div>
            </div>

            <?php include('footer.php'); ?>



        </div><!-- end of container footer -->




        <?php include('script-footer.php'); ?>

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
            $('#from').datetimepicker({
                format: 'Y-m-d H:i'
            });
            $('#to').datetimepicker({
                format: 'Y-m-d H:i'
            });
        </script>
        <script>
            $(document).ready(function() {

                $('.cboxtombol').click(function() {
                    $('.cbox').prop('checked', this.checked);
                });

                $('.cboxtombolpay').click(function() {
                    $('.cboxpay').prop('checked', this.checked);
                });
                $('#range').click(function() {
                    $('#purchase_order').html("<div class='preloader-css'><span></span><span></span><span></span><span></span><span></span></div>");
                    var from = $('#from').val();
                    var to = $('#to').val();
                    var keyword = $('#keyword').val();
                    if (from != '' && to != '') {
                        $.ajax({
                            url: "prosescarivieworder.php",
                            method: "POST",
                            data: {
                                from: from,
                                to: to,
                                keyword: keyword
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
                    $.post('hasil3.php', {
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