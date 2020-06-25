<?php
session_start();
require '../functionsales.php';


$username = $_SESSION['username'];
$id = $_GET['pk_mod'];

// $mod = query("SELECT * FROM sales_modality WHERE pk_mod = $id")[0];
$resultmod = mysqli_query($conn, "SELECT * FROM sales_modality WHERE pk_mod = '$id' ");
$rowmod = mysqli_fetch_assoc($resultmod);

if (isset($_POST['submit'])) {
	if (editmod($_POST) > 0) {
		echo "<script>alert('data berhasil diupdate');
			  document.location.href= 'view_mod.php';
			  </script>";
	} else {
		echo "<script>alert('data gagal diupdate');
			  document.location.href= 'edit_mod.php?pk_mod=$id';
			  </script>";
	}
}
if ($_SESSION['level'] == "intiadmin") {
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
				<li class="breadcrumb-item active">Tambah modality</li>
				</ol>
				</nav>
			</div>

			<div class="container-fluid content1">
				<!-- class content buat footer -->
				<div class="justify-content-md-center">
					<div class="form-harian">
						<center>
							<h1>Edit Data Modality</h1>
						</center><br>
						<form action="" method="POST">

							<input type="hidden" name="pk_mod" value="<?= $id; ?>">

							<div class="form-group">
								<label for="nama_mod">Nama Modality</label>
								<input type="text" class="form-control" id="nama_mod" name="nama_mod" placeholder="Nama Modality.." value="<?= $rowmod['nama_mod']; ?>">
							</div>

							<div class="form-group">
								<label for="merk">Merk</label>
								<input type="text" class="form-control" id="merk" name="merk_mod" placeholder="Merk Alat.." value="<?= $rowmod['merk_mod']; ?>">
							</div>
							<div class="form-group">
								<label for="model">Model</label>
								<input type="text" class="form-control" id="model" name="model_mod" placeholder="Model.." value="<?= $rowmod['model_mod']; ?>">
							</div>
							<div class="form-group">
								<label for="spek">specification</label>
								<textarea class="form-control" id="spek" name="spek_mod" placeholder="Specification.."><?= $rowmod['spek_mod']; ?></textarea>
							</div>
							<div class="form-group">
								<label for="harga">Harga</label>
								<input type="text" class="form-control" id="harga" name="harga_mod" placeholder="IDR" value="<?= $rowmod['harga_mod']; ?>">
							</div>
							<div class="form-group">
								<label for="stock">Stock</label>
								<input type="text" class="form-control" id="stock" name="stock_mod" placeholder="Jumlah Stock" value="<?= $rowmod['stock_mod']; ?>">
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