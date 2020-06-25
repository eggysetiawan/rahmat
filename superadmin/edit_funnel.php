<?php
session_start();
$no_penawaran = $_GET['no_penawaran'];


require '../functionsales.php';

$result = mysqli_query($conn, "SELECT * FROM sales_funnel WHERE no_penawaran = '$no_penawaran'");
$row = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
	if (funnel($_POST) > 0) {
		echo "<script>alert('data berhasil dimasukkan');
			  document.location.href= 'view_funnel.php';
			  </script>";
	} else {
		echo "<script>alert('data gagal dimasukkan');
			  document.location.href= 'edit_funnel.php?no_penawaran=$no_penawaran;
			  </script>";
	}
}

if ($_SESSION['level'] == "sales") {
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
				<li class="breadcrumb-item active">Funnel</li>
				</ol>
				</nav>
			</div>

			<div class="container-fluid content1">
				<!-- class content buat footer -->
				<div class="row justify-content-md-center" style="margin: 0px;">

					<div class="form-harian col-md-10">
						<center>
							<h1>Edit Funnel</h1>
						</center><br>
						<form action="" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label for="pk"></label>
								<input type="hidden" class="form-control" id="pk" name="pk" value="<?php echo $row['pk']; ?>">
							</div>

							<div class="form-group">
								<input type="radio" name="buy" <?php if ($row['buy_funnel'] == '30%') echo 'checked' ?> value="30%"> Sudah Ada Penawaran Harga<br>
								<input type="radio" name="buy" <?php if ($row['buy_funnel'] == '50%') echo 'checked' ?> value="50%"> Presentasi dan demo produk<br>
								<input type="radio" name="buy" <?php if ($row['buy_funnel'] == '70%') echo 'checked' ?> value="70%"> User cocok dengan spesifikasi barang<br>
								<input type="radio" name="buy" <?php if ($row['buy_funnel'] == '85%') echo 'checked' ?> value="85%"> Sudah ada negosiasi harga dengan user/pengadaan<br>
								<input type="radio" name="buy" <?php if ($row['buy_funnel'] == '90%') echo 'checked' ?> value="90%"> Anggaran sudah ada dan cocok<br>
								<input type="radio" name="buy" <?php if ($row['buy_funnel'] == '100%') echo 'checked'  ?> value="100%"> Sudah ada PO <input type="file" name="gambar">


								<br>
							</div>
							<div class="form-group">
								<label for="status1">Status</label>
								<input type="text" class="form-control" name="status1">
							</div>





							<!-- <div class="form-group">
							<label for="Hospital">Hospital</label>
							<input type="text" class="form-control" id="Hospital" name="Hospital" value="<?php echo $row['rs_penawaran']; ?>">
						</div>

						<div class="form-group">
							<label for="City">City</label>
							<input type="text" class="form-control" id="City" name="City" value="<?php echo $row['kota_penawaran']; ?>" >
						</div>

						<div class="form-group">
							<label for="Quotation">Quotation Number</label>
							<input type="text" class="form-control" id="Quotation" name="Quotation" value="<?php echo ''; ?>">
						</div>

						<div class="form-group">
							<label for="Type">Type</label>
							<input type="text" class="form-control" name="type" value="<?php echo $row['model_penawaran']; ?>" >
						</div>
						<div class="form-group">
							<label for="Qty">Qty</label>
							<input type="text" class="form-control" name="qty" value="<?php echo $row['qty']; ?>">
						</div>
						<div class="form-group">
							<label for="Harga">Harga</label>
							<input type="text" class="form-control" name="harga" value="<?php echo $row['harga_penawaran']; ?>">
						</div>
						<div class="form-group">
							<label for="Month">Month/Q</label>
							<input type="text" class="form-control" name="month" value="<?php echo ''; ?>">
						</div>
						<div class="form-group">
							<label for="Stock">Stock Order</label>
							<input type="text" class="form-control" name="stock" value="<?php echo ''; ?>" >
						</div>
						<div class="form-group">
							<label for="Budget">Budget Sources</label>
							<input type="text" class="form-control" name="budget" value="<?php echo ''; ?>">
						</div>
						<div class="form-group">
							<label for="Buy">% Buy</label>
							<select name="status">
								<option <?php if ($row["status"] == '30%') {
												echo 'selected';
											} ?> value="30%" >30%</option>
								<option <?php if ($row["status"] == '50%') {
												echo 'selected';
											} ?> value="50%">50%</option>
								<option <?php if ($row["status"] == '70%') {
												echo 'selected';
											} ?> value="70%">70%</option>
								<option <?php if ($row["status"] == '85%') {
												echo 'selected';
											} ?> value="85%">85%</option>
								<option <?php if ($row["status"] == '90%') {
												echo 'selected';
											} ?> value="90%">90%</option>
								<option <?php if ($row["status"] == '100%') {
												echo 'selected';
											} ?> value="100%">100%</option>
							</select>
						</div>
						<!-- <div class="form-group">
							<label for="status">Win(W)/Lose(L)/Hot(H)/On Progress(OP)/Cold(C)</label>
							<input type="text" class="form-control" name="status" placeholder="status">
						</div> -->

							<button type="submit" name="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin?')">Input</button>
							<a href=" view_funnel.php">View Funnel list</a>
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