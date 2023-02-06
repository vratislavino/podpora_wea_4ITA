<!DOCTYPE html>
<?php
    session_start();
    echo $_SESSION["username"];
		include "db.php";
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
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Dle data přidání</a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Dle názvu</a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Dle počtu odpovědí</a>
    <?php
        if(isset($_SESSION["username"])) {
    ?>
        <a href="#" class="w3-right w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white w3-green">(<?= $_SESSION["username"] ?>)&nbsp;Odhlásit se</a>
    <?php 
        } else {
            ?>
        <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Přihlásit se</a>
            <?php
        }
    ?>
</div>

  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="#" class="w3-bar-item w3-button w3-padding-large">Dle data přidání</a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large">Dle názvu</a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large">Dle počtu odpovědí</a>
  </div>
</div>

<!-- Header -->
<header class="w3-container w3-red w3-center w3-padding" style="padding-top: 40px !important">

	<form>
				.)
	</form>

</header>

<!-- Příspěvky -->
<div class="w3-row-padding w3-padding-64 w3-container">
  <div class="w3-content">
				
				<?php 
					$select = "SELECT nadpis, p.id, COUNT(*) AS count FROM prispevky AS p JOIN odpovedi AS o ON (p.id=o.id_prispevku) GROUP BY o.id_prispevku;";
					//echo $select;
					$res = $mysqli->query($select);
					while($row = $res->fetch_assoc()) {

				?>
				<a href="./prispevek.php?prispevek=<?= $row["id"] ?>">
					<div class="w3-col w3-header w3-border w3-red w3-padding w3-hover-deep-orange">
						<div class="w3-twothirds" style="display:inline;">
							<span style="font-size: 2em"><?= $row["nadpis"] ?></span>
						</div>
						<div class="w3-right" style="display:inline;">
						<span class="w3-xlarge"><?= $row["count"] ?></span>
							&nbsp;
							<i class="fa fa-comment w3-right w3-xxlarge"></i>
						</div>
					</div>
				</a>
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
