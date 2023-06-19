<?php

use function PHPSTORM_META\elementType;

    require_once 'functions/helpers.php';
    require_once 'functions/pdo_connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP tutorial</title>
    <link rel="stylesheet" href="<?= asset('assets/css/bootstrap.min.css') ?>" media="all" type="text/css">
    <link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>" type="text/css">
</head>
<body>
<section id="app">
<?php require_once "layouts/top-nav.php"?>
    <section class="container my-5">
      <?php 
            global $pdo;

            $notFound = false;
            if(isset($_GET['cat_id']) && $_GET['cat_id'] !== ''){

            $query = 'SELECT * FROM categories WHERE id = ?';
            $statement = $pdo->prepare($query);
            $statement->execute([$_GET['cat_id']]);
            $category = $statement->fetch();

            if($category !== false){
      ?>
            <section class="row">
                <section class="col-12">
                    <h1><?= $category->name ?></h1>
                    <hr>
                </section>
            </section>
            <section class="row">
            
            <?php 

            global $pdo;
            $query = "SELECT * FROM posts WHERE `status` = 16 AND cat_id = ?;";
            $statement = $pdo->prepare($query);
            $statement->execute([$_GET['cat_id']]);
            $posts = $statement->fetchAll();
            foreach($posts as $post){
           ?>



                    <section class="col-md-4">
                        <section class="mb-2 overflow-hidden" style="max-height: 15rem;"><img class="img-fluid" src="" alt=""></section>
                        <h2 class="h5 text-truncate"><?= $post->title ?></h2>
                        <p><?= substr($post->body, 0, 30) ?>...</p>
                        <p><a class="btn btn-primary" href="<?= url('detail.php?post_id=' . $post->id) ?>" role="button">View details »</a></p>
                    </section>
                 
            </section>
            <?php }}else{
                    $notFound = true;
                    }} else{
                    $notFound = true;
                    }

                    if($notFound){
                ?>
            <section class="row">
                <section class="col-12">
                    <h1>Category not found</h1>
                </section>
            </section>
                <?php } ?>
        </section>
    </section>

</section>
<script src="<?= asset('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= asset('assets/js/bootstrap.min.js') ?>"></script>
</body>
</html>