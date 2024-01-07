<?php

    session_start();

    require __DIR__ . "/TplUtility.php";
    require "include/config.inc.php";
    require "include/template2.inc.php";
    require "include/dbms.inc.php";

    define('PAGINA', 'contact');

    $main = new Template("skins/rental/dtml/index.html");
    $body = new Template("skins/rental/dtml/contact.html");

    $utility = new TplUtility();

    global $conn;

    $main = $utility->loadIndex(PAGINA, $main, $conn);

    $contacts = $conn->query("SELECT contenuto, icon, tipo, collegamento FROM contatto");

    if(!$contacts){
        header("location: contact.html");
        echo "Error {$conn->errno}: {$conn->error}"; exit;
    }

    if ($contacts->num_rows > 0) {
        while($row = $contacts->fetch_assoc()) {
            foreach($row as $key => $value) {
                $body->setContent($key, $value);
            }
        }
    }

    $body = $utility->loadAllSections(PAGINA, $body, $conn);

    $main->setContent('body', $body->get());
    $main->close();

?>