<?php

session_start();

require "include/template2.inc.php";
require "include/dbms.inc.php";

global $conn;

$main = new Template("skins/admin/dtml/index.html");
$body = new Template("skins/admin/dtml/contatti.html");

$main->setContent('nome', $_SESSION['auth']['utente']['nome']);
$main->setContent('cognome', $_SESSION['auth']['utente']['cognome']);
$main->setContent('contatti', 'active');

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

$contatti = $conn->query("SELECT id as id_contatto,tipo, contenuto, collegamento from contatto ");

if ($contatti) {
    if ($contatti->num_rows > 0) {
        while ($row = $contatti->fetch_assoc()) {
            foreach ($row as $key => $value) {
                $body->setContent($key, $value);
            }
        }
    }
}

$main->setContent('content', $body->get());

$main->close();

?>