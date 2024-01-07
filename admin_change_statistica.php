<?php

require "include/dbms.inc.php";

global $conn;

if(isset($_GET['delete'])) {
    $id_stat = $_GET['id'];
    $query = "DELETE FROM statistica WHERE id=$id_stat";
    $conn->query($query);
    header("Location: admin_statistiche.php");
    exit();
}

$id_stat = $_POST['stat'];
$main = $_POST['main'];
$active = $_POST['active'];
$numero = $_POST['numero'];

if($active == "si")
    $active = 1;
else 
    $active = 0;

if($main == "si")
    $main = 1;
else 
    $main = 0;

$query = "UPDATE statistica SET numero=$numero, active=$active, principale=$main WHERE id=$id_stat";
$conn->query($query);

header("Location: admin_statistiche.php");

?>