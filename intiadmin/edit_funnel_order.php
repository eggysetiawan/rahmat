<?php
require '../functionsales.php';

session_start();
$pk_funnel1 = $_GET['pk'];
$username = $_SESSION['username'];



$result = mysqli_query($conn, "SELECT * FROM sales_funnel
INNER JOIN sales_order3 ON sales_funnel.pk = sales_order3.fk_funnel3
 WHERE pk = '$pk_funnel1' ");



if (isset($_POST['submit'])) {
	if (barangterkirim2($_POST) > 0) {
		echo "<script>alert('data berhasil dimasukkan');
			  document.location.href= 'view_funnel.php';
			  </script>";
	} else {
		echo "<script>alert('data berhasil dimasukkan');
			  document.location.href='view_funnel.php';
			  </script>";
	}
}

if (isset($_POST['cancel'])) {
	if (cancel($_POST) > 0) {
		echo "<script>alert('data berhasil di cancel, Tetap Semangat');
			  document.location.href= 'view_funnel.php';
			  </script>";
	} else {
		echo "<script>alert('data gagal dimasukkan');
			  document.location.href= 'edit_funnel.php?pk=$pk';
			  </script>";
	}
}

if ($_SESSION['level'] == "intiadmin") {
	?>

	<!DOCTYPE html>
	<html>

	<head>
		<title>Edit Funnel</title>
		<?php include('head.php'); ?>
	</head>

	<body>
		<?php include('menu-bar.php'); ?>
		<div class="container-footer">
			<!-- buat footer -->
			<div class="bc-icons-2">
				<?php include('breadcrumb.php'); ?>
				<li class="breadcrumb-item"><a href="index.php">Home</a><i class="fas fa-angle-right mx-2" aria-hidden="true"></i></li>
				<li class="breadcrumb-item active">Funnel</li>
				</ol>
				</nav>
			</div>

			<div class="container-fluid content1">
				<!-- class content buat footer -->
				<div class="row justify-content-md-center" style="margin: 0px;">

					<div class="form-harian col-md-7">
						<center>
							<h1>Status Pengiriman</h1>
						</center><br>
						<form action="" method="POST" enctype="multipart/form-data">

							<?php $row = mysqli_fetch_assoc($result); ?>


							<div class="form-group">


								<input type="hidden" class="form-control" id="pk" name="pk" value="<?= $pk_funnel1; ?>">
								<!-- <input type="hidden" class="form-control" id="pk" name="no_penawaran" value="<?php echo $no_penawaran; ?>"> -->
							</div>

							<div class=" form-group">

								<!-- <label>
									<input type="checkbox" id="mycheckbox2" name="kirim50" <?php if ($row['kirim50'] == '50%') echo 'checked'; ?> value="50%">Tanggal Kirim
								</label><br>

								<div class="form-group" id="mycheckboxdiv2" style="display:none">


								</div> -->

								<label>
									<input type="checkbox" id="mycheckbox4" name="kirim70" <?php if ($row['kirim70'] == '70%') echo 'checked' ?> value="70%"> Tanggal Kirim Barang
								</label><br>
								<div class="form-group" id="mycheckboxdiv4" style="display:none">
									<label for="date_presentasi">Date</label>
									<input type="text" class="form-control" id="date" name="tanggal_kirim" size="4">
									<input type="file" name="resi_kirim">
								</div>

								<label>
									<input type="checkbox" id="mycheckbox3" name="kirim100" <?php if ($row['kirim100'] == '100%') echo 'checked'; ?> value="100%">Tanggal Terima Barang
								</label><br>
								<div class="form-group" id="mycheckboxdiv3" style="display:none">

									<label for="date1">Date</label>
									<input type="text" class="form-control" id="date1" name="tanggal_terima" size="4"> <input type="file" name="gambar">
								</div>



								<div class="form-group">
									<a href="#" data-toggle="modal" data-target="#basicExampleDetail">
										Lihat detail disini
									</a>

									<!-- Modal -->

									<?php $pk_penawaran = $row['penawaran_fk']; ?>
									<?php $result323 = mysqli_query($conn, "SELECT * FROM sales_order3 WHERE fk_funnel3 = '$pk_penawaran' "); ?>
									<?php while ($row323 = mysqli_fetch_assoc($result323)) : ?>

										<!-- modal detail -->

									<?php endwhile; ?>
								</div>







								<button type="submit" name="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin?')">SIMPAN</button>
								<!-- <button type="submit" name="cancel" class="btn btn-danger" onclick="return confirm('Note: Jika di CANCEL data tidak dapat di edit lagi')">BATAL</button> -->
								<a href=" view_funnel.php">View Funnel list</a>
						</form>
					</div>
				</div>
			</div>

			<div class="modal fade" id="basicExampleDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Detail Funnel</h5>
							<center>
								<center> <?= $row['no_penawaran']; ?></center><br><br>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
						</div>
						<div class="modal-body">

							<!-- <?php $pk_order = $row323['pk_order']; ?> -->
							<?php $resultdetail = mysqli_query($conn, "SELECT * FROM sales_order3 INNER JOIN sales_modality ON sales_order3.pk_mod_order = sales_modality.pk_mod WHERE fk_funnel3 = '$pk_funnel1' "); ?>
							<?php $j = 1; ?>

							<?php while ($rowdetail = mysqli_fetch_assoc($resultdetail)) : ?>
								<strong>

									<?php echo "-----Modality #" ?> <?php echo  $j++; ?>------</strong><br>

								<div class="detail-table">
									<table>
										<tr>

											<td>Nama Modality</td>
											<td>:</td>
											<td> <?= $rowdetail['nama_mod_order'];  ?></td>
										</tr>

										<tr>
											<td>Type Modality</td>
											<td>:</td>
											<td> <?= $rowdetail['model_mod_order'];  ?></td>

										</tr>
										<tr>
											<td>Merk Modality</td>
											<td>:</td>
											<td> <?= $rowdetail['merk_mod_order'];  ?></td>
										</tr>

										<tr>
											<td>Spek Modality</td>
											<td>:</td>
											<td> <?= $rowdetail['spek_mod_order'];  ?></td>
										</tr>
										<tr>
											<td>Harga Modality Modality</td>
											<td>:</td>
											<td> <?= rupiah($rowdetail['harga_mod']);  ?></td>
										</tr>
										<tr>
											<td>Harga Penawaran/pcs</td>
											<td>:</td>
											<td> <?= rupiah($rowdetail['harga_order']); ?></td>
										</tr>
										<tr>
											<td>Qty</td>
											<td>:</td>
											<td> <?= $rowdetail['qty_order'];  ?></td>
										</tr>
										<tr>
											<td>Total Harga Modality</td>
											<td>:</td>
											<td>
												<?= rupiah($rowdetail['total_order']);  ?>
											</td>



										</tr>
									</table><br><br>
								</div>
							<?php endwhile; ?>
							<?php
								$resultharga = mysqli_query($conn, "SELECT SUM(total_order) AS totalharga FROM sales_order3 WHERE fk_funnel3 = '$pk_funnel1' "); ?>

							<?php while ($row332 = mysqli_fetch_assoc($resultharga)) : ?>
								<td>Perkiraan Harga Pre-Order</td>
								<td>:</td>
								<td>
									<h3><?= rupiah($row332['totalharga']); ?></h3>
								</td>
							<?php endwhile; ?>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

						</div>
					</div>
				</div>
			</div>

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
			<?php include('footer.php'); ?>



		</div><!-- end of container footer -->

		<?php include('script-footer.php'); ?>
		<script>
			$(document).ready(function() {
				$('#mycheckbox').change(function() {
					$('#mycheckboxdiv').toggle('slow');
				});
			});
		</script>
		<script>
			$(document).ready(function() {
				$('#mycheckbox1').change(function() {
					$('#mycheckboxdiv1').toggle('slow');
				});
			});
		</script>
		<script>
			$(document).ready(function() {
				$('#mycheckbox2').change(function() {
					$('#mycheckboxdiv2').toggle('slow');
				});
			});
		</script>
		<script>
			$(document).ready(function() {
				$('#mycheckbox3').change(function() {
					$('#mycheckboxdiv3').toggle('slow');
				});
			});
		</script>
		<script>
			$(document).ready(function() {
				$('#mycheckbox4').change(function() {
					$('#mycheckboxdiv4').toggle('slow');
				});
			});
		</script>
		<script>
			$('#date').datetimepicker({
				format: 'l, d-m-Y H:i'
			});
		</script>
		<script>
			$('#date1').datetimepicker({
				format: 'l, d-m-Y H:i'
			});
		</script>

		<script>
			$('.div_entrega_outro').hide();
			$("input[id$='entrega_outro']").click(function() {
				$('.div_entrega_outro').show();
			});

			$("input[id$='entrega_mesmo']").click(function() {
				$('.div_entrega_outro').hide();
			});
		</script>
	</body>

	</html>

<?php } else {
	header("location:../index.php");
} ?>