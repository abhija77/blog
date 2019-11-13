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
?>
<!doctype html>
<html>
    <head>
        <title>
            Voir Article
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
        <div class="container-fluid" style='margin-top:40px'>
            <?php
                $articles = getOthersArticles($_SESSION["user"]);
                echo"
                    <table class='table'>
                    <thead>
                        <tr>
                        <th scope='col'>Author</th>
                        <th scope='col'>Titre</th>
                        <th scope='col'>Date de publication</th>
                        <th scope='col'>Lien</th>
                        </tr>
                    </thead>
                    <tbody>
                ";
                foreach ($articles as $value) {
                    echo "
                        <tr>
                            <th>".$value -> user."</th>
                            <th>".$value -> titre."</th>
                            <th>".$value -> date."</th>
                            <th><a href='index.php?article_id=".$value -> article_id."'>Voir L'article</a></th>
                        </tr>
                    ";
                }
                echo"</tbody></table>";
            ?>
        </div>
    </body>

</html>