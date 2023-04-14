<?php
include "config/koneksi.php";
header("Access-Control-Allow-Origin: *");

$method = $_SERVER['REQUEST_METHOD'];

if ($method == "GET") {
    $query = "SELECT * FROM posts";

    $data = mysqli_query($conn, $query);
    http_response_code(200);
    $res = [
        "data" => mysqli_fetch_array($data)
    ];

    echo json_encode($res);

}

?>