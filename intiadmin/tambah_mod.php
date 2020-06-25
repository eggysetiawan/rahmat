<?php
session_start();
require '../functionsales.php';

if (isset($_POST['submit'])) {
	if (tambahmod($_POST) > 0) {
		echo "<script>alert('data berhasil dimasukkan');
			  document.location.href= 'view_mod.php';
			  </script>";
	} else {
		echo "<script>alert('data gagal dimasukkan');
			  document.location.href= 'tambah_mod.php';
			  </script>";
	}
}
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
						<li class="breadcrumb-item active">Tambah modaliti</li>
					</ol>
				</nav>
			</div>

			<div class="container content1">
				<!-- class content buat footer -->
				<div class="justify-content-md-center">
					<div class="form-harian">
						<center>
							<h1>Tambah Data Modality</h1>
							<hr>
						</center><br>

						<form action="" method="POST">
							<div class="md-form mt-3">
								<label for="nama_mod">Nama Modality</label>
								<input type="text" class="form-control" id="nama_mod" name="nama_mod">
							</div>

							<div class="md-form mt-3">
								<label for="merk">Merk</label>
								<input type="text" class="form-control" id="merk" name="merk_mod">
							</div>
							<div class="md-form mt-3">
								<label for="model">Model</label>
								<input type="text" class="form-control" id="model" name="model_mod">
							</div>

							<div class="md-form">
								<textarea class="form-control md-textarea" id="spek" name="spek_mod"></textarea>
								<label for="spek">specification</label>
							</div>

							<div class="md-form mt-3">
								<label for="harga">Harga</label>
								<input type="text" class="form-control" id="harga" name="harga_mod">
							</div>
							<div class="md-form mt-3">
								<input type="hidden" class="form-control" name="username" value="<?= $username; ?>">
							</div>
							<button type="submit" class="btn btn-primary" name="submit">Input</button>

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