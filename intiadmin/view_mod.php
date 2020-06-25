<?php
require '../koneksi/koneksi.php';
require '../functionsales.php';
session_start();
$username = $_SESSION['username'];
$result = mysqli_query($conn, "SELECT * FROM sales_modality");

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
				<li class="breadcrumb-item"><a href="admin.php">Admin</a><i class="fas fa-angle-right mx-2" aria-hidden="true"></i></li>
				<li class="breadcrumb-item active">View Modality</li>
				</ol>
				</nav>
			</div>

			<div class="container-fluid content1">
				<!-- class content buat footer -->
				<a href="tambah_mod.php"><button class="btn_tambah">Tambah</button></a><br>
				<div class="justify-content-md-center">
					<div class="customer-admin table-box" style="overflow-x:auto;">
						<table id="example" class="table_kunjungan table-paginate" style="margin-top: 0px;" border="1" cellpadding="8" cellspacing="0">
							<thead>
								<tr>
									<th>Modality</th>
									<th>Merk</th>
									<th>Model</th>
									<th>Spek</th>
									<th>Harga</th>
									<th>Stock</th>
									<th>Action</th>
								</tr>
							</thead>
							<tr>
								<?php while ($row = mysqli_fetch_assoc($result)) : ?>
									<td><?php echo $row['nama_mod']; ?></td>
									<td><?php echo $row['merk_mod']; ?></td>
									<td><?php echo $row['model_mod']; ?></td>
									<td>
										<a href="#" class="edit-record" data-id="<?= $row['pk_mod'];  ?>">Specification</a>


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
														<h3>Specification</h3>
														<p><?php echo $row['pk_mod']; ?></p>
													</div>

													<!-- Modal footer -->
													<div class="modal-footer">
														<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
													</div>

												</div>
											</div>
										</div>
										<!-- End The Modal -->


									</td>
									<td><?php echo rupiah($row['harga_mod']); ?></td>
									<td><?php echo $row['stock_mod']; ?></td>
									<td><a href="edit_mod.php?pk_mod=<?= $row['pk_mod']; ?>">Edit</a> | <a onclick="return confirm('Apakah anda yakin?')" href="hapus_mod.php?pk_mod=<?= $row['pk_mod'];  ?>">Delete</a></td>
							</tr>
						<?php endwhile; ?>
						</table>
					</div>


				</div>
			</div>

			<?php include('footer.php'); ?>



		</div><!-- end of container footer -->




		<?php include('script-footer.php'); ?>
		<script>
			// untuk menampilkan data popup
			$(function() {
				$(document).on('click', '.edit-record', function(e) {
					e.preventDefault();
					$("#myModal").modal('show');
					$.post('hasil.php', {
							pk_mod: $(this).attr('data-id')
						},
						function(html) {
							$(".modal-body").html(html);
						}
					);
				});
			});
			// end untuk menampilkan data popup
		</script>
	</body>

	</html>

<?php } else {
	header("location:../index.php");
} ?>