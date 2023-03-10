<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Přihlášení</title>
</head>
<body>
    
<?php 
  if(isset($_GET["message"])) {
    ?>

<div class="w3-panel w3-red">
  <p><?= $_GET["message"] ?></p>
</div> 

<?php
  }

?>

<form action="./prihlaseni_submit.php" method="POST" class="w3-container w3-card-4 w3-light-grey w3-text-blue w3-margin">
    <h2 class="w3-center">Přihlášení</h2>
     
    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-envelope-o"></i></div>
        <div class="w3-rest">
          <input class="w3-input w3-border" required name="email" type="text" placeholder="Email">
        </div>
    </div>
    
    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-lock"></i></div>
        <div class="w3-rest">
          <input class="w3-input w3-border" required name="password" type="password" placeholder="Heslo">
        </div>
    </div>

    <div class="w3-row w3-section">
          <a href="password_reset.php">Zapomenuté heslo</a>
    </div>


    <button class="w3-button w3-block w3-section w3-blue w3-ripple w3-padding">Přihlásit se</button>
    
    </form>
    
  <a href="registrace.php" class="w3-button w3-blue">Ještě nemám účet, registrovat se!</a>

  <a href="index.php" class="w3-button w3-blue">Na hlavní stránku</a>

</body>
</html>