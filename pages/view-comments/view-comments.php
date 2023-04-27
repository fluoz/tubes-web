<?php
include "../../config/koneksi.php";

$id = $_GET["id"];

if (isset($_POST["submit"])) {
  $comment = $_POST["comment"];

  date_default_timezone_set('Asia/Jakarta');
  $timestamp = date('Y-m-d H:i:s');

  $sql = "INSERT INTO comments (post_id, username, comment_text, created_at)
          VALUES ('$id', '{$_COOKIE['username']}', '$comment', '$timestamp')";
  $result = mysqli_query($conn, $sql);
}

$get = "SELECT * FROM comments WHERE post_id = '$id'";
$query = mysqli_query($conn, $get);
$data = [];

while ($a = mysqli_fetch_assoc($query)) {
  $data[] = $a;
};
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
          <a href="../../index.html?to=<?= $id; ?>">
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
          </a>
          <p class="font-bold text-[1.5em] px-6 py-2">Comments (<?=  $data == null ? 0 :  count($data); ?>)</p>
          <?php
          if (isset($_COOKIE["login"]) && $_COOKIE['admin'] != "true") {
            echo '<form action="" method="post">
            <textarea
              class="border border-black w-11/12 h-32 p-2 mx-6"
              style="resize: none"
              maxlength="500"
              onkeyup="countCharacters()"
              name="comment"
            ></textarea>
            <input
              class="border border-black px-2 mx-6 my-2 hover:cursor-pointer"
              type="submit"
              name="submit"
            />
            <div id="char-count" style="float: right; margin-right: 30px">0/500</div>
          </form>';
          } else if (isset($_COOKIE["login"]) && $_COOKIE['admin'] == "true") {
            echo "<p class='ml-6'>Admin gak boleh ngelike!</p>";
          }
          else {
            echo "<p class='ml-6'>Kalo mau nambah komen harus login dulu!</p>";
          }
          ?>
          
          <?php 
          foreach($data as $comm) {
            $getUser = "SELECT * FROM users WHERE username = '{$comm['username']}'";
            $query = mysqli_query($conn, $getUser);
            $userData =  mysqli_fetch_array($query);
            $path = "../../assets/user-black.png";
            
            if ($userData['profile_picture'] != null) {
              $path = "../../assets/uploads/" . $userData["profile_picture"];
            }
            
            echo "
            <div class='flex items-start px-6 py-2'>
              <img width='35px' class='max-h-[35px] rounded-full' src='$path' alt='' />
              <div class='flex flex-col'>
                <div class='flex items-baseline'>
                  <h2 class='text-base font-bold ml-4'>{$comm['username']}</h2>
                  <span class='text-xs ml-2'>{$comm['created_at']}</span>
                </div>
                <p class='text base ml-4 pr-10'>
                  {$comm['comment_text']}
                </p>
              </div>
            </div>";
          }
          ?>
        </div>
      </div>
    </div>
    <script>
      var textarea = document.getElementById("description");
      var charCount = document.getElementById("char-count");

      function countCharacters() {
        var text = textarea.value;
        var count = text.length;
        charCount.innerHTML = count + "/500";
      }
    </script>
  </body>
</html>
