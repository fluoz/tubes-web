<?php
include "../../config/koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT profile_picture FROM users WHERE username = '{$id}'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $image_url = $row['profile_picture'];
    unlink("../../assets/uploads/" . $image_url);

    $query = "DELETE FROM users WHERE username = '{$id}'";
    mysqli_query($conn, $query);

    $query = "DELETE FROM comments WHERE username = '{$id}'";
    mysqli_query($conn, $query);

    $query = "DELETE FROM likes WHERE username = '{$id}'";
    mysqli_query($conn, $query);

    $query = "SELECT image_url FROM posts WHERE username = '{$id}'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $image_url = $row['image_url'];
    unlink("../../assets/uploads/" . $image_url);

    $query = "DELETE FROM posts WHERE username = '{$id}'";
    mysqli_query($conn, $query);
    
    header('Location: admin.php');
}

mysqli_close($conn);
?>