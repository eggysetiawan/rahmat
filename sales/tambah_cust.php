<?php
session_start();
require '../functionsales.php';

if (isset($_POST['submit'])) {
	if (tambahcust($_POST) > 0) {
		echo "<script>alert('data berhasil dimasukkan');
			  document.location.href= 'view_cust.php';
			  </script>";

		// var_dump($_POST);
	} else {
		echo "<script>alert('data gagal dimasukkan');
			  document.location.href= 'tambah_cust.php';
			  </script>";
	}
}



if ($_SESSION['level'] == "sales") {
	?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Tambah customer</title>
		<?php include('head.php'); ?>
	</head>

	<body>
		<?php include('menu-bar.php'); ?>
		<div class="container-footer">
			<!-- buat footer -->
			<div class="bc-icons-2">
				<?php include('breadcrumb.php'); ?>
				<li class="breadcrumb-item"><a href="index.php">Home</a><i class="fas fa-angle-right mx-2" aria-hidden="true"></i></li>
				<li class="breadcrumb-item active">Tambah customer</li>
				</ol>
				</nav>
			</div>

			<div class="container content1">
				<!-- class content buat footer -->
				<div class="justify-content-md-center">
					<div class="form-harian">
						<center>
							<h1>Tambah Data Customer</h1>
							<hr>
						</center><br>

						<form action="" method="POST">
							<div class="form-row">
								<div class="md-form mt-3 col-md-4">
									<label for="nama_cust">Nama Cust</label>
									<input type="text" class="form-control" id="nama_cust" name="nama_cust">
								</div>

								<div class="md-form mt-3 col-md-4">
									<label for="hp">Mobile/HP</label>
									<input type="text" class="form-control" id="hp" name="hp_cust">
								</div>
								<div class="md-form mt-3 col-md-4">
									<label for="email">Email</label>
									<input type="text" class="form-control" id="email" name="email_cust">
								</div>
							</div>

							<div class="form-row">
								<div class="md-form mt-3 col-md-6">
									<label for="jabatan">Posisi/Jabatan</label>
									<input type="text" class="form-control" id="jabatan" name="jabatan_cust">
								</div>
								<div class="md-form mt-3 col-md-6">
									<label for="nama_rs">Company/Hospital/Perusahaan</label>
									<input type="text" class="form-control" id="nama_rs" name="rs_cust">
								</div>
								<div class="md-form mt-3">
									<label for="kode_rs">Kode Rumah Sakit</label>
									<input type="text" class="form-control" id="kode_rs" name="koders_cust">
								</div>
							</div>
							<div class="md-form mt-3">
								<label for="inputAddress">Address/Alamat</label>
								<input type="text" class="form-control" id="inputAddress" name="alamat_cust">
							</div>
							<div class="form-row">
								<div class="md-form mt-3 col-md-2">
									<label for="telp">Telp/.Fax</label>
									<input type="text" class="form-control" id="telp" name="tlp_cust">
								</div>
								<div class="md-form mt-3 col-md-4">
									<label for="inputCity">City/Kota</label>
									<input type="text" class="form-control" name="kota_cust" id="inputCity">
								</div>

								<div class="md-form mt-3 col-md-3">
									<select class="form-control mdb-select md-form" name="negara_cust">
										<option value="" disabled selected>Country/Negara...</option>
										<option value="indonesia">Indonesia</option>
										<option value="malaysia">Malaysia</option>
										<option value="singapur">Singapure</option>
									</select>
								</div>

								<div class="md-form mt-3 col-md-3">
									<!-- <label for="inputZip">Zip</label> -->
									<input type="hidden" class="form-control" name="pos_cust">
								</div>
							</div>
							<div class="form-row">
								<div class="md-form mt-3 col-md-4">
									<input type="hidden" class="form-control" name="username" value="<?= $username; ?>">
								</div>
							</div>

							<button type="submit" class="btn btn-primary" name="submit">SIMPAN</button>
						</form>
					</div>


				</div>
			</div>

			<?php include('footer.php'); ?>



		</div><!-- end of container footer -->


		<?php include('script-footer.php'); ?>
	</body>

	</html>

<?php } else {
	header("location:../index.php");
} ?>