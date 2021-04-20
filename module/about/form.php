<?php
$pengirim_id = isset($_GET['pengirim_id']) ? $_GET['pengirim_id'] : false;

if ($pengirim_id) {
  $queryAbout = mysqli_query($koneksi, "SELECT * FROM my_shop WHERE pengirim_id='$pengirim_id'");
  $row = mysqli_fetch_assoc($queryAbout);

  $pengirim = $row['pengirim'];
  $phone_pengirim = $row['phone_pengirim'];
  $email_pengirim = $row['email_pengirim'];
  $alamat_asal = $row['alamat_asal'];
  $kota_asal = $row['kota_asal'];
  $provinsi_asal = $row['provinsi_asal'];
}
?>

<div id="frame-data-pengiriman">
  <h3 class="label-data-pengiriman">Alamat Pengiriman Barang</h3>

  <div id="frame-form-pengiriman">

    <form class="form-data" action="<?php echo BASE_URL . "module/about/action.php?pengirim_id=$pengirim_id"; ?>" method="POST">
      <div class="form-data-kiri">

        <div class="row">


          <div class="element-form col-6">
            <label>Toko</label>
            <span><input type="text" name="pengirim" value="<?php echo $pengirim; ?>" /></span>
          </div>

          <div class="element-form col-6">
            <label>Nomor Telepon</label>
            <span><input type="text" name="nomor_telepon" value="<?php echo $phone_pengirim; ?>" /></span>
          </div>
        </div>
        <div class="element-form col-6">
          <label>Email</label>
          <span><input type="text" name="email" value="<?php echo $email_pengirim; ?>" /></span>
        </div>
        <div class="element-form">
          <label>Alamat Pengiriman</label>
          <span><textarea name="alamat"><?php echo $alamat_asal; ?></textarea></span>
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

      </div>

      <div>
        <input type="text" name="id_distrik">
        <input type="text" name="provinsi">
        <input type="text" name="distrik">
        <input type="text" name="tipe">
        <input type="text" name="kodepos">

        <div class="element-form" style="float: right;">
          <span><input type="submit" value="Update" /></span>
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

    $("select[name=nama_distrik]").on("change", function() {
      var prov = $("option:selected", this).attr('nama_provinsi');
      var dist = $("option:selected", this).attr('nama_distrik');
      var dist_id = $("option:selected", this).attr('id_distrik');
      var tipe = $("option:selected", this).attr('tipe_distrik');
      var kodepos = $("option:selected", this).attr('kodepos');

      $("input[name=provinsi]").val(prov);
      $("input[name=id_distrik]").val(dist_id);
      $("input[name=distrik]").val(dist);
      $("input[name=tipe]").val(tipe);
      $("input[name=kodepos]").val(kodepos);
    });

  });
</script>