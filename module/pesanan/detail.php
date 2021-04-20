<?php
$pesanan_id = $_GET["pesanan_id"];

$query = mysqli_query($koneksi, "SELECT pesanans.nama_penerima, pesanans.nomor_telepon, pesanans.alamat, pesanans.tanggal_pemesanan, user.nama, pengiriman_detail.* FROM pesanans JOIN user ON pesanans.user_id = user.user_id JOIN pengiriman_detail ON pesanans.pesanan_id =  pengiriman_detail.pesanan_id  WHERE pesanans.pesanan_id='$pesanan_id'");

$row = mysqli_fetch_assoc($query);
$nama = $row['nama'];
$tanggal_pemesanan = $row['tanggal_pemesanan'];
$nama_penerima = $row['nama_penerima'];
$nomor_telepon = $row['nomor_telepon'];
$alamat = $row['alamat'];
$ongkir = $row['ongkir'];
$distrik = $row['distrik'];
$provinsi = $row['provinsi'];
$tipe = $row['tipe'];
$kode_pos = $row['kode_pos'];
?>

<div id="frame-faktur">

  <h3>
    Detail Pesanan
  </h3>

  <hr />

  <table>

    <tr>
      <td>Nomor Faktur</td>
      <td>:</td>
      <td><?php echo $pesanan_id; ?></td>
    </tr>
    <tr>
      <td>Nama Pemesan</td>
      <td>:</td>
      <td><?php echo $nama; ?></td>
    </tr>
    <tr>
      <td>Nama Penerima</td>
      <td>:</td>
      <td><?php echo $nama_penerima; ?></td>
    </tr>
    <tr>
      <td>Alamat</td>
      <td>:</td>
      <td><?php echo $alamat; ?>
        <?php echo $tipe; ?> <?php echo  $distrik ?>
        <?php echo  $provinsi  ?> - <?php echo $kode_pos ?>
      </td>
    </tr>
    <tr>
      <td>Nomor Telepon</td>
      <td>:</td>
      <td><?php echo $nomor_telepon; ?></td>
    </tr>
    <tr>
      <td>Tanggal Pemesanan</td>
      <td>:</td>
      <td><?php echo $tanggal_pemesanan; ?></td>
    </tr>
  </table>
</div>
<table class="table-list">

  <tr class="baris-title">
    <th class="no">No</th>
    <th class="kiri">Nama Barang</th>
    <th class="tengah">Qty</th>
    <th class="kanan">Harga Satuan</th>
    <th class="kanan">Total</th>
  </tr>
  <?php

  $queryDetail = mysqli_query($koneksi, "SELECT pesanans_detail.*, barang.nama_barang FROM pesanans_detail JOIN barang ON pesanans_detail.barang_id=barang.barang_id WHERE pesanans_detail.pesanan_id='$pesanan_id'");

  $no = 1;
  $subtotal = 0;
  while ($rowDetail = mysqli_fetch_assoc($queryDetail)) {

    $total = $rowDetail["harga"] * $rowDetail["quantity"];
    $subtotal = $subtotal + $total;

    echo "<tr>
						<td class='no'>$no</td>
						<td class='kiri'>$rowDetail[nama_barang]</td>
						<td class='tengah'>$rowDetail[quantity]</td>
						<td class='kanan'>" . rupiah($rowDetail["harga"]) . "</td>
						<td class='kanan'>" . rupiah($total) . "</td>
					  </tr>";

    $no++;
  }

  $subtotal = $subtotal + $ongkir;
  ?>

  <tr>
    <td class="kanan" colspan="4">Biaya Pengiriman</td>
    <td class="kanan"><?php echo rupiah($ongkir); ?></td>
  </tr>

  <tr>
    <td class="kanan" colspan="4"><b>Sub total</b></td>
    <td class="kanan"><b><?php echo rupiah($subtotal); ?></b></td>
  </tr>
</table>
<p>Silahkan Lakukan pembayaran ke<br /></p>
<?php
$queryBank = mysqli_query($koneksi, "SELECT * FROM akun_bank ");
while ($rowBank = mysqli_fetch_assoc($queryBank)) {

  $bank = $rowBank['bank'];
  $nomor_akun = $rowBank['nomor_akun'];
  $atas_nama = $rowBank['atas_nama'];

  echo "<div id='frame-keterangan-pembayaran'>
  <p>
    Bank : $bank <br/>
    Nomor Account : $nomor_akun  <br />
    Atas Nama : $atas_nama <br />

  </p>
</div>";

  $no++;
}

?>
Apabila telah melakukan pembayaran silahkan lakukan konfirmasi pembayaran
<a href='<?php echo BASE_URL . "index.php?page=my_profile&module=pesanan&action=konfirmasi_pembayaran&pesanan_id=$pesanan_id" ?>'>Disini</a>.