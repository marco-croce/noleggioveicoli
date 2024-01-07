<?php

require "include/dbms.inc.php";

global $conn;

$imgDirectory = __DIR__.'\skins\rental\assets\images';

$id_veicolo = $_POST['car'];

//Dati del veicolo che potrebbero non essere modificati
$car = $conn->query("SELECT immagine FROM veicolo WHERE id=$id_veicolo");

if($car){
    if ($car->num_rows == 1) {
        $row = $car->fetch_assoc(); 
        $fileName = $row['immagine'];
    }
}

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

$query = "UPDATE veicolo SET marca='$marca', modello='$modello', n_posti=$posti, cambio='$cambio', alimentazione='$alimentazione',
                             km_percorsi=$km, targa='$targa', immagine='$fileName', descrizione='$descrizione', tariffa_oraria=$oraria,
                             tariffa_giornaliera=$giornaliera, tariffa_mensile=$mensile, consigliato=$consigliato, id_categoria=$categoria 
                             WHERE id=$id_veicolo";

$conn->query($query);

$query = "DELETE FROM feature_veicolo WHERE id_veicolo = $id_veicolo";

$conn->query($query);

foreach ($_POST['features'] as $id_feature) {
    $insert = $conn->query("INSERT INTO feature_veicolo (`id_veicolo`, `id_feature`)
                                     VALUES ($id_veicolo, $id_feature)");
}

header("Location: admin_veicoli.php");

?>