<?php
require '../functionsales.php';
session_start();
$username = $_SESSION['username'];
$nowyear1 = date('Y');
$result = mysqli_query($conn, "SELECT * FROM sales_targeting 
INNER JOIN sales_funnel ON sales_targeting.funnel_fk = sales_funnel.pk 
INNER JOIN sales_order ON sales_funnel.penawaran_fk = sales_order.fk_penawaran 
INNER JOIN sales_modality ON sales_order.pk_mod_order = sales_modality.pk_mod 
INNER JOIN sales_customer ON sales_targeting.customer_fk = sales_customer.pk_cust
INNER JOIN inti_rs ON sales_customer.fk_rs = inti_rs.pk_rs
WHERE sales_targeting.username = '$username' 
AND sales_targeting.approve = 'approved'
AND tahun_targeting = '$nowyear1' 
GROUP BY sales_order.fk_penawaran ");
// $row = mysqli_fetch_assoc($result);
// $pk_mod_funnel = $row['pk_mod_funnel'];
$result3 = mysqli_query($conn, "SELECT * FROM inti_user WHERE username = '$username'");
$row3 = mysqli_fetch_assoc($result3);
$name3 = $row3['name'];
$approvtarget = $row3['approve_target'];
$target3 = $row3['targett'];
$result5 = mysqli_query($conn, "SELECT SUM(harga_po_targeting) AS totalsum FROM sales_targeting 
WHERE approve = 'approved' 
AND username = '$username' 
AND tahun_targeting = '$nowyear1' ");
$rows = mysqli_fetch_assoc($result5);
$total = $rows['totalsum'];
@$persen = $total / $target3;
$persen1 = $persen * 100;

// $row = mysqli_fetch_assoc($result);
// $pk_mod_funnel = $row['pk_mod_funnel'];
// $result2 = mysqli_query($conn, "SELECT * FROM sales_modality WHERE pk_mod = '$pk_mod_funnel'");
// $row2 = mysqli_fetch_assoc($result2);
if ($_SESSION['level'] == "sales") {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Targeting</title>
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

			<div class="container-fluid content1">
				<form action="" method="POST">
					<div class="form-row">
						<div class="col-2">
							<?php $nowyear = date('Y'); ?>
							<!-- <label for="from">Pilih </label> -->
							<select class="form-control" id="from" name="from">
								<option value="" selected disabled>
									<center>Pilih Tahun</center>
								</option>
								<?php
								$resTahun = mysqli_query($conn, "SELECT tahun_targeting FROM sales_targeting WHERE username = '$username' GROUP BY tahun_targeting");
								?>
								<?php while ($rowTahun = mysqli_fetch_assoc($resTahun)) : ?>
									<option value="<?= $rowTahun['tahun_targeting']; ?>"><?= $rowTahun['tahun_targeting']; ?></option>
								<?php endwhile; ?>
							</select>
							<!-- <input class="form-control" type="text" name="from" id="from" placeholder="From"> -->
						</div>
						<div class="col-1">
							<button class="btn btn-spr btn-sm btn-info" type="button" name="range" id="range">Search</button>
						</div>
					</div>
				</form>

				<!-- class content buat footer -->
				<div class="justify-content-md-center" id="purchase_order">
					<div class="row" style="margin: 0px 0px;">
						<div class="col-md-3 myTarget">
							<!-- <div style="float: left;"><h5>My Target</h5></div><br><br><br> -->
							<div class="tgt-name"><i class="fas fa-user"></i> <?= $name3; ?></div>
							<hr style="margin: 0px;">

							<?php if ($persen1 >= '70') { ?>
								<div class="persen5" style="float: left; font-size: 17px; color: #4fc678"><?php echo rupiah($total); ?></div>
							<?php } elseif ($persen1 >= '50') { ?>
								<div class="persen5" style="float: left; font-size: 17px; color: #ffa700"><?php echo rupiah($total); ?></div>
							<?php } else { ?>
								<div class="persen5" style="float: left; font-size: 17px; color: red"><?php echo rupiah($total); ?></div>
							<?php } ?>

							<div class="persen5" style="float: right;"><?php echo round($persen1); ?>% / 100%</div><br>

							<div class="progress" style="margin: 10px 0px 5px 0px;">
								<?php if ($persen1 >= '70') { ?>
									<div class="progress-bar" role="progressbar" style="background-color: #4fc678; width: <?php echo round($persen1); ?>%" aria-valuenow='0' aria-valuemin="0" aria-valuemax='100'><?php echo round($persen1); ?>%</div>
								<?php } elseif ($persen1 >= '50') { ?>
									<div class="progress-bar" role="progressbar" style="background-color: #ffa700; width: <?php echo round($persen1); ?>%" aria-valuenow='0' aria-valuemin="0" aria-valuemax='100'><?php echo round($persen1); ?>%</div>
								<?php } else { ?>
									<div class="progress-bar" role="progressbar" style="background-color: red; width: <?php echo round($persen1); ?>%" aria-valuenow='0' aria-valuemin="0" aria-valuemax='100'><?php echo round($persen1); ?>%</div>
								<?php } ?>
							</div>


							<?php if ($target3 == !NULL && $approvtarget == 'approved') { ?>
								<div class="tgt-txt persen5">Target : <?php echo rupiah($target3); ?></div><br>
							<?php } else if ($target3 == !NULL && $approvtarget == 'rejected') { ?>
								<div style="color: #00d1b2">Target ditolak! masukan target ulang</div>

							<?php } elseif ($target3 == '') { ?>
								<div style="color: #00d1b2">Target belum di masukan</div>
							<?php } elseif ($target3 == !NULL && $approvtarget == '') { ?>
								<div style="color: #00d1b2">Target belum di approve</div>
							<?php } ?>

							<table class="info-idx">
								<!-- <tr>
            <td>Nama</td>
            <td>:</td>
            <td>&nbsp;<?= $name3; ?></td>
        </tr> -->
								<!-- <tr>
            <td>Target</td>
            <td>:</td>
            <td>&nbsp;<?php echo rupiah($target3); ?></td>
        </tr> -->
								<!--  <tr>
            <td>Target yang sudah di capai&nbsp;&nbsp;</td>
            <td>:</td>
            <td>&nbsp;<?php echo rupiah($total); ?></td>
        </tr> --> <?php if ($target3 == !NULL && $approvtarget == 'approved') { ?>
									<tr>
										<td>Sisa Target&nbsp;&nbsp;</td>
										<td>:</td>
										<td>&nbsp;<?php
													$hasil = $target3 - $total;
													if ($total >= $target3) {
														echo 'Target sudah Tercapai';
													} else {
														echo rupiah($hasil);
													}
													?>
										</td>
									</tr>
								<?php } ?>
								<?php
								$hasil = $target3 - $total;
								if ($total >= $target3) {
									$hasil313 = $total - $target3;
								?>
									<tr>
										<td>Lebih Target&nbsp;&nbsp;</td>
										<td>:</td>
										<td>&nbsp;<?php echo rupiah($hasil313); ?></td>
									</tr>
								<?php
								}
								?>
							</table>
						</div>
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
									<th>Status Pengiriman</th>
								</tr>
							</thead>
							<?php if (mysqli_num_rows($result) <= 1) { ?>

							<?php } else { ?>
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

										<td>
											<div class="btn-success">Order Berhasil!</div>
										</td>
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
								<?php endwhile; ?>
								</tr>
							<?php } ?>
							<tfoot>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th><?= rupiah(@$tot); ?></th>
								<th><?= rupiah(@$tot_po); ?></th>
								<th></th>
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


		<?php include('script-footer.php'); ?>
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
		<script>
			$(document).ready(function() {

				// $('.cboxtombol').click(function() {
				//     $('.cbox').prop('checked', this.checked);
				// });

				// $('.cboxtombolpay').click(function() {
				//     $('.cboxpay').prop('checked', this.checked);
				// });
				$('#range').click(function() {
					$('#purchase_order').html("<div class='preloader-css'><span></span><span></span><span></span><span></span><span></span></div>");
					var from = $('#from').val();
					// var to = $('#to').val();
					// var keyword = $('#keyword').val();
					if (from != '') {
						$.ajax({
							url: "prosescaritargeting.php",
							method: "POST",
							data: {
								from: from

								// keyword: keyword
							},
							success: function(data) {
								$('#purchase_order').html(data);
							}
						});
					} else {
						alert("Please Select Date");
					}
				});
			});
		</script>
	</body>

	</html>

<?php } else {
	header("location:../index.php");
} ?>