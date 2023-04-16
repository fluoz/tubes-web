<?php
include "../config/koneksi.php";
header("Access-Control-Allow-Origin: *");

$method = $_SERVER['REQUEST_METHOD'];

if ($method == "POST") {
    $input = file_get_contents("php://input");
    $request = json_decode($input, true);

    date_default_timezone_set('Asia/Jakarta');
    $timestamp = date('Y-m-d H:i:s');   

    $sql = "INSERT INTO likes (post_id, username, created_at) VALUES ('{$request['post_id']}', '{$request['username']}', '$timestamp')";

    mysqli_query($conn, $sql);

}
if ($method == "DELETE") {
    $input = file_get_contents("php://input");
    $request = json_decode($input, true);

    $sql = "DELETE FROM likes WHERE post_id = '{$request['post_id']}' AND username = '{$request['username']}'";

    mysqli_query($conn, $sql);
}
?>