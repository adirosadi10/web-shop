<?php
include_once('../../function/helper.php');
include_once('../../function/koneksi.php');

$pengirim_id = $_GET['pengirim_id'];
$pengirim = $_POST['pengirim'];
$phone_pengirim = $_POST['nomor_telepon'];
$email_pengirim = $_POST['email'];
$alamat_asal = $_POST['alamat'];
$kota_asal = $_POST['distrik'];
$provinsi_asal = $_POST['provinsi'];
$id_kota = $_POST['id_distrik'];





mysqli_query($koneksi, "UPDATE my_shop SET kota_id='$id_kota', pengirim='$pengirim', phone_pengirim='$phone_pengirim', email_pengirim='$email_pengirim', alamat_asal='$alamat_asal', kota_asal='$kota_asal', provinsi_asal='$provinsi_asal' WHERE pengirim_id='$pengirim_id'");


header("location:" . BASE_URL . "index.php?page=my_profile&module=about&action=list");
