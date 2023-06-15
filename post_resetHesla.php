<?php

    $part = $_GET["action"];
    include "db.php";


    if($part == 1) {
        $email = $_POST["email"];

        $select = "SELECT text FROM uzivatele AS u JOIN otazky AS o ON(u.otazka=o.id) WHERE u.email = '$email'";
        $res = $mysqli->query($select);
        $arr;
        if($res->num_rows == 0) {
            $arr = [
                "id" => "0",
                "message" => "Uživatel neexistuje"
            ];
            echo json_encode($arr);
        } else {
            $arr = [
                "id" => "1",
                "message" => $res->fetch_assoc()["text"]
            ];
            echo json_encode($arr);
        }
    } else if($part == 2) {
        $email = $_POST["email"];
        $odpoved = $_POST["odpoved"];

        $select = "SELECT u.id FROM uzivatele AS u WHERE u.email = '$email' AND u.odpoved='$odpoved'";
        $res = $mysqli->query($select);
        if($res->num_rows == 0) {
            $arr = [
                "id" => "0",
                "message" => "Špatná odpověď"
            ];
            echo json_encode($arr);
        } else {
            $arr = [
                "id" => "1",
                "message" => $res->fetch_assoc()["id"]
            ];
            echo json_encode($arr);
        }
    } else if($part == 3) {
        
        $userid = $_POST["userid"];
        $heslo = $_POST["heslo"];
        $update = "UPDATE uzivatele SET heslo='$heslo' WHERE id=$userid";
        $res = $mysqli->query($update);
        
        $arr;
        if($res === TRUE) {
            $arr = [
                "id" => "1",
                "messsage" => "OK :)"
            ];
        } else {
            $arr = [
                "id" => "0",
                "message" => $mysqli->error
            ];
        }
        echo json_encode($arr);
    }

?>