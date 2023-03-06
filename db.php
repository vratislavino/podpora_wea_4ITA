<?php
$mysqli = new mysqli("localhost", "root", "", "podpora");
if($mysqli->connect_error) {
    echo "Nepodařilo se připojit k databázi!";
}
/*

ALTER TABLE odpovedi
ADD FOREIGN KEY (id_prispevku) REFERENCES prispevky(id) 
ON DELETE CASCADE;

ALTER TABLE hodnoceni
ADD FOREIGN KEY (id_odpoved) REFERENCES odpovedi(id)
ON DELETE CASCADE;

ALTER TABLE hodnoceni
ADD FOREIGN KEY (id_uzivatel) REFERENCES uzivatele(id)
ON DELETE CASCADE;

ALTER TABLE odpovedi
ADD FOREIGN KEY (autor) REFERENCES uzivatele(id);

ALTER TABLE prispevky
ADD FOREIGN KEY (autor) REFERENCES uzivatele(id);

ALTER TABLE uzivatele
ADD FOREIGN KEY (otazka) REFERENCES otazky(id);

*/
?>


