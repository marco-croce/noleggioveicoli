<?php

session_start();

require "include/template2.inc.php";
require "include/dbms.inc.php";

global $conn;

$main = new Template("skins/admin/dtml/index.html");
$body = new Template("skins/admin/dtml/categoria.html");

$main->setContent('nome',$_SESSION['auth']['utente']['nome']);
$main->setContent('cognome',$_SESSION['auth']['utente']['cognome']);
$main->setContent('categorie', 'active');

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

$main->setContent('content',$body->get());

$main->close();

?>