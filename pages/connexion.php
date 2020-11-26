<?php
session_start();

if (isset($_POST['formConnexion'])) {

    if (strlen($_POST['login']) > 255 or strlen($_POST['password']) > 255) { //vérification nb caractères 
        $erreur = 'Quelques lettres valent mieux qu\'un long discours';
    } else { //récupération infos
        $login = htmlspecialchars($_POST['login']);
        $password = ($_POST['password']);
    }


    if (isset($login, $password)) {
        try { //connexion bdd
            $bdd = new PDO('mysql:host=localhost;dbname=livreor;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }

        $query = 'SELECT * from utilisateurs WHERE login =?'; //vérification utilisateur
        $sqlcheck = $bdd->prepare($query);
        $sqlcheck->execute([$login]);
        $usercheck = $sqlcheck->rowCount();

        if ($usercheck == 1) {
            $user = $sqlcheck->fetch(); //création variables session
            $auth = password_verify($_POST['password'], $user['password']);

            if ($auth === true) {
                $_SESSION['id'] = $user['id'];
                $_SESSION['login'] = $user['login'];
                $_SESSION['password'] = $user['password'];
                header("location: profil.php");
            } else {
                $erreur = "L'erreur est humaine... Vérifiez votre mot de passe.";
            }
        } else {
            $erreur = "L'erreur est humaine... Vérifiez votre login";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Connexion - Dreamy</title>

    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="../css/index.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nerko+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=News+Cycle&display=swap" rel="stylesheet">
</head>

<body>
    <main class="mainInscription">
        <section class="section no-pad-bot valign-wrapper center mainSection">
            <article class="container">
                <div class="row">

                    <form class="col m6 offset-m3 s10 offset-s1" action="connexion.php" method="post">
                        <div class="row center">
                            <div class="input-field col s6 m10 offset-m1 offset-s3">
                                <input id="login" name="login" type="text" class="validate">
                                <label for="login">Login</label>
                            </div>
                        </div>

                        <div class="row center">
                            <div class="input-field col s6 m10 offset-m1 offset-s3">
                                <input id="password" name="password" type="password" class="validate">
                                <label for="password">Password</label>
                            </div>
                        </div>

                        <div class="row center">
                            <button class="btn waves-effect waves-light pink lighten-3" type="submit" name="formConnexion">Se connecter</button>
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
                    <?php echo $date = date('l d F'); ?>
                    <blockquote>
                            <em>L'automne est la saison la plus rude.
                            Les feuilles tombent, et elles tombent comme si elles tombaient amoureuses du sol.</em>
                            #Dreamy_is_a_mood
                    </blockquote>
                </div>
                <div class="col l4 offset-l2 s12">
                    <ul>
                        <li><a href="../index.php"><i class="material-icons">keyboard_backspace</i> Accueil</a></li>
                        <?php if (!isset($_SESSION['id'])) : ?>
                            <li><a href="inscription.php"><i class="material-icons">create</i> Inscription</a></li>
                        <?php else : ?>
                            <li><a href="profil.php"><i class="material-icons">assignment_ind</i> Profil</a></li>
                            <li><a href="logout.php"><i class="material-icons">close</i> Déconnexion</a></li>
                        <?php endif; ?>
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