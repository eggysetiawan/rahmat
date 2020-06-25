<?php

require '../functionsales.php';
session_start();


if (isset($_POST['submit'])) {
	if (kunjunganharian($_POST) > 0) {
		echo "<script>alert('data berhasil dimasukkan');
			  document.location.href= 'generate_funnel.php';
			  </script>";
	} else {
		echo "<script>alert('data gagal dimasukan');
			  document.location.href='kunjunganreport.php';
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

					<h3 style="text-align: center">Form Kunjungan Harian Rumah Sakit Rumah Sakit</h3>


					<div class="form-harian">



						<form action="" method="POST">
							<div class="form-row">



								<input type="hidden" class="form-control" name="username" value="<?= $username; ?>"">
							

							<div class=" md-form mt-3 col-md-6">
								<label for="nama">Nama Customer</label>
								<input type="text" class="form-control" id="nama" name="nama_kunjungan" required>
							</div>

							<div class="md-form mt-3 col-md-6">
								<label for="hp">Mobile/HP</label>
								<input type="text" class="form-control" id="hp" name="hp_kunjungan" pattern="[0-9]+">
							</div>


					</div>


					<div class="md-form mt-3">
						<label for="email">Email</label>
						<input type="text" class="form-control" id="email" name="email_kunjungan">
					</div>
					<div class="md-form mt-3">
						<label for="jabatan">Jabatan/Divisi</label>
						<input type="text" class="form-control" id="jabatan" name="jabatan_kunjungan">
					</div>
					<!-- <div class="md-form mt-3">
						<label for="kode_rs">Kode Rumah Sakit</label>
						<input type="text" class="form-control" id="kode_rs" name="koders_kunjungan">
					</div> -->

					<div class="form-row">
						<div class="md-form mt-3 col-md-3">
							<select class="select3 form-control" id="nama_rs" name="rs_kunjungan" data-width="100%">
								<option selected disabled>---Pilih Rumah Sakit---</option>
								<?php
								$result = mysqli_query($conn, "SELECT * FROM inti_rs");
								while ($row = mysqli_fetch_assoc($result)) { ?>
									<option value="<?= $row['pk_rs']; ?>">
										<?php echo $row['nama_rs']; ?>
									</option>
								<?php } ?>

							</select>
						</div>




						<div class=" md-form mt-3 col-md-3">
							<select class="form-control mdb-select md-form select2" id="exampleFormControlSelect1" name="negara_kunjungan">

								<option value="Indonesia">Indonesia</option>
								<option value="Malaysia">Malaysia</option>
								<option value="Singapura">Singapore</option>
							</select>
						</div>
					</div>
					<div class="md-form mt-3 col-md-3">
						<!-- <label for="inputZip">Zip</label> -->
						<input type="hidden" class="form-control" id="inputZip" name="pos_kunjungan">
					</div>


					<div class="md-form">
						<textarea id="materialContactFormMessage" class="form-control md-textarea" rows="3" name="req_kunjungan"></textarea>
						<label for="materialContactFormMessage">Inquery/Question/Request</label>
					</div>

					<div class="md-form">
						<textarea id="materialContactFormMessage" class="form-control md-textarea" rows="3" cols="2" name="hasil_kunjungan"></textarea>
						<label for="materialContactFormMessage">Hasil Kunjungan</label>
					</div>
					<button type="submit" class="btn btn-primary" name="submit">SIMPAN</button>
					</form>



				</div>
			</div>
		</div>
		<?php include('footer.php'); ?>



		</div><!-- end of container footer -->
		<?php include('script-footer.php'); ?>


		<script type="text/javascript">
			$(function() {
				$('.select1').selectpicker();
			});
		</script>

		<script>
			$('#date').datetimepicker({
				format: 'd-m-Y H:i'
			});
		</script>



		<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->


	</body>

	</html>

<?php } else {
	header("location:../index.php");
} ?>