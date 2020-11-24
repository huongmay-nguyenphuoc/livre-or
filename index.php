<?php
session_start();
?>

<!DOCTYPE html>
  <html lang="fr">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <title>Accueil - Dreamy</title>
      
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="css/index.css">
      
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Nerko+One&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=News+Cycle&display=swap" rel="stylesheet">     
    </head>

    <body>

      <main id="mainIndex">
        <section class="section no-pad-bot valign-wrapper center mainSection">
                <article class="container">
                    <h1 class="header pink-text  text-lighten-5 center">Dreamy ~ mix Lofi</h1>
                    <div class="row center">
                        <h5 class="header col s12 light pink-text  text-lighten-4">Beats et mix pour chiller, 
                            étudier et regretter des moments qui n'ont jamais eu lieu</h5>
                    </div>
                    <div class="row center">
                        <?php 
                          if (!isset($_SESSION['id'])) {
                          echo'<a href="pages/inscription.php" class="btn-large waves-effect waves-light pink lighten-3">Inscription</a>';
                          } else {
                          echo'<a href="pages/profil.php" class="btn-large waves-effect waves-light pink lighten-3">Profil</a>';
                        }?>
                    </div>
                </article>
        </section>
      </main>
    

    <footer class="page-footer pink lighten-3">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                    <h5 class="white-text">Aujourd'hui</h5>
                    <?php echo $date = date('l d F');?>
                    <blockquote>
                      <em>L'automne est la saison la plus rude.
                      Les feuilles tombent, et elles tombent comme si elles tombaient amoureuses du sol.</em>
                      #Dreamy_is_a_mood
                    </blockquote>
              </div>
              <div class="col l4 offset-l2 s12">
                <ul>
                  <?php 
                    if (!isset($_SESSION['id'])) {
                      echo '<li><a href="pages/inscription.php"><i class="material-icons">create</i> Inscription</a></li>
                      <li><a href="pages/connexion.php"><i class="material-icons">login</i> Connexion</a></li>';
                    } else {
                      echo '<li><a href="pages/profil.php"><i class="material-icons">assignment_ind</i> Profil</a></li>
                      <li><a href="pages/logout.php"><i class="material-icons">close</i> Déconnexion</a></li>';
                    }
                  ?>
                  <li><a href="pages/livre-or.php"><i class="material-icons">import_contacts</i> Livre d'Or</a></li>
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
      <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
  </html>