<?php

session_start();

include_once("function/koneksi.php");

$barang_id = $_POST["barang_id"];
$value = $_POST["value"];
$status = false;
$pesan = '';

$query = mysqli_query($koneksi, "SELECT stok FROM barang WHERE barang_id='$barang_id'");
$row = mysqli_fetch_array($query);

if (!$value) {
  $status = false;
  $pesan = 'Quantity tidak boleh kosong';
} else if ($value > $row['stok']) {
  $status = false;
  $pesan = 'Stok hanya ' . $row['stok'];
} else {
  $status = true;
  $keranjang = $_SESSION["keranjang"];
  $keranjang[$barang_id]["quantity"] = $value;
  $_SESSION["keranjang"] = $keranjang;
}

$arr = ['status' => $status, 'pesan' => $pesan];
$json = json_encode($arr);

echo $json;
