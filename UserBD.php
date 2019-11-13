<?php



    //**********************USER**************************** */

    function userLogin($name, $password){
        
        try {
            $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
            $filter = ["user" => $name,"password" => $password ];
            $query = new MongoDB\Driver\Query($filter,[]);
            return $manager -> executeQuery("blog.users",$query);
        }
    
        catch(\MongoDB\Driver\Exception\QueryException $e){
            echo $e -> getMessage();
            return null;
        }
        
        
    }

     function createNewUser($name, $password){
        try {
            $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
            $single_insert = new MongoDB\Driver\BulkWrite();
            $single_insert -> insert(["user" => $name, "password" => $password]);
            $manager -> executeBulkWrite('blog.users',$single_insert);
        }
        catch(\MongoDB\Driver\Exception\BulkWriteException $e){
            echo $e -> getMessage();
        }

    }

    function isUserNameExist($user){
        $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
        $query = new MongoDB\Driver\Query(['user' => $user]);
        $response = $manager-> executeQuery("blog.users", $query);

        $isExist = false;

        foreach ($response as $value) {
            echo json_encode($value);
            if(strcmp($value -> user,$user) == 0){
                $isExist = true;
            }
        }

        echo (int)$isExist;

        return $isExist;

    }

    function isUserExist($user,$password){
        $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
        $query = new MongoDB\Driver\Query(['user' => $user]);
        $response = $manager-> executeQuery("blog.users", $query);

        $isExist = false;

        foreach ($response as $value) {
            echo json_encode($value);
            if(strcmp($value -> user,$user) == 0 && strcmp($value -> password,$password) == 0){
                $isExist = true;
            }
        }

        echo (int)$isExist;

        return $isExist;

    }

    /****************************Articles**********************************/

    function getAllArticlesOfUser($userName){
        $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
        $query = new MongoDB\Driver\Query(["user" => $userName, "parentId" => null]);
        $resp = $manager -> executeQuery("blog.messages",$query);
        $i = 0;
        $finalResponse = array();

        foreach ($resp as $value) {
            
            $finalResponse[$i++] = $value;
        }

        return $finalResponse;


    }

    function getOneArticleByArticleId($article_id){
        $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
        $query = new MongoDB\Driver\Query(["article_id" => (int)$article_id]);
        $response = $manager -> executeQuery("blog.messages",$query);

        $finalResponse;

        foreach ($response as $value) {
            $finalResponse = $value;
        }
        return $finalResponse;
    }

    function getCommentsByArticleId($article_id){
        $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
        $query = new MongoDB\Driver\Query(["parentId" => $article_id]);
        $response = $manager -> executeQuery("blog.messages",$query);

        return $response;
    }

    function createMessage($user,$article_id,$title,$message){
        $date = new DateTime();
        try {
            $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
            $single_insert = new MongoDB\Driver\BulkWrite();
            $single_insert -> insert([
                "user" => $user, 
                "article_id" => (int)$article_id + rand(1,400),
                "titre" => $title,
                "message" => $message,
                "parentId" => (int)$article_id,
                "date" => date_format($date,"D M j Y H:i:s")]);
            $manager -> executeBulkWrite('blog.messages',$single_insert);
        }
        catch(\MongoDB\Driver\Exception\BulkWriteException $e){
            echo $e -> getMessage();
        }
    }

    function createArticle($user,$title,$message){
        $date = new DateTime();
        try {
            $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
            $single_insert = new MongoDB\Driver\BulkWrite();
            $single_insert -> insert([
                "user" => $user, 
                "article_id" => round(microtime(true)),
                "titre" => $title,
                "message" => $message,
                "parentId" => null,
                "date" => date_format($date,"D M j Y H:i:s")]);
            $manager -> executeBulkWrite('blog.messages',$single_insert);
        }
        catch(\MongoDB\Driver\Exception\BulkWriteException $e){
            echo $e -> getMessage();
        }
    }

    function getOthersArticles($user){
        $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
        $query = new MongoDB\Driver\Query(["user" => ['$ne' => $user],"parentId" => null]);
        $response = $manager -> executeQuery("blog.messages",$query);

        return $response;
    }

?>