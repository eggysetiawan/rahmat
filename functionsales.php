<?php

require 'koneksi/koneksi.php';


function query($query)
{
	global $conn;
	$hasil = mysqli_query($conn, $query);
	$rows1 = [];
	while ($row2 = mysqli_fetch_assoc($hasil)) {
		$rows1[] = $row2;
	}
	return $rows1;
}



function rupiah($angka)
{

	$hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
	return $hasil_rupiah;
}

function angka($angka)
{

	$hasil_rupiah = number_format($angka, 0, ',', '.');
	return $hasil_rupiah;
}
function kunjunganharian($post_kunjungan)
{
	global $conn;


	$q = mysqli_query($conn, 'SELECT MAX(pk_kunjungan) as user_id from sales_kunjungan');
	$row = mysqli_fetch_assoc($q);
	$ai = $row['user_id'] + 1;

	$z = mysqli_query($conn, 'SELECT MAX(pk_cust) as user_idcust from sales_customer');
	$rowz = mysqli_fetch_assoc($z);
	$aiz = $rowz['user_idcust'] + 1;

	$pk_rs = $post_kunjungan['rs_kunjungan'];

	$intirs = mysqli_query($conn, "SELECT * FROM inti_rs WHERE pk_rs = '$pk_rs' ");
	$row6 = mysqli_fetch_assoc($intirs);


	$nama_kunjungan = $post_kunjungan['nama_kunjungan'];
	$hp_kunjungan = $post_kunjungan['hp_kunjungan'];
	$email_kunjungan = $post_kunjungan['email_kunjungan'];
	$jabatan_kunjungan = $post_kunjungan['jabatan_kunjungan'];
	$koders_kunjungan = $row6['kode_rs'];
	$rs_kunjungan = $row6['nama_rs'];
	$alamat_kunjungan = $row6['alamat_rs'];
	$tlp_kunjungan = $row6['telepon_rs'];
	$kota_kunjungan = $row6['kota_rs'];
	$negara_kunjungan = $post_kunjungan['negara_kunjungan'];
	$pos_kunjungan = $post_kunjungan['pos_kunjungan'];
	$req_kunjungan = $post_kunjungan['req_kunjungan'];
	$username = $post_kunjungan['username'];
	$hasil_kunjungan = $post_kunjungan['hasil_kunjungan'];
	// $now_kunjungan = Date('d-m-Y');

	$query = "INSERT INTO sales_kunjungan (pk_kunjungan, fk_rs, nama_kunjungan, hp_kunjungan, email_kunjungan, jabatan_kunjungan, koders_kunjungan, rs_kunjungan, negara_kunjungan, pos_kunjungan, req_kunjungan, now_kunjungan, username, hasil_kunjungan, alamat_kunjungan, tlp_kunjungan, kota_kunjungan) 
		VALUES ('$ai', '$pk_rs','$nama_kunjungan','$hp_kunjungan', '$email_kunjungan','$jabatan_kunjungan', '$koders_kunjungan', '$rs_kunjungan','$negara_kunjungan','$pos_kunjungan','$req_kunjungan',NOW(),'$username', '$hasil_kunjungan', '$alamat_kunjungan', '$tlp_kunjungan', '$kota_kunjungan')";

	mysqli_query($conn, $query);

	$query1 = "INSERT INTO sales_customer (pk_cust, fk_rs, koders_cust, nama_cust, hp_cust, email_cust, jabatan_cust, negara_cust, pos_cust, now_cust, username) 
		VALUES ('$aiz','$pk_rs', '$koders_kunjungan', '$nama_kunjungan','$hp_kunjungan', '$email_kunjungan','$jabatan_kunjungan','$negara_kunjungan','$pos_kunjungan',NOW(),'$username')";

	mysqli_query($conn, $query1);

	return mysqli_affected_rows($conn);
}
function admintargeting($target)
{
	global $conn;

	$targetku = $target['target'];
	$username = $target['username'];
	$tahun = $target['tahun1'];

	$query = "UPDATE inti_user SET
	super_target = '$targetku',
	tahun_target = '$tahun'
	WHERE username = '$username'
	";
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}
function tambahcust($tambahcustomer)
{
	global $conn;

	$q = mysqli_query($conn, 'SELECT MAX(pk_cust) as user_id from sales_customer');
	$row = mysqli_fetch_assoc($q);
	$ai = $row['user_id'] + 1;

	$nama_cust = $tambahcustomer['nama_cust'];
	$hp_cust = $tambahcustomer['hp_cust'];
	$email_cust = $tambahcustomer['email_cust'];
	$jabatan_cust = $tambahcustomer['jabatan_cust'];
	$rs_cust = $tambahcustomer['rs_cust'];
	$alamat_cust = $tambahcustomer['alamat_cust'];
	$tlp_cust = $tambahcustomer['tlp_cust'];
	$kota_cust = $tambahcustomer['kota_cust'];
	$negara_cust = $tambahcustomer['negara_cust'];
	// $pos_cust = $tambahcustomer['pos_cust'];
	$koders_cust = $tambahcustomer['koders_cust'];
	$username = $tambahcustomer['username'];

	$query = "INSERT INTO sales_customer(pk_cust, koders_cust, nama_cust, 
	hp_cust, email_cust, jabatan_cust, rs_cust, alamat_cust, tlp_cust, kota_cust,negara_cust,now_cust, username) 
	VALUES ('$ai', '$koders_cust','$nama_cust','$hp_cust','$email_cust',
	'$jabatan_cust','$rs_cust','$alamat_cust','$tlp_cust',
	'$kota_cust','$negara_cust',NOW(),'$username')";

	mysqli_query($conn, $query);

	// var_dump($tambahcustomer);

	return mysqli_affected_rows($conn);
}

function editcust($editcustomer)
{

	global $conn;

	$q = mysqli_query($conn, 'SELECT MAX(pk_cust) as user_id from sales_customer');
	$row = mysqli_fetch_assoc($q);


	$id = $editcustomer['pk_cust'];
	$nama_cust = $editcustomer['nama_cust'];
	$hp_cust = $editcustomer['hp_cust'];
	$email_cust = $editcustomer['email_cust'];
	$jabatan_cust = $editcustomer['jabatan_cust'];
	$rs_cust = $editcustomer['rs_cust'];
	$alamat_cust = $editcustomer['alamat_cust'];
	$tlp_cust = $editcustomer['tlp_cust'];
	$kota_cust = $editcustomer['kota_cust'];
	$negara_cust = $editcustomer['negara_cust'];
	$pos_cust = $editcustomer['pos_cust'];
	$koders_cust = $editcustomer['koders_cust'];
	$username = $editcustomer['username'];
	$npwp_cust = $editcustomer['npwp_cust'];



	$query = "UPDATE sales_customer SET
				nama_cust = '$nama_cust',
				hp_cust = '$hp_cust',
				email_cust = '$email_cust',
				jabatan_cust = '$jabatan_cust',
				rs_cust = '$rs_cust',
				alamat_cust = '$alamat_cust',
				tlp_cust = '$tlp_cust',
				kota_cust = '$kota_cust',
				negara_cust = '$negara_cust',
				now_cust = NOW(),
				koders_cust = '$koders_cust',
				npwp_cust = '$npwp_cust',
				username = '$username'
				WHERE pk_cust = $id
				";


	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function editcustspvsales($editcustomer)
{

	global $conn;

	$q = mysqli_query($conn, 'SELECT MAX(pk_cust) as user_id from sales_customer');
	$row = mysqli_fetch_assoc($q);


	$id = $editcustomer['pk_cust'];
	$nama_cust = $editcustomer['nama_cust'];
	$hp_cust = $editcustomer['hp_cust'];
	$email_cust = $editcustomer['email_cust'];
	$jabatan_cust = $editcustomer['jabatan_cust'];
	$rs_cust = $editcustomer['rs_cust'];
	$alamat_cust = $editcustomer['alamat_cust'];
	$tlp_cust = $editcustomer['tlp_cust'];
	$kota_cust = $editcustomer['kota_cust'];
	$negara_cust = $editcustomer['negara_cust'];
	$pos_cust = $editcustomer['pos_cust'];
	$koders_cust = $editcustomer['koders_cust'];

	$npwp_cust = $editcustomer['npwp_cust'];

	$query = "UPDATE sales_customer SET
				nama_cust = '$nama_cust',
				hp_cust = '$hp_cust',
				email_cust = '$email_cust',
				jabatan_cust = '$jabatan_cust',
				rs_cust = '$rs_cust',
				alamat_cust = '$alamat_cust',
				tlp_cust = '$tlp_cust',
				kota_cust = '$kota_cust',
				negara_cust = '$negara_cust',
				now_cust = NOW(),
				koders_cust = '$koders_cust',
				npwp_cust = '$npwp_cust'
				
				WHERE pk_cust = $id
				";


	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function tambahmod($tambahmodality)
{
	global $conn;

	$q = mysqli_query($conn, 'SELECT MAX(pk_mod) as user_id from sales_modality');
	$row = mysqli_fetch_assoc($q);
	$ai = $row['user_id'] + 1;

	$nama_mod = $tambahmodality['nama_mod'];
	$merk_mod = $tambahmodality['merk_mod'];
	$model_mod = $tambahmodality['model_mod'];
	$spek_mod = $tambahmodality['spek_mod'];
	$harga_mod = $tambahmodality['harga_mod'];
	$stock_mod = $tambahmodality['stock_mod'];

	$query22 = "INSERT INTO sales_modality(pk_mod, nama_mod, merk_mod, model_mod, spek_mod, harga_mod, now_mod, stock_mod) VALUES ('$ai','$nama_mod','$merk_mod','$model_mod','$spek_mod','$harga_mod',NOW(), '$stock_mod')";

	mysqli_query($conn, $query22);

	return mysqli_affected_rows($conn);
}

function editmod($editmodality)
{
	global $conn;

	$q = mysqli_query($conn, 'SELECT MAX(pk_mod) as user_id from sales_modality');
	$row = mysqli_fetch_assoc($q);
	$ai = $row['user_id'] + 1;

	$id = $editmodality['pk_mod'];
	$nama_mod = $editmodality['nama_mod'];
	$merk_mod = $editmodality['merk_mod'];
	$model_mod = $editmodality['model_mod'];
	$spek_mod = $editmodality['spek_mod'];
	$harga_mod = $editmodality['harga_mod'];
	// $username = $editmodality['username'];
	$stock_mod = $editmodality['stock_mod'];

	$query = "UPDATE sales_modality SET
				nama_mod = '$nama_mod',
				merk_mod = '$merk_mod',
				model_mod = '$model_mod',
				spek_mod = '$spek_mod',
				harga_mod = '$harga_mod',
				now_mod = NOW(),
				stock_mod = '$stock_mod'
				WHERE pk_mod = $id
				";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function penawaran($pnwrn)
{
	global $conn;

	$q = mysqli_query($conn, 'SELECT MAX(pk_penawaran) as user_id from sales_penawaran');
	$row = mysqli_fetch_assoc($q);
	$ai = $row['user_id'] + 1;

	$qz = mysqli_query($conn, 'SELECT MAX(pk) as user_id from sales_funnel');
	$rowz = mysqli_fetch_assoc($qz);
	$aiz = $rowz['user_id'] + 1;

	$x = mysqli_query($conn, 'SELECT MAX(no_penawaran) as no_pen from sales_penawaran');
	$rowx = mysqli_fetch_assoc($x);
	$aix = $rowx['no_pen'];



	// $harga_penawaran = $pnwrn['harga_penawaran'];
	// $qty = $pnwrn['qty'];
	$budget = $pnwrn['budget_funnel'];




	$array_bln = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
	$bln = $array_bln[Date('n')];




	$thn = Date('Y');


	$pk_kunjungan = $pnwrn['pk_kunjungan'];
	// $kunjungan = mysqli_query($conn, "SELECT * FROM sales_kunjungan WHERE pk_kunjungan = '$pk_kunjungan' ");
	// $row_kunj = mysqli_fetch_assoc($kunjungan);
	// $nama_kunjungan_penawaran = $row_kunj['nama_kunjungan'];
	// $rs_kunjungan = $row_kunj['rs_kunjungan'];
	// $alamat_kunjungan = $row_kunj['alamat_kunjungan'];
	// $kota_kunjungan = $row_kunj['kota_kunjungan'];

	$customer = mysqli_query($conn, "SELECT * FROM sales_customer WHERE pk_cust = '$pk_kunjungan'");
	$row_cust = mysqli_fetch_assoc($customer);
	$nama_kunjungan_penawaran = $row_cust['nama_cust'];
	$rs_kunjungan = $row_cust['rs_cust'];
	$alamat_kunjungan = $row_cust['alamat_cust'];
	$kota_kunjungan = $row_cust['kota_cust'];





	// 	foreach ($pk_mod as $pk_mod1) {
	// $pk_mod1 = implode("','", $pk_mod1)
	$tdate = date("m");
	if ($tdate == 01 or $tdate == 02 or $tdate == 03) {
		$dt = 'I';
	} elseif ($tdate == 04 or $tdate == 05 or $tdate == 06) {
		$dt = 'II';
	} elseif ($tdate == 07 or $tdate == 08 or $tdate == 09) {
		$dt = 'III';
	} else {
		$dt = 'IV';
	}


	// $count = $pnwrn[';



	$nourut = substr($aix, 2, 4);
	$nourut++;
	$username = $pnwrn['username'];
	$nopen = sprintf("%04s", $nourut);
	$referensi = $pnwrn['referensi'];


	$count_add = $pnwrn['count_add'];

	$user = mysqli_query($conn, "SELECT * FROM inti_user WHERE username = '$username'");
	$rowusername = mysqli_fetch_assoc($user);
	$tahun_penawaran = $rowusername['tahun_target'];
	$no_penawaran = 'Q-' . $nopen . '/IPI/' . '/' . $username . '/' . $bln . '/' . $tahun_penawaran;






	// $pk_mod = $pnwrn['pk_mod1'];
	// $pk_mod1 = implode(",", $pk_mod);

	// for ($pk_mod as $pk_mod1) {
	for ($i = 0; $i < $count_add; $i++) {

		$pk_mod1 = $pnwrn['pk_mod1'][$i];
		$o = mysqli_query($conn, 'SELECT MAX(pk_order) as user_id from sales_order');
		$rowq = mysqli_fetch_assoc($o);
		$aoi = $rowq['user_id'] + 1;

		$qo = mysqli_query($conn, 'SELECT MAX(pk_penawaran) as user_id1 from sales_penawaran');
		$roworder = mysqli_fetch_assoc($qo);
		$ao = $roworder['user_id1'];

		echo $count_add;
		$mod = mysqli_query($conn, "SELECT * FROM sales_modality WHERE pk_mod IN ('" . $pk_mod1 . "') ");
		$row_mod = mysqli_fetch_assoc($mod);
		$nama_mod = $row_mod['nama_mod'];
		$merk_mod = $row_mod['merk_mod'];
		$model_mod = $row_mod['model_mod'];
		$spek_mod = $row_mod['spek_mod'];
		$harga_mod = $row_mod['harga_mod'];
		$cust_fk = $pk_kunjungan;

		$harga_penawaran1 = $pnwrn['harga_penawaran1'][$i];
		$harga_penawaran = str_replace("[a-zA-Z].", "",  $harga_penawaran1);
		$qty = $pnwrn['qty1'][$i];

		$totalharga = $harga_penawaran * $qty;

		$disc = $harga_mod - $harga_penawaran;
		$harga_penawaran2 = ($disc / $harga_mod) * 100;

		if ($harga_penawaran2 > 50) {

			echo "<script>alert('discount > 50%!');
			  document.location.href= 'penawaran.php';
			  </script>";

			return false;
			die;
		} else {

			$queryorder = "INSERT INTO sales_order(pk_order, fk_penawaran, pk_mod_order, nama_mod_order, model_mod_order, merk_mod_order, spek_mod_order,harga_order, total_order, qty_order, cust_fk, delete_order, tujuan_order) VALUES('$aoi', '$ai', '$pk_mod1','$nama_mod','$model_mod','$merk_mod', '$spek_mod','$harga_penawaran', '$totalharga','$qty','$cust_fk', 'ada', 'sales')";
			mysqli_query($conn, $queryorder);
		}
	}

	if ($harga_penawaran2 > 50) {
		echo "<script>alert('discount > 50%!');
			  document.location.href= 'penawaran.php';
			  </script>";

		return false;
	} else {

		$query = "INSERT INTO sales_penawaran(pk_penawaran, no_penawaran, pk_cust_penawaran, budget_penawaran, tgl_penawaran, status, username, referensi_penawaran, delete_penawaran, tahun_penawaran ) VALUES 
	('$ai','$no_penawaran','$pk_kunjungan', '$budget',NOW(),'30%','$username', '$referensi', 'ada', '$tahun_penawaran')";
		mysqli_query($conn, $query);

		$query1 = "INSERT INTO sales_funnel(pk, penawaran_fk, customer_fk, month_funnel, budget_funnel, buy_funnel, status_funnel, start_funnel, username, referensi_funnel, buy1, delete_funnel, tujuan_funnel, tahun_funnel) 
		VALUES ('$aiz', '$ai', '$pk_kunjungan', '$dt', '$budget', '30%', 'On Progress', NOW(), '$username', '$referensi', '30%', 'ada', 'sales', '$tahun_penawaran')";

		mysqli_query($conn, $query1);
	}

	return mysqli_affected_rows($conn);
}

function order($pnwrn)
{
	global $conn;

	$q = mysqli_query($conn, 'SELECT MAX(pk_penawaran) as user_id from sales_penawaran');
	$row = mysqli_fetch_assoc($q);
	$ai = $row['user_id'] + 1;

	$qz = mysqli_query($conn, 'SELECT MAX(pk) as user_id from sales_funnel');
	$rowz = mysqli_fetch_assoc($qz);
	$aiz = $rowz['user_id'] + 1;

	$x = mysqli_query($conn, 'SELECT MAX(no_penawaran) as no_pen from sales_penawaran');
	$rowx = mysqli_fetch_assoc($x);
	$aix = $rowx['no_pen'];



	// $harga_penawaran = $pnwrn['harga_penawaran'];
	// $qty = $pnwrn['qty'];
	$budget = $pnwrn['budget_funnel'];




	$array_bln = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
	$bln = $array_bln[Date('n')];




	$thn = Date('Y');


	$pk_kunjungan = $pnwrn['pk_kunjungan'];
	// $kunjungan = mysqli_query($conn, "SELECT * FROM sales_kunjungan WHERE pk_kunjungan = '$pk_kunjungan' ");
	// $row_kunj = mysqli_fetch_assoc($kunjungan);
	// $nama_kunjungan_penawaran = $row_kunj['nama_kunjungan'];
	// $rs_kunjungan = $row_kunj['rs_kunjungan'];
	// $alamat_kunjungan = $row_kunj['alamat_kunjungan'];
	// $kota_kunjungan = $row_kunj['kota_kunjungan'];

	$customer = mysqli_query($conn, "SELECT * FROM sales_customer WHERE pk_cust = '$pk_kunjungan'");
	$row_cust = mysqli_fetch_assoc($customer);
	$nama_kunjungan_penawaran = $row_cust['nama_cust'];
	$rs_kunjungan = $row_cust['rs_cust'];
	$alamat_kunjungan = $row_cust['alamat_cust'];
	$kota_kunjungan = $row_cust['kota_cust'];



	// 	foreach ($pk_mod as $pk_mod1) {
	// $pk_mod1 = implode("','", $pk_mod1)
	$tdate = date("m");
	if ($tdate == 01 or $tdate == 02 or $tdate == 03) {
		$dt = 'I';
	} elseif ($tdate == 04 or $tdate == 05 or $tdate == 06) {
		$dt = 'II';
	} elseif ($tdate == 07 or $tdate == 08 or $tdate == 09) {
		$dt = 'III';
	} else {
		$dt = 'IV';
	}


	// $count = $pnwrn[';



	$nourut = substr($aix, 2, 4);
	$nourut++;
	$username = $pnwrn['username'];
	$nopen = sprintf("%04s", $nourut);
	$referensi = $pnwrn['referensi'];
	$no_penawaran = 'Q-' . $nopen . '/IPI/' . '/' . $username . '/' . $bln . '/' . $thn;

	$count_add = $pnwrn['count_add'];




	// $pk_mod = $pnwrn['pk_mod1'];
	// $pk_mod1 = implode(",", $pk_mod);

	// for ($pk_mod as $pk_mod1) {
	for ($i = 0; $i < $count_add; $i++) {

		$pk_mod1 = $pnwrn['pk_mod1'][$i];
		$o = mysqli_query($conn, 'SELECT MAX(pk_order) as user_id from sales_order3');
		$rowq = mysqli_fetch_assoc($o);
		$aoi = $rowq['user_id'] + 1;



		echo $count_add;
		$mod = mysqli_query($conn, "SELECT * FROM sales_modality WHERE pk_mod IN ('" . $pk_mod1 . "') ");
		$row_mod = mysqli_fetch_assoc($mod);
		$nama_mod = $row_mod['nama_mod'];
		$merk_mod = $row_mod['merk_mod'];
		$model_mod = $row_mod['model_mod'];
		$spek_mod = $row_mod['spek_mod'];
		$harga_mod = $row_mod['harga_mod'];
		$cust_fk = $pk_kunjungan;

		$harga_penawaran1 = $pnwrn['harga_penawaran1'][$i];
		$harga_penawaran = str_replace("[a-zA-Z].", "",  $harga_penawaran1);
		$qty = $pnwrn['qty1'][$i];

		$totalharga = $harga_penawaran * $qty;

		$disc = $harga_mod - $harga_penawaran;
		$harga_penawaran2 = ($disc / $harga_mod) * 100;

		if ($harga_penawaran2 > 50) {

			echo "<script>alert('discount > 50%!');
			  document.location.href= 'penawaran.php';
			  </script>";

			return false;
			die;
		} else {

			$queryorder = "INSERT INTO sales_order3(pk_order, fk_funnel3, pk_mod_order, nama_mod_order, model_mod_order, merk_mod_order, spek_mod_order,harga_order, total_order, qty_order, cust_fk, delete_order, tujuan_order) VALUES('$aoi', '$aiz', '$pk_mod1','$nama_mod','$model_mod','$merk_mod', '$spek_mod','$harga_penawaran', '$totalharga','$qty','$cust_fk', 'ada', 'distributor')";
			mysqli_query($conn, $queryorder);
		}
	}

	$totalharga = $harga_penawaran * $qty;

	$disc = $harga_mod - $harga_penawaran;
	$harga_penawaran2 = ($disc / $harga_mod) * 100;

	if ($harga_penawaran2 > 50) {
		echo "<script>alert('discount > 50%!');
			  document.location.href= 'penawaran.php';
			  </script>";

		return false;
	} else {


		$query1 = "INSERT INTO sales_funnel(pk, customer_fk, rs_funnel, kota_funnel, month_funnel, budget_funnel, buy_funnel, status_funnel, start_funnel, username, delete_funnel, approve, referensi_funnel, tujuan_funnel) 
		VALUES ('$aiz', '$pk_kunjungan', '$rs_kunjungan', '$kota_kunjungan', '$dt', '$budget', '100%', 'WIN', NOW(), '$username', 'ada','approved', '$referensi', 'distributor')";

		mysqli_query($conn, $query1);
	}

	return mysqli_affected_rows($conn);
}

function funnel2($funnel2)
{
	global $conn;

	$q = mysqli_query($conn, 'SELECT MAX(pk) as user_id from sales_funnel2');
	$row = mysqli_fetch_assoc($q);
	$ai = $row['user_id'] + 1;

	$qz = mysqli_query($conn, 'SELECT MAX(pk) as user_id from sales_funnel');
	$rowz = mysqli_fetch_assoc($qz);
	$aiz = $rowz['user_id'] + 1;



	$x = mysqli_query($conn, 'SELECT MAX(no_penawaran) as no_pen from sales_penawaran');
	$rowx = mysqli_fetch_assoc($x);
	$aix = $rowx['no_pen'];



	// $harga_penawaran = $funnel2['harga_penawaran'];
	// $qty = $funnel2['qty'];





	$array_bln = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
	$bln = $array_bln[Date('n')];




	$thn = Date('Y');


	$pk_kunjungan = $funnel2['pk_kunjungan'];
	// $kunjungan = mysqli_query($conn, "SELECT * FROM sales_kunjungan WHERE pk_kunjungan = '$pk_kunjungan' ");
	// $row_kunj = mysqli_fetch_assoc($kunjungan);
	// $nama_kunjungan_penawaran = $row_kunj['nama_kunjungan'];
	// $rs_kunjungan = $row_kunj['rs_kunjungan'];
	// $alamat_kunjungan = $row_kunj['alamat_kunjungan'];
	// $kota_kunjungan = $row_kunj['kota_kunjungan'];

	$customer = mysqli_query($conn, "SELECT * FROM sales_customer WHERE pk_cust = '$pk_kunjungan'");
	$row_cust = mysqli_fetch_assoc($customer);
	$nama_kunjungan_penawaran = $row_cust['nama_cust'];
	$rs_kunjungan = $row_cust['rs_cust'];
	$alamat_kunjungan = $row_cust['alamat_cust'];
	$kota_kunjungan = $row_cust['kota_cust'];



	// 	foreach ($pk_mod as $pk_mod1) {
	// $pk_mod1 = implode("','", $pk_mod1)
	$tdate = date("m");
	if ($tdate == 01 or $tdate == 02 or $tdate == 03) {
		$dt = 'I';
	} elseif ($tdate == 04 or $tdate == 05 or $tdate == 06) {
		$dt = 'II';
	} elseif ($tdate == 07 or $tdate == 08 or $tdate == 09) {
		$dt = 'III';
	} else {
		$dt = 'IV';
	}


	// $count = $funnel2[';



	$nourut = substr($aix, 2, 4);
	$nourut++;
	$username = $funnel2['username'];
	// $nopen = sprintf("%04s", $nourut);
	// $referensi = $funnel2['referensi'];
	// $no_penawaran = 'Q-' . $nopen . '/IPI/' . '/' . $username . '/' . $bln . '/' . $thn;

	$count_add = $funnel2['count_add'];
	$progress = $funnel2['progress_funnel2'];
	$tahun = $funnel2['tahun1'];
	$keterangan = $funnel2['keterangan1'];




	// $pk_mod = $funnel2['pk_mod1'];
	// $pk_mod1 = implode(",", $pk_mod);

	// for ($pk_mod as $pk_mod1) {
	for ($i = 0; $i < $count_add; $i++) {

		$pk_mod1 = $funnel2['pk_mod1'][$i];
		$o = mysqli_query($conn, 'SELECT MAX(pk_order) as user_id from sales_order2');
		$rowq = mysqli_fetch_assoc($o);
		$aoi = $rowq['user_id'] + 1;

		$qo = mysqli_query($conn, 'SELECT MAX(pk_penawaran) as user_id1 from sales_penawaran');
		$roworder = mysqli_fetch_assoc($qo);
		$ao = $roworder['user_id1'];

		$qza = mysqli_query($conn, 'SELECT MAX(pk) as user_id from sales_funnel2');
		$rowza = mysqli_fetch_assoc($qza);
		$aiza = $rowza['user_id'] + 1;


		$mod = mysqli_query($conn, "SELECT * FROM sales_modality WHERE pk_mod IN ('" . $pk_mod1 . "') ");
		$row_mod = mysqli_fetch_assoc($mod);
		$nama_mod = $row_mod['nama_mod'];
		$merk_mod = $row_mod['merk_mod'];
		$model_mod = $row_mod['model_mod'];
		$spek_mod = $row_mod['spek_mod'];
		$harga_mod = $row_mod['harga_mod'];
		$cust_fk = $pk_kunjungan;

		$harga_penawaran1 = $funnel2['harga_penawaran1'][$i];
		$harga_penawaran = str_replace("[a-zA-Z].", "",  $harga_penawaran1);
		$qty = $funnel2['qty1'][$i];

		$totalharga = $harga_penawaran * $qty;

		$disc = $harga_mod - $harga_penawaran;
		$harga_penawaran2 = ($disc / $harga_mod) * 100;

		if ($harga_penawaran2 > 50) {

			echo "<script>alert('Discont yang diberikan melebihi batas 50%');
			  document.location.href= 'penawaran.php';
			  </script>";

			return false;
			die;
		} else {

			$queryorder = "INSERT INTO sales_order2(pk_order, fk_funnel2, pk_mod_order, nama_mod_order, model_mod_order, merk_mod_order, spek_mod_order,harga_order, total_order, qty_order, cust_fk, tujuan_order) VALUES('$aoi', '$aiza', '$pk_mod1','$nama_mod','$model_mod','$merk_mod', '$spek_mod','$harga_penawaran', '$totalharga','$qty','$cust_fk', 'sales')";
			mysqli_query($conn, $queryorder);
		}
	}

	if ($harga_penawaran2 > 50) {
		echo "<script>alert('discount > 50%!');
			  document.location.href= 'penawaran.php';
			  </script>";

		return false;
	} else {


		$query2 = "INSERT INTO sales_funnel2(pk, customer_fk, rs_funnel2, kota_funnel2, progress_funnel2, tahun_funnel2, status_funnel2, username) VALUES('$aiza', '$pk_kunjungan', '$rs_kunjungan', '$kota_kunjungan', '$progress','$tahun', '$keterangan', '$username')";

		mysqli_query($conn, $query2);
	}

	return mysqli_affected_rows($conn);
}

function editfunnel22($funnel2)
{
	global $conn;


	$username = $funnel2['username'];
	$count_add = $funnel2['count_add'];
	$progress = $funnel2['progress_funnel2'];
	$tahun = $funnel2['tahun1'];
	$keterangan = $funnel2['keterangan1'];
	$pk_funnel2 = $funnel2['pk'];



	for ($i = 0; $i < $count_add; $i++) {

		$pk_order = $funnel2['pk_order'][$i];
		$pk_mod = $funnel2['pk_mod'][$i];

		$mod = mysqli_query($conn, "SELECT * FROM sales_modality WHERE pk_mod IN ('" . $pk_mod . "') ");
		$row_mod = mysqli_fetch_assoc($mod);
		$nama_mod = $row_mod['nama_mod'];
		$merk_mod = $row_mod['merk_mod'];
		$model_mod = $row_mod['model_mod'];
		$spek_mod = $row_mod['spek_mod'];
		$harga_mod = $row_mod['harga_mod'];
		// $cust_fk = $pk_kunjungan;

		$harga_penawaran = $funnel2['harga_penawaran'][$i];
		// $harga_penawaran = str_replace("[a-zA-Z].", "",  $harga_penawaran1);
		$qty = $funnel2['qty'][$i];

		$totalharga = $harga_penawaran * $qty;

		$disc = $harga_mod - $harga_penawaran;
		$harga_penawaran2 = ($disc / $harga_mod) * 100;

		if ($harga_penawaran2 > 50) {

			echo "<script>alert('Discont yang diberikan melebihi batas 50%');
			  document.location.href= 'edit_funnel2.php';
			  </script>";

			return false;
			die;
		} else {

			$queryorder = "UPDATE sales_order2 SET
			pk_mod_order = '$pk_mod',
			nama_mod_order = '$nama_mod',
			model_mod_order = '$model_mod',
			merk_mod_order = '$merk_mod',
			spek_mod_order = '$spek_mod',
			harga_order = '$harga_penawaran',
			total_order = '$totalharga',
			qty_order = '$qty'
			WHERE pk_order = '$pk_order'
			";
			mysqli_query($conn, $queryorder);
		}
	}


	$disc = $harga_mod - $harga_penawaran;
	$harga_penawaran2 = ($disc / $harga_mod) * 100;
	$totalharga = $harga_penawaran * $qty;


	if ($harga_penawaran2 > 50) {
		echo "<script>alert('discount > 50%!');
			  document.location.href= 'edit_funnel2.php?pk=$pk_funnel2';
			  </script>";

		return false;
	} else {
		$query2 = "UPDATE sales_funnel2 SET
		progress_funnel2 = '$progress',
		tahun_funnel2 = '$tahun',
		status_funnel2 = '$keterangan'
		WHERE pk = '$pk_funnel2'
		";

		mysqli_query($conn, $query2);

		//  Jum'at, 12/6/2019 4:18
	}

	return mysqli_affected_rows($conn);
}

function editfunnel222($funnel2)
{
	global $conn;


	$username = $funnel2['username'];
	$count_add = $funnel2['count_add'];
	$progress = $funnel2['progress_funnel2'];
	$tahun = $funnel2['tahun1'];
	$keterangan = $funnel2['keterangan1'];




	// $pk_mod = $funnel2['pk_mod1'];
	// $pk_mod1 = implode(",", $pk_mod);

	// for ($pk_mod as $pk_mod1) {
	for ($i = 0; $i < $count_add; $i++) {

		$pk_order = $funnel2['pk_order'][$i];
		$pk_mod = $funnel2['pk_mod'][$i];

		$mod = mysqli_query($conn, "SELECT * FROM sales_modality WHERE pk_mod IN ('" . $pk_mod . "') ");
		$row_mod = mysqli_fetch_assoc($mod);
		$nama_mod = $row_mod['nama_mod'];
		$merk_mod = $row_mod['merk_mod'];
		$model_mod = $row_mod['model_mod'];
		$spek_mod = $row_mod['spek_mod'];
		$harga_mod = $row_mod['harga_mod'];
		// $cust_fk = $pk_kunjungan;

		$harga_penawaran = $funnel2['harga_penawaran'][$i];
		// $harga_penawaran = str_replace("[a-zA-Z].", "",  $harga_penawaran1);
		$qty = $funnel2['qty1'][$i];

		$totalharga = $harga_penawaran * $qty;

		$disc = $harga_mod - $harga_penawaran;
		$harga_penawaran2 = ($disc / $harga_mod) * 100;

		if ($harga_penawaran2 > 50) {

			echo "<script>alert('Discont yang diberikan melebihi batas 50%');
			  document.location.href= 'penawaran.php';
			  </script>";

			return false;
			die;
		} else {

			$queryorder = "UPDATE sales_order2 SET
			pk_mod_order = '$pk_mod',
			nama_mod_order = '$nama_mod',
			model_mod_order = '$model_mod',
			merk_mod_order = '$merk_mod',
			spek_mod_order = '$spek_mod',
			harga_order = '$harga_penawaran',
			total_order = '$totalharga',
			qty_order = '$qty'
			WHERE pk_order = '$pk_order'
			";
			mysqli_query($conn, $queryorder);
		}
	}

	if ($harga_penawaran2 > 50) {
		echo "<script>alert('discount > 50%!');
			  document.location.href= 'penawaran.php';
			  </script>";

		return false;
	} else {


		// $query2 = "INSERT INTO sales_funnel2(pk, customer_fk, rs_funnel2, kota_funnel2, progress_funnel2, tahun_funnel2, status_funnel2, username) VALUES('$aiza', '$pk_kunjungan', '$rs_kunjungan', '$kota_kunjungan', '$progress','$tahun', '$keterangan', '$username')";

		// $count_add = $funnel2['count_add'];
		// $progress = $funnel2['progress_funnel2'];
		// $tahun = $funnel2['tahun1'];
		// $keterangan = $funnel2['keterangan1'];


		$query2 = "UPDATE sales_funnel2 SET
		progress_funnel2 = '$progress',
		tahun_funnel2 = '$tahun',
		status_funnel2 = '$keterangan'
		";

		mysqli_query($conn, $query2);

		//  Jum'at, 12/6/2019 4:18
	}

	return mysqli_affected_rows($conn);
}

function funnel3($funnel3)
{
	global $conn;

	$q = mysqli_query($conn, 'SELECT MAX(pk) as user_id from sales_funnel2');
	$row = mysqli_fetch_assoc($q);
	$ai = $row['user_id'] + 1;

	$qz = mysqli_query($conn, 'SELECT MAX(pk) as user_id from sales_funnel');
	$rowz = mysqli_fetch_assoc($qz);
	$aiz = $rowz['user_id'] + 1;



	$x = mysqli_query($conn, 'SELECT MAX(no_penawaran) as no_pen from sales_penawaran');
	$rowx = mysqli_fetch_assoc($x);
	$aix = $rowx['no_pen'];



	// $harga_penawaran = $funnel2['harga_penawaran'];
	// $qty = $funnel2['qty'];





	$array_bln = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
	$bln = $array_bln[Date('n')];




	$thn = Date('Y');


	$nama_rs = $funnel3['nama_rs'];
	$kode_rs = $funnel3['kode_rs'];
	$z = mysqli_query($conn, 'SELECT MAX(pk_cust) as user_idcust from sales_customer');
	$rowz = mysqli_fetch_assoc($z);
	$aizz = $rowz['user_idcust'] + 1;

	$pk_kunjungan = $funnel3['pk_kunjungan'];


	$customer = mysqli_query($conn, "SELECT * FROM sales_customer WHERE pk_cust = '$pk_kunjungan'");
	$row_cust = mysqli_fetch_assoc($customer);
	$rs_customer = $row_cust['rs_cust'];
	$koders_customer = $row_cust['alamat_cust'];



	$nourut = substr($aix, 2, 4);
	$nourut++;
	$username = $funnel3['username'];


	$count_add = $funnel3['count_add'];
	$progress = $funnel3['progress_funnel2'];
	$tahun = $funnel3['tahun1'];
	$keterangan = $funnel3['keterangan1'];

	for ($i = 0; $i < $count_add; $i++) {

		$pk_mod1 = $funnel3['pk_mod1'][$i];
		$o = mysqli_query($conn, 'SELECT MAX(pk_order) as user_id from sales_order2');
		$rowq = mysqli_fetch_assoc($o);
		$aoi = $rowq['user_id'] + 1;


		$qza = mysqli_query($conn, 'SELECT MAX(pk) as user_id from sales_funnel2');
		$rowza = mysqli_fetch_assoc($qza);
		$aiza = $rowza['user_id'] + 1;




		$mod = mysqli_query($conn, "SELECT * FROM sales_modality WHERE pk_mod IN ('" . $pk_mod1 . "') ");
		$row_mod = mysqli_fetch_assoc($mod);
		$nama_mod = $row_mod['nama_mod'];
		$merk_mod = $row_mod['merk_mod'];
		$model_mod = $row_mod['model_mod'];
		$spek_mod = $row_mod['spek_mod'];
		$harga_mod = $row_mod['harga_mod'];



		$harga_penawaran1 = $funnel3['harga_penawaran1'][$i];
		$harga_penawaran = str_replace("[a-zA-Z].", "",  $harga_penawaran1);
		$qty = $funnel3['qty1'][$i];

		$totalharga = $harga_penawaran * $qty;

		$disc = $harga_mod - $harga_penawaran;
		$harga_penawaran2 = ($disc / $harga_mod) * 100;

		if ($harga_penawaran2 > 50) {

			echo "<script>alert('Discont yang diberikan melebihi batas 50%');
			  document.location.href= 'penawaran.php';
			  </script>";

			return false;
			die;
		} else {
			$queryorder = "INSERT INTO sales_order2(pk_order, fk_funnel2, pk_mod_order, nama_mod_order, model_mod_order, merk_mod_order, spek_mod_order,harga_order, total_order, qty_order, tujuan_order) VALUES('$aoi', '$aiza', '$pk_mod1','$nama_mod','$model_mod','$merk_mod', '$spek_mod','$harga_penawaran', '$totalharga','$qty', 'distributor')";
			mysqli_query($conn, $queryorder);
		}
	}

	if ($harga_penawaran2 > 50) {
		echo "<script>alert('discount > 50%!');
			  document.location.href= 'penawaran.php';
			  </script>";

		return false;
	} else {

		if ($pk_kunjungan == "other") {
			$query2 = "INSERT INTO sales_funnel2(pk, customer_fk, rs_funnel2, progress_funnel2, tahun_funnel2, status_funnel2, username) VALUES('$aiza', '$aizz', '$nama_rs', '$progress','$tahun', '$keterangan', '$username')";
			mysqli_query($conn, $query2);
		} else {
			$query2 = "INSERT INTO sales_funnel2(pk, customer_fk, rs_funnel2, progress_funnel2, tahun_funnel2, status_funnel2, username) VALUES('$aiza', '$pk_kunjungan', '$rs_customer', '$progress','$tahun', '$keterangan', '$username')";
			mysqli_query($conn, $query2);
		}

		if ($pk_kunjungan == "other") {
			$query3 = "INSERT INTO sales_customer(pk_cust, koders_cust, rs_cust, username) VALUES ('$aizz', '$kode_rs', '$nama_rs', '$username')";
			mysqli_query($conn, $query3);
		}
	}


	return mysqli_affected_rows($conn);
}
function editpenawaran($editpnwrn)
{
	global $conn;

	$pk_cust = $editpnwrn['pk_cust'];
	$customer = mysqli_query($conn, "SELECT * FROM sales_customer WHERE pk_cust = '$pk_cust'");
	$row_cust = mysqli_fetch_assoc($customer);
	$rs_kunjungan = $row_cust['rs_cust'];


	$pnwrn_id = $editpnwrn['no_penawaran'];

	$budget_penawaran = $editpnwrn['budget_penawaran'];

	$referensi = $editpnwrn['referensi'];
	$count_add = $editpnwrn['count_add'];



	for ($i = 0; $i < $count_add; $i++) {

		$pk_order = $editpnwrn['pk_order'][$i];
		// echo $pk_order. ', <br />';
		$fk_penawaran = $editpnwrn['fk_penawaran'];
		// echo $fk_penawaran. ', <br />';

		$pk_mod = $editpnwrn['pk_mod'][$i];
		$mod = mysqli_query($conn, "SELECT * FROM sales_modality WHERE pk_mod IN ('" . $pk_mod . "') ");
		$row_mod = mysqli_fetch_assoc($mod);
		$pk_mod1 = $row_mod['pk_mod'];
		$nama_mod = $row_mod['nama_mod'];
		$merk_mod = $row_mod['merk_mod'];
		$model_mod = $row_mod['model_mod'];
		$spek_mod = $row_mod['spek_mod'];
		$harga_mod = $row_mod['harga_mod'];
		// echo $pk_mod. ', <br />';
		// echo $nama_mod. ', <br />';
		$pk_penawaran = $editpnwrn['pk_penawaran'];
		$resultorder = mysqli_query($conn, "SELECT * FROM sales_order WHERE fk_penawaran IN ('" . $pk_penawaran . "') ");
		$roworder = mysqli_fetch_assoc($resultorder);

		$harga_penawaran = $editpnwrn['harga_penawaran'][$i];
		$qty = $editpnwrn['qty'][$i];

		// echo $qty . ', <br />';
		// echo $harga_penawaran;

		$totalharga = $harga_penawaran * $qty;

		$disc = $harga_mod - $harga_penawaran;
		$harga_penawaran2 = ($disc / $harga_mod) * 100;

		if ($harga_penawaran2 > 50) {

			echo "<script>alert('discount > 50%!');
			  document.location.href= 'view_penawaran.php';
			  </script>";

			return false;
			die;
		} else {

			$queryorder = "UPDATE sales_order SET
		pk_mod_order = '$pk_mod',
		nama_mod_order = '$nama_mod',
		model_mod_order = '$model_mod',
		merk_mod_order = '$merk_mod',
		spek_mod_order = '$spek_mod',
		harga_order = '$harga_penawaran',
		total_order = '$totalharga',
		qty_order = '$qty'
		WHERE pk_order = '$pk_order'	
		";
			mysqli_query($conn, $queryorder);
		}
	}


	$disc = $harga_mod - $harga_penawaran;
	$harga_penawaran2 = ($disc / $harga_mod) * 100;
	$totalharga = $harga_penawaran * $qty;

	if ($harga_penawaran2 > 50) {
		echo "<script>alert('discount > 50%!');
			  document.location.href= 'edit_penawaran.php?no_penawaran=$pnwrn_id';
			  </script>";

		return false;
	} else {

		// -----------------------------------
		$query = "UPDATE sales_penawaran SET
	budget_penawaran = '$budget_penawaran',
	tgl_penawaran = NOW(),
	pk_cust_penawaran = '$pk_cust',
	referensi_penawaran = '$referensi'

	WHERE no_penawaran = '$pnwrn_id'
	";
		mysqli_query($conn, $query);



		$query1 = "UPDATE sales_funnel SET
	customer_fk = '$pk_cust',
	budget_funnel = '$budget_penawaran',
	start_funnel = NOW(),
	referensi_funnel = '$referensi'

	WHERE no_penawaran = '$pnwrn_id'
	";
		mysqli_query($conn, $query1);
	}


	return mysqli_affected_rows($conn);
}

function editfunnel2($editpnwrn)
{
	global $conn;

	$pk_cust = $editpnwrn['pk_cust'];
	$customer = mysqli_query($conn, "SELECT * FROM sales_customer WHERE pk_cust = '$pk_cust'");
	$row_cust = mysqli_fetch_assoc($customer);
	$nama_kunjungan_penawaran = $row_cust['nama_cust'];
	$rs_kunjungan = $row_cust['rs_cust'];
	$alamat_kunjungan = $row_cust['alamat_cust'];
	$kota_kunjungan = $row_cust['kota_cust'];

	$pnwrn_id = $editpnwrn['no_penawaran'];

	$budget_penawaran = $editpnwrn['budget_penawaran'];

	$referensi = $editpnwrn['referensi'];
	$count_add = $editpnwrn['count_add'];

	// $result1 = mysqli_query($conn, "SELECT * FROM sales_order WHERE pk_order = '$pk_order' ");
	// while ($row123 = mysqli_fetch_assoc($result1)) {
	// 	echo $row123['pk_order'];
	// }

	for ($i = 0; $i < $count_add; $i++) {

		$pk_order = $editpnwrn['pk_order'][$i];
		// echo $pk_order. ', <br />';
		$fk_penawaran = $editpnwrn['fk_penawaran'];
		// echo $fk_penawaran. ', <br />';

		$pk_mod = $editpnwrn['pk_mod'][$i];
		$mod = mysqli_query($conn, "SELECT * FROM sales_modality WHERE pk_mod IN ('" . $pk_mod . "') ");
		$row_mod = mysqli_fetch_assoc($mod);
		$pk_mod1 = $row_mod['pk_mod'];
		$nama_mod = $row_mod['nama_mod'];
		$merk_mod = $row_mod['merk_mod'];
		$model_mod = $row_mod['model_mod'];
		$spek_mod = $row_mod['spek_mod'];
		$harga_mod = $row_mod['harga_mod'];
		// echo $pk_mod. ', <br />';
		// echo $nama_mod. ', <br />';
		$pk_penawaran = $editpnwrn['pk_penawaran'];
		$resultorder = mysqli_query($conn, "SELECT * FROM sales_order WHERE fk_penawaran IN ('" . $pk_penawaran . "') ");
		$roworder = mysqli_fetch_assoc($resultorder);

		$harga_penawaran = $editpnwrn['harga_penawaran'][$i];
		$qty = $editpnwrn['qty'][$i];

		// echo $qty . ', <br />';
		// echo $harga_penawaran;

		$totalharga = $harga_penawaran * $qty;

		$disc = $harga_mod - $harga_penawaran;
		$harga_penawaran2 = ($disc / $harga_mod) * 100;

		if ($harga_penawaran2 > 50) {

			echo "<script>alert('discount > 50%!');
			  document.location.href= 'view_penawaran.php';
			  </script>";

			return false;
			die;
		} else {

			$queryorder = "UPDATE sales_order2 SET
		pk_mod_order = '$pk_mod',
		nama_mod_order = '$nama_mod',
		model_mod_order = '$model_mod',
		merk_mod_order = '$merk_mod',
		spek_mod_order = '$spek_mod',
		harga_order = '$harga_penawaran',
		total_order = '$totalharga',
		qty_order = '$qty'
		WHERE pk_order = '$pk_order'	
		";
			mysqli_query($conn, $queryorder);
		}
	}


	$disc = $harga_mod - $harga_penawaran;
	$harga_penawaran2 = ($disc / $harga_mod) * 100;
	$totalharga = $harga_penawaran * $qty;

	if ($harga_penawaran2 > 50) {
		echo "<script>alert('discount > 50%!');
			  document.location.href= 'edit_penawaran.php?no_penawaran=$pnwrn_id';
			  </script>";

		return false;
	} else {

		// -----------------------------------
		// 	$query = "UPDATE sales_penawaran SET
		// rs_penawaran = '$rs_kunjungan',
		// nama_cust_penawaran = '$nama_kunjungan_penawaran',
		// alamat_penawaran = '$alamat_kunjungan',
		// kota_penawaran = 'kota_kunjungan',
		// budget_penawaran = '$budget_penawaran',
		// tgl_penawaran = NOW(),
		// referensi_penawaran = '$referensi'
		// WHERE no_penawaran = '$pnwrn_id'
		// ";
		// 	mysqli_query($conn, $query);

		$query1 = "UPDATE sales_funnel2 SET
	rs_funnel = '$rs_kunjungan',
	budget_funnel = '$budget_penawaran',
	start_funnel = NOW(),
	referensi_funnel = '$referensi'

	WHERE no_penawaran = '$pnwrn_id'
	";
		mysqli_query($conn, $query1);
	}


	return mysqli_affected_rows($conn);
}

function uploads($upload)
{

	global $conn;

	$pnwrn_id = $upload['no_penawaran'];

	$gambar = upload();
	if (!$gambar) {
		return false;
	}

	$tgl_upload = $upload['tgl_upload'];

	$query = "UPDATE sales_penawaran SET
	gambar = '$gambar',
	tgl_upload = NOW()
	WHERE no_penawaran = '$pnwrn_id'
	";

	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

function approve($revisi)
{
	global $conn;

	$no_penawaran = $revisi['no_penawaran'];
	$approved = 'approved';



	$q = mysqli_query($conn, "SELECT * FROM sales_penawaran WHERE no_penawaran = '$no_penawaran' ");
	$row = mysqli_fetch_assoc($q);

	$no_penawaran = $row['no_penawaran'];
	$fk_penawaran = $row['pk_penawaran'];


	$query = "UPDATE sales_penawaran SET
    approve = '$approved'
    WHERE no_penawaran = '$no_penawaran'
	";

	mysqli_query($conn, $query);

	$query1 = "UPDATE sales_funnel SET
	approve = '$approved' WHERE penawaran_fk = '$fk_penawaran'
	";

	mysqli_query($conn, $query1);


	return mysqli_affected_rows($conn);
}


function approvedemo($demo)
{
	global $conn;

	$no_penawaran = $demo['no_penawaran'];
	$approved = 'approved';



	$q = mysqli_query($conn, "SELECT * FROM sales_penawaran WHERE no_penawaran = '$no_penawaran' ");
	$row = mysqli_fetch_assoc($q);

	$no_penawaran = $row['no_penawaran'];

	// $approve = $revisi['approve'];

	$query = "UPDATE sales_penawaran SET
    approve = '$approved'
    WHERE no_penawaran = '$no_penawaran'
	";

	mysqli_query($conn, $query);



	$query1 = "UPDATE sales_funnel SET
	approve_presentasi = '$approved' WHERE no_penawaran = '$no_penawaran'
	";

	mysqli_query($conn, $query1);

	return mysqli_affected_rows($conn);
}
function rejectdemo($rejectdemo)
{
	global $conn;

	$no_penawaran = $rejectdemo['no_penawaran'];
	$approved = 'rejected';



	$q = mysqli_query($conn, "SELECT * FROM sales_penawaran WHERE no_penawaran = '$no_penawaran' ");
	$row = mysqli_fetch_assoc($q);

	$no_penawaran = $row['no_penawaran'];

	// $approve = $revisi['approve'];

	$query = "UPDATE sales_penawaran SET
    approve = '$approved'
    WHERE no_penawaran = '$no_penawaran'
	";

	mysqli_query($conn, $query);



	$query1 = "UPDATE sales_funnel SET
	approve_presentasi = '$approved' WHERE no_penawaran = '$no_penawaran'
	";

	mysqli_query($conn, $query1);

	return mysqli_affected_rows($conn);
}

function revisi($revisi)
{
	global $conn;

	$no_penawaran = $revisi['no_penawaran'];
	$approved = 'revisi';



	$q = mysqli_query($conn, "SELECT * FROM sales_penawaran WHERE no_penawaran = '$no_penawaran' ");
	$row = mysqli_fetch_assoc($q);

	$no_penawaran = $row['no_penawaran'];

	// $approve = $revisi['approve'];

	$query = "UPDATE sales_penawaran SET
    approve = '$approved'
    WHERE no_penawaran = '$no_penawaran'
	";

	mysqli_query($conn, $query);


	$query1 = "UPDATE sales_funnel SET
	approve = '$approved' WHERE no_penawaran = '$no_penawaran'
	";

	mysqli_query($conn, $query1);

	return mysqli_affected_rows($conn);
}

function unlock($unlock)
{
	global $conn;

	$no_penawaran = $unlock['no_penawaran'];
	// $approved = NULL;



	$q = mysqli_query($conn, "SELECT * FROM sales_penawaran WHERE no_penawaran = '$no_penawaran' ");
	$row = mysqli_fetch_assoc($q);

	$no_penawaran = $row['no_penawaran'];

	// $approve = $unlock['approve'];

	$query = "UPDATE sales_penawaran SET
    approve = NULL
    WHERE no_penawaran = '$no_penawaran'
	";

	mysqli_query($conn, $query);


	$query1 = "UPDATE sales_funnel SET
	approve = NULL
	 WHERE no_penawaran = '$no_penawaran'
	";

	mysqli_query($conn, $query1);

	return mysqli_affected_rows($conn);
}
function hapus($id)
{

	global $conn;
	// mysqli_query($conn, "DELETE FROM sales_penawaran WHERE pk_penawaran = '$id' ");
	// mysqli_query($conn, "DELETE FROM sales_order WHERE fk_penawaran = '$id' ");
	// mysqli_query($conn, "DELETE FROM sales_funnel WHERE penawaran_fk = '$id' ");

	$query1 = "UPDATE sales_penawaran SET
delete_penawaran = 'delete'
WHERE pk_penawaran = '$id'
";
	mysqli_query($conn, $query1);

	$query2 = "UPDATE sales_funnel SET
delete_funnel = 'delete'
WHERE penawaran_fk = '$id'
";
	mysqli_query($conn, $query2);

	$query3 = "UPDATE sales_order SET
delete_order = 'delete'
WHERE fk_penawaran = '$id'
";
	mysqli_query($conn, $query3);




	return mysqli_affected_rows($conn);
}
function restore($id)
{

	global $conn;


	$query1 = "UPDATE sales_penawaran SET
delete_penawaran = 'ada'
WHERE pk_penawaran = '$id'
";
	mysqli_query($conn, $query1);

	$query2 = "UPDATE sales_funnel SET
delete_funnel = 'ada'
WHERE penawaran_fk = '$id'
";
	mysqli_query($conn, $query2);

	$query3 = "UPDATE sales_order SET
delete_order = 'ada'
WHERE fk_penawaran = '$id'
";
	mysqli_query($conn, $query3);


	return mysqli_affected_rows($conn);
}


function hapusmod($id_mod)
{

	global $conn;
	mysqli_query($conn, "DELETE FROM sales_modality WHERE pk_mod = '$id_mod' ");


	return mysqli_affected_rows($conn);
}

function barangterkirim($terkirim)
{
	global $conn;
	$pk = $terkirim['pk'];
	$no_penawaran = $terkirim['no_penawaran'];

	@$kirim50 = $terkirim['kirim50'];
	@$kirim70 = $terkirim['kirim70'];
	@$kirim100 = $terkirim['kirim100'];
	// $username = $terkirim['username'];
	// $approved = 'approved';
	// $approved2 = $revisi2['approve2'];



	$q = mysqli_query($conn, "SELECT * FROM sales_penawaran WHERE no_penawaran = '$no_penawaran' ");
	$row = mysqli_fetch_assoc($q);
	$pk_penawaran = $row['pk_penawaran'];
	// $pk_cust_penawaran = $row['pk_cust_penawaran'];
	// $rs_penawaran = $row['rs_penawaran'];
	// $kota_penawaran = $row['kota_penawaran'];
	$no_penawaran = $row['no_penawaran'];
	// $pk_mod_penawaran = $row['pk_mod_penawaran'];
	// $nama_mod_penawaran = $row['nama_mod_penawaran'];
	// $model_penawaran = $row['model_penawaran'];
	// $qty = $row['qty'];
	// $harga_penawaran = $row['harga_penawaran'];
	// $status = $row['status'];

	$result = mysqli_query($conn, "SELECT * FROM sales_funnel WHERE pk = '$pk'");
	$row = mysqli_fetch_assoc($result);
	$pk_funnel = $row['penawaran_fk'];
	// $no_penawaran = $row['no_penawaran'];
	$harga_po = $row['harga_po'];
	$username = $row['username'];







	// update stock mod

	$resultorder = mysqli_query($conn, "SELECT * FROM sales_order WHERE fk_penawaran = '$pk_funnel' ");
	while ($roworder = mysqli_fetch_assoc($resultorder)) {
		$pk_order = $roworder['pk_order'];
		$fk_penawaran_order = $roworder['fk_penawaran'];
		$pk_mod_order = $roworder['pk_mod_order'];
		$qty_order = $roworder['qty_order'];


		$a = mysqli_query($conn, "SELECT * FROM sales_modality WHERE pk_mod = '$pk_mod_order' ");
		$row = mysqli_fetch_assoc($a);
		$stock_mod = $row['stock_mod'];

		if ($kirim100 == '100%') {
			$kirim = '100%';
			$kirim70 = '70%';
			$kirim50 = '50%';
			$tglterima = $terkirim['tanggal_terima'];

			$hasil = $stock_mod - $qty_order;
			$gambar = upload();
			if (!$gambar) {
				echo "<script>alert('data berhasil dimasukkan');
			document.location.href= 'edit_funnel.php?no_penawaran=$no_penawaran';
				</script>";
				return false;
			}


			$query100 = "UPDATE sales_funnel SET
			tanggal_terima = '$tglterima'
			WHERE pk = '$pk'
			";
			mysqli_query($conn, $query100);
		} elseif ($kirim70 == '70%') {
			$kirim = '70%';
			$kirim50 = '50%';
			$tglkirim = $terkirim['tanggal_kirim'];
			$gambar70 = upload1();
			if (!$gambar70) {
				echo "<script>alert('silahkan ulangi upload');
				document.location.href= 'edit_funnel.php?no_penawaran=$no_penawaran';
				</script>";
				return false;
			}

			$query70 = "UPDATE sales_funnel SET
			tanggal_kirim = '$tglkirim',
			resi_kirim = '$gambar70'
			WHERE pk = '$pk'
			";
			mysqli_query($conn, $query70);
		}

		if ($kirim == '100%') {
			$query = "UPDATE sales_funnel SET
			kirim = '$kirim',
			kirim50 = '$kirim50',
			kirim100 = '$kirim100',
			kirim70 = '$kirim70',
			resi_terima = '$gambar'
			WHERE pk = '$pk'
			";
			mysqli_query($conn, $query);


			$query2 = "UPDATE sales_modality SET 
			stock_mod = '$hasil' 
			WHERE pk_mod = '$pk_mod_order' 
			";

			mysqli_query($conn, $query2);


			// update barang terkirim pada sales targeting
			$querytargeting = "UPDATE sales_targeting SET
	pengiriman = 'terkirim'
	WHERE funnel_fk = '$pk' 
	";
			mysqli_query($conn, $querytargeting);
		} else {
			$query2 = "UPDATE sales_funnel SET
			kirim = '$kirim',
			kirim50 = '$kirim50',
			kirim70 = '$kirim70'
			WHERE pk = '$pk'
			";
			mysqli_query($conn, $query2);
		}
	}
	return mysqli_affected_rows($conn);
}

function barangterkirim2($terkirim)
{
	global $conn;
	$pk = $terkirim['pk'];
	@$kirim50 = $terkirim['kirim50'];
	@$kirim70 = $terkirim['kirim70'];
	@$kirim100 = $terkirim['kirim100'];

	// update stock mod

	$resultorder = mysqli_query($conn, "SELECT * FROM sales_order3 WHERE fk_funnel3 = '$pk' ");
	while ($roworder = mysqli_fetch_assoc($resultorder)) {
		$pk_order = $roworder['pk_order'];
		$pk_mod_order = $roworder['pk_mod_order'];
		$qty_order = $roworder['qty_order'];


		$a = mysqli_query($conn, "SELECT * FROM sales_modality WHERE pk_mod = '$pk_mod_order' ");
		$row = mysqli_fetch_assoc($a);
		$stock_mod = $row['stock_mod'];

		if ($kirim100 == '100%') {
			$kirim = '100%';
			$kirim70 = '70%';
			$kirim50 = '50%';
			$tglterima = $terkirim['tanggal_terima'];

			$hasil = $stock_mod - $qty_order;
			$gambar = upload();
			if (!$gambar) {
				echo "<script>alert('Upload Foto Gagal');
			document.location.href= 'edit_funnel.php?pk=$pk';
				</script>";
				return false;
			}


			$query100 = "UPDATE sales_funnel SET
			tanggal_terima = '$tglterima'
			WHERE pk = '$pk'
			";
			mysqli_query($conn, $query100);
		} elseif ($kirim70 == '70%') {
			$kirim = '70%';

			$tglkirim = $terkirim['tanggal_kirim'];
			$gambar70 = upload1();
			if (!$gambar70) {
				echo "<script>alert('silahkan ulangi upload');
				document.location.href= 'edit_funnel.php?pk=$pk';
				</script>";
				return false;
			}

			$query70 = "UPDATE sales_funnel SET
			tanggal_kirim = '$tglkirim',
			resi_kirim = '$gambar70'
			WHERE pk = '$pk'
			";
			mysqli_query($conn, $query70);
		}

		if ($kirim == '100%') {
			$query = "UPDATE sales_funnel SET
			kirim = '$kirim',
			kirim50 = '$kirim50',
			kirim100 = '$kirim100',
			kirim70 = '$kirim70',
			resi_terima = '$gambar'
			WHERE pk = '$pk'
			";
			mysqli_query($conn, $query);


			$query2 = "UPDATE sales_modality SET 
			stock_mod = '$hasil' 
			WHERE pk_mod = '$pk_mod_order' 
			";

			mysqli_query($conn, $query2);


			// update barang terkirim pada sales targeting
			$querytargeting = "UPDATE sales_targeting SET
	pengiriman = 'terkirim'
	WHERE funnel_fk = '$pk' 
	";
			mysqli_query($conn, $querytargeting);
		} else {
			$query2 = "UPDATE sales_funnel SET
			kirim = '$kirim',
			kirim50 = '$kirim50',
			kirim70 = '$kirim70'
			WHERE pk = '$pk'
			";
			mysqli_query($conn, $query2);
		}
	}
	return mysqli_affected_rows($conn);
}

function approve2($revisi2)
{
	global $conn;

	$pk = $revisi2['pk'];
	@$no_penawaran = $revisi2['no_penawaran'];
	$username = $revisi2['username'];
	$approved = 'approved';
	$approved2 = $revisi2['approve2'];
	// @$level = $revisi2['level'];


	$qz = mysqli_query($conn, 'SELECT MAX(pk) as user_id from sales_targeting');
	$rowz = mysqli_fetch_assoc($qz);
	$aiz = $rowz['user_id'] + 1;

	// $q = mysqli_query($conn, "SELECT * FROM sales_penawaran WHERE no_penawaran = '$no_penawaran' ");
	// $row = mysqli_fetch_assoc($q);
	// $pk_penawaran = $row['pk_penawaran'];
	// // $pk_cust_penawaran = $row['pk_cust_penawaran'];
	// // $rs_penawaran = $row['rs_penawaran'];
	// // $kota_penawaran = $row['kota_penawaran'];
	// $no_penawaran = $row['no_penawaran'];
	// // $pk_mod_penawaran = $row['pk_mod_penawaran'];
	// // $nama_mod_penawaran = $row['nama_mod_penawaran'];
	// // $model_penawaran = $row['model_penawaran'];
	// // $qty = $row['qty'];
	// // $harga_penawaran = $row['harga_penawaran'];
	// // $status = $row['status'];

	$result = mysqli_query($conn, "SELECT * FROM sales_funnel WHERE pk = '$pk'");
	$row = mysqli_fetch_assoc($result);
	$harga_po = $row['harga_po'];
	$username = $row['username'];
	$cust_fk = $row['customer_fk'];
	$tahun_targeting = $row['tahun_funnel'];

	$result2 = mysqli_query($conn, "SELECT * FROM sales_customer WHERE pk_cust = '$cust_fk'");
	$row1 = mysqli_fetch_assoc($result2);
	$rs_cust = $row1['rs_cust'];
	$kota_cust = $row1['kota_cust'];







	$query = "UPDATE sales_funnel SET
	approve2 = '$approved' 
	WHERE pk = '$pk'";
	mysqli_query($conn, $query);


	$query1 = "INSERT INTO sales_targeting(pk, funnel_fk, no_targeting, harga_po_targeting, username, approve, customer_fk, tahun_targeting)
			VALUES ('$aiz', '$pk', '$no_penawaran', '$harga_po', '$username', 'approved', '$cust_fk', '$tahun_targeting')";
	mysqli_query($conn, $query1);





	return mysqli_affected_rows($conn);
}


function reject($tolak)
{
	global $conn;

	$no_penawaran = $tolak['no_penawaran'];
	$username = $tolak['username'];
	$rejected = 'rejected';

	$result = mysqli_query($conn, "SELECT * FROM sales_penawaran WHERE no_penawaran = '$no_penawaran'");
	$row = mysqli_fetch_assoc($result);
	$penawaran_fk = $row['pk_penawaran'];


	// $approve = $revisi['approve'];
	$query = "UPDATE sales_penawaran SET
    approve = '$rejected'
    WHERE no_penawaran = '$no_penawaran'
	";

	mysqli_query($conn, $query);

	// $query1 = "INSERT INTO sales_funnel(pk, penawaran_fk, customer_fk, rs_funnel, kota_funnel, no_penawaran,  pk_mod_funnel, nama_mod_funnel, model_funnel, qty_funnel, harga_funnel, month_funnel,  budget_funnel, buy_funnel, status_funnel, start_funnel, end_funnel, username, approve) 
	// 	VALUES ('$aiz', '$pk_penawaran', '$pk_cust_penawaran', '$rs_penawaran', '$kota_penawaran', '$no_penawaran',
	// 	'$pk_mod_penawaran', '$nama_mod_penawaran', '$model_penawaran', '$qty', '$harga_penawaran', 'month', 'budget', 'On Progress', '$rejected', NOW(), '', '$username', '$approve')";

	$query1 = "UPDATE sales_funnel SET
	approve = '$rejected',
	status_funnel = 'Rejected'
	WHERE penawaran_fk = '$penawaran_fk'
	";

	mysqli_query($conn, $query1);

	return mysqli_affected_rows($conn);
}
function reject2($tolak2)
{
	global $conn;

	$pk = $tolak2['pk'];
	@$no_penawaran = $tolak2['no_penawaran'];
	$username = $tolak2['username'];
	$rejected = 'rejected';
	// @$level = $tolak2['level'];
	// $approved2 = $tolak2['approve2'];


	$qz = mysqli_query($conn, 'SELECT MAX(pk) as user_id from sales_funnel');
	$rowz = mysqli_fetch_assoc($qz);
	$aiz = $rowz['user_id'] + 1;



	$result = mysqli_query($conn, "SELECT * FROM sales_funnel WHERE pk = '$pk'");
	$row = mysqli_fetch_assoc($result);
	$no_penawaran = $row['no_penawaran'];
	$harga_po = $row['harga_po'];
	$username = $row['username'];
	@$cust_fk = $row['cust_fk'];
	$tahun_targeting = $row['tahun_funnel'];
	$penawaran_fk = $row['penawaran_fk'];







	$q = mysqli_query($conn, 'SELECT MAX(pk) as user_id from sales_targeting');
	$row = mysqli_fetch_assoc($q);
	$aiz = $row['user_id'] + 1;



	$query = "UPDATE sales_funnel SET
		approve2 = '$rejected' 
		WHERE penawaran_fk = '$penawaran_fk'";
	mysqli_query($conn, $query);




	$query1 = "INSERT INTO sales_targeting(pk, funnel_fk, no_targeting, harga_po_targeting, username, approve, customer_fk, tahun_targeting)
			VALUES ('$aiz', '$pk', '$no_penawaran', '$harga_po', '$username', 'rejected', '$cust_fk', '$tahun_targeting')";
	mysqli_query($conn, $query1);



	return mysqli_affected_rows($conn);
}

function upload()
{
	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];



	// cek apakah tidak ada gambar yang di upload

	if ($error === 4) {
		echo "<script>
	    alert('upload bukti PO!');
	    </script>";
		return false;
	}

	// cek apakah yang di upload adalah gambar
	$ekstensiGambarValid = ['pdf'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));



	if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {

		echo "<script>
        alert('Silahkan upload file dengan format PDF');
        </script>";
		return false;
	}

	// cek jika ukurannya terlalu besar
	// $ekstensiFile = [' > 441500000 '];
	// if (in_array($ukuranFile, $ekstensiFile)) {
	// 	echo "<script>
	//         alert('ukuran gambar terlalu besar !');
	//     </script>";
	// 	return false;
	// }

	// lolos pengecekan, gambar siap diupload
	// generate nama gambar baru


	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	// move_uploaded_file($tmpName, '/intimedika/pdf/' . $namaFileBaru);

	$move = move_uploaded_file($_FILES['gambar']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . "/intimedika/pdf/" . $namaFileBaru);

	if (!$move) {
		echo "<script>alert('data berhasil dimasukkan');
		document.location.href= 'view_funnel.php';
		</script>";
		die('File didnt upload');
	} else {

		echo "Upload Complete!";
	}


	return $namaFileBaru;
}

function upload1()
{
	$namaFile = $_FILES['resi_kirim']['name'];
	$ukuranFile = $_FILES['resi_kirim']['size'];
	$error = $_FILES['resi_kirim']['error'];
	$tmpName = $_FILES['resi_kirim']['tmp_name'];



	// cek apakah tidak ada gambar yang di upload

	if ($error === 4) {
		echo "<script>
	    alert('upload bukti PO!');
	    </script>";
		return false;
	}

	// cek apakah yang di upload adalah gambar
	$ekstensiGambarValid = ['pdf'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));



	if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {

		echo "<script>
        alert('Silahkan upload file dengan format PDF');
        </script>";
		return false;
	}

	// cek jika ukurannya terlalu besar
	// $ekstensiFile = [' > 441500000 '];
	// if (in_array($ukuranFile, $ekstensiFile)) {
	// 	echo "<script>
	//         alert('ukuran gambar terlalu besar !');
	//     </script>";
	// 	return false;
	// }

	// lolos pengecekan, gambar siap diupload
	// generate nama gambar baru


	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	// move_uploaded_file($tmpName, '/intimedika/pdf/' . $namaFileBaru);

	$move = move_uploaded_file($_FILES['resi_kirim']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . "/intimedika/pdf/" . $namaFileBaru);

	if (!$move) {
		echo "<script>alert('data berhasil dimasukkan');
		document.location.href= 'view_funnel.php';
		</script>";
		die('File didnt upload');
	} else {

		echo "Upload Complete!";
	}


	return $namaFileBaru;
}



function funnel($fnnl)
{
	global $conn;
	$pk = $fnnl['pk'];
	$no_penawaran = $fnnl['no_penawaran'];
	@$buy1 = $fnnl['buy1'];
	@$buy2 = $fnnl['buy2'];
	@$buy3 = $fnnl['buy3'];
	@$buy4 = $fnnl['buy4'];
	@$buy5 = $fnnl['buy5'];
	@$buy6 = $fnnl['buy6'];
	// $estimasi = $fnnl['estimasi'];

	// $day = time() + ($estimasi * 24 * 60 * 60);
	// $estimasi_d = date('d-m-Y', $day);




	// $q = mysqli_query($conn, 'SELECT MAX(pk) as user_id from sales_presentasi');
	// $row = mysqli_fetch_assoc($q);
	// $ai = $row['user_id'] + 1;







	$result = mysqli_query($conn, "SELECT * FROM sales_funnel WHERE pk = '$pk'");
	$row = mysqli_fetch_assoc($result);
	// $no_penawaran = $row['no_penawaran'];
	$penawaran_fk = $row['penawaran_fk'];


	$resultorder = mysqli_query($conn, "SELECT * FROM sales_order WHERE fk_penawaran = '$penawaran_fk' ");
	while ($roworder = mysqli_fetch_assoc($resultorder)) {

		// awal buy funnel

		$status1 = $fnnl['status1'];
		if ($buy6 == '100%') {
			// $status = 'Cold';
			$buy = '100%';
			$buy5 = '90%';
			$buy4 = '85%';
			$buy3 = '70%';
			$buy2 = '50%';
			$status = 'WIN';
			// $harga_po1 = $fnnl['harga_po'];
			// $harga_po = str_replace(".", "", $harga_po1);

			$harga_po1 = $fnnl['harga_po'];
			$harga_po2 = str_replace(".", "", $harga_po1);
			$harga_po = str_replace("Rp ", "", $harga_po2);
			@$gambar = upload();
			if (!$gambar) {
				echo "<script>alert('data berhasil dimasukkan');
			document.location.href= 'edit_funnel.php?no_penawaran=$no_penawaran';
				</script>";
				return false;
			}
			$query100 = "UPDATE sales_funnel SET
			tgl_presentasi = NULL
			WHERE pk = '$pk'
			";
			mysqli_query($conn, $query100);
		} elseif ($buy5 == '90%') {
			// $status = 'On Progress';
			$buy = '90%';
			$buy4 = '85%';
			$buy3 = '70%';
			$buy2 = '50%';

			$status = $fnnl['status'];

			$query90 = "UPDATE sales_funnel SET
			now90 = NOW(),
			tgl_presentasi = NULL
			WHERE pk = '$pk'
			";
			mysqli_query($conn, $query90);
		} elseif ($buy4 == '85%') {
			// $status = 'On Progress';
			$buy = '85%';
			$buy3 = '70%';
			$buy2 = '50%';
			$status = $fnnl['status'];

			$query85 = "UPDATE sales_funnel SET
			now85 = NOW(),
			tgl_presentasi = NULL
			WHERE pk = '$pk'
			";
			mysqli_query($conn, $query85);
		} elseif ($buy3 == '70%') {
			// $status = 'Hot';
			$buy = '70%';
			$buy2 = '50%';
			$status = $fnnl['status'];

			$query70 = "UPDATE sales_funnel SET
			now70 = NOW(),
			tgl_presentasi = NULL
			WHERE pk = '$pk'
			";
			mysqli_query($conn, $query70);
		} elseif ($buy2 == '50%') {
			// $status = 'Hold';
			$buy = '50%';
			$status = $fnnl['status'];
		} else {
			// $status = 'PO';
			$buy = '30%';
			$status = $fnnl['status'];

			$query30 = "UPDATE sales_funnel SET
			now30 = NOW()
			WHERE pk = '$pk'
			";
			mysqli_query($conn, $query30);
		}

		// akhir buy funnel



		$pk_order = $roworder['pk_order'];
		$fk_penawaran_order = $roworder['fk_penawaran'];
		$pk_mod_order = $roworder['pk_mod_order'];
		$qty_order = $roworder['qty_order'];
		$a = mysqli_query($conn, "SELECT * FROM sales_modality WHERE pk_mod = '$pk_mod_order' ");
		$row = mysqli_fetch_assoc($a);
		$stock_mod = $row['stock_mod'];

		if (($buy == '100%') && ($stock_mod < $qty_order)) {
			echo "<script>alert('stock modality tidak tersedia, silahkan hubungi admin.');
		  document.location.href= 'view_funnel.php';
		  </script>";

			return false;
		} elseif ($buy == '100%') {

			$query = "UPDATE sales_funnel SET 
			buy_funnel = '$buy',
			status_funnel = '$status',
			status2_funnel = '$status1',
			gambar = '$gambar',
			harga_po = '$harga_po',
			tgl_upload = NOW(),
			buy1 = '$buy1',
			buy2 = '$buy2',
			buy3 = '$buy3',
			buy4 = '$buy4',
			buy5 = '$buy5',
			buy6 = '$buy6'
			WHERE pk = '$pk'
		";
			mysqli_query($conn, $query);
		} else {
			$query2 = "UPDATE sales_funnel SET 
			buy_funnel = '$buy',
			status_funnel = '$status',
			status2_funnel = '$status1',
			buy1 = '$buy1',
			buy2 = '$buy2',
			buy3 = '$buy3',
			buy4 = '$buy4',
			buy5 = '$buy5'
			WHERE pk = '$pk'
		";
			mysqli_query($conn, $query2);
		}
	}

	return mysqli_affected_rows($conn);
}



function registrasi($regis)
{
	global $conn;

	// username & password
	$q = mysqli_query($conn, 'SELECT MAX(log_id) as user_id from inti_login');
	$row = mysqli_fetch_assoc($q);
	$ai = $row['user_id'] + 1;

	// data user
	$q1 = mysqli_query($conn, 'SELECT MAX(pk_user) as user_data from inti_user');

	$row1 = mysqli_fetch_assoc($q1);
	$ai1 = $row1['user_data'] + 1;

	$username = strtolower(stripslashes($regis["inputUname"]));
	$password = mysqli_real_escape_string($conn, $regis["inputPassword4"]);
	$position = strtolower($regis["inputPosition"]);
	$email = $regis["inputEmail4"];
	$name = $regis["inputNama"];
	$address = $regis["inputAddress"];
	$city = $regis["inputCity"];
	$state = $regis["inputState"];
	$zip = $regis["inputZip"];
	$targett = $regis["targett"];



	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);

	// tambahkan user kedalam database



	$query = "INSERT INTO inti_login(log_id, fk_user, username, password, level) 
	VALUES('$ai','$ai1', '$username', '$password', '$position')";

	mysqli_query($conn, $query);

	$query1 = "INSERT INTO inti_user(pk_user, username, name, email, address, city, state, zip, targett, level)
	VALUES ('$ai1', '$username', '$name', '$email', '$address', '$city', '$state', '$zip', NULL, '$position')";

	mysqli_query($conn, $query1);

	return mysqli_affected_rows($conn);
}

function updtprofile($post_profile)
{
	global $conn;

	$username = $post_profile['username'];
	$target = $post_profile['target'];
	$tahun = $post_profile['tahun1'];
	$minTarget = $post_profile['aveTarget'];

	if ($target < $minTarget) {
		echo "<script>alert('tidak memenuhi minimum target');
			  document.location.href= 'generate_tahun.php';
			  </script>";

		return false;
	} else {

		$query = "UPDATE inti_user SET
	targett = '$target',
	tahun_target = '$tahun',
	approve_target = NULL
	WHERE username = '$username'
	";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}
}

function updtprofile2($post_profile2)
{
	global $conn;

	$username = $post_profile2['username'];
	$email = $post_profile2['email'];
	$nama = $post_profile2['nama'];
	$address = $post_profile2['address'];
	$city = $post_profile2['city'];
	$state = $post_profile2['state'];
	$zip = $post_profile2['zip'];


	$query = "UPDATE inti_user SET
	email = '$email',
	name = '$nama',
	address = '$address',
	city = '$city',
	state = '$state',
	zip = '$zip'
	WHERE username = '$username'
	";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function cancel($post_cncl)
{
	global $conn;
	$pk = $post_cncl['pk'];
	$status1 = $post_cncl['status1'];
	$cancel = 'CANCEL';
	@$buy1 = $post_cncl['buy1'];
	@$buy2 = $post_cncl['buy2'];
	@$buy3 = $post_cncl['buy3'];
	@$buy4 = $post_cncl['buy4'];
	@$buy5 = $post_cncl['buy5'];
	@$buy6 = $post_cncl['buy6'];
	if ($buy5 == '90%') {
		// $status = 'On Progress';
		$buy = '90%';
	} elseif ($buy4 == '85%') {
		// $status = 'On Progress';
		$buy = '85%';
	} elseif ($buy3 == '70%') {
		// $status = 'Hot';
		$buy = '70%';
	} elseif ($buy2 == '50%') {
		// $status = 'Hold';
		$buy = '50%';
	} else {
		// $status = 'PO';
		$buy = '30%';
	}

	$query = "UPDATE sales_funnel SET 
			  buy_funnel = '$buy',
			  status_funnel = 'LOSE',
			  status2_funnel = '$status1',
		      cancel = '$cancel'
			  WHERE pk = '$pk'
	";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function approve_target($post_approve_target)
{
	global $conn;

	$username = $post_approve_target['username'];

	$query = "UPDATE inti_user SET
	approve_target = 'approved'
	WHERE username = '$username'
	";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function reject_target($post_approve_target)
{
	global $conn;

	$username = $post_approve_target['username'];

	$query = "UPDATE inti_user SET
	approve_target = 'rejected'
	WHERE username = '$username'
	";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function password($passwordid)
{
	global $conn;
	$username = $_SESSION['username'];
	$password = $passwordid["password"];
	$password_hash = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

	mysqli_query($conn, "UPDATE inti_login SET 
				password = '$password_hash'
				WHERE username = '$username'");
	return mysqli_affected_rows($conn);
}
