<?php

session_start();

require "include/template2.inc.php";
require "include/dbms.inc.php";

global $conn;

$main = new Template("skins/admin/dtml/index.html");
$body = new Template("skins/admin/dtml/veicolo.html");

$main->setContent('nome',$_SESSION['auth']['utente']['nome']);
$main->setContent('cognome',$_SESSION['auth']['utente']['cognome']);
$main->setContent('veicoli', 'active');

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

$categorie = $conn->query("SELECT id AS id_cat, nome AS nome_cat FROM categoria");
    
if ($categorie) {
    if ($categorie->num_rows > 0) {
        while ($row = $categorie->fetch_assoc()) {
            foreach ($row as $key => $value) {
                $body->setContent($key, $value);
            }
        }
    }
}

$features = $conn->query("SELECT id AS id_feat, nome AS nome_feat FROM feature");
    
if ($features) {
    if ($features->num_rows > 0) {
        while ($row = $features->fetch_assoc()) {
            foreach ($row as $key => $value) {
                $body->setContent($key, $value);
            }
        }
    }
}

$main->setContent('numero', $pagine->num_rows);

$main->setContent('content',$body->get());

$main->close();

?>