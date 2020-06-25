<?php
require '../functionsales.php';


session_start();
$nowyear = date('Y');
$username = $_SESSION['username'];
$result = mysqli_query($conn, "SELECT 
sales_funnel.pk,
sales_funnel.penawaran_fk,
sales_funnel.customer_fk,
sales_funnel.month_funnel,
sales_funnel.budget_funnel,
sales_funnel.buy6,
sales_funnel.buy5,
sales_funnel.buy4,
sales_funnel.buy3,
sales_funnel.buy2,
sales_funnel.buy1,
sales_funnel.buy_funnel,
sales_funnel.status_funnel,
sales_funnel.status2_funnel,
sales_funnel.start_funnel,
sales_funnel.approve2,
sales_funnel.approve,
sales_funnel.gambar,
sales_funnel.username,
sales_funnel.referensi_funnel,
sales_funnel.cancel,
sales_funnel.harga_po,
sales_funnel.tgl_upload,
sales_funnel.now30,
sales_funnel.now50,
sales_funnel.now70,
sales_funnel.now85,
sales_funnel.now90,
sales_funnel.tgl_presentasi,
sales_funnel.now_presentasi,
sales_funnel.mod_presentasi,
sales_funnel.delete_funnel,
sales_funnel.approve_presentasi,
sales_funnel.estimasi_date,
sales_funnel.tanggal_kirim,
sales_funnel.tanggal_terima,
sales_funnel.kirim,
sales_funnel.kirim50,
sales_funnel.kirim100,
sales_funnel.kirim70,
sales_funnel.resi_kirim,
sales_funnel.resi_terima,
sales_funnel.tujuan_funnel,
sales_funnel.tahun_funnel,
inti_user.pk_user,
inti_user.username,
inti_user.name,
inti_user.email,
inti_user.address,
inti_user.city,
inti_user.state,
inti_user.zip,
inti_user.targett,
inti_user.level,
inti_user.approve_target,
inti_user.super_target,
inti_user.tahun_target,
inti_rs.pk_rs,
inti_rs.kode_rs,
inti_rs.nama_rs,
inti_rs.alamat_rs,
inti_rs.kota_rs,
inti_rs.telepon_rs,
sales_order.pk_order,
sales_order.fk_penawaran,
sales_order.pk_mod_order,
sales_order.nama_mod_order,
sales_order.model_mod_order,
sales_order.merk_mod_order,
sales_order.spek_mod_order,
sales_order.harga_order,
sales_order.total_order,
sales_order.qty_order,
sales_order.status_order,
sales_order.cust_fk,
sales_order.koders_cust,
sales_order.delete_order,
sales_order.tujuan_order,
sales_penawaran.pk_penawaran,
sales_penawaran.no_penawaran,
sales_penawaran.pk_cust_penawaran,
sales_penawaran.month,
sales_penawaran.budget_penawaran,
sales_penawaran.tgl_penawaran,
sales_penawaran.status,
sales_penawaran.approve,
sales_penawaran.username,
sales_penawaran.referensi_penawaran,
sales_penawaran.delete_penawaran,
sales_penawaran.tahun_penawaran,
sales_modality.pk_mod,
sales_modality.nama_mod,
sales_modality.merk_mod,
sales_modality.model_mod,
sales_modality.spek_mod,
sales_modality.harga_mod,
sales_modality.now_mod,
sales_modality.stock_mod,
sales_modality.jenis_mod,
sales_modality.type_mod,
sales_customer.pk_cust,
sales_customer.koders_cust,
sales_customer.fk_rs,
sales_customer.nama_cust,
sales_customer.hp_cust,
sales_customer.email_cust,
sales_customer.jabatan_cust,
sales_customer.negara_cust,
sales_customer.pos_cust,
sales_customer.now_cust,
sales_customer.username,
sales_customer.npwp_cust,
sales_customer.dry_film_cust
FROM sales_funnel 
INNER JOIN sales_penawaran ON sales_funnel.penawaran_fk = sales_penawaran.pk_penawaran
INNER JOIN inti_user ON inti_user.username = sales_funnel.username 
INNER JOIN sales_order ON sales_order.fk_penawaran = sales_funnel.penawaran_fk
INNER JOIN sales_modality ON sales_modality.pk_mod = sales_order.pk_mod_order
INNER JOIN sales_customer ON sales_customer.pk_cust = sales_funnel.customer_fk
INNER JOIN inti_rs ON  sales_customer.fk_rs = inti_rs.pk_rs
WHERE tujuan_funnel = 'sales' AND delete_funnel = 'ada'
 GROUP BY sales_funnel.pk ORDER BY sales_funnel.pk ASC");
// $row = mysqli_fetch_assoc($result);
// $pk_mod_funnel = $row['pk_mod_funnel'];
// $result2 = mysqli_query($conn, "SELECT * FROM sales_modality WHERE pk_mod = '$pk_mod_funnel'");
// $row2 = mysqli_fetch_assoc($result2);
$result313 = mysqli_query($conn, "SELECT * FROM sales_funnel WHERE buy_funnel = '100%' AND approve2 IS NULL");
$num_rowss = mysqli_num_rows($result313);

if (isset($_POST['approve2'])) {
  if (approve2($_POST) > 0) {
    echo "<script>alert('data disetujui!');
			  document.location.href= 'view_funnel.php';
			  </script>";
  } else {
    echo "<script>alert('system error, silahkan hubungi admin!');
			  document.location.href= 'view_funnel.php';
			  </script>";
  }
}

if (isset($_POST['rejected2'])) {
  if (reject2($_POST) > 0) {
    echo "<script>alert('data berhasil ditolak');
			  document.location.href= 'view_funnel.php';
			  </script>";
  } else {
    echo "<script>alert('system error, silahkan hubungi admin!');
			  document.location.href= 'view_funnel.php';
			  </script>";
  }
}

if ($_SESSION['level'] == "superadmin") {
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
        <form action="" method="POST">
          <div class="form-row">
            <div class="col-1">
              <?php $nowyear = date('Y'); ?>
              <!-- <label for="from">Pilih </label> -->
              <select class="form-control" id="from" name="from">
                <option value="" selected disabled>
                  <center>Pilih Tahun</center>
                </option>
                <?php
                $resTahun = mysqli_query($conn, "SELECT tahun_funnel FROM sales_funnel GROUP BY tahun_funnel");
                ?>
                <?php while ($rowTahun = mysqli_fetch_assoc($resTahun)) : ?>
                  <option value="<?= $rowTahun['tahun_funnel']; ?>"><?= $rowTahun['tahun_funnel']; ?></option>
                <?php endwhile; ?>
              </select>


            </div>
            <div class="col-1">
              <select class="browser-default custom-select" name="username" id="username">
                <option value="other">----Name Sales----</option>
                <?php
                $res = mysqli_query($conn, "SELECT * FROM inti_user WHERE level = 'sales' ");
                while ($row = mysqli_fetch_assoc($res)) { ?>
                  <option value="<?= $row['username']; ?>"><?= $row['name'];  ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-1">
              <button class="btn btn-spr btn-sm btn-info" type="button" name="range" id="range">Search</button>
            </div>
          </div>
        </form>
        <!-- class content buat footer -->

        <div class="justify-content-md-center" id="purchase_order">
          <div class="col-md-12 table-box" style="overflow-x:auto;">
            <table id="example" class="table_kunjungan" style="margin-top: 0px;" border="1" cellpadding="8" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>No. Penawaran</th>
                  <th>Rumah Sakit</th>
                  <th>Kota</th>
                  <th>Funnel Detail</th>
                  <th>Total Harga</th>
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
                  <td><?php echo $row['nama_rs']; ?></td>
                  <td><?php echo $row['kota_rs']; ?></td>

                  <td>
                    <a href="#" class="edit-record1" data-id="<?= $row['penawaran_fk'];  ?>"><button class="btn btn-fnl btn-info" data-toggle="tooltip" data-placement="top" title="Detail Funnel"><i class="fas fa-info-circle"></i></button></a></td>


                  <!-- Modal -->


                  <?php $pk_penawaran = $row['fk_penawaran']; ?>
                  <?php $result323 = mysqli_query($conn, "SELECT * FROM sales_order WHERE fk_penawaran = '$pk_penawaran' "); ?>
                  <?php while ($row323 = mysqli_fetch_assoc($result323)) : ?>

                  <?php endwhile; ?>



                  </td>
                  <td>
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
                    <?php if ($row['gambar'] == NULL) { ?>
                      <?php echo "<i style='color: #a8978e;' class='fas fa-clock'></i>" ?>
                    <?php } else { ?>
                      <a class="penawaran-a" href="../pdf/pdf_funnel.php?pk=<?= $row['pk'];  ?>" target="_blank">PDF </a>
                    <?php } ?></td>
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


                      <?php $row['approve2']; ?>

                      <?php if ($row['approve2'] == "approved") { ?>
                        <?php echo "<div style='color: green;'>Approved!</div>" ?>
                      <?php } elseif ($row['approve2'] == "rejected") { ?>
                        <?php echo "<div style='color: red;'>Rejected</div>" ?>
                      <?php } elseif ($row['buy_funnel'] != "100%") { ?>
                        <?= $row['status_funnel']; ?>
                      <?php } else { ?>
                        <button type="submit" name="approve2" class="btn btn-fnl btn-primary" onclick="return confirm('Apakah anda yakin?')"><i class="fas fa-check"></i></button>
                        <button type="submit" name="rejected2" class="btn btn-fnl btn-danger" onclick="return confirm('Apakah anda yakin?')"><i class="fas fa-times"></i></button>
                      <?php } ?>
                    </form>
                  </td>

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
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
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
              <!-- <h1 class="modal-title">Modal Heading</h1> -->
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
          var username = $('#username').val();
          // var keyword = $('#keyword').val();
          if (from != '') {
            $.ajax({
              url: "prosescariviewfunnel.php",
              method: "POST",
              data: {
                from: from,
                username: username

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