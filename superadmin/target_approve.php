<?php
require '../functionsales.php';
session_start();
$username = $_SESSION['username'];
$result = mysqli_query($conn, "SELECT * FROM inti_user WHERE level = 'sales' OR level = 'distributor' ");

$result5 = mysqli_query($conn, "SELECT * FROM inti_user WHERE targett IS NOT NULL AND approve_target IS NULL AND level IN('sales', 'distributor')");
$num_row5 = mysqli_num_rows($result5);

$result313 = mysqli_query($conn, "SELECT SUM(harga_po_targeting) AS totalsum313 FROM sales_targeting WHERE approve = 'approved' AND pengiriman = 'terkirim' ");
$row313 = mysqli_fetch_assoc($result313);
$total313 = $row313['totalsum313'];

if (isset($_POST['approve'])) {
	if (approve_target($_POST) > 0) {
		echo "<script>alert('data disetujui!');
			  document.location.href= 'target_approve.php';
			  </script>";
	} else {
		echo "<script>alert('system error, silahkan hubungi admin!');
			  document.location.href= 'target_approve.php';
			  </script>";
	}
}

if (isset($_POST['rejected'])) {
	if (reject_target($_POST) > 0) {
		echo "<script>alert('data berhasil ditolak');
			  document.location.href= 'target_approve.php';
			  </script>";
	} else {
		echo "<script>alert('system error, silahkan hubungi admin!');
			  document.location.href= 'target_approve.php';
			  </script>";
	}
}

if ($_SESSION['level'] == "superadmin") {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Targeting Sales</title>
		<?php include('head.php'); ?>
	</head>

	<body>
		<?php include('menu-bar.php'); ?>
		<div class="container-footer">
			<!-- buat footer -->
			<div class="bc-icons-2">
				<?php include('breadcrumb.php'); ?>
				<li class="breadcrumb-item"><a href="index.php">Home</a><i class="fas fa-angle-right mx-2" aria-hidden="true"></i></li>
				<li class="breadcrumb-item active">Targeting</li>
				</ol>
				</nav>
			</div>

			<div class="container-fluid">
				<!-- <?php echo $num_row5; ?> Data Belum Di Approve </br> -->

				<div class="justify-content-md-center">
					<div class="customer-admin table-box" style="overflow-x:auto;">
						<table id="example" class="table_kunjungan table-paginate" style="margin-top: 0px;" border="1" cellpadding="8" cellspacing="0">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>Target</th>
									<th>Jabatan/Divisi</th>
									<th>Target Yang Sudah Dicapai</th>
									<th>Informasi</th>
									<th>Tahun</th>
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
									<td><?php echo $row['name']; ?></td>
									<td>
										<?php echo rupiah($row['targett']); ?></td>
									<td><?php echo $row['level']; ?></td>
									<td>
										<?php $username313 = $row['username'];
										$result5 = mysqli_query($conn, "SELECT SUM(harga_po_targeting) AS totalsum FROM sales_targeting WHERE approve = 'approved' AND username = '$username313' AND pengiriman = 'terkirim'"); ?>
										<?php if ($row['approve_target'] == "approved") { ?>
											<?php
											$rows = mysqli_fetch_assoc($result5);
											$total = $rows['totalsum']; ?>
											<?php echo rupiah($total); ?>
										<?php } else { ?>
											<?php echo "<i style='color: #a8978e;' class='fas fa-clock'></i>" ?></td>
								<?php } ?>
								<td>
									<?php
									$rows = mysqli_fetch_assoc($result5);
									$total = $rows['totalsum']; ?>
									<?php if (!$row['targett'] and !$row['approve_target']) { ?>
										<?php echo "<i style='color: #a8978e;' class='fas fa-clock'></i>"; ?>
									<?php } elseif ($total < $row['targett']) {
										$hasil313 = $row['targett'] - $total; ?>
										<?php echo rupiah($hasil313); ?>
									<?php } elseif ($total > $row['targett']) { ?>
										<?php echo "SUDAH MENCAPAI TARGET" ?></td>
							<?php } ?>
							<td><?= $row['tahun_target']; ?></td>
							<td>
								<!-- <a class="penawaran-a" href="approv.php?no_penawaran=<?= $row['no_penawaran'];  ?>" target="_blank" onclick="return confirm('Apakah anda yakin?')">Approve </a>|
										<a class="penawaran-a" href="approv.php?no_penawaran=<?= $row['no_penawaran'];  ?>" target="_blank" onclick="return confirm('Apakah anda yakin?')">Reject</a> -->
								<form id=order name=order method=post action="">

									<input name="username" type="hidden" value="<?= $row['username']; ?>">
									<?php if (!$row['approve_target'] and !$row['targett']) { ?>
										<?php echo "<div class='btn-info'>Belum Input Target</div>" ?>
									<?php } elseif ($row['approve_target'] == "approved") { ?>
										<?php echo "<div class='btn-success'>Approved</div>" ?>
									<?php } elseif ($row['approve_target'] == "rejected") { ?>
										<?php echo "<div class='btn-danger'>Rejected</div>" ?>
									<?php } else { ?>
										<button type="submit" name="approve" class="btn btn-fnl btn-primary" onclick="return confirm('Apakah anda yakin?')" data-toggle="tooltip" data-placement="top" title="Approve"><i class="fas fa-check-circle"></i></button>
										<button type="submit" name="rejected" class="btn btn-fnl btn-danger" onclick="return confirm('Apakah anda yakin?')" data-toggle="tooltip" data-placement="top" title="Reject"><i class="fas fa-times-circle"></i></button>
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