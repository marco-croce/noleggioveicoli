<?php

require "include/dbms.inc.php";

global $conn;

if(isset($_GET['delete'])) {
    $id_cat = $_GET['id'];
    $query = "DELETE FROM categoria WHERE id=$id_cat";
    $conn->query($query);
    header("Location: admin_categorie.php");
    exit();
}

$id_cat = $_POST['cat'];
$oraria = $_POST['oraria'];
$giornaliera = $_POST['giornaliera'];
$mensile = $_POST['mensile'];

$query = "UPDATE categoria SET tariffa_oraria=$oraria, tariffa_giornaliera=$giornaliera, tariffa_mensile=$mensile WHERE id=$id_cat";
$conn->query($query);

header("Location: admin_categorie.php");

?>