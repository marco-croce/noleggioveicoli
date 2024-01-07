<?php

session_start();

require "include/dbms.inc.php";

global $conn;

if(isset($_POST['logged'])) {
    if(isset($_SESSION['auth']['operazione']['login.php'])) {
        echo true;
        exit();
    } else {
        echo false;
        exit();
    }
}

$result = $conn->query("SELECT id, nome, cognome 
    FROM utente 
    WHERE email = '{$_POST['email']}' AND password = '{$_POST['password']}'");

if (!$result) {
    echo 0; // Errore generico
}

if ($result->num_rows == 0) {
    echo 1; // Errore utente non riconosciuto
} else {
    $data = $result->fetch_assoc();
    $_SESSION['auth']['utente'] = $data;

    $result = $conn->query("select utente.email, utente_ruolo.id_ruolo, operazione.nome, operazione.script
        from utente
        left join utente_ruolo
        on utente_ruolo.id_utente = utente.id
        left join ruolo_operazione
        on ruolo_operazione.id_ruolo = utente_ruolo.id_ruolo
        left join operazione
        on operazione.id = ruolo_operazione.id_operazione
        where utente.email = '{$_POST['email']}'");

    while ($data = $result->fetch_assoc()) {
        $_SESSION['auth']['operazione'][$data['script']] = true;
        echo($data['script']);
    }
        
}

?>