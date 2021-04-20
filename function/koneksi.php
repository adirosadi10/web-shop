<?php 
  $server ="localhost";
  $username = "root";
  $password = "";
  $database = "web-shop";

  $koneksi = mysqli_connect($server, $username, $password, $database) or die ('konek gagal');
