<?php

include_once("../../function/koneksi.php");
include_once("../../function/helper.php");

session_start();

$pesanan_id = $_GET["pesanan_id"];
$button = $_POST["button"];

if ($button === "Konfirmasi") {

	$user_id = $_SESSION["user_id"];
	$bank_account = $_POST['bank_account'];
	$nomor_rekening = $_POST['nomor_rekening'];
	$nama_account = $_POST['nama_account'];
	$tanggal_transfer = $_POST['tanggal_transfer'];
	$update_gambar = "";

	if (!empty($_FILES["bukti-transfer"]["name"])) {
		$nama_file = $_FILES["bukti-transfer"]["name"];
		move_uploaded_file($_FILES["bukti-transfer"]["tmp_name"], "../../images/konfirmasi/" . $nama_file);

		$update_gambar = ", bukti-transfer='$nama_file'";
	}

	$queryPembayaran = mysqli_query($koneksi, "INSERT INTO `konfirmasie_pembayaran`( `pesanan_id`, `bank_account`, `nomor_akun`, `nama_account`, `bukti_transfer`, `tanggal_transfer`)
		VALUES ('$pesanan_id','$bank_account', '$nomor_rekening', '$nama_account', '$nama_file', '$tanggal_transfer')");

	if ($queryPembayaran) {
		mysqli_query($koneksi, "UPDATE pesanans SET status='1' WHERE pesanan_id='$pesanan_id'");
	}
} else if ($button == "Edit Status") {
	$status = $_POST["status"];

	mysqli_query($koneksi, "UPDATE pesanans SET status='$status' WHERE pesanan_id='$pesanan_id'");

	if ($status == "2") {
		$query = mysqli_query($koneksi, "SELECT * FROM pesanans_detail WHERE pesanan_id='$pesanan_id'");
		while ($row = mysqli_fetch_assoc($query)) {
			$barang_id = $row["barang_id"];
			$quantity = $row["quantity"];

			mysqli_query($koneksi, "UPDATE barang SET stok=stok-$quantity WHERE barang_id='$barang_id'");
		}
	}
}
header("location:" . BASE_URL . "index.php?page=my_profile&module=pesanan&action=list");
