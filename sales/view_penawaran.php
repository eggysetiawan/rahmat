<?php
require '../koneksi/koneksi.php';
require '../functionsales.php';
session_start();
$username = $_SESSION['username'];

$nowyear = date('Y');
$result = mysqli_query($conn, "SELECT * FROM sales_penawaran 
INNER JOIN  sales_order ON sales_penawaran.pk_penawaran = sales_order.fk_penawaran 
INNER JOIN sales_modality ON sales_order.pk_mod_order = sales_modality.pk_mod
INNER JOIN sales_customer ON sales_customer.pk_cust = sales_penawaran.pk_cust_penawaran
INNER JOIN inti_rs ON sales_customer.fk_rs = inti_rs.pk_rs
WHERE sales_penawaran.delete_penawaran = 'ada' 
AND sales_penawaran.username = '$username'
AND tahun_penawaran = '$nowyear'

GROUP BY pk_penawaran  
ORDER BY pk_penawaran 
ASC  ");


$result2 = mysqli_query($conn, "SELECT * FROM sales_order GROUP BY fk_penawaran");








if ($_SESSION['level'] == "sales") {
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
                <form action="" method="POST">
                    <div class="form-row">
                        <div class="col-2">
                            <?php $nowyear = date('Y'); ?>

                            <select class="form-control" id="from" name="from">
                                <option value="" selected disabled>
                                    <center>Pilih Tahun</center>
                                </option>
                                <?php
                                $resTahun = mysqli_query($conn, "SELECT tahun_penawaran FROM sales_penawaran WHERE username = '$username' GROUP BY tahun_penawaran");
                                ?>
                                <?php while ($rowTahun = mysqli_fetch_assoc($resTahun)) : ?>
                                    <option value="<?= $rowTahun['tahun_penawaran']; ?>"><?= $rowTahun['tahun_penawaran']; ?></option>
                                <?php endwhile; ?>
                            </select>

                        </div>
                        <div class="col-1">
                            <button class="btn btn-spr btn-sm btn-info" type="button" name="range" id="range">Search</button>
                        </div>
                    </div>
                </form>
                <a href="penawaran.php"><button class="btn_tambah">Tambah Data</button></a><br>
                <br>
                <div class="justify-content-md-center table-box" id="purchase_order">
                    <div class="customer-admin" style="overflow-x:auto;">
                        <div class="form-group">
                            <!-- </div> -->
                            <!-- <div class="justify-content-md-center table-box" id="purchase_order"> -->
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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <?php if (mysqli_num_rows($result) < 1) { ?>

                                <?php } else { ?>
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
                                            <?php $i++; ?>
                                        <?php endwhile; ?>
                                    </tr>
                                <?php } ?>
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
                    </div>
                    <!-- </div> -->


                    <?php include('footer.php'); ?>



                </div>
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
                // $('#from').datetimepicker({
                //     format: 'Y-m-d H:i'
                // });
                $('#to').datetimepicker({
                    format: 'Y-m-d H:i'
                });
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
                                url: "prosescarivewpenawaran.php",
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