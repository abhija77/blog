<?php
require_once "UserBD.php";
    if(session_status() != 2){
        session_start();
    }


    if(isset($_SESSION["connected"]) && $_SESSION["connected"] == true){
        
    }   
    else {
        header('Location:index.php?page=connexion');
        exit();
    }
?>
<!doctype html>
<html>
    <head>
        <title>
            Mes messages
        </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="./css/bootstrap.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </head>
    <body class="container">
    <?php
        include("menu.php")
    ?>
    <div class="container-fluid" style="margin-top:40px">
        <a class="btn btn-primary" href='mes_messages.php?form=true'>
        <b >+ </b>Ajouter Un article
        </a>
        <?php
            if(isset($_GET["form"])){
                echo "
                <div class='card container-fluid' style='margin-top:15px;padding:10px;'>
                    <form action='index.php?create_article_user=".$_SESSION['user']."' method='post'>
                        <div class='form-group'>
                            <label>
                                Titre :
                                <input class='form-control' name='titre' required cols=100>
                            </label>
                        </div>
                        <div class='form-group'>
                            <label>
                                Message :
                                <textarea class='form-control' name='message' cols=100 required></textarea>
                            </label>
                        </div>
                        <button type='submit' class='btn btn-primary'>
                            Créer article
                        </button>
                    </form>
                </div>
                ";
            }

        ?>
        <div class="container-fluid mt-2 p-2" style="background-color:white;margin-top:50px">
        <h3 class="bg-light" style="text-align:center">Mes Articles</h3>
            <div class="row">
            <br><br><br><br>
            <?php
                $articles = getAllArticlesOfUser($_SESSION["user"]);
                    foreach($articles as $article){
                        $dat = new DateTime($article -> date);
                        echo "
                            <div class='col-4' style='margin-bottom:15px'>
                                <div class='card'>
                                <div class='card-body'>
                                    <h3 class='card-title text-align-center p-0' >".$article -> titre."</h3>
                                    <p>
                                    <small>Date de publication : ".$dat->format('Y-m-d H:i')."</small>
                                </p>
                                <a href='index.php?article_id=".$article -> article_id."' class='btn btn-primary'>
                                    Voir mon article 
                                </a>
                                </div>
                                </div>
                            </div>
                        ";
                    }
                ?>
            </div>
            

        </div>
        
    </div>
</div>
    </body>
</html>


