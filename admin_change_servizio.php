<?php

require "include/dbms.inc.php";

global $conn;

if(isset($_GET['delete'])) {
    $id_serv = $_GET['id'];
    $query = "DELETE FROM servizio WHERE id=$id_serv";
    $conn->query($query);
    header("Location: admin_servizi.php");
    exit();
}

$id_serv = $_POST['serv'];
$descrizione = htmlspecialchars($_POST['descrizione']);
$active = $_POST['active'];
$icona = $_POST['icona'];

if($active == "si")
    $active = 1;
else 
    $active = 0;

$query = "UPDATE servizio SET descrizione='$descrizione', active=$active, icona='$icona' WHERE id=$id_serv";
$conn->query($query);

header("Location: admin_servizi.php");

?>