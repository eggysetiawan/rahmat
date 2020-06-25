<?php

session_start();
if ($_SESSION['level'] == "sales") {
	?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Kunjungan Harian</title>
		
	</head>

	<body>
		<?php include('menubartest2.php'); ?>
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
				test
			</div>
			<?php include('footer.php'); ?>



		</div><!-- end of container footer -->


		<?php include('script-footer.php'); ?>
	</body>

	</html>

<?php } else {
	header("location:../index.php");
} ?>
