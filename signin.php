<?php

session_start();

    require "include/dbms.inc.php";

    global $conn;

    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm-password'];

    $insert = "INSERT INTO utente (`nome`, `cognome`, `email`, `password`, `telefono`) 
            VALUES ('$nome', '$cognome', '$email', '$password', '$telefono')";

    if($conn->query($insert) == true) {
        $last_id = $conn->insert_id;
    }

    $ruolo = "INSERT INTO utente_ruolo (`id_utente`, `id_ruolo`)
            VALUES ('$last_id', '1')";

    if($conn->query($ruolo) == true) {
        $result = $conn->query("SELECT nome, cognome, email 
                    FROM utente 
                    WHERE email = '{$_POST['email']}' AND password = '{$_POST['password']}'");


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
                        }

    }

    Header("Location: login.php");
    
?>