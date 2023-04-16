<?php
session_start();
include "../../config/koneksi.php";

if (isset($_COOKIE['login'])) {
  $_SESSION["login"] = $_COOKIE['login'];
  $_SESSION["username"] = $_COOKIE['username'];
  header("Location: ../../index.html");
}

if (isset($_POST["submit"])) {
  $name = $_POST["name"];
  $username = $_POST["username"];
  $email = $_POST["email"];
  $birth = $_POST["birth"];
  $gender = $_POST["gender"];
  $password = $_POST["password"];
  $confirmpass = $_POST["confirmpass"];
  date_default_timezone_set('Asia/Jakarta');
  $timestamp = date('Y-m-d H:i:s');
  $fileName = null;
  
  if ($password != $confirmpass) {
    echo '
    <div style="z-index: 999;" class="popup open-popup" id="popup">
      <h2>Error!</h2>
      <p>Konfirmasi Password tidak sesuai!</p>
      <button onclick="btnClicked()" type="button">Ok</button>
    </div>';
  } else {
    
    if (!empty($_FILES["filepic"]['name'])) {
      $fileExt = explode('.', $_FILES['filepic']['name']);
      $fileExt = strtolower(end($fileExt));
      $fileName = $username . "." . $fileExt;
      $fileTmp = $_FILES['filepic']['tmp_name'];
      move_uploaded_file($fileTmp, '../../assets/uploads/' .  $fileName);
    } 
  
    $md5Pass = md5($password);
  
    $query = "INSERT INTO users (username, name, email, birthdate, gender, password, profile_picture, created_at)
              VALUES ('$username', '$name', '$email', '$birth', '$gender', '$md5Pass', '$fileName', '$timestamp')";
    
    try {
      $result = mysqli_query($conn, $query);
      $_SESSION['login'] = True;
      $_SESSION['username'] = $username;
      $_SESSION['profile_picture'] = $fileName;
      setcookie('login', "true", time()+3600, "/tubes-web");
      setcookie('username', $username, time()+3600, "/tubes-web");
      setcookie('profile_picture', $fileName, time()+3600, "/tubes-web");
      header("Location: ../../index.html");
      
    } catch (Exception $e) {
      echo '
      <div style="z-index: 999;" class="popup open-popup" id="popup">
        <h2>Error!</h2>
        <p>Username atau Email udah ada!</p>
        <button onclick="btnClicked()" type="button">Ok</button>
      </div>';
    }
  
  }

}

?>

<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign-Up</title>
    <link rel="stylesheet" type="text/css" href="./signup.css" />
    <link rel="stylesheet" type="text/css" href="./formInput.css" />
    <link rel="stylesheet" href="../../global.css">
    <script src="https://cdn.tailwindcss.com"></script>
  </head>

  <body>
    <form action="" method="POST" enctype="multipart/form-data">
      <a href="../sign-in/signIn.php">
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
      <h1 class="title">Sign Up</h1>
      <div class="user-box">
        <input type="text" name="name" id="name" required />
        <label for="name" style="color: #212121">Name *</label>
        <br />
        <br />
      </div>
      <div class="user-box">
        <input type="text" name="username" id="username" maxlength="30" required />
        <label for="username" style="color: #212121">Username *</label>
        <br />
        <br />
      </div>
      <div class="user-box">
        <input type="email" name="email" id="email" required />
        <label for="email" style="color: #212121">Email *</label>
        <br />
        <br />
      </div>
      <div class="user-box">
        <input
          type="text"
          name="birth"
          id="birthDate"
          required
          onfocus="(this.type = 'date')"
          onblur="if(!this.value)this.type ='text'"
        />
        <!--agar placeholder type date tidak menabrak label-->
        <label for="birthDate" style="color: #212121">Birth Date *</label>
        <br />
        <br />
      </div>
      <div class="user-box">
        <select required name="gender">
          <option value="">Select Gender</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
          <option value="not">Rather not say</option>
        </select>
      </div>
      <div class="user-box">
        <input name="password" type="password" id="password" required />
        <label for="password" style="color: #212121">Password *</label>
        <br />
        <br />
      </div>
      <div class="user-box">
        <input name="confirmpass" type="password" id="passwordConfirmCon" required />
        <label for="passwordConfirm" style="color: #212121"
          >Password Confirmation *</label
        >
        <br />
        <br />
      </div>
      <div class="user-box">
        <input name="filepic" type="file" id="profilePic" accept="image/*" />
        <label for="profilePic" style="color: #212121">Profile Picture</label>
        <br />
        <br />
      </div>
      <div>
        <input
          type="submit"
          value="Sign-In"
          name="submit"
          class="submit-btn"
        />
      </div>
    </form>
    <script>
    function btnClicked() {
      document.querySelector(".popup").classList.remove("open-popup")
    }
    </script>
  </body>
</html>