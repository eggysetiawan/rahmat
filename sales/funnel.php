<?php

require '../functionsales.php';

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
?>

<!DOCTYPE html>
<html>

<head>
	<title>Funnel</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" media="screen" href="../css/jquery.datetimepicker.min.css">
</head>

<body>
	<?php include('menu-bar.php'); ?>
	<div class="bc-icons-2">
			<?php include('breadcrumb.php'); ?>
					<li class="breadcrumb-item"><a href="index.php">Home</a><i class="fas fa-angle-right mx-2" aria-hidden="true"></i></li>
					<li class="breadcrumb-item active">Funnel</li>
				</ol>
			</nav>
		</div>

	<div class="container-fluid">
		<div class="row justify-content-md-center">

			<div class="form-harian col-md-6">
				<center>
					<h1>Input Funnel</h1>
				</center><br>
				<form action="" method="POST">

					<div class="form-group">
						<label for="Hospital">Hospital</label>
						<input type="text" class="form-control" id="Hospital" name="Hospital" placeholder="Hospital">
					</div>

					<div class="form-group">
						<label for="City">City</label>
						<input type="text" class="form-control" id="City" name="City" placeholder="City">
					</div>

					<div class="form-group">
						<label for="Quotation">Quotation Number</label>
						<input type="text" class="form-control" id="Quotation" name="Quotation" placeholder="Quotation">
					</div>

					<div class="form-group">
						<label for="Type">Type</label>
						<input type="text" class="form-control" id="date" name="type" placeholder="Type">
					</div>
					<div class="form-group">
						<label for="Qty">Qty</label>
						<input type="text" class="form-control" id="date" name="qty" placeholder="Qty">
					</div>
					<div class="form-group">
						<label for="Harga">Harga</label>
						<input type="text" class="form-control" id="date" name="harga" placeholder="Harga">
					</div>
					<div class="form-group">
						<label for="Month">Month/Q</label>
						<input type="text" class="form-control" id="date" name="month" placeholder="Month">
					</div>
					<div class="form-group">
						<label for="Stock">Stock Order</label>
						<input type="text" class="form-control" id="date" name="stock" placeholder="Stock">
					</div>
					<div class="form-group">
						<label for="Budget">Budget Sources</label>
						<input type="text" class="form-control" id="date" name="budget" placeholder="Budget">
					</div>
					<div class="form-group">
						<label for="Buy">% Buy</label>
						<input type="text" class="form-control" id="date" name="buy" placeholder="Buy">
					</div>
					<div class="form-group">
						<label for="status">Win(W)/Lose(L)/Hot(H)/On Progress(OP)/Cold(C)</label>
						<input type="text" class="form-control" id="date" name="status" placeholder="status">
					</div>

					<button type="submit" name="submit" class="btn btn-primary">Input</button>
					<a href="view_funnel.php">View Funnel list</a>
				</form>
			</div>
		</div>
	</div>

	<?php include('script-footer.php'); ?>
	<script>
		$('#date').datetimepicker({
			format: 'd-m-Y H:i'
		});
	</script>
</body>

</html>