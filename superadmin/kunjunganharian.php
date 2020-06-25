<?php

require '../functionsales.php';
session_start();

if (isset($_POST['submit'])) {
	if (kunjunganharian($_POST) > 0) {
		echo "<script>alert('data berhasil dimasukkan');
			  document.location.href= 'kunjunganreport.php';
			  </script>";
	} else {
		echo "<script>alert('data gagal dimasukkan');
			  document.location.href= 'kunjunganharian.php';
			  </script>";
	}
}


$username = $_SESSION['username'];
if ($_SESSION['level'] == "sales") {
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
						<li class="breadcrumb-item active">Kunjungan harian</li>
					</ol>
				</nav>
			</div>
			<div class="container content1">
				<div class="justify-content-md-center">

					<div class="form-harian">
						<center>
							<h1>Laporan Kunjungan Harian</h1>
							<hr>
						</center><br>


						<form action="" method="POST">
							<div class="form-row">



								<input type="hidden" class="form-control" name="username" value="<?= $username; ?>"">
							

								<div class=" md-form mt-3 col-md-4">
								<label for="nama">Nama Depan</label>
								<input type="text" class="form-control" id="nama" name="nama_kunjungan" required>
							</div>

							<div class="md-form mt-3 col-md-4">
								<label for="namab">Nama Belakang</label>
								<input type="text" class="form-control" id="namab" name="namab_kunjungan">
							</div>

							<div class="md-form mt-3 col-md-4">
								<label for="hp">Mobile/HP</label>
								<input type="text" class="form-control" id="hp" name="hp_kunjungan">
							</div>

					</div>


					<div class="md-form mt-3">
						<label for="email">Email</label>
						<input type="text" class="form-control" id="email" name="email_kunjungan">
					</div>
					<div class="md-form mt-3">
						<label for="jabatan">Posisi/Jabatan</label>
						<input type="text" class="form-control" id="jabatan" name="jabatan_kunjungan">
					</div>
					<div class="md-form mt-3">
						<label for="kode_rs">Kode Rumah Sakit</label>
						<input type="text" class="form-control" id="kode_rs" name="koders_kunjungan">
					</div>
					<div class="md-form mt-3">
						<label for="nama_rs">Company/Hospital/Perusahaan</label>
						<input type="text" class="form-control" id="nama_rs" name="rs_kunjungan">
					</div>
					<div class="md-form mt-3">
						<label for="inputAddress">Address/Alamat</label>
						<input type="text" class="form-control" id="inputAddress" name="alamat_kunjungan">
					</div>

					<div class="form-row">
						<div class="md-form mt-3 col-md-2">
							<label for="telp">Telp/.Fax</label>
							<input type="text" class="form-control" id="telp" name="tlp_kunjungan">
						</div>
						<div class="md-form mt-3 col-md-4">
							<label for="inputCity">City/Kota</label>
							<input type="text" class="form-control" name="kota_kunjungan" id="inputCity">
						</div>

						<div class="md-form mt-3 col-md-3">
							<select class="form-control mdb-select md-form">
								<option value="" disabled selected>Country/Negara...</option>
								<option value="indonesia">Indonesia</option>
								<option value="malaysia">Malaysia</option>
								<option value="singapur">Singapore</option>
							</select>
						</div>
						<div class="md-form mt-3 col-md-3">
							<label for="inputZip">Zip</label>
							<input type="text" class="form-control" id="inputZip" name="pos_kunjungan">
						</div>
					</div>

					<div class="md-form">
						<textarea id="materialContactFormMessage" class="form-control md-textarea" rows="3" name="req_kunjungan"></textarea>
						<label for="materialContactFormMessage">Inquery/Question/Request</label>
					</div>

					<div class="md-form mt-3">
						<label for="date">Date</label>
						<input type="text" class="form-control" id="date" name="date_kunjungan">
					</div>
					<button type="submit" class="btn btn-primary" name="submit">Input</button>
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