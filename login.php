<?php
if ($user_id) {
  direct(BASE_URL);
}
?>
<div id="container-register">
  <form action="<?php echo BASE_URL . 'proses_login.php'; ?>" method="POST">
    <?php
    $notif = isset($_GET['notif']) ? $_GET['notif'] : false;

    if ($notif == true) {
      echo "<div class='notif'>maaf, data yang kamu input tidak cocok</div>";
    }
    ?>
    <div class="element-form">
      <label for="email">Email</label>
      <span><input type="text" name="email"></span>
    </div>
    <div class="element-form">
      <label for="password">Password</label>
      <span><input type="password" name="password"></span>
    </div>
    <div class="element-form">
      <span> <input type="submit" value="login"></span>
    </div>
  </form>
</div>