<?php
session_start();
include "../../config/koneksi.php";

if (isset($_COOKIE['login'])) {
  $_SESSION["login"] = $_COOKIE['login'];
  $_SESSION["username"] = $_COOKIE['username'];
} else {
  header("Location: ../sign-in/signIn.php");
}

if (isset($_POST['add-post'])) {
  $username = $_COOKIE['username'];
  $description = $_POST['description'];

  date_default_timezone_set('Asia/Jakarta');
  $timestamp = date('Y-m-d H:i:s');

  $fileName = uniqid() . '-' . $_FILES['image']['name'];
  $fileTmp = $_FILES['image']['tmp_name'];
  move_uploaded_file($fileTmp, '../../assets/uploads/' .  $fileName);

  $sql = "INSERT INTO posts (username, image_url, caption, created_at)
            VALUES ('$username', '$fileName', '$description', '$timestamp')";
  $result = mysqli_query($conn, $sql);

  header("Location: ../../index.html");

  mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Post</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../../global.css" />
    <link rel="stylesheet" type="text/css" href="add-post.css" />
  </head>
  <body>
    <my-navbar
      logo="../../assets/insta-logo.png"
      userImg="../../assets/user.png"
      profileLogo="../../assets/user-black.png"
    ></my-navbar>
    
    <div class="flex justify-center items-center h-[85vh]">
      <form method="POST" action="" enctype="multipart/form-data">
        <div class="flex items-center justify-between space-x-6">
          <div>
            <label class="block border-4 border-black">
              <span
                class="flex items-center justify-center w-[320px] h-[320px] text-3xl py-2 px-4 border font-semibold bg-[#fff] text-violet-700 hover:bg-violet-100 hover:cursor-pointer"
              >
                Add Image
              </span>
              <input
                type="file"
                name="image"
                accept="image/*"
                class="hidden"
                onchange="previewImage(this, 'preview')"
              />
            </label>
          </div>
          <div>
            <label>
              <span
                id="desc-box"
                class="border-4 border-black flex items-center justify-center w-[450px] h-[450px] text-3xl py-2 px-4 border font-semibold bg-[#fff] text-violet-700 hover:bg-violet-100 hover:cursor-pointer"
                onclick="showDescription()"
              >
                Add Description
              </span>
            </label>
            <textarea
              id="description"
              maxlength="1000"
              class="resize-none block border border-black p-2 w-[450px] h-[450px] hidden"
              placeholder="Add Description"
              name="description"
              onkeyup="countCharacters()"
            ></textarea>
            <div id="char-count">0/1000</div>
          </div>
        </div>
        <div class="flex justify-center">
          <input
            type="submit"
            name="add-post"
            value="Upload"
            class="border rounded-full mt-5 px-24 py-2 bg-[#5e17eb] text-[#fff] text-3xl hover:cursor-pointer hover:bg-[#8b3dff]"
          />
        </div>
      </form>
    </div>

    <script src="../../components/Navbar.js"></script>
    <script src="../../components/SideBar.js"></script>
    <script src="add-post.js"></script>  
  </body>
</html>