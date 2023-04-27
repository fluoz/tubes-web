<?php
include "../../config/koneksi.php";
$username = $_GET['username'];

$getUser = "SELECT * FROM users WHERE username = '$username'";
$getPost = "SELECT * FROM posts WHERE username = '$username'";

$queryUser = mysqli_query($conn, $getUser);
$queryPost = mysqli_query($conn, $getPost);

$dataUser = mysqli_fetch_assoc($queryUser);
$picture = "../../assets/user-black.png";

if (!empty($dataUser['profile_picture']))
$picture = "../../assets/uploads/{$dataUser['profile_picture']}";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $dataUser['username'] ?></title>
    <link rel="stylesheet" href="../../global.css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <my-navbar logo="../../assets/insta-logo.png" specific-path="../../"></my-navbar>
    <main id="main" class="mx-auto sm:px-20 px-4">
        <img class="mx-auto mt-20 w-32 rounded-full max-h-32" src="<?= $picture; ?>" alt="" />
        <h1 class="text-center font-bold text-[32px] mt-4"><?= $username ?></h1>
        <p class="text-center font-bold text-md -mt-1"><?= $dataUser['gender'] ?></p>
        <hr class="border-black my-4 border-2">

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <?php 
            while ($row = mysqli_fetch_assoc($queryPost)) {
                echo "<div class='w-full'><img class='object-cover object-center h-[400px] w-full border-black' src='../../assets/uploads/{$row['image_url']}' alt=''></div>";
            }
            ?>
        </div>
    </main>
    <script src="../../components/SideBar.js"></script>
    <script src="../../components/Navbar.js"></script>
</body>
</html>