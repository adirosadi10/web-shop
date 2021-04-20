<?php

$queryAbout = mysqli_query($koneksi, "SELECT * FROM my_shop");

$row = mysqli_fetch_assoc($queryAbout);
$nama_toko = $row['pengirim'];
$alamat_asal = $row['alamat_asal'];
$kota_id = $row['kota_id'];
$kota_asal = $row['kota_asal'];
$provinsi_asal = $row['provinsi_asal'];
$phone_pengirim = $row['phone_pengirim'];
$email_pengirim = $row['email_pengirim'];
?>
<div id="frame-faktur">

  <h3>
    <?php echo $nama_toko ?>
  </h3>

  <hr />

  <table>
    <td>Alamat</td>
    <td>:</td>
    <td><?php echo $alamat_asal; ?> <?php echo  $kota_asal ?>
      <?php echo  $provinsi_asal  ?>
    </td>
    </tr>
    <tr>
      <td>Nomor Telepon</td>
      <td>:</td>
      <td><?php echo $phone_pengirim; ?></td>
    </tr>
    <tr>
      <td>Email</td>
      <td>:</td>
      <td><?php echo $email_pengirim; ?></td>
    </tr>
  </table>
</div>
<?php
echo "
<div style='margin: 10px;'>
  <a class='tombol-action' href='" . BASE_URL . "index.php?page=my_profile&module=about&action=form&pengirim_id=$row[pengirim_id]" . "'>Edit</a>
</div>"
?>