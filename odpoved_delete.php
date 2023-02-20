<?php
    session_start();
    $userid = $_SESSION["user_id"];
    $id = $_GET["id"];
    include "db.php";

    $id_prispevku = 0;
    $select = "SELECT id, autor, id_prispevku FROM odpovedi WHERE id=$id";
    $res = $mysqli->query($select);
    if($res !== FALSE) {
        if($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $id_prispevku = $row["id_prispevku"];
            if($row["autor"] == $userid) {
                
                $delete = "DELETE FROM odpovedi WHERE id=$id";
                $res = $mysqli->query($delete);
                if($res === TRUE) {

                    echo "Odpověď smazána";
                } else {
                    echo "Error! " . $mysqli->error;
                }
            } else {
                echo "Nejsi přihlášen jako autor příspěvku, ty špíno!";
            }
        } else {
            echo "Odpověď neexistuje!";
        }
    }
    header("Location: prispevek.php?prispevek=".$id_prispevku);
?>