<?php
    $first = $_POST["first"];
    $last = $_POST["last"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $question = $_POST["question"];
    $answer = $_POST["answer"];
    $note = $_POST["note"];
 
    include "db.php";

    $insert = "INSERT INTO uzivatele(jmeno, prijmeni, username, email, heslo, otazka, odpoved, poznamka) VALUES "
    ."('$first', '$last', '$username', '$email', '$password', $question, '$answer', '$note')";
    
    echo $insert;
    $res = $mysqli->query($insert);
    if($res === TRUE) {
        echo "Registrace úspěšná";
        header("Location: ./prihlaseni.php?message=Registrace%20uspesna!");
    } else {
        echo "Něco je špatně " . $mysqli->error;
        header("Location: ./registrace.php?message=Registrace%20neuspesna!");
    }

?>