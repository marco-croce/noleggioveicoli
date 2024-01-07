<?php

    require "include/dbms.inc.php";

    global $conn;

    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $email = $_POST['email'];
    $oggetto = $_POST['oggetto'];
    $messaggio = htmlspecialchars($_POST["messaggio"]);

    $insert = "INSERT INTO messaggio (`email`, `nome`, `cognome`, `oggetto`, `messaggio`) 
            VALUES ('$email', '$nome', '$cognome', '$oggetto', '$messaggio')";

    if($conn->query($insert) == true) {
        echo true;
    }

?>