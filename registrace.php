<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Registrace</title>
</head>
<body>
    
<form action="./registrace_submit.php" method="POST" class="w3-container w3-card-4 w3-light-grey w3-text-blue w3-margin">
  
  <?php if(isset($_GET["message"])) { ?>
  <div class="w3-panel w3-red">
    
    <p><?= $_GET["message"] ?></p>
  </div> 
  <?php } ?>
  <h2 class="w3-center">Registrace</h2>
     

    <div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
    <div class="w3-rest">
      <input required class="w3-input w3-border" name="first" type="text" placeholder="Jméno">
    </div>
</div>

<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
    <div class="w3-rest">
      <input required class="w3-input w3-border" name="last" type="text" placeholder="Příjmení">
    </div>
</div>

<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
    <div class="w3-rest">
      <input required class="w3-input w3-border" name="username" type="text" placeholder="Uživatelské jméno">
    </div>
</div>

    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-envelope-o"></i></div>
        <div class="w3-rest">
          <input required class="w3-input w3-border" name="email" type="text" placeholder="Email">
        </div>
    </div>
    
    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-lock"></i></div>
        <div class="w3-rest">
          <input required class="w3-input w3-border" name="password" type="password" placeholder="Heslo">
        </div>
    </div>
    
    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-lock"></i></div>
        <div class="w3-rest">
          <input required class="w3-input w3-border" name="password2" type="password" placeholder="Kontrola hesla">
        </div>
    </div>

    <label>Kontrolní otázka</label>
    <select required class="w3-select w3-border" name="question">
    <?php
      include "db.php";
      $select = "SELECT id, text FROM otazky";
      $res = $mysqli->query($select);
      if($res === FALSE) {
        echo "Chyba získávání kontrolních otázek";
      } else {
        while($row = $res->fetch_assoc()) {
          echo "<option value=\"" . $row["id"] . "\">" . $row["text"] . "</option>";
        }
      }

    ?>
    </select>

    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-lock"></i></div>
        <div class="w3-rest">
          <input required class="w3-input w3-border" name="answer" type="text" placeholder="Odpověď na kontrolní otázku">
        </div>
    </div>

    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-edit"></i></div>
        <div class="w3-rest">
          <input class="w3-input w3-border" name="note" type="text" placeholder="Poznámka">
        </div>
    </div>

    <button class="w3-button w3-block w3-section w3-blue w3-ripple w3-padding">Registrovat se</button>
    
    </form>
    
  <a href="prihlaseni.php" class="w3-button w3-blue">Již mám účet, přihlásit se!</a>

  <a href="index.php" class="w3-button w3-blue">Na hlavní stránku</a>
</body>
</html>