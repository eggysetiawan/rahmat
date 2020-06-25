<?php
require '../functionsales.php';
session_start();
$username = $_SESSION['username'];
$result = mysqli_query($conn, "SELECT * FROM sales_penawaran INNER JOIN  sales_order ON sales_penawaran.pk_penawaran = sales_order.fk_penawaran INNER JOIN sales_modality ON sales_order.pk_mod_order = sales_modality.pk_mod GROUP BY pk_penawaran  ORDER BY pk_penawaran ASC ");

if (isset($_POST['approve'])) {
	if (approve($_POST) > 0) {
		echo "<script>alert('data disetujui!');
			  document.location.href= 'view_penawaran.php';
			  </script>";
	} else {
		echo "<script>alert('system error, silahkan hubungi admin!');
			  document.location.href= 'view_penawaran.php';
			  </script>";
	}
}

if (isset($_POST['rejected'])) {
	if (reject($_POST) > 0) {
		echo "<script>alert('data berhasil ditolak');
			  document.location.href= 'view_penawaran.php';
			  </script>";
	} else {
		echo "<script>alert('system error, silahkan hubungi admin!');
			  document.location.href= 'view_penawaran.php';
			  </script>";
	}
}


if ($_SESSION['level'] == "intiadmin") {
	?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Penawaran</title>
		<?php include('head.php'); ?>
	</head>

	<body>
		<?php include('menu-bar.php'); ?>
		<div class="container-footer">
			<!-- buat footer -->
			<div class="bc-icons-2">
				<?php include('breadcrumb.php'); ?>
				<li class="breadcrumb-item"><a href="index.php">Home</a><i class="fas fa-angle-right mx-2" aria-hidden="true"></i></li>
				<li class="breadcrumb-item"><a href="penawaran.php">Penawaran</a><i class="fas fa-angle-right mx-2" aria-hidden="true"></i></li>
				<li class="breadcrumb-item active" aria-current="page">View data Penawaran</li>
				</ol>
				</nav>
			</div>

			<div class="container-fluid content1">
				<!-- class content buat footer -->

				<div class="justify-content-md-center">
					<div class="customer-admin table-box" style="overflow-x:auto;">
						<table id="example" class="table_kunjungan table-paginate" style="margin-top: 0px;" border="1" cellpadding="8" cellspacing="0">
							<thead>
								<tr>
									<th>No</th>
									<th>No. Penawaran</th>
									<th>Nama</th>
									<th>Rumah Sakit</th>
									<th>Alamat</th>
									<th>Detail Penawaran</th>
									<th>Total Harga Penawaran</th>
									<!-- <th>Modality</th>
                                <th>Merk</th>
                                <th>Model</th>
                                <th>Spek</th>
                                <th>Penawaran</th>
                                <th>Qty</th> -->
									<th>Tgl Penawaran</th>
									<th>Nama Sales</th>
									<th>Referensi</th>
									<th>Tgl Upload</th>
									<th>Action</th>
								</tr>
							</thead>
							<tr>
								<?php
									$i = 1;
									while ($row = mysqli_fetch_assoc($result)) : ?>
									<td>
										<center><?php echo $i; ?></center>
									</td>
									<td><?php echo $row['no_penawaran']; ?></td>
									<td><?php echo $row['nama_cust_penawaran']; ?></td>
									<td><?php echo $row['rs_penawaran']; ?></td>
									<td><?php echo $row['kota_penawaran']; ?></td>


									<!-- modal -->
									<td>
										<a href="#" class="edit-record" data-id="<?= $row['pk_penawaran'];  ?>">&nbsp;Detail</a>
										<!-- Modal -->



										<?php $pk_penawaran = $row['pk_penawaran']; ?>
										<?php $result323 = mysqli_query($conn, "SELECT * FROM sales_order WHERE fk_penawaran = '$pk_penawaran' "); ?>
										<?php while ($row323 = mysqli_fetch_assoc($result323)) : ?>

											<!-- modal detail -->

										<?php endwhile; ?>



									</td>
									<td>
										<?php
												$resultharga = mysqli_query($conn, "SELECT SUM(total_order) AS totalharga FROM sales_order WHERE fk_penawaran = '$pk_penawaran' "); ?>

										<?php while ($row332 = mysqli_fetch_assoc($resultharga)) : ?>
											<?= rupiah($row332['totalharga']); ?>
										<?php endwhile; ?>
									</td>



									<td><?php echo $row['tgl_penawaran']; ?></td>

									<?php
											$username313 = $row['username'];
											$result2 = mysqli_query($conn, "SELECT * FROM inti_user WHERE username = '$username313'"); ?>
									<?php ($rownama = mysqli_fetch_assoc($result2)) ?>
									<td><?php echo $rownama['name']; ?></td>

									<td><a class="penawaran-a" href="../pdf/testpdf4.php?no_penawaran=<?= $row['no_penawaran'];  ?>" target="_blank">PDF </a></td>
									<td>
										<?php $row['tgl_upload']; ?>
										<?php if ($row['tgl_upload'] == "") { ?>
											<?php echo "<i style='color: #a8978e;' class='fas fa-clock'></i>" ?>
										<?php } else { ?>
											<?= $row['tgl_upload']; ?>
										<?php } ?>
									</td>
									<td>
										<!-- <a class="penawaran-a" href="approv.php?no_penawaran=<?= $row['no_penawaran'];  ?>" target="_blank" onclick="return confirm('Apakah anda yakin?')">Approve </a>|
										<a class="penawaran-a" href="approv.php?no_penawaran=<?= $row['no_penawaran'];  ?>" target="_blank" onclick="return confirm('Apakah anda yakin?')">Reject</a> -->
										<form id=order name=order method=post action="">

											<input name="no_penawaran" type="hidden" value="<?= $row['no_penawaran']; ?>">
											<input name="username" type="hidden" value="<?= $row['username']; ?>">



											<?php if ($row['approve'] == "approved") { ?>
												<?php echo "<div style='color: green;'>Approved</div>" ?>
											<?php } elseif ($row['approve'] == "rejected") { ?>
												<?php echo "<div style='color: red;'>Rejected</div>" ?>
											<?php } else { ?>
												<?php echo "<div style='color: blue;'>Waiting..</div>" ?>
											<?php } ?>
									</td>
									</form>
							</tr>

							<!-- <?php echo $i++;  ?> -->
						<?php endwhile; ?>
						</table>
						<!-- The Modal -->
						<div class="modal" id="myModal">
							<div class="modal-dialog modal-dialog-scrollable">
								<div class="modal-content">

									<!-- Modal Header -->
									<div class="modal-header">
										<h3>Detail Penawaran</h3>
										<button type="button" class="close" data-dismiss="modal">×</button>
									</div>

									<!-- Modal body -->
									<div class="modal-body">
										<p><?php echo $row['pk_penawaran']; ?></p>
									</div>

									<!-- Modal footer -->
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
									</div>

								</div>
							</div>
						</div>
						<!-- End The Modal -->
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
					$.post('hasil3.php', {
							pk_penawaran: $(this).attr('data-id')
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