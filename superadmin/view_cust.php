<?php
require '../koneksi/koneksi.php';
session_start();
$username = $_SESSION['username'];
$result = mysqli_query($conn, "SELECT * FROM sales_customer");

if ($_SESSION['level'] == "superadmin") {
	?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>View Customer</title>
		<?php include('head.php'); ?>
	</head>

	<body>
		<?php include('menu-bar.php'); ?>
		<div class="container-footer">
			<!-- buat footer -->
			<div class="bc-icons-2">
				<?php include('breadcrumb.php'); ?>
				<li class="breadcrumb-item"><a href="index.php">Home</a><i class="fas fa-angle-right mx-2" aria-hidden="true"></i></li>
				<li class="breadcrumb-item"><a href="admin.php">Admin</a><i class="fas fa-angle-right mx-2" aria-hidden="true"></i></li>
				<li class="breadcrumb-item active">View data customer</li>
				</ol>
				</nav>
			</div>

			<div class="container-fluid content1">
				<!-- class content buat footer -->
				<a href="tambah_cust.php"><button class="btn_tambah">Tambah Data Customer</button></a><br>
				<div class="justify-content-md-center">

					<div class="customer-admin">
						<table class="table_kunjungan table-paginate" style="margin-top: 0px;" border="1" cellpadding="8" cellspacing="0">
							<tr>
								<th>Nama</th>
								<th>Mobile/HP</th>
								<th>Email</th>
								<th>Posisi</th>
								<th>Perusahaan</th>
								<th>Alamat</th>
								<th>Telp/.Fax</th>
								<th>Action</th>
							</tr>
							<tr>
								<?php while ($row = mysqli_fetch_assoc($result)) : ?>
									<td><?php echo $row['nama_cust']; ?></td>
									<td><?php echo $row['hp_cust']; ?></td>
									<td><?php echo $row['email_cust']; ?></td>
									<td><?php echo $row['jabatan_cust']; ?></td>
									<td><?php echo $row['rs_cust']; ?></td>
									<td>
										<?php echo $row['alamat_cust']; ?>
										<?php echo $row['kota_cust']; ?>
										<?php echo $row['negara_cust']; ?>
										<?php echo $row['pos_cust']; ?>
									</td>
									<td><?php echo $row['tlp_cust']; ?></td>
									<td><a href="edit_cust.php?pk_cust=<?= $row['pk_cust']; ?>">Edit</a></td>

							</tr>
						<?php endwhile; ?>
						</table>
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