<?php


define("BASE_URL", "http://localhost/web-shop/");
function direct($url)
{
  echo "<script>window.location = '$url';</script>";
}
$arrayStatusPesanan[0] = "Menunggu Pembayaran";
$arrayStatusPesanan[1] = "Pembayaran Sedang Di Validasi";
$arrayStatusPesanan[2] = "Lunas";
$arrayStatusPesanan[3] = "Pembayaran Di Tolak";

function rupiah($nilai = 0)
{
  $string = "Rp," . number_format($nilai);
  return $string;
}

function kategori($kategori_id = false)
{
  global $koneksi;

  $string = "<div id='menu-kategori'>";

  $string .= "<ul>";

  $query = mysqli_query($koneksi, "SELECT * FROM kategori WHERE status='on'");

  while ($row = mysqli_fetch_assoc($query)) {
    $kategori = strtolower($row['kategori']);
    if ($kategori_id == $row['kategori_id']) {
      $string .= "<li><a href='" . BASE_URL . "$row[kategori_id]/$kategori.html' class='active'>$row[kategori]</a></li>";
    } else {
      $string .= "<li><a href='" . BASE_URL . "$row[kategori_id]/$kategori.html'>$row[kategori]</a></li>";
    }
  }

  $string .= "</ul>";

  $string .= "</div>";

  return $string;
}
function admin_only($level, $module)
{
  if ($level != "superadmin") {
    $admin_page = array("kategori", "about", "banking", "barang", "user", "banner");
    if (in_array($module, $admin_page)) {
      header("location: " . BASE_URL);
    }
  }
}
function pagination($query, $perHalaman, $pagination, $url)
{
  global $koneksi;
  $queryHitungData = mysqli_query($koneksi, $query);

  $totalData = mysqli_num_rows($queryHitungData);
  $totalHalaman = ceil($totalData / $perHalaman);

  $batasPosisiNomor = 6;
  $batasJumlahHalaman = 10;
  $mulaiPagination = 1;
  $batasAkhirPagination = $totalHalaman;

  echo "<ul class='pagination'>";
  if ($pagination > 1) {
    $prev = $pagination - 1;

    echo "<li><a  href='" . BASE_URL . "$url&pagination=$prev' ><< Prev</a></li>";
  }
  if ($totalHalaman >= $batasJumlahHalaman) {

    if ($pagination = $batasPosisiNomor) {
      $mulaiPagination = $pagination - ($batasAkhirPagination - 1);
    }
    $batasAkhirPagination = ($mulaiPagination - 1) + $batasJumlahHalaman;
    if ($batasAkhirPagination > $totalHalaman) {
      $batasAkhirPagination = $totalHalaman;
    }
  }
  for ($i = $mulaiPagination; $i <= $batasAkhirPagination; $i++) {
    if ($pagination == $i) {
      echo "<li><a class='active' href='" . BASE_URL . "$url&pagination=$i' >$i</a></li>";
    } else {

      echo "<li><a href='" . BASE_URL . "$url&pagination=$i' >$i</a></li>";
    }
  }
  if ($pagination < $totalHalaman) {
    $next = $pagination + 1;

    echo "<li><a  href='" . BASE_URL . "$url&pagination=$next' >Next >></a></li>";
  }
  echo "</ul>";
}
