<?php
    session_start();

    include "db.php";
    $nadpis = $_POST["nadpis"];
    $obsah = $_POST["obsah"];
    $autor = $_SESSION["user_id"];
    $insert = "INSERT INTO prispevky (autor, nadpis, text) VALUES ($autor, '$nadpis', '$obsah')";

    $res = $mysqli->query($insert);
    if($res === TRUE) {
        echo "Ok :)";
        header("Location: index.php");
    } else {
        echo $mysqli->error;
    }
?>