<?php
include("../../function/koneksi.php");
include("../../function/helper.php");

$bank = $_POST['bank'];
$nomor_akun = $_POST['nomor_akun'];
$atas_nama = $_POST['atas_nama'];
$button = $_POST['button'];

if ($button == "Add") {
  mysqli_query($koneksi, "INSERT INTO akun_bank (bank, nomor_akun, atas_nama) VALUES('$bank', '$nomor_akun', '$atas_nama')");
} else if ($button == "Update") {
  $akun_bank_id = $_GET['akun_bank_id'];

  mysqli_query($koneksi, "UPDATE akun_bank SET bank='$bank',
													nomor_akun='$nomor_akun', atas_nama='$atas_nama' WHERE akun_bank_id='$akun_bank_id'");
}

header("location:" . BASE_URL . "index.php?page=my_profile&module=banking&action=list");
