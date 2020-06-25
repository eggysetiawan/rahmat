<?php
require '../functionsales.php';

session_start();
$username = $_SESSION['username'];
$result = mysqli_query($conn, "SELECT 
*
FROM sales_funnel 
INNER JOIN inti_user ON inti_user.username = sales_funnel.username 
INNER JOIN sales_order3 ON sales_order3.fk_funnel3 = sales_funnel.pk
INNER JOIN sales_modality ON sales_modality.pk_mod = sales_order3.pk_mod_order
INNER JOIN sales_customer ON sales_funnel.customer_fk = sales_customer.pk_cust 
WHERE tujuan_funnel = 'distributor' GROUP BY sales_funnel.pk ORDER BY sales_funnel.pk ASC");
// $row = mysqli_fetch_assoc($result);
// $pk_mod_funnel = $row['pk_mod_funnel'];
// $result2 = mysqli_query($conn, "SELECT * FROM sales_modality WHERE pk_mod = '$pk_mod_funnel'");
// $row2 = mysqli_fetch_assoc($result2);
$result313 = mysqli_query($conn, "SELECT * FROM sales_funnel WHERE buy_funnel = '100%' AND approve2 IS NULL");
$num_rowss = mysqli_num_rows($result313);

if (isset($_POST['approve2'])) {
	if (approve2($_POST) > 0) {
		echo "<script>alert('data disetujui!');
			  document.location.href= 'view_distributor.php';
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
			  document.location.href= 'view_distributor.php';
			  </script>";
	} else {
		echo "<script>alert('system error, silahkan hubungi admin!');
			  document.location.href= 'view_distributor.php';
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
				<!-- class content buat footer -->
				<!-- <?php echo $num_rowss; ?> Data Belum Di Approve -->
				<div class="justify-content-md-center">
					<div class="col-md-12 table-box" style="overflow-x:auto;">
						<table id="example" class="table_kunjungan" style="margin-top: 0px;" border="1" cellpadding="8" cellspacing="0">
							<thead>
								<tr>
									<th>No</th>
									<!-- <th>No. Penawaran</th> -->
									<th>Rumah Sakit</th>
									<th>Kota</th>

									<th>Funnel Detail</th>
									<th>Total Harga</th>
									<!-- <th>Type</th> -->
									<!-- <th>Stock/Indent</th> -->
									<!-- <th>Qty</th> -->
									<!-- <th>Harga Satuan</th> -->
									<!-- <th>Harga PO</th> -->
									<th>Month/Q</th>
									<th>Budget Sources</th>
									<!-- <th>%Buy</th> -->
									<!-- <th>W/L/H/OP/C</th> -->
									<th>Nama Sales</th>
									<!-- <th>PDF</th> -->
									<!-- <th>Waktu Upload</th> -->
									<th>Action</th>
								</tr>
							</thead>

							<tr>
								<?php
									$no = 1;
									while ($row = mysqli_fetch_assoc($result)) : ?>
									<td><?php echo $no; ?></td>
									<!-- <td><?php echo $row['no_penawaran']; ?></td> -->
									<td><?php echo $row['rs_cust']; ?></td>
									<td>
										<?php if ($row['kota_cust'] == NULL) { ?>
											Indonesia
										<?php } else { ?>
											<?php echo $row['kota_cust']; ?>
										<?php } ?>
									</td>

									<td>
										<a href="#" class="edit-record1" data-id="<?= $row['pk'];  ?>"><button class="btn btn-fnl btn-info" data-toggle="tooltip" data-placement="top" title="Detail Funnel"><i class="fas fa-info-circle"></i></button></a></td>


									<!-- Modal -->


									<?php $pk = $row['pk']; ?>
									<?php $result323 = mysqli_query($conn, "SELECT * FROM sales_order3 WHERE fk_funnel3 = '$pk' "); ?>
									<?php while ($row323 = mysqli_fetch_assoc($result323)) : ?>

									<?php endwhile; ?>



									</td>
									<td>
										<?php
												$resultharga = mysqli_query($conn, "SELECT SUM(total_order) AS totalharga FROM sales_order3 WHERE fk_funnel3 = '$pk' "); ?>

										<?php while ($row332 = mysqli_fetch_assoc($resultharga)) : ?>
											<?= rupiah($row332['totalharga']); ?>
										<?php endwhile; ?>
									</td>

									<td><?php echo $row['month_funnel']; ?></td>

									<td><?php echo $row['budget_funnel']; ?></td>

									<td><?php echo $row['name']; ?></td>

									<td>
										<form id=order name=order method=post action="">
											<input type="hidden" name="level" value="<?= $row['level']; ?>">
											<!-- <input name="no_penawaran" type="hidden" value="<?= $row['no_penawaran']; ?>"> -->
											<input name="username" type="hidden" value="<?= $row['username']; ?>">

											<input type="hidden" class="form-control" id="pk" name="pk" value="<?php echo $row['pk']; ?>">



											<?php $row['approve2']; ?>
											<?php if ($row['approve2'] == "approved" && $row['buy_funnel'] == "100%" && $row['kirim'] == "100%") { ?>
												<div style="color: green;" href="#" class="edit-record2" data-id="<?= $row['pk'];  ?>">&nbsp;Pengiriman Berhasil</div>

											<?php } elseif ($row['approve2'] == "approved" && $row['buy_funnel'] == "100%") { ?>
												<?php echo "WIN"; ?>
												<br>
												<a href="#" class="edit-record2" data-id="<?= $row['pk'];  ?>">&nbsp;Lihat Estimasi Pengiriman</a>
											<?php } elseif ($row['approve2'] == "approved") { ?>
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
							<!-- <h1 class="modal-title">Modal Heading</h1> -->
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
					$.post('hasil9.php', {
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
					$.post('hasil8.php', {
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