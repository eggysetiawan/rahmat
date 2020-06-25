<?php
require '../koneksi/koneksi.php';
require '../functionsales.php';
session_start();
$username = $_SESSION['username'];
$result = mysqli_query($conn, "SELECT * FROM sales_customer
INNER JOIN inti_rs ON sales_customer.fk_rs = inti_rs.pk_rs
 ORDER BY pk_cust ASC");
$result1 = mysqli_query($conn, "SELECT * FROM sales_modality");

if ($_SESSION['level'] == "superadmin") {
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

			<!-- <div class="container-fluid content1">
				<div class="row justify-content-md-center" style="margin: 0px;">
					<div class="customer-admin col-lg-3">
						<div class="head_admin">
							<center>
								<h2>Customer</h2>
							</center>
						</div>
						<div class="btn_admin">
							
							<a href="view_cust.php"><button class="btn_add">View</button></a>
						</div><br> <br>

						<div class="head_admin">
							<center>
								<h2>Modality</h2>
							</center>
						</div>
						<div class="btn_admin">
							
							<a href="view_mod.php"><button class="btn_view">View</button></a>
						</div>

					</div>


				</div>
			</div> -->

			<div class="container-fluid content1">
				<h2>Table Customer</h2>
				<!-- class content buat footer -->

				<div class="justify-content-md-center">

					<div class="customer-admin table-box" style="overflow-x:auto;">
						<table id="example" class="table_kunjungan" style="margin-top: 0px;" border="1" cellpadding="8" cellspacing="0">
							<thead>
								<tr>
									<th>No.</th>
									<th>Nama</th>
									<th>Mobile/HP</th>
									<th>Email</th>
									<th>Posisi</th>
									<th>Kode RS</th>
									<th>Perusahaan</th>
									<th>Alamat</th>
									<th>Telp/.Fax</th>
									<th>NPWP</th>
								</tr>
							</thead>
							<tr>
								<?php
								$no1 = 1;
								while ($row = mysqli_fetch_assoc($result)) : ?>
									<td><?= $no1; ?></td>
									<td><?php echo $row['nama_cust']; ?></td>
									<td><?php echo $row['hp_cust']; ?></td>
									<td><?php echo $row['email_cust']; ?></td>
									<td><?php echo $row['jabatan_cust']; ?></td>
									<td><?= $row['koders_cust']; ?></td>
									<td><?php echo $row['nama_rs']; ?></td>
									<td>
										<?php echo $row['alamat_rs']; ?>
										<?php echo $row['kota_rs']; ?>
										<?php echo $row['negara_cust']; ?>
									</td>
									<td><?php echo $row['telepon_rs']; ?></td>
									<td>
										<?php $row['npwp_cust']; ?>
										<?php if ($row['npwp_cust'] == "") { ?>
											<?php echo "<i style='color: #a8978e;' class='fas fa-clock'></i>" ?>
										<?php } else { ?>
											<?= $row['npwp_cust']; ?>
										<?php } ?>
									</td>


							</tr>
							<?php $no1++; ?>
						<?php endwhile; ?>
						</table>
					</div>


				</div>
			</div>

			<div class="container-fluid content1">
				<h2>Table Modality</h2>
				<!-- class content buat footer -->
				<a href="tambah_mod.php"><button class="btn_tambah">Tambah Modality</button></a><br>
				<div class="justify-content-md-center">
					<div class="customer-admin table-box" style="overflow-x:auto;">
						<table id="example1" class="table_kunjungan table-paginate" style="margin-top: 0px;" border="1" cellpadding="8" cellspacing="0">
							<thead>
								<tr>
									<th>No.</th>
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
								<?php
								$no = 1;
								while ($row = mysqli_fetch_assoc($result1)) : ?>
									<td><?= $no; ?></td>
									<td><?php echo $row['nama_mod']; ?></td>
									<td><?php echo $row['merk_mod']; ?></td>
									<td><?php echo $row['model_mod']; ?></td>
									<td>
										<a href="#" class="edit-record" data-id="<?= $row['pk_mod'];  ?>"><button class="btn btn-fnl btn-info" data-toggle="tooltip" data-placement="top" title="Specification"><i class="fas fa-info-circle"></i></button></a>


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
									<td><a href="edit_mod.php?pk_mod=<?= $row['pk_mod']; ?>"><button class="btn btn-fnl btn-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></button></a> <a onclick="return confirm('Apakah anda yakin?')" href="hapus_mod.php?pk_mod=<?= $row['pk_mod'];  ?>"><button class="btn btn-fnl btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button></a></td>
							</tr>
							<?php $no++; ?>
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