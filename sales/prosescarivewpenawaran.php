<?php
require '../koneksi/koneksi.php';
require '../functionsales.php';
session_start();
// $username = $_SESSION['username'];
if (isset($_POST["from"])) {

    $username = $_SESSION['username'];
    $from = $_POST["from"];
    // $to = $_POST["to"];
    // $from1 = date("Y-m-d", strtotime($from));
    // $to1 = date("Y-m-d", strtotime($to));
    $result = mysqli_query($conn, "SELECT * FROM sales_penawaran 
INNER JOIN  sales_order ON sales_penawaran.pk_penawaran = sales_order.fk_penawaran 
INNER JOIN sales_modality ON sales_order.pk_mod_order = sales_modality.pk_mod
INNER JOIN sales_customer ON sales_customer.pk_cust = sales_penawaran.pk_cust_penawaran
INNER JOIN inti_rs ON sales_customer.fk_rs = inti_rs.pk_rs
WHERE sales_penawaran.delete_penawaran = 'ada' 
AND sales_penawaran.username = '$username' AND tahun_penawaran IN ('" . $_POST["from"] . "')
GROUP BY sales_order.fk_penawaran
ORDER BY pk_penawaran 
ASC  ");


    $result2 = mysqli_query($conn, "SELECT * FROM sales_order WHERE tahun_penawaran IN ('" . $_POST["from"] . "') GROUP BY fk_penawaran");
}

// if ($_SESSION['level'] == "sales") {
?>
<!DOCTYPE html>
<html>

<head>
    <title></title>
    <?php include('head.php'); ?>
</head>

<body>


    <div class="container-fluid content1">


        <br>

        <!-- <div class="justify-content-md-center table-box"> -->
        <div class="customer-admin" style="overflow-x:auto;">
            <div class=" form-group">

            </div>
            <table id="example" class="table_kunjungan table-paginate" style="margin-top: 0px;" border="1" cellpadding="8" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No. Penawaran</th>
                        <th>Nama Customer</th>
                        <th>Rumah Sakit</th>
                        <th>Alamat</th>
                        <th>Detail Penawaran</th>
                        <th>Total Harga Penawaran</th>
                        <th>Tgl Penawaran</th>
                        <th>Nama Sales</th>
                        <th>Referensi</th>
                        <!-- <th>Tgl Upload</th> -->
                        <th>Action</th>
                    </tr>
                </thead>
                <tr>
                    <?php
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($result)) : ?>
                        <td>
                            <center><?php echo $i; ?></center>
                        </td>
                        <td><?php echo $row['no_penawaran']; ?></td>
                        <td><?php echo $row['nama_cust']; ?></td>
                        <td><?php echo $row['nama_rs']; ?></td>
                        <td><?php echo $row['kota_rs']; ?></td>


                        <!-- modal -->
                        <td>
                            <a href="#" class="edit-record" data-id="<?= $row['pk_penawaran'];  ?>"><button class="btn btn-fnl btn-info" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fas fa-info-circle"></i></button></a>
                            <!-- Modal -->



                            <?php $pk_penawaran = $row['pk_penawaran']; ?>




                        </td>
                        <td>
                            <?php
                            $resultharga = mysqli_query($conn, "SELECT SUM(total_order) AS totalharga FROM sales_order WHERE fk_penawaran = '$pk_penawaran' "); ?>

                            <?php while ($row332 = mysqli_fetch_assoc($resultharga)) : ?>
                                <?php $total =  rupiah($row332['totalharga']);
                                echo $total;
                                ?>
                                <?php @$total_harga2 += $row332['totalharga']; ?>
                            <?php endwhile; ?>

                        </td>

                        <td><?php echo $row['tgl_penawaran']; ?></td>

                        <?php
                        $username313 = $row['username'];
                        $result2 = mysqli_query($conn, "SELECT * FROM inti_user WHERE username = '$username313' "); ?>
                        <?php ($rownama = mysqli_fetch_assoc($result2)) ?>
                        <td><?php echo $rownama['name']; ?></td>
                        <td>
                            <?= $row['referensi_penawaran']; ?>
                        </td>
                        <!-- <td>
                                        <?php $row['tgl_upload']; ?>
                                        <?php if ($row['tgl_upload'] == "") { ?>
                                            <?php echo "<i style='color: #a8978e;' class='fas fa-clock'></i>" ?>
                                        <?php } else { ?>
                                            <?= $row['tgl_upload']; ?>
                                        <?php } ?>
                                    </td> -->
                        <td>
                            <?php if ($row['approve'] == "approved") { ?>
                                <?php echo "<div class='ic-yes'><i class='fas fa-check-circle'></i></div>" ?>
                            <?php } elseif ($row['approve'] == "rejected") { ?>
                                <?php echo "<div class='ic-no'><i class='fas fa-times-circle'></i></div>" ?>
                            <?php } elseif ($row['approve'] == "revisi") { ?>
                                hubungi Admin
                            <?php } else { ?>
                                <!-- <a class="penawaran-a" href="../pdf/testpdf4.php?no_penawaran=<?= $row['no_penawaran'];  ?>" target="_blank">PDF</a> | -->
                                <a class="penawaran-a" onclick="return confirm('Apakah anda yakin?')" href="hapus.php?pk_penawaran=<?= $row['pk_penawaran'];  ?>">Delete</a> |
                                <a class="penawaran-a" href="edit_penawaran.php?no_penawaran=<?= $row['no_penawaran'];  ?>">Edit</a>
                            <?php } ?>
                        </td>
                </tr>
                <!-- <?php echo $i++;  ?> -->
            <?php endwhile; ?>
            <tfoot>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th><?= @rupiah($total_harga2); ?></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>

            </tfoot>
            </table>



            <!-- The Modal -->
            <div class="modal" id="myModal">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h3>Detail Penawaran</h3>
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <p><?php echo $row['pk_penawaran']; ?></p>
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
        <!-- </div> -->
        <!-- </div> -->

        <?php include('footer.php'); ?>



    </div><!-- end of container footer -->




    <?php include('script-footer.php'); ?>
    <script>
        // untuk menampilkan data popup
        $(function() {
            $(document).on('click', '.edit-record', function(e) {
                e.preventDefault();
                $("#myModal").modal('show');
                $.post('hasil3.php', {
                        pk_penawaran: $(this).attr('data-id')
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
        $('#from1').datetimepicker({
            format: 'Y-m-d H:i'
        });
        $('#to').datetimepicker({
            format: 'Y-m-d H:i'
        });
    </script>
    <!-- <script>
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
    </script> -->



</body>

</html>