<?php

session_start();

require "include/template2.inc.php";
require "include/dbms.inc.php";

global $conn;

$main = new Template("skins/admin/dtml/index.html");
$body = new Template("skins/admin/dtml/messaggi.html");

$main->setContent('nome',$_SESSION['auth']['utente']['nome']);
$main->setContent('cognome',$_SESSION['auth']['utente']['cognome']);
$main->setContent('messaggi','active');

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

$messaggi = $conn->query("SELECT email as email1, email as email2,  nome as nome1, cognome as cognome1, oggetto as oggetto1, messaggio as messaggio1, data as data1 from messaggio ORDER BY data DESC");

if ($messaggi) {
    if ($messaggi->num_rows > 0) {
        while ($row = $messaggi->fetch_assoc()) {
            foreach ($row as $key => $value) {
                if($key == 'data1')
                    $body->setContent('data1', date('d-m-Y', strtotime($row['data1'])));
                else
                    $body->setContent($key, $value);
            }
        }
    }
}

$main->setContent('content',$body->get());

$main->close();

?>