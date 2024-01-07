<?php

require "include/template2.inc.php";
require "include/dbms.inc.php";

global $conn;

$body = new Template("skins/admin/dtml/row_veicolo.html");

$targa = $_POST['targa'];

if($targa == "no") {
    $query = "SELECT id, marca, modello, cambio, km_percorsi, targa
              FROM veicolo ORDER BY targa";
    $vehicles = $conn->query($query);
    if ($vehicles) {
        if ($vehicles->num_rows > 0) {
            while ($row = $vehicles->fetch_assoc()) {
                foreach ($row as $key => $value) {
                    $body->setContent($key, $value);
                    }
                }   
        }
    } 
    echo $body->get();
}
else {
    $query = "SELECT id, marca, modello, cambio, km_percorsi, targa
        FROM veicolo WHERE targa='$targa'";
    $vehicles = $conn->query($query);
    if ($vehicles) {
        if ($vehicles->num_rows == 1) {
            $row = $vehicles->fetch_assoc();
                foreach ($row as $key => $value) {
                    $body->setContent($key, $value);
                }
                echo $body->get();
        } else {
            $error = new Template("skins/admin/dtml/veicolo_not_found.html");
            echo $error->get();
        }
    }
}

?>
