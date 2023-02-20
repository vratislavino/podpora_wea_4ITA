<?php
    session_start();
    $userid = $_SESSION["user_id"];
    $id = $_GET["prispevek"];
    include "db.php";

    $select = "SELECT id, autor FROM prispevky WHERE id=$id";
    $res = $mysqli->query($select);
    if($res !== FALSE) {
        if($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            
            if($row["autor"] == $userid) {
                
                $delete = "DELETE FROM prispevky WHERE id=$id";
                $res = $mysqli->query($delete);
                if($res === TRUE) {
                    echo "Příspěvek smazán";
                    header("Location: index.php");
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
?>