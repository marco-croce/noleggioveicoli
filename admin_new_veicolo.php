<?php

require "include/dbms.inc.php";

global $conn;

$imgDirectory = __DIR__.'\skins\rental\assets\images';

$targa = $_POST['targa'];
$marca = $_POST['marca'];
$modello = $_POST['modello'];
$km = $_POST['chilometri'];
$posti = $_POST['posti'];
$oraria = $_POST['oraria'];
$cambio = $_POST['cambio'];
$alimentazione = $_POST['alimentazione'];
$categoria = $_POST['categoria'];
$giornaliera = $_POST['giornaliera'];
$mensile = $_POST['mensile'];
$descrizione = htmlspecialchars($_POST['descrizione']);
$consigliato = $_POST['active'];


foreach ($_FILES as $file) {
    if (UPLOAD_ERR_OK === $file['error']) {
        $fileName = basename($file['name']); 
        move_uploaded_file($file['tmp_name'], $imgDirectory.DIRECTORY_SEPARATOR.$fileName);
    }
}

if($consigliato == "si")
    $consigliato = 1;
else 
    $consigliato = 0;


$query = "INSERT INTO veicolo (`marca`, `modello`, `n_posti`, `cambio`, `alimentazione`, `km_percorsi`, `targa`, `immagine`, `descrizione`, `tariffa_oraria`, `tariffa_giornaliera`, `tariffa_mensile`, `consigliato`, `id_categoria`) 
                   VALUES ('$marca', '$modello', $posti, '$cambio', '$alimentazione', $km, '$targa', '$fileName', '$descrizione', $oraria, $giornaliera, $mensile, $consigliato, $categoria )";

$conn->query($query);
// id del veicolo appena inserito
$id_veicolo = $conn->insert_id;

foreach ($_POST['features'] as $id_feature) {
    $insert = $conn->query("INSERT INTO feature_veicolo (`id_veicolo`, `id_feature`)
                                     VALUES ($id_veicolo, $id_feature)");
}

header("Location: admin_veicoli.php");

?>