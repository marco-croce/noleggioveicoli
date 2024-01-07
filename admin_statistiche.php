<?php

session_start();

require "include/template2.inc.php";
require "include/dbms.inc.php";

global $conn;

$main = new Template("skins/admin/dtml/index.html");
$body = new Template("skins/admin/dtml/statistiche.html");

$main->setContent('nome',$_SESSION['auth']['utente']['nome']);
$main->setContent('cognome',$_SESSION['auth']['utente']['cognome']);
$main->setContent('stats','active');

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

$stats = $conn->query("SELECT id, numero, titolo, active, principale FROM statistica");

if($stats) {
    if ($stats->num_rows > 0) {
        while ($row = $stats->fetch_assoc()) {
                $body->setContent('id',$row['id']);
                $body->setContent('titolo',$row['titolo']);
                $body->setContent('numero',$row['numero']);
                if($row['active'] == 1) {
                    $body->setContent('active', 'checked');
                    $body->setContent('not_active', '');
                } else {
                    $body->setContent('not_active', 'checked');
                    $body->setContent('active', '');
                }
                if($row['principale'] == 1) {
                    $body->setContent('main', 'checked');
                    $body->setContent('not_main', '');
                } else {
                    $body->setContent('not_main', 'checked');
                    $body->setContent('main', '');
                }
            }   
        }
    }

$main->setContent('content',$body->get());

$main->close();

?>