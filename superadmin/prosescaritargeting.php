<?php
require '../koneksi/koneksi.php';
require '../functionsales.php';
session_start();
if (isset($_POST["from"])) {

	$from = $_POST["from"];
	$username = $_POST['username'];

	// result sales
	$result = mysqli_query($conn, "SELECT * FROM sales_targeting 
INNER JOIN sales_funnel ON sales_targeting.funnel_fk = sales_funnel.pk 
INNER JOIN sales_order ON sales_funnel.penawaran_fk = sales_order.fk_penawaran 
INNER JOIN sales_modality ON sales_order.pk_mod_order = sales_modality.pk_mod
INNER JOIN inti_user ON inti_user.username = sales_funnel.username
INNER JOIN sales_customer ON sales_customer.pk_cust = sales_targeting.customer_fk 
INNER JOIN inti_rs ON sales_customer.fk_rs = inti_rs.pk_rs
WHERE sales_targeting.approve = 'approved' 
AND sales_funnel.tujuan_funnel = 'sales'
AND tahun_targeting IN ('" . $_POST["from"] . "')
AND sales_targeting.username = '$username'
GROUP BY sales_order.fk_penawaran
ORDER BY sales_targeting.pk ASC ");

	// result distributor



	$result3 = mysqli_query($conn, "SELECT * FROM inti_user");
	$row3 = mysqli_fetch_assoc($result3);
	$name3 = $row3['name'];

?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Targeting Sales</title>
		<?php include('head.php'); ?>
	</head>
	<div class="mt-1">
		<form action="printProsesCariTargeting.php" method="POST" target="_blank">
			<input type="hidden" name="from" value="<?= $_POST['from']; ?>">
			<input type="hidden" name="username" value="<?= $_POST['username']; ?>">
			<button type="submit" name="submit" class="btn btn-success">Print</button>
		</form>

	</div>

	<body>

		<div class="container-fluid content1">
		<?php
		$result313 = mysqli_query($conn, "SELECT SUM(harga_po_targeting) AS totalsum313 FROM sales_targeting WHERE approve = 'approved' AND pengiriman = 'terkirim' AND tahun_targeting IN ('" . $_POST["from"] . "')");
		$row313 = mysqli_fetch_assoc($result313);
		$total313 = $row313['totalsum313'];
	}
		?>




		<!-- class content buat footer -->
		<div class="justify-content-md-center">
			<div class="ket-target">
			</div><br>
			<div class="fill" id="div-id-name">
				<div class="col-md-12 table-box" style="overflow-x:auto;">
					<table id="example" class="table_kunjungan" style="margin-top: 0px;" border="1" cellpadding="8" cellspacing="0">
						<thead>

							<h2>Sales</h2>

							<tr>
								<th>No</th>
								<th>No. Penawaran</th>
								<th>Rumah Sakit</th>
								<th>Kota</th>
								<th>Targeting Detail</th>
								<th>Total Penawaran</th>
								<th>Harga PO</th>
								<th>Nama Sales</th>
								<th>Status</th>
							</tr>
						</thead>
						<tr>
							<?php
							$no = 1;
							while ($row = mysqli_fetch_assoc($result)) : ?>
								<td><?php echo $no; ?></td>
								<td><?php echo $row['no_targeting']; ?></td>
								<td><?php echo $row['nama_rs']; ?></td>
								<td><?php echo $row['kota_rs']; ?></td>
								<!-- modal -->
								<td>
									<a href="#" class="edit-record" data-id="<?= $row['penawaran_fk'];  ?>"><button class="btn btn-fnl btn-info" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fas fa-info-circle"></i></button></a>
									<!-- Modal -->



									<?php $pk_penawaran = $row['penawaran_fk']; ?>
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
										<?php @$tot += $row332['totalharga']; ?>
									<?php endwhile; ?>
								</td>
								<td><?php echo rupiah($row['harga_po_targeting']); ?>
									<?php @$tot_po += $row['harga_po_targeting']; ?>
								</td>
								<td><?= $row['name']; ?></td>
								<td><?php if ($row['approve'] == 'approved') { ?>
										<div class="btn-success">Order Sukses!</div>
									<?php } ?></td>



								<?php $no++; ?>
						</tr>
					<?php endwhile; ?>
					<tfoot>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th><?= rupiah(@$tot); ?></th>
						<th><?= rupiah(@$tot_po); ?></th>
						<th></th>
						<th></th>
					</tfoot>
					</table>

				</div>
				<div>

				</div>

				<div class="col-md-6 targetSPA offset-md-3">
					Sales Achievment :

					<?php $resulttarget = mysqli_query($conn, "SELECT * FROM inti_user WHERE username = '$username' ");
					$rowtarget = mysqli_fetch_assoc($resulttarget);
					$target = $rowtarget['super_target'];
					if ($target == '') {
					?>

						<a href="superadmintarget.php">Input My Target</a>
					<?php } else { ?>

						<!-- persen -->
						<?php
						$jumlah10 = $total313 / $target;
						$hasil_persen = $jumlah10 * 100;
						?>
						<!-- persen -->

						<h3><strong><?= rupiah($total313); ?></strong></h3>
						<!-- <div class="persen2"><?php echo round($hasil_persen); ?>%/100%</div><br> -->
						<div class="progress">
							<div class="progress-bar" role="progressbar" style="width: <?php echo round($hasil_persen); ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo round($hasil_persen); ?>%</div>
						</div><br>

						From target :
						<h5> <?= rupiah($target); ?></h5>
					<?php } ?>



					<?php
					$lebih = $total313 - $target;
					$sisa = $target - $total313;
					if ($target > $total313) { ?>

						Sisa Target : <?= rupiah($sisa); ?>
					<?php } elseif ($target < $total313) { ?>

						<div style="float: right;">Target telah tercapai!</div>
						Lebih Target : <?= rupiah($lebih);  ?>

					<?php } ?>
				</div>

			</div>

		</div>



		<!-- </div> -->



		<!-- The Modal -->
		<div class="modal" id="myModal">
			<div class="modal-dialog modal-dialog-scrollable">
				<div class="modal-content">

					<!-- Modal Header -->
					<div class="modal-header">
						<h3>Detail Targeting</h3>
						<button type="button" class="close" data-dismiss="modal">×</button>
					</div>

					<!-- Modal body -->
					<div class="modal-body">

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



		<script>
			// untuk menampilkan data popup
			$(function() {
				$(document).on('click', '.edit-record', function(e) {
					e.preventDefault();
					$("#myModal").modal('show');
					$.post('hasil4.php', {
							penawaran_fk: $(this).attr('data-id')
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

	<script>
		// untuk menampilkan data popup
		$(function() {
			$(document).on('click', '.edit-record1', function(e) {
				e.preventDefault();
				$("#myModal").modal('show');
				$.post('hasil10.php', {
						pk: $(this).attr('data-id')
					},
					function(html) {
						$(".modal-body").html(html);
					}
				);
			});
		});
		// end untuk menampilkan data popup
	</script>

	<script type="text/javascript">
		function printlayer(layer) {
			var generator = window.open(",'name',")
			var layertext = document.getElementById(layer);
			generator.document.write(layertext.innerHTML.replace("Print Me"));

			generator.document.close();
			generator.print();
			generator.close();
		}
	</script>

	</body>


	</html>