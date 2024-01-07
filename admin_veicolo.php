<?php

session_start();

require "include/template2.inc.php";
require "include/dbms.inc.php";

global $conn;

$main = new Template("skins/admin/dtml/index.html");
$body = new Template("skins/admin/dtml/gestisci_veicolo.html");

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

$noleggi = $conn->query("SELECT COUNT(*) as numero_noleggi FROM noleggio WHERE stato <> 'Terminato'");

    if($noleggi){
        if ($noleggi->num_rows > 0) {
            $row = $noleggi->fetch_assoc();
            $main->setContent('numero_noleggi', $row['numero_noleggi']);    
        }
    }

$main->setContent('numero', $pagine->num_rows);

$id_veicolo = $_GET['id'];

$veicolo = $conn->query("SELECT * FROM veicolo WHERE id=$id_veicolo");

if($veicolo) {
    if ($veicolo->num_rows == 1) {
        while ($row = $veicolo->fetch_assoc()) {
            $body->setContent('id', $row['id']);
            $body->setContent('targa', $row['targa']);
            $body->setContent('marca', $row['marca']);
            $body->setContent('modello', $row['modello']);
            $body->setContent('km_percorsi', $row['km_percorsi']);
            $body->setContent('n_posti', $row['n_posti']);
            $body->setContent('oraria', $row['tariffa_oraria']);
            $body->setContent('giornaliera', $row['tariffa_giornaliera']);
            $body->setContent('mensile', $row['tariffa_mensile']);
            $body->setContent($row['cambio'], 'selected');
            $body->setContent($row['alimentazione'], 'selected');
            $body->setContent('descrizione', $row['descrizione']);

            $consigliato = $row['consigliato'];

            $categoria = $row['id_categoria'];

            if($consigliato == 1) {
                $body->setContent('checked', 'checked'); 
            } else {
                $body->setContent('not_checked', 'checked'); 
            }

            // Caricamento categorie
            $categorie = $conn->query("SELECT id AS id_cat, nome AS nome_cat FROM categoria");
            if ($categorie) {
                if ($categorie->num_rows > 0) {
                    while ($row = $categorie->fetch_assoc()) {
                        $body->setContent('id_cat', $row['id_cat']);
                        $body->setContent('nome_cat', $row['nome_cat']);
                        if($row['id_cat'] == $categoria) {
                            $body->setContent('selected', 'selected'); 
                        }
                    }
                }
            }

            $i = 0;
            $optional = array();
            
            $features = $conn->query("SELECT fv.id_feature FROM feature_veicolo fv WHERE fv.id_veicolo=$id_veicolo");
            if ($features) {
                if ($features->num_rows > 0) {
                    while ($row = $features->fetch_assoc()) {
                        $optional[$i++] = $row['id_feature'];
                    }
                }
            }

            // Caricamento optional "settati"
            $features = $conn->query("SELECT id AS id_feat, nome AS nome_feat FROM feature");
            if ($features) {
                if ($features->num_rows > 0) {
                    while ($row = $features->fetch_assoc()) {
                        if(in_array($row['id_feat'], $optional)) {
                            $body->setContent('id_feat', $row['id_feat']);
                            $body->setContent('nome_feat', $row['nome_feat']);
                            $body->setContent('sel', 'selected');
                        }
                    }
                }
            }

            // Caricamento optional "non settati"
            $features = $conn->query("SELECT id AS id_feat, nome AS nome_feat FROM feature");
            if ($features) {
                if ($features->num_rows > 0) {
                    while ($row = $features->fetch_assoc()) {
                        if(!in_array($row['id_feat'], $optional)) {
                            $body->setContent('id_feat', $row['id_feat']);
                            $body->setContent('nome_feat', $row['nome_feat']);
                        }
                    }
                }
            }

            }   
        }
    }

$main->setContent('content',$body->get());

$main->close();

?>