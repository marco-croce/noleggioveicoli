<?php

require "include/dbms.inc.php";

global $conn;

$section = $_GET['section'];

$select_name = 'select' . $section;
$select = $_GET[$select_name];
$page = $_GET['page'];

$sezione = $conn->query("SELECT id FROM section WHERE nome='$section'");

if($sezione){
    if ($sezione->num_rows == 1) {
        $row = $sezione->fetch_assoc();
        $id_sezione = $row['id'];
    }
}
$pagina = $conn->query("SELECT id FROM pagina WHERE nome='$page'");

if($pagina){
    if ($pagina->num_rows == 1) {
        $row = $pagina->fetch_assoc();
        $id_pagina = $row['id'];
    }
}


$ordine = $conn->query("SELECT ordine FROM section_pagina WHERE id_section=$id_sezione AND id_pagina=$id_pagina");

if($ordine){
    if ($ordine->num_rows == 1) {
        if($select != 0)
            $query = "UPDATE section_pagina SET ordine=$select WHERE id_section=$id_sezione AND id_pagina=$id_pagina";
        else
            $query = "DELETE FROM section_pagina WHERE id_section=$id_sezione AND id_pagina=$id_pagina";
        $conn->query($query);
    } else {
        if($select != 0) {
        $query = "INSERT INTO section_pagina (`id_section`, `id_pagina`, `ordine`) 
                    VALUES ('$id_sezione', '$id_pagina', '$select')";
        $conn->query($query);
        }
    }
}

header("Location: admin_section.php?pagina=$page");

?>