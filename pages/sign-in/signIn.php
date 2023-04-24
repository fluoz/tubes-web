<?php
session_start();
include "../../config/koneksi.php";

if (isset($_COOKIE['login'])) {
    $_SESSION["login"] = $_COOKIE['login'];
    $_SESSION["username"] = $_COOKIE['username'];
}

if (isset($_COOKIE['login'])) {
    header("Location: ../../index.html");
}

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $xml = simplexml_load_file('../../admins.xml');

    foreach ($xml->admin as $data) {
        if ($data->username == $username && $data->password == $password) {
            $_SESSION['login'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['admin'] = "true";
            setcookie('login', "true", time() + 3600, "/tubes-web");
            setcookie('username', $username, time() + 3600, "/tubes-web");
            setcookie('admin', "true", time() + 3600, "/tubes-web");

            header("Location: ../admin/admin.php");
        }
    }

    $md5Pass = md5($password);

    $query = "SELECT * FROM users WHERE username = '$username'";

    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_array($result);

    if ($data == null) {
        echo '
        <div style="z-index: 999;" class="popup open-popup" id="popup">
        <h2>Error!</h2>
        <p>Username tidak ada!</p>
        <button onclick="btnClicked()" type="button">Ok</button>
        </div>';
    } else if ($data["password"] != $md5Pass) {
        echo '
        <div style="z-index: 999;" class="popup open-popup" id="popup">
        <h2>Error!</h2>
        <p>Password salah!</p>
        <button onclick="btnClicked()" type="button">Ok</button>
        </div>';
    } else {

    $_SESSION['login'] = True;
    $_SESSION['username'] = $username;
    $_SESSION['profile_picture'] = $data['profile_picture'];
    $_SESSION['admin'] = "false";
    setcookie('login', "true", time() + 3600, "/tubes-web");
    setcookie('username', $username, time() + 3600, "/tubes-web");
    setcookie('profile_picture', $data['profile_picture'], time() + 3600, "/tubes-web");
    setcookie('admin', "false", time() + 3600, "/tubes-web");
    header("Location: ../../index.html");
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign In</title>
    <link rel="stylesheet" type="text/css" href="signIn.css" />
    <link rel="stylesheet" href="../../global.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        <div class="column left" style="padding: 0">
            <div class="signup">
                <div class="button-wrapper">
                    <p class="text"><strong>Don't have an account?</strong></p>
                    <a href="../sign-up/signup.php" class="signup-button"><strong>Sign up</strong></a>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="signIn">
                <div class="title-box">
                    <h1 class="title">Welcome</h1>
                    <h1 class="title" style="margin-top: 40px">to</h1>
                    <img src="../../assets/insta-logo-black.png" alt="logo" class="logo">
                </div>
                <form action="" method="POST">
                    <div class="user-box">
                        <input type="text" name="username" id="username" required />
                        <label for="name" style="color :#212121;">Username </label>
                        <br />
                        <br />
                    </div>
                    <div class="user-box">
                        <input type="password" name="password" id="password" required />
                        <label for="password" style="color :#212121;">Password</label>
                        <br />
                        <br />
                    </div>
                    <div>
                        <input type="submit" value="Sign-In" name="submit" id="submit" onclick="popupOpen()" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="popup" id="popup">
        <h2>Welcome back!</h2>
        <p>Anda telah berhasil login akun!</p>
        <button type="button" onclick="popupRemove()">Ok</button>
    </div>
    <script>
    function btnClicked() {
      document.querySelector(".popup").classList.remove("open-popup")
    }
    </script>
</body>

</html>