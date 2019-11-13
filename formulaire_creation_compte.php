<?php
        if(session_status() != 2){
            session_start();
            session_unset();
        }
        if(isset($_SESSION["connected"]) && $_SESSION["connected"] == true){
            header("Location:index.php?page=articles");
            exit();
        }
?>
<html>
    <head>
        <title>
            Créer mon compte
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
        include('menu.php');
    ?>
        <div class="card bg-light container-fluid d-flex justify-content-center align-items-center mt-5 p-5">
            <h3 style="text-align-center">
                Créer un compte
            </h3>
        <?php
            if(isset($_GET["response"])){
                if(strcmp($_GET["response"],"error")==0){
                    echo "<p style='color:red;text-align:center;'>Ce nom n'est pas disponible</p>";
                }
            }
            
        ?>
            <form    action="index.php?page=check_creation_compte"  method="post" class="d-flex flex-column justify-content-center align-items-center" style="margin-top:20px">
                    <div class="form-group">
                        <label>
                            Username : 
                            <input class="form-control" name="user" type="text">
                        </label>
                    </div>
                    <div class="form-group">
                            <label>
                                password : 
                                <input class="form-control" name="password" type="password">
                            </label>
                        </div>
                        <button class="btn btn-primary" type="submit">
                            Créer un compte
                        </button>
                </form>
        </div> 
    </body>

</html>
           