<?php

require '../functionsales.php';
session_start();
$username = $_SESSION['username'];
if (isset($_POST['submit'])) {
	if (penawaran($_POST) > 0) {
		echo "<script>alert('data berhasil dimasukkan');
			  document.location.href= 'penawaran.php';
			  </script>";
	} else {
		echo "<script>alert('data gagal dimasukkan');
			  document.location.href= 'penawaran.php';
			  </script>";
	}
}
if ($_SESSION['level'] == "superadmin") {
	?>

	<!DOCTYPE html>
	<html>

	<head>
		<title>Kunjungan Harian</title>
		<?php include('head.php'); ?>
	</head>

	<body>
		<?php include('menu-bar.php'); ?>
		<div class="container-footer">
			<!-- buat footer -->
			<div class="bc-icons-2">
				<?php include('breadcrumb.php'); ?>
				<li class="breadcrumb-item"><a href="index.php">Home</a><i class="fas fa-angle-right mx-2" aria-hidden="true"></i></li>
				<li class="breadcrumb-item active">Penawaran</li>
				</ol>
				</nav>
			</div>

			<div class="container-fluid content1">
				<div class="row justify-content-md-center" style="margin: 0px;">

					<div class="form-harian col-md-6">
						<!-- <?php

									$i = 0000;
									while ($i <= 1000) {
										printf('%04d ', $i);
										$i++;
									}

									?> -->
						<center>
							<h1>Input Penawaran</h1>
						</center><br>
						<form action="" method="POST">

							<div class="form-group">
								<label for="exampleFormControlSelect1">Rumah Sakit</label>
								<select class="form-control" id="exampleFormControlSelect1" name="pk_kunjungan">
									<option>---Pilih Rumah Sakit---</option>
									<?php
										$result = mysqli_query($conn, "SELECT * FROM sales_kunjungan");
										while ($row = mysqli_fetch_assoc($result)) { ?>
										<option value="<?php echo $row['pk_kunjungan'] ?>"><?php echo $row['rs_kunjungan'] ?></option>
									<?php } ?>
								</select>
							</div>

							<div class="form-group">
								<label for="exampleFormControlSelect1">Modality</label>
								<select class="form-control" id="exampleFormControlSelect1" name="pk_mod">
									<option>---Pilih Modality---</option>
									<?php
										$result = mysqli_query($conn, "SELECT * FROM sales_modality");
										while ($row = mysqli_fetch_assoc($result)) { ?>
										<option value="<?php echo $row['pk_mod'] ?>"><?php echo $row['nama_mod'] ?></option>
									<?php } ?>
								</select>
							</div>

							<div class="form-group">
								<label for="qty">Qty Penawaran</label>
								<input type="text" class="form-control" id="qty" name="qty" placeholder="Qty penawaran..">
							</div>

							<div class="form-group">
								<label for="tanggal">Tanggal Penawaran</label>
								<input type="text" class="form-control" id="date" name="tgl_penawaran" placeholder="tanggal penawaran..">
							</div>

							<div class="md-form mt-3">
								<input type="hidden" class="form-control" name="username" value="<?= $username; ?>">
							</div>


							<button type="submit" name="submit" class="btn btn-primary">Input</button>
							<a href="view_penawaran.php">View Penawaran</a>
						</form>
					</div>
				</div>
			</div>

			<?php include('footer.php'); ?>



		</div><!-- end of container footer -->

		<?php include('script-footer.php'); ?>
		<script>
			$('#date').datetimepicker({
				format: 'd-m-Y H:i'
			});
		</script>
	</body>

	</html>

<?php } else {
	header("location:../index.php");
} ?>