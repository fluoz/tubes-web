<?php
include "../config/koneksi.php";
header("Access-Control-Allow-Origin: *");

$method = $_SERVER['REQUEST_METHOD'];

if ($method == "GET") {
    $query = "SELECT * FROM posts";
    $data = [];
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_assoc($result)) {
        $get_profile = "SELECT * FROM users WHERE username = '{$row['username']}'";
        $profile = mysqli_fetch_assoc(mysqli_query($conn, $get_profile));
        $row["profile_picture"] = $profile["profile_picture"];
        $data[] = $row;
    };
    http_response_code(200);
    $res = [
        "data" => array_reverse($data),
    ];

    echo json_encode($res);

}
if ($method == "POST") {
    
}

?>