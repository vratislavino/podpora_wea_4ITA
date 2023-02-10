<?php
    session_start();

    include "db.php";
    $text = $_POST["text"];
    $autor = $_SESSION["user_id"];
    $prispevek_id = $_GET["prispevek"];
    $insert = "INSERT INTO odpovedi (autor, text, id_prispevku) VALUES ($autor, '$text', $prispevek_id)";

    $res = $mysqli->query($insert);
    if($res === TRUE) {
        echo "Ok :)";
        header("Location: prispevek.php?prispevek=$prispevek_id");
    } else {
        echo $mysqli->error;
    }
?>