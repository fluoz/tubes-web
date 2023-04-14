<?php
session_start();
session_unset();
session_destroy();
setcookie("login","",1, "/tubes-web");
?>