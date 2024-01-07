<?php

require "include/dbms.inc.php";

global $conn;

$titolo = $_GET['titolo'];
$valore = $_GET['valore'];
$active = $_GET['active'];
$main = $_GET['main'];

if($active == "si")
    $active = 1;
else 
    $active = 0;

if($main == "si")
    $main = 1;
else 
    $main = 0;

$query = "INSERT INTO statistica (`numero`, `titolo`, `active`, `principale`) 
                    VALUES ($valore, '$titolo', $active, $main)";

$conn->query($query);

header("Location: admin_statistiche.php");

?>