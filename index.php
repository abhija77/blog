<?php
require_once 'UserBD.php';
if(session_status() != 2){

    if(session_start()){
        if(!isset($_SESSION["connected"])){
            $_SESSION["connected"] = false;
        }

        
    }
    
}
/*if(session_status() == PHP_SESSION_ACTIVE){
    echo "cnkjwdn";
    if(isset($_SESSION["connected"]) && isset($_SESSION["user"])){
        /*header('Location:mes_messages.php');
        exit();
    }
}*/
if((isset($_GET["create_article_user"])==false && isset($_GET["message_article_id"])==false && isset($_GET["article_id"]) == false && isset($_GET["page"]) == false) || $_GET["page"] == "connexion"){
    session_unset();
    header('Location:formulaire_connexion.php');
    exit();
}

if(isset($_GET["page"])){

    if(strcmp($_GET["page"],"check_connexion") == 0){
        
        if(isset($_POST["user"]) && isset($_POST["password"])){

                if(isUserExist($_POST["user"], $_POST["password"])){
                    $_SESSION["connected"] = true;
                    $_SESSION["user"] = $_POST["user"];
                    header('Location:mes_messages.php');
                    exit();
                }
                else {
                    header("Location:formulaire_connexion.php?response=error");
                    exit();
                }
        }

    }
    if(strcmp($_GET["page"],"check_creation_compte") == 0){
        if(isset($_POST["user"]) && isset($_POST["password"])){

            if(isUserNameExist($_POST["user"])){
                header("Location:formulaire_creation_compte.php?response=error");
                exit();
            }
            else {
                createNewUser($_POST["user"], $_POST["password"]);
               header('Location:mes_messages.php');
               exit();
            }
        }
    }

    if(strcmp($_GET["page"],"articles") == 0){
        header("Location:mes_messages.php");
        exit();
    }

    if(strcmp($_GET["page"],"new") == 0){
        session_unset();
        header("Location:formulaire_creation_compte.php");
        exit();
    }
    if(strcmp($_GET["page"],"voir_articles") == 0){
        header("Location:voir_articles.php");
        exit();
    }
}

if(isset($_GET["article_id"])){
    echo "Article id ".$_GET["article_id"];
    header("Location:article_view.php?article_id=".$_GET["article_id"]);
    exit();
}

if(isset($_GET["message_article_id"]) && isset($_POST["message"])){
    createMessage($_GET["user"], $_GET["message_article_id"],$_GET["titre"],$_POST["message"]);
    header("Location:article_view.php?article_id=".$_GET["message_article_id"]);
    exit();
}

if(isset($_GET["create_article_user"])){
    if(isset($_POST["titre"]) && isset($_POST["message"])){
        createArticle($_GET["create_article_user"],$_POST["titre"],$_POST["message"]);
        header("Location:mes_messages.php");
        exit();
    }
}

?>

