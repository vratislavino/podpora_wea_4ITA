<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script>
        
        let part = 1;

        function getEmail() {
            return $("input[name=email]").val();
        }   
        
        function getOdpoved() {
            return $("input[name=odpoved]").val();
        }  

        function tryToSubmit() {
            //console.log(getEmail());
            if(part == 1) {
                $.post("post_resetHesla.php?action=1", "email="+getEmail(), function (data) {
                    //console.log("Ze serveru: " + data);

                    let json = JSON.parse(data);
                    if(json.id == 0) {
                        $("#message").html(json.message).show(400).delay(2000).hide(400);
                    } else {
                        $("input[name=email]").attr("disabled", "true");
                        $("button").html("Odeslat odpověď");
                        $("#part2").html(`
                        <p>${json.message}</p>

                        <div class="w3-row w3-section">
                        <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-lock"></i></div>
                            <div class="w3-rest">
                            <input class="w3-input w3-border" required name="odpoved" type="text" placeholder="Odpověď">
                            </div>
                        </div>
                        `);
                        part = 2;
                    }


                });
            } else if(part == 2) {
                $.post("post_resetHesla.php?action=2", "email="+getEmail()+"&odpoved="+getOdpoved(), function (data) {
                    let json = JSON.parse(data);
                    if(json.id == 0) {
                        $("#message").html(json.message).show(400).delay(2000).hide(400);
                    } else {
                        $("input[name=odpoved]").attr("disabled", "true");
                        $("button").html("Změnit heslo");
                        $("#part3").html(`
                        <div class="w3-row w3-section">
                            <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-lock"></i></div>
                            <div class="w3-rest">
                            <input class="w3-input w3-border" required name="password" type="password" placeholder="Nové heslo">
                            </div>
                        </div>
                        
                        <div class="w3-row w3-section">
                            <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-lock"></i></div>
                            <div class="w3-rest">
                            <input class="w3-input w3-border" required name="password" type="password" placeholder="Nové heslo znovu">
                            </div>
                        </div>
                        `);
                        
                    }
                });

            }
            return false;
        }

    </script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Zapomenuté heslo</title>
</head>
<body>
   
<div class="w3-panel w3-red w3-padding-16" style="display: none" id="message"></div>

<form onsubmit="return tryToSubmit()" class="w3-container w3-card-4 w3-light-grey w3-text-blue w3-margin">
    <h2 class="w3-center">Zapomenuté heslo</h2>
     
    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-envelope-o"></i></div>
        <div class="w3-rest">
          <input class="w3-input w3-border" required name="email" type="text" placeholder="Email">
        </div>
    </div>
    
    <div id="part2"></div>
    <div id="part3"></div>

    <button class="w3-button w3-block w3-section w3-blue w3-ripple w3-padding">Potvrdit email</button>
    
    </form>


</body>
</html>