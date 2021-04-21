<?php
session_start();
include_once('function/helper.php');
include_once('function/koneksi.php');
$page = isset($_GET['page']) ? $_GET['page'] : false;
$kategori_id = isset($_GET['kategori_id']) ? $_GET['kategori_id'] : false;

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;
$nama = isset($_SESSION['nama']) ? $_SESSION['nama'] : false;
$level = isset($_SESSION['level']) ? $_SESSION['level'] : false;
$keranjang = isset($_SESSION['keranjang']) ? $_SESSION['keranjang'] : array();
$totalBarang = count($keranjang);


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="<?php echo BASE_URL . "css/index.css"  ?>" type="text/css" rel="stylesheet" />
  <link href="<?php echo BASE_URL . "css/banner.css"  ?>" type="text/css" rel="stylesheet" />
  <script src="<?php echo BASE_URL . "js/jquery-3.1.1.min.js"; ?>"></script>
  <script src="<?php echo BASE_URL . "js/jquery.min.js"; ?>"></script>
  <script src="<?php echo BASE_URL . "js/Slides-SlidesJS-3/source/jquery.slides.min.js"; ?>"></script>
  <script>
    $(function() {
      $('#slides').slidesjs({
        height: 350,
        play: {
          auto: true,
          interval: 3000
        },
        navigation: false
      });
    });
  </script>
  <title>Web-Shop</title>
</head>

<body>
  <div id="container">
    <div id="header">

      <div id="menu">
        <div id="user">
          <a href=" <?php echo BASE_URL; ?> ">
            <img src="<?php echo BASE_URL . "images/logo.png"; ?>" />
          </a>

        </div>
        <div id="menus">


          <?php
          if ($user_id) {
            echo " <a href='" . BASE_URL . "index.php?page=my_profile&module=pesanan&action=list' id='nama'>Hi, <b>$nama</b></a>
            <a href='" . BASE_URL . "logout.php' id='nama'>Logout</a>";
          } else {
            echo "<a href='" . BASE_URL . "login.html'id='nama'>Login</a>
              <a href='" . BASE_URL . "register.html'id='nama'>Register</a>";
          }
          ?>


          <a href=" <?php echo BASE_URL . "keranjang.html"; ?> " id="button-keranjang">
            <?php
            if ($totalBarang != 0) {
              echo "<span style='color: white;
            text-decoration: none;
            font-weight: bold;
            text-align: right;'>$totalBarang</span>";
            }
            ?>
            <img src="<?php echo BASE_URL . "images/cart.png"; ?>" />
          </a>
        </div>
      </div>
    </div>
    <div id="content">
      <?php
      $filename = "$page.php";
      if (file_exists($filename)) {
        include_once($filename);
      } else {
        include_once('main.php');
      }
      ?>
    </div>
    <div id="footer">
      <p>Copyright</p>
    </div>
  </div>
</body>

</html>