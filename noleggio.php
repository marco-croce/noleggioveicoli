<?php

  session_start();

  require "include/dbms.inc.php";

  global $conn;

  if(isset($_POST['costo']))
    $costo = $_POST['costo'];
  else
    $costo = $_GET['costo'];

  if($costo == 0) {
    $inizio = $_POST['inizio'];
    $fine = $_POST['fine'];
    $orario = $_POST['orario'];
    $id_veicolo = $_POST['id'];
    $start = new DateTime($inizio);
    $end  = new DateTime($fine);
    $durata = $end->diff($start);
    $durata = $durata->format("%R%a");
    $durata = abs($durata);

    $tariffa =  $conn->query("SELECT c.tariffa_oraria, c.tariffa_giornaliera, c.tariffa_mensile FROM veicolo v JOIN categoria c ON v.id_categoria = c.id WHERE v.id=$id_veicolo");
    if($tariffa){
      if ($tariffa->num_rows > 0) {
        $row = $tariffa->fetch_assoc();
      }
    }

    if($durata == 0) {
      $costo = $row['tariffa_oraria'] * (19-$orario);
    } else {
      if($durata < 30) {
        $costo = $row['tariffa_giornaliera'] * $durata;
      } else {
        $costo = $row['tariffa_mensile'] * $durata/30;
      }
    }

    echo $costo;
    
  } else {

    $inizio = $_GET['inizio'];
    $fine = $_GET['fine'];
    $orario = $_GET['orario'];
    $id_veicolo = $_GET['id'];
    $id_utente = $_SESSION['auth']['utente']['id'];

    $insert = "INSERT INTO noleggio (`id_utente`, `id_veicolo`, `data_ritiro`, `data_riconsegna`, `orario`, `costo`) 
                VALUES ($id_utente, $id_veicolo, '$inizio', '$fine', '$orario', $costo)";

    if($conn->query($insert) == true) {
      Header("Location: cars.php?noleggio=true");
    }

  }

?>