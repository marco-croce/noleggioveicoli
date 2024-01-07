<?php

    session_start();

    require __DIR__ . "/TplUtility.php";
    require "include/config.inc.php";
    require "include/template2.inc.php";
    require "include/dbms.inc.php";

    define('PAGINA', 'cars');

    $main = new Template("skins/rental/dtml/index.html");
    $body = new Template("skins/rental/dtml/cars.html");

    $utility = new TplUtility();

    global $conn;

    $main = $utility->loadIndex(PAGINA, $main, $conn);

    $body = $utility->loadAllSections(PAGINA, $body, $conn);

    $main->setContent('body', $body->get());

    $main->close();

?>