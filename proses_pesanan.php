<?php
include_once('function/helper.php');
include_once('function/koneksi.php');
session_start();

$nama_penerima = $_POST['nama_penerima'];
$nomor_telepon = $_POST['nomor_telepon'];
$alamat = $_POST['alamat'];

$nama_distrik = $_POST['nama_distrik'];

$total_berat = $_POST['total_berat'];
$provinsi = $_POST['provinsi'];
$distrik = $_POST['distrik'];
$tipe = $_POST['tipe'];
$kodepos = $_POST['kodepos'];
$ekspedisi = $_POST['ekspedisi'];
$paket = $_POST['paket'];
$ongkir = $_POST['ongkir'];
$estimasi = $_POST['estimasi'];


$user_id = $_SESSION['user_id'];
$waktu_saat_ini = date("Y-m-d H:i:s");

$query = mysqli_query($koneksi, "INSERT INTO pesanans (user_id, nama_penerima,  nomor_telepon,  alamat, tanggal_pemesanan, status)
												VALUES ( '$user_id','$nama_penerima', '$nomor_telepon',  '$alamat', '$waktu_saat_ini', '0')");


$last_pesanan_id = mysqli_insert_id($koneksi);

$keranjang = $_SESSION['keranjang'];




foreach ($keranjang as $key => $value) {
  $barang_id = $key;
  $quantity = $value['quantity'];
  $harga = $value['harga'];

  $query = mysqli_query($koneksi, "INSERT INTO pesanans_detail(pesanan_id, barang_id, quantity, harga)
											   VALUES ('$last_pesanan_id', '$barang_id', '$quantity', '$harga')");
}

$query = mysqli_query($koneksi, "INSERT INTO pengiriman_detail(pesanan_id, provinsi, distrik, tipe,kode_pos,kurir,paket,berat,ongkir,estimasi)
												   VALUES ('$last_pesanan_id', '$provinsi', '$distrik', '$tipe','$kodepos','$ekspedisi','$paket','$total_berat','$ongkir','$estimasi')");
unset($_SESSION["keranjang"]);

header("location:" . BASE_URL . "index.php?page=my_profile&module=pesanan&action=detail&pesanan_id=$last_pesanan_id");
