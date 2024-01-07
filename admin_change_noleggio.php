<?php

require "include/dbms.inc.php";

global $conn;

$id = $_POST['noleggio'];
$stato = $_POST['stato'];
$veicolo = $_POST['veicolo'];
$km = $_POST['km'];

$query = "UPDATE noleggio SET stato='$stato' WHERE id=$id ";
$query2 = "UPDATE veicolo SET km_percorsi=$km WHERE id=$veicolo";
$conn->query($query);
$conn->query($query2);

header("Location: admin_noleggi.php");

?>