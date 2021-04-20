<div id="frame-tambah">
  <a href="<?php echo BASE_URL . "index.php?page=my_profile&module=banking&action=form"; ?>" class="tombol-action">+ Tambah </a>
</div>
<?php
$no = 1;

$queryBank = mysqli_query($koneksi, "SELECT * FROM akun_bank");

if (mysqli_num_rows($queryBank) == 0) {
  echo "<h3>Saat ini belum ada data banking yang dimasukan</h3>";
} else {
  echo "<table class='table-list'>";

  echo "<tr class='baris-title'>
                    <th class='kolom-nomor'>No</th>
                    <th class='kiri'>Bank</th>
                    <th class='kiri'>Nomer Rekening</th>
                    <th class='kiri'>Atas Nama</th>
                    <th class='tengah'h>Action</th>
                 </tr>";

  while ($rowBank = mysqli_fetch_array($queryBank)) {
    echo "<tr>
                        <td class='kolom-nomor'>$no</td>
                        <td>$rowBank[bank]</td>
                        <td>$rowBank[nomor_akun]</td>
                        <td>$rowBank[atas_nama]</td>
                        <td class='tengah'><a class='tombol-action' href='" . BASE_URL . "index.php?page=my_profile&module=banking&action=form&akun_bank_id=$rowBank[akun_bank_id]" . "'>Edit</a></td>
                     </tr>";

    $no++;
  }

  //AKHIR DARI TABLE
  echo "</table>";
}
