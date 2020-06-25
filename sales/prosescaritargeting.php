<?php
require '../functionsales.php';
session_start();

if (isset($_POST["from"])) {

	$username = $_SESSION['username'];
	$from = $_POST["from"];
	$result = mysqli_query($conn, "SELECT * FROM sales_targeting 
INNER JOIN sales_funnel ON sales_targeting.funnel_fk = sales_funnel.pk 
INNER JOIN sales_order ON sales_funnel.penawaran_fk = sales_order.fk_penawaran 
INNER JOIN sales_modality ON sales_order.pk_mod_order = sales_modality.pk_mod 
INNER JOIN sales_customer ON sales_targeting.customer_fk = sales_customer.pk_cust
INNER JOIN inti_rs ON sales_customer.fk_rs = inti_rs.pk_rs
WHERE sales_targeting.username = '$username' 
AND sales_targeting.approve = 'approved'
AND tahun_targeting IN ('" . $_POST["from"] . "')
GROUP BY sales_order.fk_penawaran ");
	// $row = mysqli_fetch_assoc($result);
	// $pk_mod_funnel = $row['pk_mod_funnel'];
	$result3 = mysqli_query($conn, "SELECT * FROM inti_user WHERE username = '$username'");
	$row3 = mysqli_fetch_assoc($result3);
	$name3 = $row3['name'];
	$approvtarget = $row3['approve_target'];
	$target3 = $row3['targett'];
	$result5 = mysqli_query($conn, "SELECT SUM(harga_po_targeting) AS totalsum FROM sales_targeting WHERE approve = 'approved' AND username = '$username' AND tahun_targeting IN ('" . $_POST["from"] . "') ");
	$rows = mysqli_fetch_assoc($result5);
	$total = $rows['totalsum'];
	@$persen = $total / $target3;
	$persen1 = $persen * 100;
}
// $row = mysqli_fetch_assoc($result);
// $pk_mod_funnel = $row['pk_mod_funnel'];
// $result2 = mysqli_query($conn, "SELECT * FROM sales_modality WHERE pk_mod = '$pk_mod_funnel'");
// $row2 = mysqli_fetch_assoc($result2);

?>
<!DOCTYPE html>
<html>

<head>
	<title>Targeting</title>
	<?php include('head.php'); ?>
</head>

<body>
	<div class="mt-1">
		<form action="printTargeting.php" method="POST" target="_blank">
			<input type="hidden" name="from" value="<?= $_POST['from']; ?>">
			<input type="hidden" name="username" value="<?= $_SESSION['username']; ?>">
			<button type="submit" name="submit" class="btn btn-success">Print</button>
		</form>

	</div>

	<div class="container-fluid content1">
		<!-- class content buat footer -->
		<div class="justify-content-md-center">
			<!--  -->
			<!-- <div class="col-md-6 myTarget" style="margin-left: 20px;">
						hahaha
					</div> -->
		</div>
		<div class="col-md-12 table-box" style="overflow-x:auto;">
			<table id="example" class="table_kunjungan" style="margin-top: 0px;" border="1" cellpadding="8" cellspacing="0">
				<thead>
					<tr>
						<th>No</th>
						<th>No. Penawaran</th>
						<th>Rumah Sakit</th>
						<th>Kota</th>
						<th>Targeting Detail</th>
						<th>Total Penawaran</th>
						<th>Harga PO</th>
						<!-- <th>Status Pengiriman</th> -->
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
							<?php @$tot_po += $row['harga_po_targeting']; ?></td>

						<!-- <td><?php if ($row['kirim'] == '100%') { ?>
								<div class="btn-success">Barang Terkirim!</div>
							<?php } elseif ($row['kirim'] == '70%') { ?>
								<div class="btn-info">Sedang dalam Pengiriman</div>
							<?php } else { ?>
								<div class="btn-warning">Barang sedang disiapkan</div>
							<?php } ?></td>
						</td> -->
						<!-- <td><?php echo rupiah($row['harga_order']); ?></td> -->

						<!-- <?php
								$hasil111 = ($row['harga_mod'] * $row['qty_targeting']) - $row['harga_po_targeting'];
								$hasil222 = ($hasil111 / ($row['harga_mod'] * $row['qty_targeting'])) * 100;

								if ($hasil222 <= 0) { ?> -->
						<!-- <td>Tidak Diskon</td> -->
					<?php } else {
					?>
						<td><?php echo $hasil222 . '%' ?></td>
						<td><?= $row['approve']; ?></td>
					<?php }

								$no++; ?>
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
				<!-- <th></th> -->
			</tfoot>
			</table>
		</div>
	</div>
	</div>


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
					<p><?php echo $row['penawaran_fk']; ?></p>
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

</html>