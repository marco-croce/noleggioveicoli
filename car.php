<?php

    session_start();    

    require __DIR__ . "/TplUtility.php";
    require "include/config.inc.php";
    require "include/template2.inc.php";
    require "include/dbms.inc.php";

    $main = new Template("skins/rental/dtml/index.html");
    $body = new Template("skins/rental/dtml/car.html");

    $utility = new TplUtility();

    global $conn;

    $main = $utility->loadIndex("car", $main, $conn);

    // id del veicolo di cui mostrare le caratteristiche
    $id = $_GET['id'];
    $body->setContent("id", $id);

    // Query per i dati generali del veicolo
    $car = $conn->query("SELECT v.marca, v.modello, v.n_posti, v.cambio, v.alimentazione, v.km_percorsi, v.immagine, v.descrizione, c.nome AS categoria
                         FROM veicolo v JOIN categoria c ON v.id_categoria = c.id WHERE v.id=$id");
    // Query per le features che il veicolo possiede
    $features = $conn->query("SELECT id_feature FROM feature_veicolo WHERE id_veicolo=$id");
    // Query per ottenere tutte le possibili feature che un veicolo può possedere
    $all = $conn->query("SELECT nome FROM feature");
    // Query per ottenere il numero di recensioni associate al veicolo
    $number = $conn->query("SELECT COUNT(*) AS numero FROM feedback WHERE id_veicolo=$id");
    // Query per ottenere i dati relativi ad ogni feedback associati al veicolo
    $feeds = $conn->query("SELECT u.nome AS name, u.cognome AS surname, f.data AS date, f.testo, f.stelle FROM feedback f JOIN utente u ON f.id_utente = u.id JOIN veicolo v ON v.id = f.id_veicolo WHERE v.id=$id");

    // Array associativo per le memorizzare quali features il veicolo possiede
    $feature_veicolo = array();

    if(!$car){
        header("location: car.html");
        echo "Error {$conn->errno}: {$conn->error}"; exit;
    }

    if ($car->num_rows == 1) {
        $row = $car->fetch_all(MYSQLI_ASSOC); 
        foreach($row as $attr) {
            $body->setContent("marca", $attr['marca']);
            $body->setContent("modello", $attr['modello']);
            $body->setContent("n_posti", $attr['n_posti']);
            $body->setContent("cambio", $attr['cambio']);
            $body->setContent("alimentazione", $attr['alimentazione']);
            $body->setContent("km_percorsi", $attr['km_percorsi']);
            $body->setContent("descrizione", $attr['descrizione']);
            $body->setContent("immagine", $attr['immagine']);
            $body->setContent("categoria", $attr['categoria']);
        }
    }

    if(!$all){
        header("location: car.html");
        echo "Error {$conn->errno}: {$conn->error}"; exit;
    }

    if ($all->num_rows > 0) {
        while($row = $all->fetch_assoc()) {
            $feature_veicolo[$row['nome']] = "remove"; // feature NO
        }
    }

    if(!$features){
        header("location: car.html");
        echo "Error {$conn->errno}: {$conn->error}"; exit;
    }

    if ($features->num_rows > 0) {
        while($row = $features->fetch_assoc()) {
            $id_feature = $row['id_feature'];
            $feature = $conn->query("SELECT nome FROM feature WHERE id=$id_feature");
            $row2 = $feature->fetch_assoc();
            $feature_veicolo[$row2['nome']] = "check"; // feature SI
        }
    }

    $nomi = array_keys($feature_veicolo); 
    
    for($i=0; $i < count($feature_veicolo); ++$i) { 
        if($feature_veicolo[$nomi[$i]] == "check"){
            $body->setContent("simbolo", "checkmark"); // Carica V
        } else {
            $body->setContent("simbolo", "close"); // Carica X
        }
        $body->setContent("check", $feature_veicolo[$nomi[$i]]);
        $body->setContent("feature", $nomi[$i]);
    } 

    if(!$number){
        header("location: car.html");
        echo "Error {$conn->errno}: {$conn->error}"; exit;
    }

    if ($number->num_rows > 0) {
        $row = $number->fetch_assoc();
        $body->setContent("numero", $row['numero']);
    }

    if(!$feeds){
        header("location: car.html");
        echo "Error {$conn->errno}: {$conn->error}"; exit;
    }

    if ($feeds->num_rows > 0) {
        while($row = $feeds->fetch_assoc()) {
            foreach ($row as $key => $value) {
                $body->setContent($key, $value);
            }
            // Caricamento data formattata
            $date = date_create($row['date']);
            $body->setContent('data',date_format($date, "d-m-Y"));
            // Caricamento numero di stelle del feedback
            $stelle = $row['stelle'];
            while($stelle != 0) {
                $body->setContent('star',"star");
                $stelle = $stelle - 1;
            }
        }
    } else {
        $body->setContent('name','');
        $body->setContent('surname','');
        $body->setContent('star',"");
    }

    $main->setContent('body', $body->get());
    $main->close();

?>