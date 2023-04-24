<?php
include "../../config/koneksi.php";

$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

$data = "<users>";
while ($row = mysqli_fetch_array($result)){
    $data .= "<user>";
    $data .= "<username>" . $row['username'] . "</username>";
    $data .= "<name>" . $row['name'] . "</name>";
    $data .= "<email>" . $row['email'] . "</email>";
    $data .= "<birthdate>" . $row['birthdate'] . "</birthdate>";
    $data .= "<gender>" . $row['gender'] . "</gender>";
    $data .= "<password>" . $row['password'] . "</password>";
    $data .= "<profile_picture>" . $row['profile_picture'] . "</profile_picture>";
    $data .= "<created_at>" . $row['created_at'] . "</created_at>";
    $data .= "</user>";
}
$data .= "</users>";

$x = new SimpleXMLElement($data);
$x->asXML("../../users.xml");

mysqli_close($conn);

header("Location: admin.php");
?>