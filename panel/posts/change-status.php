<?php 
    require_once '../../functions/helpers.php';
    require_once '../../functions/pdo_connection.php';
    require_once '../../functions/check-login.php';





    global $pdo;

    if(isset($_GET['post_id']) and $_GET['post_id'] !== ''){
        $query = 'SELECT * FROM posts WHERE id = ?';
        $statement = $pdo->prepare($query);
        $statement->execute([$_GET['post_id']]);
        $post = $statement->fetch();
    
        if($post !== false){

            $status = ($post->status == 16) ? 0 : 16;
            $query = 'UPDATE posts SET `status` = ? WHERE id = ? ;';
            $statement = $pdo->prepare($query);
            $statement->execute([$status, $_GET['post_id']]);
        }
    }

    redirect('panel/posts');