<?php

class TplUtility
{

    private function getData($tpl, $conn)
    {
        switch ($tpl) {
            case "veicoli":
                $vehicles = $conn->query("SELECT v.id, v.marca, v.modello, v.immagine, c.tariffa_giornaliera, c.nome as categoria FROM veicolo v JOIN categoria c ON v.id_categoria = c.id");
                return $vehicles;
                break;
            case "carousel":
                $vehicles = $conn->query("SELECT v.id, v.marca, v.modello, v.immagine, c.nome as categoria FROM veicolo v JOIN categoria c ON v.id_categoria = c.id WHERE consigliato=1");
                return $vehicles;
                break;
            case "service":
                $services = $conn->query("SELECT nome AS servizio, descrizione, icona FROM servizio WHERE active=1");
                return $services;
                break;
            case "tariffe":
                $prices = $conn->query("SELECT v.immagine, c.id, c.nome AS nome1, c.tariffa_oraria, c.tariffa_giornaliera, c.tariffa_mensile FROM veicolo v JOIN categoria c ON v.id_categoria = c.id GROUP BY c.nome");
                return $prices;
                break;
            case "statistica":
                $stats = $conn->query("SELECT numero, titolo AS testo FROM statistica WHERE active=1 ORDER BY principale DESC");
                return $stats;
                break;
            case "noleggio":
                return "empty";
                break;
            case "welcome":
                return "empty";
                break;
            case "feedback":
                $feeds = $conn->query("SELECT u.nome AS name, u.cognome AS surname, f.id_veicolo, f.data, f.testo, v.immagine, v.marca, v.modello FROM feedback f JOIN utente u ON f.id_utente = u.id JOIN veicolo v ON v.id = f.id_veicolo WHERE active=1");
                return $feeds;
                break;
            case "richiesta":
                return "empty";
                break;
        }
        
        return "empty";
    }

    private function loadSection($page, $row, $conn)
    {
        $file = $row['file'];
        $$file = new Template("skins/rental/dtml/section/" . $file . ".html");
        $$file->setContent('nome', $row['nome']);
        $$file->setContent('titolo', $row['titolo']);

        if ($row['paragrafo'])
            $$file->setContent('paragrafo', $row['paragrafo']);
        if ($row['immagine'])
            $$file->setContent('immagine', $row['immagine']);

        $data = $this->getData($file, $conn);

        if (!$data) {
            if ($data != "empty") {
                header("location: $page.html");
                echo "Error {$conn->errno}: {$conn->error}";
                exit;
            }
        }

        if ($data != "empty") {
            if ($data->num_rows > 0) {
                while ($row = $data->fetch_assoc()) {
                    // Mostra il testo "bene" all'interno della section delle statistiche
                    if ($file == "statistica")
                        $row["testo"] = str_replace(" ", "<br>", $row["testo"]);
                    // Formattazione della data nella section dei feedback
                    if ($file == "feedback")
                        $row["data"] = date_format(date_create($row['data']), "d-m-Y");
                    // Caricamento dei dati della section all'interno del template
                    foreach ($row as $key => $value) {
                        $$file->setContent($key, $value);
                    }
                }
            }
            if ($file == "veicoli") {
                $this->loadValuesSelect($$file, $conn);
            }
        }

        return $$file;
    }

    public function loadAllSections($page, $body, $conn)
    {
        $sections = $conn->query("SELECT s.nome, s.titolo, s.file, s.immagine, s.paragrafo 
                                FROM section s JOIN section_pagina sp ON s.id = sp.id_section
                                               JOIN pagina p ON sp.id_pagina = p.id 
                                WHERE p.nome = '" . PAGINA . "' ORDER BY ordine");

        if(!$sections){
            header("location: $page.html");
            echo "Error {$conn->errno}: {$conn->error}"; exit;
        }

        if ($sections->num_rows > 0) {
            while($row = $sections->fetch_assoc()) {
    
                $tpl = $this->loadSection("$page.html", $row, $conn);
    
                $body->setContent('section', $tpl->get());
            }
        }

        return $body;
    }

    public function loadIndex($page, $main, $conn)
    {
        $socials = $conn->query("SELECT nome, link FROM social");
        $contacts = $conn->query("SELECT contenuto, icon2, collegamento FROM contatto");

        if(!$socials){
            header("location: $page.html");
            echo "Error {$conn->errno}: {$conn->error}"; exit;
        }
    
        if ($socials->num_rows > 0) {
            while($row = $socials->fetch_assoc()) {
                foreach($row as $key => $value) {
                    $main->setContent($key, $value);
                }
            }
        }
    
        if(!$contacts){
            header("location: $page.html");
            echo "Error {$conn->errno}: {$conn->error}"; exit;
        }
    
        if ($contacts->num_rows > 0) {
            while($row = $contacts->fetch_assoc()) {
                foreach($row as $key => $value) {
                    $main->setContent($key, $value);
                }
            }
        }

        if(isset($_SESSION['auth']['operazione']['login.php'])) {
            $auth = new Template("skins/rental/dtml/logout.html");
        } else {
            $auth = new Template("skins/rental/dtml/login.html");
        }

        // Mostra login oppure logout
        $main->setContent('auth', $auth->get());
        // Setta la pagina "active"
        $main->setContent($page, "active");

        return $main;
    }

    public function loadValuesSelect($page, $conn) {
        $marche = $conn->query("SELECT DISTINCT marca from veicolo");
        $cambi = $conn->query("SELECT DISTINCT cambio from veicolo");
        $alimentazioni = $conn->query("SELECT DISTINCT alimentazione FROM veicolo");
        $categorie = $conn->query("SELECT DISTINCT categoria.nome FROM veicolo join categoria on veicolo.id_categoria");
        while($rowm = $marche->fetch_assoc()) {
            foreach ($rowm as $key => $value) {
                $page->setContent('marchio1',$value);
                $page->setContent('marchio2',$value);
            }
        } 
    
        while($rowcam = $cambi->fetch_assoc()) {
            foreach ($rowcam as $key => $value) {
                $page->setContent('cambio1',$value);
                $page->setContent('cambio2',$value);
            }
        }  
    
        while($rowa = $alimentazioni->fetch_assoc()) {
            foreach ($rowa as $key => $value) {
                $page->setContent('alimentazione1',$value);
                $page->setContent('alimentazione2',$value);
            }
        }  
    
        while($rowcat = $categorie->fetch_assoc()) {
            foreach ($rowcat as $key => $value) {
                $page->setContent('categoria1',$value);
                $page->setContent('categoria2',$value);
            }
        }
    }

}
