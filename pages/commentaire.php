<?php
    session_start();
    try { //connexion bdd
        $bdd = new PDO('mysql:host=localhost;dbname=livreor;charset=utf8', 'root', '');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    if (isset($_POST['formComm'])) {
        $commentaire = htmlspecialchars($_POST['commentaire']);

        date_default_timezone_set('Europe/Paris');
        $date = date("Y-m-d");

        $query = 'INSERT INTO commentaires (commentaire, id_utilisateur, date) VALUES (?,?,?);';
        $sql = $bdd->prepare($query);
        $sql->execute(array($commentaire, $_SESSION['id'], $date));
        $succes = 'Le commentaire a bien été envoyé, merci belle âme <3.';
    }
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Commentaire - Dreamy</title>

    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="../css/index.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nerko+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=News+Cycle&display=swap" rel="stylesheet">
</head>

<body>
    <main id="mainCommentaire">
        <section class="section valign-wrapper center mainSection">
            <article class="container">
                <div class="row">

                    <form class="col m12" action="commentaire.php" method="post">
                        <div class="row center">
                            <div class="input-field col m12">
                                <input id="commentaire" name="commentaire" type="text" class="validate white-text">
                                <label for="commentaire">Commentaire</label>
                            </div>
                        </div>

                        <div class="row center">
                            <button class="btn waves-effect waves-light pink lighten-3" type="submit" name="formComm">Envoyer</button>
                        </div>
                    </form>

                </div>

                <?php
                if (isset($succes)) {
                    echo '<p class="white-text">' . $succes . '</p>';
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