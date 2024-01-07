<?php

session_start();

require "include/template2.inc.php";
require "include/dbms.inc.php";

global $conn;

$main = new Template("skins/admin/dtml/index.html");
$body = new Template("skins/admin/dtml/noleggi.html");

$main->setContent('nome', $_SESSION['auth']['utente']['nome']);
$main->setContent('cognome', $_SESSION['auth']['utente']['cognome']);
$main->setContent('noleggi', 'active');

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

$noleggi = $conn->query("SELECT v.id as id_veicolo, n.id, v.targa, v.km_percorsi, u.email, n.data_ritiro, n.data_riconsegna, n.orario, n.costo, n.stato FROM noleggio n join veicolo v on v.id=id_veicolo join utente u on n.id_utente=u.id ORDER BY stato ASC, data_ritiro ASC");

if ($noleggi) {
    if ($noleggi->num_rows > 0) {
        while ($row = $noleggi->fetch_assoc()) {
            $body->setContent('id', $row['id']);
            $body->setContent('targa', $row['targa']);
            $body->setContent('email', $row['email']);
            $body->setContent('data_ritiro', date('d-m-Y', strtotime($row['data_ritiro'])));
            $body->setContent('data_riconsegna', date('d-m-Y', strtotime($row['data_riconsegna'])));
            $body->setContent('orario', date('H:i', strtotime($row['orario'])));
            $body->setContent('costo', $row['costo']);
            $body->setContent('km_percorsi', $row['km_percorsi']);
            $body->setContent('stato', $row['stato']);
            $body->setContent('id_veicolo', $row['id_veicolo']);
            $stato = $row["stato"];

            if ($stato == "Da ritirare") {
                $body->setContent('stato2', "In corso");
                $body->setContent('stato3', "Terminato");
            }

            if ($stato == "In corso") {
                $body->setContent('stato2', "Da ritirare");
                $body->setContent('stato3', "Terminato");
            }

            if ($stato == "Terminato") {
                $body->setContent('stato2', "In corso");
                $body->setContent('stato3', "Da Ritirare");
            }

        }
    }
}

$main->setContent('content', $body->get());

$main->close();

?>