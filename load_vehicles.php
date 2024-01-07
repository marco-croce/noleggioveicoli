<?php

require "include/config.inc.php";
require "include/template2.inc.php";
require "include/dbms.inc.php";

global $conn;

$main = new Template("skins/rental/dtml/example.html");
$body = new Template("skins/rental/dtml/section/veicolo.html");


$marca = $_POST['marca'];
$cambio = $_POST['cambio'];
$alimentazione = $_POST['alimentazione'];
$categoria = $_POST['categoria'];
$prezzoDa = $_POST['prezzoDa'];
$prezzoA = $_POST['prezzoA'];

$query = "SELECT v.id, v.marca, v.modello, v.immagine, c.tariffa_giornaliera, c.nome as categoria 
          FROM veicolo v 
          JOIN categoria c ON v.id_categoria = c.id 
          WHERE 1=1 ";

// Aggiungi i filtri alla query se le variabili sono diverse da 0
if ($marca !== '0') {
    $query .= "AND v.marca = '$marca' ";
}
if ($cambio !== '0') {
    $query .= "AND v.cambio = '$cambio' ";
}
if ($alimentazione !== '0') {
    $query .= "AND v.alimentazione = '$alimentazione' ";
}
if ($categoria !== '0') {
    $query .= "AND c.nome = '$categoria' ";
}
if ($prezzoDa !== '') {
    $query .= "AND c.tariffa_giornaliera >= '$prezzoDa' ";
}
if ($prezzoA !== '') {
    $query .= "AND c.tariffa_giornaliera <= '$prezzoA' ";
}

$vehicles = $conn->query($query);

if ($vehicles) {
    if ($vehicles->num_rows > 0) {
        while ($row = $vehicles->fetch_assoc()) {
            foreach ($row as $key => $value) {
                $body->setContent($key, $value);
            }
        }
    }
} else {
    echo "Query execution failed: " . $conn->error;
}

echo $body->get();

$main->close();

?>
