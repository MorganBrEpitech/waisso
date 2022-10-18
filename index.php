<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>Inscription à la newsletter Buitoni</title>
  <meta name="robots" content="index, follow" />
  <meta name="keywords" content="" />
  <meta name="description" content="" />

  <!-- Style CSS -->
  <link rel="stylesheet" href="style.css">

  <!-- jQuery -->
  <script src="js/jquery-1.12.4.js"></script>

</head>

<body>

  <div id="wrapper">

    <header class="header">
      <div>
        <img class="logo" src="./images/logo.png" alt="logo">
      </div>
      <div class="bg-contain">
        <img class="bg-pizza" src="./images/pizza.jpg" alt="bg-pizza">
      </div>

    </header>

    <main id="main" class="contact-main">

      <div class="listing-content">
        <div class='listing-container'>
          <h3 class="main-title">Inscription à la newsletter Buitoni</h3>
          <hr>

          <div class="listing-box" id="contact">
            <h4 class="box-title">Inscrivez-vous</h4>
            <div class="field-group">
              <select id="sexe">
                <option value="sexe">---Civilité---</option>
                <option value="monsieur">Monsieur</option>
                <option value="madame">Madame</option>
              </select>
            </div>
            <div class="field-group">
              <input type="text" id="last_name" value="" placeholder="Nom">
            </div>
            <div class="field-group">
              <input type="text" id="first_name" value="" placeholder="Prénom">
            </div>
            <div class="field-group">
              <input type="email" id="email" value="" placeholder="Email">
            </div>
            <div class="field-group">
              <p>Saisissez le texte ci-dessous pour valider votre inscription</p>
            </div>

            <div id="captcha_image" class="field-group captcha"></div>
            <div class="field-group">
              <input type="text" id="captcha_input" placeholder="Recopiez le code">
            </div>
            <div>
              <input type="submit" onclick="affichermsg()">
            </div>
            <div class="change-captcha" style="cursor:pointer;" onclick="genererCaptcha()">
              Changer de captcha
            </div>
            <div id="resultat"></div>

            <div class="field-group">
              <p>Je souhaite recevoir des informations concernant les produits BUITONI et les autres produits du groupe Nestlé et j'autorise Nestlé Suisse SA à collecter et à traiter mes données. J'accepte <span>l'Avis concernant la protection des données.</span></p>
            </div>
            <div class="field-group field-submit">
              <button class="send-button" onclick="sendMessage();">S'INSCRIRE</button>
            </div>

          </div><!-- .listing-box -->

        </div><!-- .listing-container -->
      </div><!-- .listing-content -->

    </main><!-- .site-main -->

    <footer id="footer">
      <p>©Nestlé | Protection des données | Conditions d'utilisation</p>
    </footer>

    <?php
    echo '<div class="alert-error hidden">';
    echo '</div>';
    echo '<div class="alert-ok hidden">';
    echo '</div>';
    ?>

  </div><!-- #wrapper -->

  <script>
    function sendMessage() {
      $('body').toggleClass('loading');
      var email = document.getElementById("email").value;
      var last_name = document.getElementById("last_name").value;
      var first_name = document.getElementById("first_name").value;
      var sexe = document.getElementById("sexe").value;
      var captcha_input = document.getElementById("captcha_input").value;

      if (sexe == undefined || sexe == "") {
        $(".alert-error").show().delay(3000).fadeOut();
        $(".alert-error").html("Merci de mentionner votre sexe");
        $('body').toggleClass('loading');
        return;
      }
      if (sexe == undefined || sexe == "sexe") {
        $(".alert-error").show().delay(3000).fadeOut();
        $(".alert-error").html("Merci de mentionner votre sexe");
        $('body').toggleClass('loading');
        return;
      }
      if (first_name == undefined || first_name == "") {
        $(".alert-error").show().delay(3000).fadeOut();
        $(".alert-error").html("Merci de compléter votre prénom");
        $('body').toggleClass('loading');
        return;
      }
      if (last_name == undefined || last_name == "") {
        $(".alert-error").show().delay(3000).fadeOut();
        $(".alert-error").html("Merci de compléter votre nom");
        $('body').toggleClass('loading');
        return;
      }
      if (email == undefined || email == "") {
        $(".alert-error").show().delay(3000).fadeOut();
        $(".alert-error").html("Merci de compléter votre email");
        $('body').toggleClass('loading');
        return;
      }
      if (captcha_input == undefined || captcha_input == "") {
        $(".alert-error").show().delay(3000).fadeOut();
        $(".alert-error").html("Merci de saisir le code captcha");
        $('body').toggleClass('loading');
        return;
      }

      var formData = new FormData();
      formData.append("email", email);
      formData.append("last_name", last_name);
      formData.append("first_name", first_name);
      formData.append("sexe", sexe);


      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          $('body').toggleClass('loading');
          $(".alert-ok").show().delay(3000).fadeOut();
          $(".alert-ok").html("Votre message a été envoyé avec succès");
        }
      };

      var qs = "email=" + email + "&last_name=" + last_name + "&first_name=" + first_name + "&sexe=" + sexe;

      var editLink = "send_message.php?" + encodeURI(qs);
      console.log(editLink);
      xmlhttp.open("GET", editLink, true);
      xmlhttp.send();
    }
  </script>

  <script>
    var captcha;
    var longueur_captcha = 6;

    function genererCaptcha() {
      document.getElementById("captcha_input").value = "";
      captcha = document.getElementById("captcha_image");
      var code_captcha = "";
      const hasard = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
      for (let i = 1; i < longueur_captcha; i++) {
        code_captcha += hasard.charAt(Math.random() * hasard.length);
      }
      captcha.innerHTML = code_captcha;
    }

    function affichermsg() {
      const captcha_input = document.getElementById("captcha_input").value;
      if (captcha_input == captcha.innerHTML) {
        var s = document.getElementById("resultat").innerHTML = "Captcha correct";
        genererCaptcha();
      } else {
        var s = document.getElementById("resultat").innerHTML = "Captcha incorrect";
        genererCaptcha();
      }
    }

    genererCaptcha();
  </script>

</body>

</html>