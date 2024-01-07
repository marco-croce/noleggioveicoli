<?php

session_start();

require "include/template2.inc.php";
require "include/dbms.inc.php";

global $conn;

$main = new Template("skins/admin/dtml/index.html");
$body = new Template("skins/admin/dtml/servizi.html");

$main->setContent('nome',$_SESSION['auth']['utente']['nome']);
$main->setContent('cognome',$_SESSION['auth']['utente']['cognome']);
$main->setContent('servizi','active');

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

$servizi = $conn->query("SELECT id, nome, descrizione, active, icona FROM servizio ORDER BY nome");

if($servizi) {
    if ($servizi->num_rows > 0) {
        while ($row = $servizi->fetch_assoc()) {
            $body->setContent('id', $row['id']);
            $body->setContent('nome', $row['nome']);
            $body->setContent('descrizione', $row['descrizione']);
            if($row['active'] == 1) {
                $body->setContent('active', 'checked');
                $body->setContent('not_active', '');
            } else {
                $body->setContent('active', '');
                $body->setContent('not_active', 'checked');
            }
            $body->setContent('icona', $row['icona']);
            }   
        }
    }

$main->setContent('content',$body->get());

$main->close();

?>