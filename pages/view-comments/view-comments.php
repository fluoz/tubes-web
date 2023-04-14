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
    <link rel="stylesheet" href="view-comments.css" />
    <title>View Comments</title>
  </head>
  <body>
    <div id="popup-comment" class="popup-comment">
      <div class="popup-container">
        <div class="popup-content">
          <svg
            class="close"
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
          <p class="font-bold text-[1.5em] px-6 py-2">Comments (4)</p>
          <form action="">
            <input class="border border-black w-full" type="text" />
            <button type="submit"></button>
          </form>
          <div class="flex items-start px-6 py-2">
            <img width="35px" src="../../assets/user-black.png" alt="" />
            <div class="flex flex-col">
              <h2 class="text-base font-bold ml-4">Username</h2>
              <p class="text base ml-4 pr-10">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                enim ad minim veniam, quis nostrud exercitation ullamco laboris
                nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                nulla pariatur. Excepteur sint occaecat cupidatat non proident,
                sunt in culpa qui officia deserunt mollit anim id est laborum.
              </p>
            </div>
          </div>
          <div class="flex items-start px-6 py-2">
            <img width="35px" src="../../assets/user-black.png" alt="" />
            <div class="flex flex-col">
              <h2 class="text-base font-bold ml-4">Username</h2>
              <p class="text base ml-4 pr-10">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                enim ad minim veniam, quis nostrud exercitation ullamco laboris
                nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                nulla pariatur. Excepteur sint occaecat cupidatat non proident,
                sunt in culpa qui officia deserunt mollit anim id est laborum.
              </p>
            </div>
          </div>
          <div class="flex items-start px-6 py-2">
            <img width="35px" src="../../assets/user-black.png" alt="" />
            <div class="flex flex-col">
              <h2 class="text-base font-bold ml-4">Username</h2>
              <p class="text base ml-4 pr-10">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                enim ad minim veniam, quis nostrud exercitation ullamco laboris
                nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                nulla pariatur. Excepteur sint occaecat cupidatat non proident,
                sunt in culpa qui officia deserunt mollit anim id est laborum.
              </p>
            </div>
          </div>
          <div class="flex items-start px-6 py-2">
            <img width="35px" src="../../assets/user-black.png" alt="" />
            <div class="flex flex-col">
              <h2 class="text-base font-bold ml-4">Username</h2>
              <p class="text base ml-4 pr-10">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                enim ad minim veniam, quis nostrud exercitation ullamco laboris
                nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                nulla pariatur. Excepteur sint occaecat cupidatat non proident,
                sunt in culpa qui officia deserunt mollit anim id est laborum.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
