<?php
session_start();
include "../../config/koneksi.php";

$query = "SELECT * FROM users WHERE username = '{$_COOKIE["username"]}'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_array($result);

if (isset($_COOKIE["login"])) {
  $_SESSION['login'] = $_COOKIE['login'];
  $_SESSION['username'] = $_COOKIE['username'];
} else {
  header("Location: ../sign-in/signIn.php");
}

if(isset($_POST["submit"])){
  $name = $_POST['name'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $birthdate = $_POST['birthdate'];
  $gender = $_POST['gender'];
  $fileName = $data["profile_picture"];
  $dir = "../../assets/uploads/";

  // ini aku pindahin ke atas + cek $data['profile_picture'] nya null gak
  // kalau null berarti dia gak punya gambar jadi skip aja rename gambarnya
  // terus dia rename kalau dia ganti usernamenya aja selebihnya enggak
  if ($data["profile_picture"] != null && $username != $data["username"]){
    $fileExt = explode('.', $data["profile_picture"]);
    $fileExt = strtolower(end($fileExt));
    $fileName = $username . "." . $fileExt;
    rename($dir . $data["profile_picture"], $dir . $fileName);
  }
  // ternyata harus ada empty $_FILES["filepic"]["name"] kalau isset($_FILES["filepic"]) -> ini bakal true terus
  if (!empty($_FILES["filepic"]["name"])) {   
    $fileExt = explode('.', $_FILES['filepic']['name']);  
    $fileExt = strtolower(end($fileExt));
    $fileName = $username . "." . $fileExt;
    
    $fileTmp = $_FILES['filepic']['tmp_name'];
    move_uploaded_file($fileTmp, $dir .  $fileName);
  } 

  setcookie("username", $username, time() + 3600, "/tubes-web");
  setcookie('profile_picture', $fileName, time()+3600, "/tubes-web"); // nambah ini aja

  $update = "UPDATE users SET name = '$name', username = '$username', email = '$email', birthdate = '$birthdate', gender = '$gender', profile_picture = '$fileName' WHERE username = '{$_COOKIE['username']}'";
  $result = mysqli_query($conn, $update);
  
  echo "
    <div style='z-index: 999;' class='popup open-popup' id='popup'>
      <h2>Berhasil!</h2>
      <p>Berhasil Update!</p>
      <button onclick='clickedBtn()' type='button'>Ok</button>
    </div>";
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>update account</title>
    <link rel="stylesheet" href="../../hooks/form-style.css" />
    <link rel="stylesheet" href="../../global.css" />
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body>
    <form action="" method="post" enctype="multipart/form-data">
      <h1 class="title">Update Account</h1>

      <div class="user-box">
        <input type="text" name="name" id="name" value="<?= $data['name']; ?>" />
        <label for="name" style="color: #212121">Name </label>
        <br />
        <br />
      </div>
      <div class="user-box">
        <input type="text" name="username" id="username" value="<?= $data['username']; ?>" />
        <label for="username" style="color: #212121">Username </label>
        <br />
        <br />
      </div>
      <div class="user-box">
        <input type="email" name="email" id="email" value="<?= $data['email']; ?>" />
        <label for="email" style="color: #212121">E-Mail </label>
        <br />
        <br />
      </div>
      <div class="user-box">
        <input
          type="text"
          id="birthdate" name="birthdate"
          value="<?= $data['birthdate']; ?>"
          onfocus="(this.type = 'date')"
          onblur="if(!this.value)this.type ='text'"
        />
        <label for="birth" style="color: #212121">Birthdate </label>
        <br />
        <br />
      </div>
      <div class="user-box">
          <select name="gender">
            <option value="">Select Gender</option>
            <option value="male" <?php if($data['gender'] == 'male') echo 'selected'; ?>>Male</option>
            <option value="female" <?php if($data['gender'] == 'female') echo 'selected'; ?>>Female</option>
            <option value="not" <?php if($data['gender'] == 'not') echo 'selected'; ?>>Rather not say</option>
          </select>
      </div>
      <div class="user-box">
        <input type="file" name="filepic" id="filepic" accept="image/*" />
        <label for="picture" style="color: #212121">Picture </label>
        <br />
        <br />
      </div>

      <input class="submit-btn" name="submit" type="submit" value="Update" />

      <a href="../../index.html" class="close-form">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          class="w-16 h-16 cursor-pointer absolute right-5 top-5 close-profile"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
          />
        </svg>
      </a>
    </form>
    <script>
      function clickedBtn() {
        location.href = "../../index.html";
      }
    </script>
  </body>
</html>
