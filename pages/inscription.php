<?php
session_start();

  if (isset($_POST['formInscription'])) {

      foreach ($_POST as $element) { //vérification nb caractères
          if (strlen($element) > 255) {
              $erreur = 'Quelques lettres valent mieux qu\'un long discours';
          }
      }

      if ($_POST['password'] != $_POST['passwordverif']) { //vérification mdp
          $erreur = 'Hélas, le mot de passe ne correspond pas';
      } else { //récupération infos
          $login = htmlspecialchars($_POST['login']);
          $password = htmlspecialchars($_POST['password']);
          $hashed_password = password_hash($password, PASSWORD_DEFAULT);
      }


      if (isset($login, $hashed_password)) {
          try { //connexion bdd
              $bdd = new PDO('mysql:host=localhost;dbname=livreor;charset=utf8', 'root', 'root');
          } catch (Exception $e) {
              die('Erreur : ' . $e->getMessage());
          }


          $query = 'SELECT login from utilisateurs WHERE login =?'; //vérification login existant
          $sqlcheck = $bdd->prepare($query);
          $sqlcheck->execute([$login]);
          $res = $sqlcheck->fetch();

          if ($res) {
              $erreur = "Cet identifiant existe déjà.";
          } else { //envoi données bdd
              $query = 'INSERT INTO utilisateurs (login, password) VALUES (?,?)';
              $sql = $bdd->prepare($query);
              $sql->execute(array($login, $hashed_password));
              header("location: connexion.php");
          }
      }
  }

?>



<!DOCTYPE html>
  <html lang="fr">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <title>Inscription - Dreamy</title>
      
      <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="../css/index.css">
      
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Nerko+One&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=News+Cycle&display=swap" rel="stylesheet">     
    </head>

    <body>
        <main id="mainInscription">
            <section class="section no-pad-bot valign-wrapper center mainSection">
              <article class="container">
                <div class="row">
                  <form class="col m6 offset-m3 s10 offset-s1" action="inscription.php" method="post" >

                    <div class="row center">
                      <div class="input-field col s12 center">
                        <input id="login" name="login" type="text" class="validate" required>
                        <label for="login">Login</label>
                      </div>
                    </div>
                  
                    <div class="row center">
                      <div class="input-field col s11 m6">
                        <input id="password" name="password" type="password" class="validate" required>
                        <label for="password">Password</label>
                      </div>
                      <div class="input-field col s11 m6">
                        <input id="passwordverif" name="passwordverif" type="password" class="validate" required>
                        <label for="password">Vérification</label>
                      </div>
                    </div>

                    <div class="row center">
                      <button class="btn waves-effect waves-light pink lighten-3" type="submit" name="formInscription" >S'inscrire</button>
                    </div>
                    
                  </form>
                </div>
                <?php
                  if (isset($erreur)) {
                    echo '<p class="white-text">' . $erreur . '</p>';
                    }
                ?>
              </article>
            </section>
        </main>


    <footer class="page-footer pink lighten-3">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                  <h5 class="white-text">Aujourd'hui</h5>
                  <?php echo $date = date('l d F');?>
                  <blockquote><em>
                    L'automne est la saison la plus rude.
                    Les feuilles tombent, et elles tombent comme si elles tombaient amoureuses du sol.</em>
                    #Dreamy_is_a_mood
                  </blockquote>
              </div>
              <div class="col l4 offset-l2 s12">
                <ul>
                <li><a href="../index.php"><i class="material-icons">keyboard_backspace</i> Accueil</a></li>
                  <?php
                  if (!isset($_SESSION['id'])) {
                    echo '<li><a href="connexion.php"><i class="material-icons">login</i> Connexion</a></li>';
                  } else {
                    echo  '<li><a href="profil.php"><i class="material-icons">assignment_ind</i> Profil</a></li>
                    <li><a href="logout.php"><i class="material-icons">close</i> Déconnexion</a></li>';
                  }
                  ?>
                  <li><a href="livre-or.php"><i class="material-icons">import_contacts</i> Livre d'Or</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2020 - Dreamy
            <a class="grey-text text-lighten-4 right" href="https://www.youtube.com/channel/UCYVyQv2rUtCMxJAFSuOSpmg"> <i class="material-icons">play_circle_filled</i></a>
            </div>
          </div>
    </footer>

      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="../js/materialize.min.js"></script>
    </body>
  </html>