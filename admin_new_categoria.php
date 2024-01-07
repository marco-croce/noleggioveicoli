<?php

require "include/dbms.inc.php";

global $conn;

$nome = $_GET['nome'];
$oraria = $_GET['oraria'];
$giornaliera = $_GET['giornaliera'];
$mensile = $_GET['mensile'];

$query = "INSERT INTO categoria (`nome`, `tariffa_oraria`, `tariffa_giornaliera`, `tariffa_mensile`) 
                    VALUES ('$nome', $oraria, $giornaliera, $mensile)";

$conn->query($query);

header("Location: admin_categorie.php");

?>