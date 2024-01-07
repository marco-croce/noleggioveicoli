<?php

require "include/dbms.inc.php";

global $conn;

$id = $_POST['social'];
$link = $_POST['link'];

$query = "UPDATE social SET link='$link' WHERE id=$id ";

$conn->query($query);

header("Location: admin_social.php");

?>