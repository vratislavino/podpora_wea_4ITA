<?php
    session_start();
    $id = $_GET["prispevek"];
    $prispevek;
    include "db.php";

    $select = "SELECT p.id, p.nadpis, p.text, p.cas, u.id AS userid, u.username, u.jmeno, u.prijmeni FROM prispevky AS p JOIN uzivatele AS u ON(u.id = p.autor) WHERE p.id=$id";
    $res = $mysqli->query($select);
    if($mysqli->error) {
        echo "Chyba! " . $mysqli->error;
    } else {
        $prispevek = $res->fetch_assoc();
    }

    function formatTime($str) {
        $mils = strtotime($str);
        return date("d.m.Y H:i:s", $mils);
    }
?>

<html>
<head>
<title>Technická podpora</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
.w3-bar,h1,button {font-family: "Montserrat", sans-serif}
.fa-anchor,.fa-coffee {font-size:200px}
</style>
</head>
<body>

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-red w3-card w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="index.php?orderby=datum" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Dle data přidání</a>
    <a href="index.php?orderby=nazev" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Dle názvu</a>
    <a href="index.php?orderby=komentare" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Dle počtu odpovědí</a>
    <?php
        if(isset($_SESSION["username"])) {
    ?>
        <a href="odhlaseni.php" class="w3-right w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white w3-green">(<?= $_SESSION["username"] ?>)&nbsp;Odhlásit se</a>
    <?php 
        } else {
            ?>
        <a href="prihlaseni.php" class="w3-right w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white w3-green">Přihlásit se</a>
            <?php
        }
    ?>
</div>

  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="index.php?orderby=datum" class="w3-bar-item w3-button w3-padding-large">Dle data přidání</a>
    <a href="index.php?orderby=nazev" class="w3-bar-item w3-button w3-padding-large">Dle názvu</a>
    <a href="index.php?orderby=komentare" class="w3-bar-item w3-button w3-padding-large">Dle počtu odpovědí</a>
  </div>
</div>

<!-- Příspěvek -->
<div class="w3-row-padding w3-padding-64 w3-container">
  <div class="w3-content">
	
  <div class="w3-card-4">

<header class="w3-container w3-red">
  <h1>
    <?= $prispevek["nadpis"] ?>
    
  </h1>
</header>

<div class="w3-container">
  <p><?= $prispevek["text"] ?></p>
</div>

<footer class="w3-container w3-red">
  <h5><?= $prispevek["jmeno"] . " " . $prispevek["prijmeni"] . " (" . $prispevek["username"] . ") " . formatTime($prispevek["cas"]) ?></h5>
  <?php
      if(isset($_SESSION["user_id"]) && $_SESSION["user_id"] == $prispevek["userid"])
      {
    ?>
      <form action="prispevek_delete.php?prispevek=<?= $prispevek["id"] ?>" method="POST">
        <button class="w3-button w3-red w3-right">Smazat</button>
      </form>
    <?php } ?>
</footer>

</div>

<div class="w3-container w3-margin">
  <h2 class="w3-red w3-container">Odpovědi</h2>
<?php
  $select = "SELECT o.id, o.text, o.cas, u.username, o.autor, o.spravna FROM odpovedi AS o JOIN uzivatele AS u ON(o.autor=u.id) WHERE id_prispevku=$id";
  $res = $mysqli->query($select);
  if($res !== FALSE) {
    while($row = $res->fetch_assoc()) {

?>
<div class="w3-card-4">
  <header class="w3-red w3-container">
    <?= $row["username"] ?> <?= formatTime($row["cas"]) ?> 
      <?php
        if($row["spravna"] == 1) {
          ?>
            <i class="fa fa-check w3-xxlarge"></i>
          <?php
        }
      ?>
  </header>
  <div class="w3-container">
      <?= $row["text"] ?>
  </div>
  
  <div>
  <?php 
  // PODMÍNKA, JESTLI MŮŽU SMAZAT ODPOVĚĎ
    if(isset($_SESSION["user_id"]) && $_SESSION["user_id"] == $row["autor"]) {
  ?>
    <form action="odpoved_delete.php?id=<?= $row["id"] ?>" method="POST">
      <button class="w3-button w3-red">Smazat</button>
    </form>
  <?php 
    }
  ?>

  <?php 
  // PODMÍNKA, JESTLI MŮŽU OZNAČIT ODPOVĚĎ ZA SPRÁVNOU
    if(isset($_SESSION["user_id"]) && $_SESSION["user_id"] == $prispevek["userid"]) {
  ?>
    <form action="odpoved_right.php?id=<?= $row["id"] ?>" method="POST">
      <button class="w3-button w3-green">Od/označit jako správnou</button>
    </form>
  <?php 
    }
  ?>
  </div>
</div>
<?php
  }
}
?>

</div>


<!-- ZDE BY MĚL BÝT VÝPIS ODPOVĚDÍ PRO DANÝ PŘÍSPĚVEK -->


<?php
  if(isset($_SESSION["user_id"])) {
?>
<form class="w3-container w3-card-4 w3-padding-16" action="odpoved_submit.php?prispevek=<?= $id ?>" method="POST">

<label>Odpověď</label>
<textarea class="w3-input" type="text" name="text"></textarea>
<button class="w3-red w3-button w3-right">Odeslat</button>

</form>

<?php 
  }
  ?>

  </div>
</div>

<div class="w3-container w3-black w3-center w3-opacity w3-padding-64">
    <h1 class="w3-margin w3-xlarge">Quote of the day: live life</h1>
</div>

<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-center w3-opacity">  
        <a href="#">To the top</a>
</footer>

<script>
// Used to toggle the menu on small screens when clicking on the menu button
function myFunction() {
  var x = document.getElementById("navDemo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>

</body>
</html>
