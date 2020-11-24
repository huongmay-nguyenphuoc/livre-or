<?php
session_start();
try { //connexion bdd
    $bdd = new PDO('mysql:host=localhost;dbname=livreor;charset=utf8', 'root', 'root');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}


if (isset($_POST['formProfil']) and isset($_POST['passwordverif'])) { //si form rempli

    if ($_POST['password'] != $_POST['passwordverif']) { //vérif mdp
        $erreur = 'Le mot de passe ne correspond pas';
    } else { //récup données form
        $newpseudo = htmlspecialchars($_POST['login']);
        $newpassword = htmlspecialchars($_POST['password']);
        $hashed_newpassword = password_hash(($newpassword), PASSWORD_DEFAULT);

       
        $query= 'SELECT * FROM utilisateurs where login=?';
        $checklogin= $bdd->prepare($query);
        $checklogin->execute([$newpseudo]);
        $usercheck = $checklogin->rowCount();
       if (($_SESSION['login'] == $newpseudo AND $usercheck == 1) OR ($usercheck == 0)) {

            $query = 'UPDATE utilisateurs SET login = ?, password = ? WHERE id = ?';
            $insertnewdata = $bdd->prepare($query);
            $insertnewdata->execute(array($newpseudo, $hashed_newpassword, $_SESSION['id']));
            $succes = $newpseudo . ', le changement a bien été enregistré.';
        } else {
            $erreur = "Cet identifiant existe déjà.";
        } 
    }
} else {
    $erreur = 'Remplissez tous les champs s\'il-vous-plaît.';
}
?>





<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile - Dreamy</title>

    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="../css/index.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nerko+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=News+Cycle&display=swap" rel="stylesheet">
</head>

<body>
    <main id="mainProfil">
        <section class="section no-pad-bot valign-wrapper center mainSection">
            <article class="container">
                <div class="row">
                    <?php
                    if (isset($_SESSION['id'])) {
                        echo '<form class="col m6 offset-m3 s10 offset-s1" action="profil.php" method="post" id="formProf">

      <div class="row center">
        <div class="input-field col s10 m6 offset-m3 offset-s1">
          <input id="login" name="login" type="text" class="validate">
          <label for="login">Login</label>
        </div>
      </div>
     
      <div class="row center">
      <div class="input-field col s10 m6 offset-m3 offset-s1">
          <input id="password" name="password" type="password" class="validate">
          <label for="password">Password</label>
      </div>
      <div class="input-field col s10 m6 offset-m3 offset-s1">
          <input id="passwordverif" name="passwordverif" type="password" class="validate">
          <label for="passwordverif">Vérification</label>
      </div>
      </div>

      <div class="row center">
      <button class="btn waves-effect waves-light pink lighten-3" type="submit" name="formProfil" >Modifier</button>
      </div>
      
    </form>
  </div>';

        if (isset($erreur)) {
            echo '<p class="white-text">' . $erreur . '</p>';
            } elseif (isset($succes)) {
            echo  '<p class="white-text">' . $succes . '</p>';
            }

}     else {
 echo '<div class="row">
 <p class="pink lighten-2 col s12 z-depth-2" id="paragraphe">Qui êtes-vous ? Veuillez vous connecter</p>    </div>';
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
                    <?php echo $date = date('l d F'); ?>
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
                            echo '<li><a href="inscription.php"><i class="material-icons">create</i> Inscription</a></li>
                    <li><a href="connexion.php"><i class="material-icons">login</i> Connexion</a></li>';
                        } else {
                            echo  ' <li><a href="logout.php"><i class="material-icons">close</i> Déconnexion</a></li>';
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