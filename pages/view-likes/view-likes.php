<?php
$username = $_GET["username"];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../../index.css" />
    <link rel="stylesheet" href="view-likes.css" />
    <title>View Likes</title>
  </head>
  <body>
    <div id="popup-like" class="popup-like">
      <div class="popup-container">
        <div class="popup-content">
          <svg
            class="close close-popup-like"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
          >
            <g>
              <path fill="none" d="M0 0h24v24H0z" />
              <path
                d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm0-9.414l2.828-2.829 1.415 1.415L13.414 12l2.829 2.828-1.415 1.415L12 13.414l-2.828 2.829-1.415-1.415L10.586 12 7.757 9.172l1.415-1.415L12 10.586z"
              />
            </g>
          </svg>
          <p class="font-bold text-[1.5em] px-6 py-2">Likes (8)</p>
          <div class="flex items-center px-6 py-2">
            <img width="35px" src="../../assets/user-black.png" alt="" />
            <h2 class="text-base ml-4">Username</h2>
          </div>
          <div class="flex items-center px-6 py-2">
            <img width="35px" src="../../assets/user-black.png" alt="" />
            <h2 class="text-base ml-4">Username</h2>
          </div>
          <div class="flex items-center px-6 py-2">
            <img width="35px" src="../../assets/user-black.png" alt="" />
            <h2 class="text-base ml-4">Username</h2>
          </div>
          <div class="flex items-center px-6 py-2">
            <img width="35px" src="../../assets/user-black.png" alt="" />
            <h2 class="text-base ml-4">Username</h2>
          </div>
          <div class="flex items-center px-6 py-2">
            <img width="35px" src="../../assets/user-black.png" alt="" />
            <h2 class="text-base ml-4">Username</h2>
          </div>
          <div class="flex items-center px-6 py-2">
            <img width="35px" src="../../assets/user-black.png" alt="" />
            <h2 class="text-base ml-4">Username</h2>
          </div>
          <div class="flex items-center px-6 py-2">
            <img width="35px" src="../../assets/user-black.png" alt="" />
            <h2 class="text-base ml-4">Username</h2>
          </div>
          <div class="flex items-center px-6 py-2">
            <img width="35px" src="../../assets/user-black.png" alt="" />
            <h2 class="text-base ml-4">Username</h2>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
