<?php
    session_start();

    try { //connexion bdd
        $bdd = new PDO('mysql:host=localhost;dbname=livreor;charset=utf8', 'root', '');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    $query = "SELECT commentaire, login, date FROM commentaires 
    INNER JOIN utilisateurs ON utilisateurs.id = commentaires.id_utilisateur 
    ORDER BY commentaires.id desc;";
    
    $sql =  $bdd->prepare($query);
    $sql->execute();
    $res = $sql->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Livre d'Or - Dreamy</title>

    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="../css/index.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nerko+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=News+Cycle&display=swap" rel="stylesheet">
</head>

<body>
    <main id="mainLivre">
        <?php
            foreach ($res as $row) { // génération des commentaires
                echo '  <section class="section center">
                            <div class=" container pink lighten-5">
                                <div class="row ">
                                    <div class="col s12">
                                        <h5>posté le ' . $row['date'] . ' par <em class="pink-text lighten-2">' . $row['login'] .   '</em></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12">
                                        <p>' . $row['commentaire'] . '</p> 
                                    </div>
                                </div>
                            </div>
                        </section>';
            }

            if (isset($_SESSION['id'])) { //bouton ajout commentaire si connecté
                echo '<div class="section">
                        <div class="container center">
                            <a href="commentaire.php" class="btn-floating btn-large waves-effect waves-light pink lighten-2"><i class="material-icons">add</i></a>
                        </div>
                    </div>';
            }
        ?>
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
                        <?php
                        if (!isset($_SESSION['id'])) {
                            echo '<li><a href="inscription.php"><i class="material-icons">create</i> Inscription</a></li>
                    <li><a href="connexion.php"><i class="material-icons">login</i> Connexion</a></li>';
                        } else {
                            echo  '<li><a href="profil.php"><i class="material-icons">assignment_ind</i> Profil</a></li>
                            <li><a href="logout.php"><i class="material-icons">close</i> Déconnexion</a></li>';
                        }
                        ?>
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