<div id="frame-tambah">
  <a href="<?php echo BASE_URL . "index.php?page=my_profile&module=barang&action=form"; ?>" class="tombol-action">+ Tambah </a>
</div>

<?php


$query = mysqli_query($koneksi, "SELECT barang.*, kategori.kategori FROM barang JOIN kategori ON barang.kategori_id = kategori.kategori_id ORDER BY nama_barang ASC");

if (mysqli_num_rows($query) == 0) {
  echo "<h3>Saat ini belum ada nama kategori di dalam table barang</h3>";
} else {

  echo "<table class='table-list'>";

  echo "<tr class='baris-title'>
				<th class='nomor'>No</th>
				<th class='kiri'>Nama</th>
				<th class='kiri'>Kategori</th>
				<th class='kiri'>Spesifikasi</th>
				<th class='tengah'>Harga</th>
				<th class='tengah'>Gambar</th>
				<th class='tengah'>Stok</th>
				<th class='tengah'>Action</th>
			 </tr>";

  $no = 1;
  while ($row = mysqli_fetch_assoc($query)) {
    $gambar = $row['gambar'];
    $gambar = "<img src='" . BASE_URL . "/images/barang/$gambar'  style='width:100px; vertical-align: middle ' />";
    echo "<tr>
					<td class='nomor'>$no</td>
					<td class='kiri'>$row[nama_barang]</td>
					<td class='kiri'>$row[kategori]</td>
					<td class='kiri'>$row[spesifikasi]</td>
          <td class='tengah'>" . rupiah($row["harga"]) . "</td>
          <td class='tengah'>$gambar</td>
          <td class='tengah'>$row[stok]</td>
					<td class='tengah'>
						<a class='tombol-action' href='" . BASE_URL . "index.php?page=my_profile&module=barang&action=form&barang_id=$row[barang_id]'>Edit</a>
					</td>
				  </tr>";

    $no++;
  }

  echo "</table>";
}

?>