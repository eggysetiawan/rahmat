<?php

require '../functionsales.php';
session_start();
$username = $_SESSION['username'];
$result = mysqli_query($conn, "SELECT * FROM sales_kunjungan WHERE username = '$username'");

if ($_SESSION['level'] == "superadmin" || $_SESSION['level'] == "sales") {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Report Kunjungan</title>
		<?php include('head.php'); ?>
	</head>

	<body>
		<?php include('menu-bar.php'); ?>
		<div class="container-footer">
			<!-- buat footer -->
			<div class="bc-icons-2">
				<?php include('breadcrumb.php'); ?>
				<li class="breadcrumb-item"><a href="index.php">Home</a><i class="fas fa-angle-right mx-2" aria-hidden="true"></i></li>
				<li class="breadcrumb-item active">Report Kunjungan</li>
				</ol>
				</nav>
			</div>

			<div class="container-fluid content1">
				<!-- class content buat footer -->
				<div class="justify-content-md-center kunjungan_rprt">
					<center>
						<h1>Report Kunjungan</h1>
					</center>

					<form action="" method="POST">
						<div class="form-row">
							<div class="col-1">
								<input class="form-control" type="text" name="from" id="from" placeholder="From">
							</div>
							<div class="col-1">
								<input class="form-control" type="text" name="to" id="to" placeholder="To">
							</div>

							<div class="col-1">
								<button class="btn btn-spr btn-sm btn-info" type="button" name="range" id="range">Search</button>
							</div>
						</div>
					</form>

					<div class="col-md-12 table-box" style="overflow-x: auto;" id="purchase_order">
						<table id="example" class="table_kunjungan" style="margin-top: 0px;" border="1" cellpadding="8" cellspacing="0">
							<thead>
								<tr>
									<th>
										<center>No</center>
									</th>
									<th>
										<center>Nama Customer</center>
									</th>
									<th>
										<center>Mobile/HP</center>
									</th>
									<th>
										<center>Email</center>
									</th>
									<th>
										<center>Posisi</center>
									</th>
									<th>
										<center>Perusahaan</center>
									</th>
									<th>
										<center>Alamat</center>
									</th>
									<th>
										<center>Telp/.Fax</center>
									</th>
									<th>
										<center>In/Q/R</center>
									</th>
									<th>
										<center>Hasil Kunjungan</center>
									</th>
									<th>
										<center>Tgl Kunjungan</center>
									</th>
								</tr>
							</thead>
							<?php if (mysqli_num_rows($result) < 1) { ?>

							<?php } else { ?>
								<tr>
									<?php
									$no = 1;
									while ($row = mysqli_fetch_assoc($result)) : ?>
										<td><?php echo $no; ?></td>
										<td><?php echo $row['nama_kunjungan']; ?></td>
										<td><?php echo $row['hp_kunjungan']; ?></td>
										<td><?php echo $row['email_kunjungan']; ?></td>
										<td><?php echo $row['jabatan_kunjungan']; ?></td>
										<td><?php echo $row['rs_kunjungan']; ?></td>
										<td>

											<?php echo $row['kota_kunjungan']; ?>
										</td>
										<td><?php echo $row['tlp_kunjungan']; ?></td>
										<td><?php echo $row['req_kunjungan']; ?></td>
										<td><?= $row['hasil_kunjungan']; ?></td>
										<td><?php echo $row['now_kunjungan']; ?></td>
										<?php
										$username313 = $row['username'];
										$result2 = mysqli_query($conn, "SELECT * FROM inti_user WHERE username = '$username313' "); ?>
										<?php ($rownama = mysqli_fetch_assoc($result2)) ?>

										<?php $no++; ?>
								</tr>
							<?php endwhile; ?>
						<?php } ?>

						</table>
					</div>
				</div>
			</div>

			<?php include('footer.php'); ?>



		</div><!-- end of container footer -->
		<?php include('script-footer.php'); ?>
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
					var username = $('#username').val();
					var keyword = $('#keyword').val();
					if (from != '' && to != '') {
						$.ajax({
							url: "prosescarikunjungan.php",
							method: "POST",
							data: {
								from: from,
								to: to
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