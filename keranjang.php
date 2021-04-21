<?php
if ($totalBarang == 0) {
  echo "<h2>Saat belum anda data barang didalam kerajang anda</h2>";
} else {
  $no = 1;

  echo "<table class='table-list'>";

  echo "<tr class='baris-title'>
				<th class='nomor'>No</th>
				<th class='tengah'>Gambar</th>
				<th class='kiri'>Nama</th>
				<th class='tengah'>QTY</th>
				<th class='kiri'>Berat</th>
				<th class='kanan'>Harga</th>
				<th class='kanan'>Total</th>
			 </tr>";
  $sub_total = 0;
  $sub_berat = 0;
  foreach ($keranjang as $key => $value) {
    $barang_id = $key;

    $nama_barang = $value['nama_barang'];
    $gambar = $value['gambar'];
    $quantity = $value['quantity'];
    $harga = $value['harga'];
    $berat = $value['berat'] * $quantity;
    $total = $harga * $quantity;
    $sub_total = $sub_total + $total;
    $sub_berat = $sub_berat + $berat;

    $gambar = "<img src='" . BASE_URL . "/images/barang/$gambar'  style='width:100px; vertical-align: middle ' />";
    echo "<tr>
					<td class='nomor'>$no</td>
          <td class='tengah'>$gambar</td>
					<td class='kiri'>$nama_barang</td>
					<td class='tengah'>
          <input style='width: 80px;' type='text' name='$barang_id' value='$quantity' class='update-quantity' />
					</td>
          <td class='kiri'>$berat</td>
          <td class='kanan'>" . rupiah($harga) . "</td>
					<td class='kanan hapus_item'>" . rupiah($total) . "<a href='" . BASE_URL . "hapus_item.php?barang_id=$barang_id'>X</a></td>
          
				  </tr>";

    $no++;
  }
  echo "<tr>
				<td colspan='4' class='kanan'><b>Berat Total</b></td>
				<td class='kiri'><b>$sub_berat</b></td>
				<td class='kanan'><b>Sub Total</b></td>
				<td class='kanan'><b>" . rupiah($sub_total) . "</b></td>
				
			  </tr>";
  echo "</table>";
  echo "<div id='frame-button-keranjang'>
				<a id='lanjut-belanja' href='" . BASE_URL . "index.php'>< Lanjut Belanja</a>
				<a id='lanjut-pemesanan' href='" . BASE_URL . "data-pemesan.html'>Lanjut Pemesanan ></a>
			  </div>";
}
?>
<script>
  $(".update-quantity").on("input", function(e) {
    var barang_id = $(this).attr("name");
    var value = $(this).val();

    $.ajax({
        method: "POST",
        url: "update_keranjang.php",
        data: "barang_id=" + barang_id + "&value=" + value
      })
      .done(function(data) {
        var json = $.parseJSON(data);
        if (json.status == true) {
          location.reload();
        } else {
          alert(json.pesan);
          location.reload();
        }
      });

  });
</script>