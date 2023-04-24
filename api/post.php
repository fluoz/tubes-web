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
        $row['liked'] = false;
        $row["profile_picture"] = $profile["profile_picture"];
        $data[] = $row;
    };

    if (isset($_COOKIE['login'])) {
        $queryLikes = "SELECT * FROM likes WHERE username = '{$_COOKIE['username']}'";
        $result = mysqli_query($conn, $queryLikes);

        while($row = mysqli_fetch_assoc($result)) {
            foreach($data as &$x) {
                if ($x['id'] == $row["post_id"]) {  
                    $x['liked'] = true;
                    break;
                }
            }
        }

    }

    http_response_code(200);
    $res = [
        "data" => array_reverse($data),
    ];

    echo json_encode($res);

}

if ($method == "DELETE") {
    $input = file_get_contents("php://input");
    $request = json_decode($input, true);

    $post_id = $request['post_id'];

    $query = "DELETE FROM comments WHERE post_id = '{$post_id}'";
    mysqli_query($conn, $query);

    $query = "DELETE FROM likes WHERE post_id = '{$post_id}'";
    mysqli_query($conn, $query);

    $query = "SELECT image_url FROM posts WHERE id = '{$post_id}'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $image_url = $row['image_url'];

    unlink("../assets/uploads/" . $image_url);

    $query = "DELETE FROM posts WHERE id = '{$post_id}'";
    mysqli_query($conn, $query);
}
?>