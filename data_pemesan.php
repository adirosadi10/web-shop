<?php
if ($user_id == false) {
  $_SESSION["proses_pesanan"] = true;

  header("location: " . BASE_URL . "index.php?page=login");
  exit;
}
?>

<div id="frame-data-detail">
  <h3 class="label-data-pengiriman">Detail Order</h3>

  <div id="frame-detail-order">

    <table class="table-list">
      <tr style="border-bottom: 1px solid black;">
        <th class='kiri'>Nama Barang</th>
        <th class='tengah'>Qty</th>
        <th class='tengah'>Berat</th>
        <th class='kanan'>Total</th>
      </tr>

      <?php
      $subtotal = 0;
      $subberat = 0;
      foreach ($keranjang as $key => $value) {

        $barang_id = $key;

        $nama_barang = $value['nama_barang'];
        $harga = $value['harga'];
        $quantity = $value['quantity'];

        $berat = $value['berat'] * $quantity;
        $total = $quantity * $harga;
        $subtotal = $subtotal + $total;
        $subberat = $subberat + $berat;

        echo "<tr style='border-bottom: 1px solid black;'s>
							<td class='kiri'>$nama_barang</td>
							<td class='tengah'>$quantity</td>
							<td class='tengah'>$berat</td>
							<td class='kanan'>" . rupiah($total) . "</td>
						</tr>";
      }
      echo "<tr>
						<td colspan='2' class='kanan'><b>Sub Berat $subberat</b></td>
						
						<td  class='kanan'><b>Sub Total</b></td>
						<td class='kanan'><b>" . rupiah($subtotal) . "</b></td>
					 </tr>";

      ?>

    </table>

  </div>
</div>

<div id="frame-data-pengiriman">
  <h3 class="label-data-pengiriman">Alamat Pengiriman Barang</h3>

  <div id="frame-form-pengiriman">

    <form class="form-data" action="<?php echo BASE_URL . "proses_pesanan.php"; ?>" method="POST">
      <div class="form-data-kiri">

        <div class="row">


          <div class="element-form col-6">
            <label>Nama Penerima</label>
            <span><input type="text" name="nama_penerima" /></span>
          </div>

          <div class="element-form col-6">
            <label>Nomor Telepon</label>
            <span><input type="text" name="nomor_telepon" /></span>
          </div>
        </div>
        <div class="element-form">
          <label>Alamat Pengiriman</label>
          <span><textarea name="alamat"></textarea></span>
        </div>
      </div>
      <div class="form-data-kanan">
        <div class="row">



          <div class="element-form col-6">
            <label>Provinsi</label>
            <span>
              <select name="nama_provinsi" id="">

              </select>
            </span>
          </div>
          <div class="element-form col-6">
            <label>Kota</label>
            <span>
              <select name="nama_distrik" id="">

              </select>
            </span>
          </div>
        </div>
        <div class="row">
          <div class="element-form col-4">
            <label>Berat</label>
            <span>
              <input type="text" name="total_berat" value="<?php echo $subberat ?>">
            </span>
          </div>
          <div class="element-form col-4">
            <label>Kurir</label>
            <span>
              <select name="nama_ekspedisi" id="">

              </select>
            </span>
          </div>
          <div class="element-form col-4">
            <label>Jasa</label>
            <span>
              <select name="nama_paket" id="">

              </select>
            </span>
          </div>

        </div>
      </div>

      <div>
        <input type="text" name="provinsi">
        <input type="text" name="distrik">
        <input type="text" name="tipe">
        <input type="text" name="kodepos">
        <input type="text" name="ekspedisi">
        <input type="text" name="paket">
        <input type="text" name="ongkir">
        <input type="text" name="estimasi">

        <div class="element-form" style="float: right;">
          <span><input type="submit" value="submit" /></span>
        </div>
      </div>
    </form>
  </div>

</div>

<script>
  $(document).ready(function() {
    $.ajax({
      type: 'post',
      url: 'function/api/data_provinsi.php',
      success: function(hasil_provinsi) {
        $("select[name=nama_provinsi]").html(hasil_provinsi);
        console.log(hasil_provinsi)
      }
    });
    $("select[name=nama_provinsi]").on("change", function() {
      // Ambil id_provinsi ynag dipilih (dari atribut pribadi)
      var id_provinsi_terpilih = $("option:selected", this).attr("id_provinsi");
      $.ajax({
        type: 'post',
        url: 'function/api/data_kota.php',
        data: 'id_provinsi=' + id_provinsi_terpilih,
        success: function(hasil_distrik) {
          $("select[name=nama_distrik]").html(hasil_distrik);
        }
      })
    });
    $.ajax({
      type: 'post',
      url: 'function/api/data_ekspedisi.php',
      success: function(hasil_ekspedisi) {
        $("select[name=nama_ekspedisi]").html(hasil_ekspedisi);
      }
    });
    $("select[name=nama_ekspedisi]").on("change", function() {
      // Mendapatkan data ongkos kirim
      // Mendapatkan ekspedisi yang dipilih
      var ekspedisi_terpilih = $("select[name=nama_ekspedisi]").val();
      // Mendapatkan id_distrik yang dipilih
      var distrik_terpilih = $("option:selected", "select[name=nama_distrik]").attr("id_distrik");
      // Mendapatkan toatal berat dari inputan
      var $total_berat = $("input[name=total_berat]").val();
      $.ajax({
        type: 'post',
        url: 'function/api/data_paket.php',
        data: 'ekspedisi=' + ekspedisi_terpilih + '&distrik=' + distrik_terpilih + '&berat=' + $total_berat,
        success: function(hasil_paket) {
          // console.log(hasil_paket);
          $("select[name=nama_paket]").html(hasil_paket);
          // Meletakkan nama ekspedisi terpilih di input ekspedisi
          $("input[name=ekspedisi]").val(ekspedisi_terpilih);
        }
      })
    });
    $("select[name=nama_distrik]").on("change", function() {
      var prov = $("option:selected", this).attr('nama_provinsi');
      var dist = $("option:selected", this).attr('nama_distrik');
      var tipe = $("option:selected", this).attr('tipe_distrik');
      var kodepos = $("option:selected", this).attr('kodepos');

      $("input[name=provinsi]").val(prov);
      $("input[name=distrik]").val(dist);
      $("input[name=tipe]").val(tipe);
      $("input[name=kodepos]").val(kodepos);
    });
    $("select[name=nama_paket]").on("change", function() {
      var paket = $("option:selected", this).attr("paket");
      var ongkir = $("option:selected", this).attr("ongkir");
      var etd = $("option:selected", this).attr("etd");
      $("input[name=paket]").val(paket);
      $("input[name=ongkir]").val(ongkir);
      $("input[name=estimasi]").val(etd);
    })
  });
</script>