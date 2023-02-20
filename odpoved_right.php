<?php
    session_start();
    $userid = $_SESSION["user_id"];
    $id = $_GET["id"];
    include "db.php";

    $id_prispevku = 0;
    $select = "SELECT id_prispevku, spravna FROM odpovedi WHERE id=$id";
    $res = $mysqli->query($select);
    if($res !== FALSE) {
        if($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $id_prispevku = $row["id_prispevku"];
            
            $update = ""; 
            if($row["spravna"] == 1) {
                $update = "UPDATE odpovedi SET spravna=0 WHERE id=$id";
            } else {
                $update = "UPDATE odpovedi SET spravna=1 WHERE id=$id";
            }

            $res = $mysqli->query($update);
            if($res === TRUE) {
                echo "Povedlo se";
                header("Location: prispevek.php?prispevek=".$id_prispevku);
            } else {
                echo "Chyba " . $mysqli->error;
            }
        } else {
            echo "Odpověď neexistuje!";
        }
    }
?>