<?php

$barang_id = isset($_GET['barang_id']) ? $_GET['barang_id'] : false;

$kategori_id = "";
$nama_barang = "";
$spesifikasi = "";
$gambar = "";
$harga = "";
$stok = "";
$berat = "";
$keterangan = "";
$status = "";
$button = "Add";

if ($barang_id) {
  $queryBarang = mysqli_query($koneksi, "SELECT * FROM barang WHERE barang_id='$barang_id'");
  $row = mysqli_fetch_assoc($queryBarang);


  $kategori_id = $row['kategori_id'];
  $nama_barang = $row['nama_barang'];
  $spesifikasi = $row['spesifikasi'];
  $gambar = $row['gambar'];
  $harga = $row['harga'];
  $stok = $row['stok'];
  $berat = $row['berat'];
  $status = $row['status'];
  $button = "Update";

  $keterangan = "(Klik pilih file jika ingin mengganti gambar disamping)";
  $gambar = "<img src='" . BASE_URL . "/images/barang/$gambar'  style='width:200px; vertical-align: middle ' />";
}

?>

<form action="<?php echo BASE_URL . "module/barang/action.php?barang_id=$barang_id"; ?>" method="POST" enctype="multipart/form-data">

  <div class="element-form">
    <label>Kategori</label>
    <span>
      <select type="text" name="kategori_id">
        <?php
        $query = mysqli_query($koneksi, "SELECT kategori_id, kategori FROM kategori WHERE status='on' ORDER BY kategori ASC");
        while ($row = mysqli_fetch_assoc($query)) {
          if ($kategori_id == $row['kategori_id']) {

            echo "<option value='$row[kategori_id]' selected='true'>$row[kategori]</option>";
          } else {

            echo "<option value='$row[kategori_id]'>$row[kategori]</option>";
          }
        }
        ?>
      </select>
    </span>
  </div>
  <div class="element-form">
    <label>Nama Barang</label>
    <span><input type="text" name="nama_barang" value="<?php echo $nama_barang; ?>" /></span>
  </div>
  <div class="element-form">
    <label>Spesifikasi</label>
    <span><textarea type="text" id="editor" name="spesifikasi"><?php echo $spesifikasi; ?></textarea></span>
  </div>
  <div class="element-form">
    <label>Gambar <?php echo $keterangan; ?></label>
    <span><input type="file" name="gambar" /><?php echo $gambar; ?></span>
  </div>
  <div class="element-form">
    <label>Harga</label>
    <span><input type="number" name="harga" value="<?php echo $harga; ?>" /></span>
  </div>
  <div class="element-form">
    <label>Stok</label>
    <span><input type="number" name="stok" value="<?php echo $stok; ?>" /></span>
  </div>
  <div class="element-form">
    <label>Berat(g)</label>
    <span><input type="number" name="berat" value="<?php echo $berat; ?>" /></span>
  </div>

  <div class="element-form">
    <label>Status</label>
    <span>
      <input type="radio" name="status" value="on" <?php if ($status == "on") {
                                                      echo "checked='true'";
                                                    } ?> /> On
      <input type="radio" name="status" value="off" <?php if ($status == "off") {
                                                      echo "checked='true'";
                                                    } ?> /> Off
    </span>
  </div>

  <div class="element-form">
    <span><input type="submit" name="button" value="<?php echo $button; ?>" /></span>
  </div>

</form>