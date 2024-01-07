<?php

session_start();

require "include/template2.inc.php";
require "include/dbms.inc.php";

global $conn;

$main = new Template("skins/admin/dtml/index.html");
$body = new Template("skins/admin/dtml/section.html");

$pagina = $_GET['pagina'];

$main->setContent('nome',$_SESSION['auth']['utente']['nome']);
$main->setContent('cognome',$_SESSION['auth']['utente']['cognome']);
$main->setContent('pagine','active');

$body->setContent('page', $pagina);

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

$section = $conn->query("SELECT s.id AS id_section, sp.ordine, s.nome AS nome_section
                          FROM section s JOIN section_pagina sp ON s.id = sp.id_section 
                                         JOIN pagina p ON sp.id_pagina = p.id WHERE p.nome='$pagina'");  

$sezioni = [];
$ordini = [];

if($section) {
    if ($section->num_rows > 0) {
        while ($row = $section->fetch_assoc()) {
                $i = $row['id_section'];
                $sezioni[$i] = $row['nome_section'];
                $ordini[$row['nome_section']] = $row['ordine'];
            }   
        }
    }

$sections = $conn->query("SELECT id, nome FROM section");
$num_sezioni = $sections->num_rows;

if ($sections) {
    if ($num_sezioni > 0) {
        while ($row2 = $sections->fetch_assoc()) {
            $nome_sezione = $row2['nome'];
            $body->setContent('pagina', $pagina);
            $body->setContent('nome_section', $nome_sezione);

            $ord = 0;

            if(array_key_exists($nome_sezione, $ordini)) {
                $ord = $ordini[$nome_sezione];
            } 

            if($ord != 0) {
                $body->setContent('ordine', 0);
            }

            for($ordine = 1;$ordine<= $num_sezioni;$ordine++) {
                if($ordine != $ord) {
                    $body->setContent('ordine', $ordine);
                }

            }

            $body->setContent('ordineSel', $ord);

        }
    }
}

$main->setContent('content',$body->get());
    
$main->close();

?>