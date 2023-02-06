<?php
    session_start();
    
    $email = $_POST["email"];
    $password = $_POST["password"];

    include "db.php";

    $select = "SELECT id, username FROM uzivatele WHERE email='$email' AND heslo='$password'";
    $res = $mysqli->query($select);
    if($res->num_rows > 0) {
        $user = $res->fetch_assoc();
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];
        
        header("Location: ./index.php");
    } else {
        header("Location: ./prihlaseni.php?message=Spatne%20udaje!");
    }
    
?>