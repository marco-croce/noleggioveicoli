<?php

require "include/dbms.inc.php";

global $conn;

$nome = $_GET['nome'];
$descrizione = htmlspecialchars($_GET['descrizione']);
$active = $_GET['active'];
$icona = $_GET['icona'];

if($active == "si")
    $active = 1;
else 
    $active = 0;

$query = "INSERT INTO servizio (`nome`, `descrizione`, `active`, `icona`) 
                    VALUES ('$nome', '$descrizione', $active, '$icona')";

$conn->query($query);

header("Location: admin_servizi.php");

?>