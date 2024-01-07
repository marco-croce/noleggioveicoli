<?php

    session_start();

    require "include/config.inc.php";
    require "include/template2.inc.php";
    require "include/dbms.inc.php";

    global $conn;

    $main = new Template("skins/admin/dtml/index.html");
    $body = new Template("skins/admin/dtml/home.html");

    $main->setContent('nome',$_SESSION['auth']['utente']['nome']);
    $main->setContent('cognome',$_SESSION['auth']['utente']['cognome']);
    $main->setContent('home','active');
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

    $veicoli = $conn->query("SELECT COUNT(*) as numero_veicoli from veicolo");

    if($veicoli){
        if ($veicoli->num_rows > 0) {
            $row = $veicoli->fetch_assoc();
            $body->setContent('numero_veicoli', $row['numero_veicoli']);      
        }
    }

    $noleggi = $conn->query("SELECT COUNT(*) as numero_noleggi FROM noleggio WHERE stato <> 'Terminato'");

    if($noleggi){
        if ($noleggi->num_rows > 0) {
            $row = $noleggi->fetch_assoc();
            $body->setContent('numero_noleggi', $row['numero_noleggi']);
            $main->setContent('numero_noleggi', $row['numero_noleggi']);    
        }
    }

    $messaggi = $conn->query("SELECT COUNT(*) as numero_messaggi from messaggio");

    if($messaggi){
        if ($messaggi->num_rows > 0) {
            $row = $messaggi->fetch_assoc();    
            $body->setContent('numero_messaggi', $row['numero_messaggi']);
        }
    }

    $profitto = $conn->query("SELECT SUM(costo) AS profitto FROM noleggio WHERE MONTH(data_ritiro) = MONTH(CURRENT_DATE()) AND YEAR(data_ritiro) = YEAR(CURRENT_DATE());");

    if($profitto){
        if ($profitto->num_rows > 0) {
            $row = $profitto->fetch_assoc();
            $body->setContent('profitto', $row['profitto']);      
        }
    }

    $noleggi = $conn->query("SELECT v.marca, v.modello, n.stato, u.nome AS nome2, u.cognome AS cognome2, u.email, n.data_ritiro, n.orario FROM veicolo v JOIN noleggio n ON v.id = n.id_veicolo 
                                                                                     JOIN utente u ON u.id = n.id_utente WHERE stato <> 'Terminato' ORDER BY stato DESC, data_ritiro ASC LIMIT 7");

    if($noleggi){
        if ($noleggi->num_rows > 0) {
            while($row = $noleggi->fetch_assoc()) {
                foreach ($row as $key => $value) {
                    if($key == 'data_ritiro')
                    $body->setContent('data_ritiro', date('d-m-Y', strtotime($row['data_ritiro'])));
                    else {
                        if($key == 'orario')
                            $body->setContent('orario', date('H:i', strtotime($row['orario'])));
                        else
                            $body->setContent($key, $value);
                    }
                }   
            }
        }
    }

    $messaggi = $conn->query("SELECT email as email1, nome as nome1, cognome as cognome1, oggetto as oggetto1, messaggio as messaggio1, data as data1 from messaggio ORDER BY data DESC LIMIT 3");

    
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