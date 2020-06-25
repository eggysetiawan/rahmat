<?php

session_start();
if ($_SESSION['level'] == "intiadmin") {
	?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Admin</title>
		<?php include('head.php'); ?>
	</head>

	<body>
		<?php include('menu-bar.php'); ?>
		<div class="container-footer">
			<!-- buat footer -->
			<div class="bc-icons-2">
				<?php include('breadcrumb.php'); ?>
				<li class="breadcrumb-item"><a href="index.php">Home</a><i class="fas fa-angle-right mx-2" aria-hidden="true"></i></li>
				<li class="breadcrumb-item active">Admin</li>
				</ol>
				</nav>
			</div>

			<div class="container-fluid content1">
				<div class="row justify-content-md-center" style="margin: 0px;">
					<div class="customer-admin col-lg-3">
						<div class="head_admin">
							<center>
								<h2>Customer</h2>
							</center>
						</div>
						<div class="btn_admin">
							<!-- <a href="tambah_cust.php"><button class="btn_add">Tambah</button></a><br> -->
							<a href="view_cust.php"><button class="btn_add">View</button></a>
						</div><br> <br>

						<div class="head_admin">
							<center>
								<h2>Modality</h2>
							</center>
						</div>
						<div class="btn_admin">
							<!-- <a href="tambah_mod.php"><button class="btn_add">Tambah</button></a><br> -->
							<a href="view_mod.php"><button class="btn_view">View</button></a>
						</div>

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