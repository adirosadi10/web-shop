<?php

$akun_bank_id = isset($_GET['akun_bank_id']) ? $_GET['akun_bank_id'] : false;

$bank = "";
$nomor_akun = "";
$atas_nama = "";
$button = "Add";

if ($akun_bank_id) {
  $queryBank = mysqli_query($koneksi, "SELECT * FROM akun_bank WHERE akun_bank_id='$akun_bank_id'");
  $row = mysqli_fetch_assoc($queryBank);

  $bank = $row['bank'];
  $nomor_akun = $row['nomor_akun'];
  $atas_nama = $row['atas_nama'];
  $button = "Update";
}

?>
<form action="<?php echo BASE_URL . "module/banking/action.php?akun_bank_id=$akun_bank_id"; ?>" method="POST">

  <div class="element-form">
    <label>Bank</label>
    <span><input type="text" name="bank" value="<?php echo $bank; ?>" /></span>
  </div>
  <div class="element-form">
    <label>Nomor Akun</label>
    <span><input type="text" name="nomor_akun" value="<?php echo $nomor_akun; ?>" /></span>
  </div>
  <div class="element-form">
    <label>Atas Nama</label>
    <span><input type="text" name="atas_nama" value="<?php echo $atas_nama; ?>" /></span>
  </div>

  <div class="element-form">
    <span><input type="submit" name="button" value="<?php echo $button; ?>" /></span>
  </div>

</form>