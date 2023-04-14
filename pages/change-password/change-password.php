<?php
session_start();
include "../../config/koneksi.php";

if (isset($_COOKIE["login"])) {
  $_SESSION['login'] = $_COOKIE['login'];
  $_SESSION['username'] = $_COOKIE['username'];
} else {
  header("Location: ../sign-in/signIn.php");
}

if (isset($_POST['submit'])) {
  $old_password = $_POST['old_password'];
  $new_password = $_POST['new_password'];
  $confirm_password = $_POST['confirm_password'];

  $query = "SELECT * FROM users WHERE username = '{$_COOKIE['username']}'";

  $result = mysqli_query($conn, $query);
  $data = mysqli_fetch_array($result);
  if ($data["password"] == md5($old_password)) {
    if ($new_password == $confirm_password) {
      $newPass = md5($new_password);
      $update = "UPDATE users SET password = '$newPass' WHERE username = '{$_COOKIE['username']}'";
      $result = mysqli_query($conn, $update);
      header("Location: ../../index.html"); 
    } else {
      echo '
        <div style="z-index: 999;" class="popup open-popup" id="popup">
          <h2>Error!</h2>
          <p>Konfirmasi Password tidak sesuai!</p>
          <button onclick="btnClicked()" type="button">Ok</button>
        </div>';
    }
  } else {
    echo '
        <div style="z-index: 999;" class="popup open-popup" id="popup">
          <h2>Error!</h2>
          <p>Old password salah!</p>
          <button onclick="btnClicked()" type="button">Ok</button>
        </div>';
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>change password</title>
  <link rel="stylesheet" href="../../hooks/form-style.css" />
  <link rel="stylesheet" href="../../global.css" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <form action="" method="post">
    <h1 class="title">Change Password</h1>

    <div class="user-box">
      <input type="password" name="old_password" id="old_password" required />
      <label for="old_password" style="color: #212121">Old Password </label>
      <br />
      <br />
    </div>

    <div class="user-box">
      <input type="password" name="new_password" id="new_password" required />
      <label for="new_password" style="color: #212121">New Password </label>
      <br />
      <br />
    </div>

    <div class="user-box">
      <input type="password" name="confirm_password" id="confirm_password" required />
      <label for="confirm_password" style="color: #212121">Confirm Password
      </label>
      <br />
      <br />
    </div>

    <input class="submit-btn" name="submit" type="submit" value="Change Password" />
    <a href="../../index.html" class="close-form">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 cursor-pointer absolute right-5 top-5 close-profile">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
    </a>
  </form>
  <script>
    function btnClicked() {
      document.querySelector(".popup").classList.remove("open-popup")
    }
    </script>
</body>

</html>