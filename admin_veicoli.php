<?php

session_start();

require "include/template2.inc.php";
require "include/dbms.inc.php";

global $conn;

$main = new Template("skins/admin/dtml/index.html");
$body = new Template("skins/admin/dtml/veicoli.html");

$main->setContent('nome',$_SESSION['auth']['utente']['nome']);
$main->setContent('cognome',$_SESSION['auth']['utente']['cognome']);
$main->setContent('veicoli','active');

$pagine = $conn->query("SELECT nome as nome_pagina FROM pagina");
    
if ($pagine) {
    if ($pagine->num_rows > 0) {
        while ($row = $pagine->fetch_assoc()) {
            foreach ($row as $key => $value) {
                $main->setContent($key, $value);
            }
        }
    }
}

$main->setContent('numero', $pagine->num_rows);

$noleggi = $conn->query("SELECT COUNT(*) as numero_noleggi FROM noleggio WHERE stato <> 'Terminato'");

    if($noleggi){
        if ($noleggi->num_rows > 0) {
            $row = $noleggi->fetch_assoc();
            $main->setContent('numero_noleggi', $row['numero_noleggi']);    
        }
    }

$veicoli = $conn->query("SELECT id, marca, modello, cambio, km_percorsi, targa FROM veicolo ORDER BY targa");

if($veicoli) {
    if ($veicoli->num_rows > 0) {
        while ($row = $veicoli->fetch_assoc()) {
            foreach ($row as $key => $value) {
                $body->setContent($key, $value);
                }
            }   
        }
    }

$main->setContent('content',$body->get());

$main->close();

?>