<?php

require "include/dbms.inc.php";

global $conn;

$id = $_POST['contatto'];
$contenuto = $_POST['contenuto'];
$collegamento = $_POST['collegamento'];

$query = "UPDATE contatto SET contenuto='$contenuto' , collegamento='$collegamento'  WHERE id=$id";
$conn->query($query);

header("Location: admin_contatti.php");

?>