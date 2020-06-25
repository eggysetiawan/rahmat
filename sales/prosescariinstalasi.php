<?php

require '../functionsales.php';

session_start();

if (isset($_POST["from"], $_POST["to"], $_POST["keyword"])) {

    $username = $_SESSION['username'];
    $from = $_POST["from"];
    $to = $_POST["to"];
    // $from1 = date("Y-m-d", strtotime($from));
    // $to1 = date("Y-m-d", strtotime($to));
    $result = mysqli_query($conn, "SELECT * 
FROM sales_funnel 
INNER JOIN sales_order3 ON sales_funnel.pk = sales_order3.fk_funnel3 
INNER JOIN sales_modality ON sales_order3.pk_mod_order = sales_modality.pk_mod
INNER JOIN sales_customer ON sales_funnel.customer_fk = sales_customer.pk_cust  
WHERE sales_funnel.delete_funnel = 'ada' 
AND start_funnel BETWEEN '" . $_POST["from"] . "' AND '" . $_POST["to"] . "'
AND rs_funnel LIKE '%" . $_POST['keyword'] . "%'
AND sales_funnel.username = '$username' 
AND tujuan_order = 'distributor' 
GROUP BY fk_funnel3 
ORDER BY pk 
ASC  
   ");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title></title>
    <?php include('head.php'); ?>
</head>

<body>
    <div class="container-footer">
        <!-- buat footer -->

        <div class="container-fluid content1">
            <!-- class content buat footer -->

            <br>
            <div style="overflow-x:auto; padding: 5px;">
                <table id="example" class="table_kunjungan table-paginate" style="margin-top: 0px;" border="1" cellpadding="8" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>

                            <th>Nama Customer</th>
                            <th>Rumah Sakit</th>
                            <th>Regional</th>
                            <th>Detail Order</th>
                            <th>Total Harga Order</th>
                            <!-- <th>Modality</th>
                                <th>Merk</th>
                                <th>Model</th>
                                <th>Spek</th>
                                <th>Penawaran</th>
                                <th>Qty</th> -->
                            <th>Tgl Order</th>
                            <th>Nama Distributor</th>
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

                            <!-- <td><?php echo $row['no_penawaran']; ?></td> -->
                            <td>
                                <?php if ($row['nama_cust'] == NULL) { ?>
                                    <div style="color: grey">Belum di input.</div>
                                <?php } else { ?>
                                    <?php echo $row['nama_cust']; ?>
                                <?php } ?>
                            </td>
                            <td><?php echo $row['rs_cust']; ?></td>
                            <td><?php if ($row['kota_cust'] == NULL) { ?>
                                    <div style="color: grey">Belum di input.</div>
                                <?php } else { ?>
                                    <?php echo $row['kota_cust']; ?>
                                <?php } ?></td>


                            <!-- modal -->
                            <td>
                                <a href="#" class="edit-record" data-id="<?= $row['pk'];  ?>"><button class="btn btn-fnl btn-info" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fas fa-info-circle"></i></button></a>
                                <!-- Modal -->
                            </td>
                            <td>
                                <?php $pk = $row['pk']; ?>
                                <?php
                                $resultharga = mysqli_query($conn, "SELECT SUM(total_order) AS totalharga FROM sales_order3 WHERE fk_funnel3 = '$pk' "); ?>

                                <?php while ($row332 = mysqli_fetch_assoc($resultharga)) : ?>
                                    <?= rupiah($row332['totalharga']); ?>
                                <?php endwhile; ?>
                            </td>

                            <td><?php echo $row['start_funnel']; ?></td>

                            <?php
                            $username313 = $row['username'];
                            $result2 = mysqli_query($conn, "SELECT * FROM inti_user WHERE username = '$username313' "); ?>
                            <?php ($rownama = mysqli_fetch_assoc($result2)) ?>
                            <td><?php echo $rownama['name']; ?></td>
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
                                    <div style="color:red">Order Rejected!</div>
                                <?php } elseif ($row['approve'] == "approved" && $row['approve2'] == 'approved') { ?>
                                    <div style="color:green">Order Approved!</div>
                                <?php } elseif ($row['approve'] == "approved") { ?>
                                    <div style="color:blue">Waiting for Approval</div>
                                <?php } elseif ($row['approve'] == "rejected") { ?>
                                    <?php echo "<div class='ic-no'><i class='fas fa-times-circle'></i></div>" ?>
                                <?php } elseif ($row['approve'] == "revisi") { ?>
                                    Silahkan Menghubungi Super Admin Untuk Diskusi Penawaran
                                <?php } ?>

                                <!-- <?php if ($row['gambar'] == '') { ?>
                                                <a class="penawaran-a" href="../pdf/testpdf4.php?no_penawaran=<?= $row['no_penawaran'];  ?>" target="_blank">PDF</a> |
                                                <a class="penawaran-a" onclick="return confirm('Apakah anda yakin?')" href="hapus.php?pk_penawaran=<?= $row['pk_penawaran'];  ?>">Delete</a> |
                                                <a class="penawaran-a" href="upload_penawaran.php?no_penawaran=<?= $row['no_penawaran'];  ?>">Upload</a>
                                                <a href="edit_penawaran.php?no_penawaran=<?= $row['no_penawaran'];  ?>">Edit</a>
                                            <?php } else { ?>
                                                <a class="penawaran-a" href="../pdf/testpdf4.php?no_penawaran=<?= $row['no_penawaran'];  ?>" target="_blank">PDF</a> |
                                                <a class="penawaran-a" onclick="return confirm('Apakah anda yakin?')" href="hapus.php?pk_penawaran=<?= $row['pk_penawaran'];  ?>">Delete</a> |
                                                <a class="penawaran-a" href="upload_penawaran.php?no_penawaran=<?= $row['no_penawaran'];  ?>">Re-Upload</a>
                                            <?php } ?> -->

                            </td>
                    </tr>
                    <?php echo $i++;  ?>
                <?php endwhile; ?>
                </table>



                <!-- The Modal -->
                <div class="modal" id="myModal">
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

            </div>
        </div>




    </div><!-- end of container footer -->




    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "order": [
                    [0, "dsc"]
                ],
                "deferRender": true
            });
        });
    </script>
</body>

</html>