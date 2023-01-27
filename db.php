<?php
$mysqli = new mysqli("localhost", "root", "", "podpora");
if($mysqli->connect_error) {
    echo "Nepodařilo se připojit k databázi!";
}

?>