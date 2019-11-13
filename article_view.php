<?php
    require_once "UserBD.php";
    
    if(session_status() != 2){
        session_start();
    }

    if(!isset($_SESSION["connected"]) || $_SESSION["connected"] == false){
        echo "not connected";
        header("Location:index.php?page=connexion");
        exit();
    }

    if(!isset($_GET["article_id"])){
        header("Location:index.php?page=articles");
        exit();
    }
?>
<!doctype html>
<html>
    <head>
        <title>
            Article
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
            include("menu.php");
        ?>
        <div class="container-fluid">
            <div class="container">
                <div class="card" style="margin-top:40px;background-color:whitesmoke">
                    <div class="card-body">
                        <?php
                            $mainArticle = getOneArticleByArticleId($_GET["article_id"]);
                            $date = new DateTime($mainArticle -> date);
                            echo "
                                <h3 class='card-title'>
                                    ".$mainArticle -> titre."
                                </h3>
                                <small>par : <b style='color:#4678fd'>".$mainArticle -> user."</b></small><br>
                                <small  style='color:gray'> le ".$date->format('Y-m-d H:i')."</small>
                                <p class='card-text' style='border:1px solid gray;border-radius:3px;margin-top:20px;padding:5px'>
                                    ".$mainArticle -> message."
                                </p>
                            ";
                        ?>
                    </div>
                </div>
            </div>
            <div class="container" style="margin-top:15px;">
                <h3 style="text-align:center" class="bg-light">
                    Réponses
                </h3>
                <div style="margin-top:15px">    
                    <?php
                        $comments = getCommentsByArticleId((int)$_GET["article_id"]);
                            //var_dump($comments);
                        foreach ($comments as $value) {
                            $date = new DateTime($value -> date);
                            echo "
                                <div style='border-radius:5px; padding:10px;margin-bottom:15px' class='card'>
                                    <small>Re : ".$value -> titre."</small><br>
                                    <small>par : <b style='color:#4678fd'>".$value -> user."</b></small>
                                    <small style='color:gray'> le ".$date -> format('Y-m-d H:i')."</small>    
                                    <p style='margin-top:20px;padding:5px'>
                                        ".$value -> message."
                                    </p>
                                </div>
                            ";
                        }
                    ?>
                </div>
                <?php
                    $action = "message_article_id=".$_GET['article_id']."&user=".$_SESSION["user"]."&titre=".$mainArticle -> titre;
                    echo  "<div class='card' style='margin-top:20px;padding:10px'>
                    <form  action='index.php?".$action."' method='post'>
                        <div class='form-group'>
                        <label>
                            Votre message :
                            <textarea class='form-control form-control-lg' cols='100' rows='3' name='message'></textarea>
                        </label>
                        </div>
                        <button class='btn btn-primary'>
                            Envoyer le message
                        </button>
                    </form>            
                </div>"
                ?>

            </div>
        </div>
    </body>
</html>