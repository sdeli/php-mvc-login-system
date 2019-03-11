<!DOCTYPE html>
<html lang="en">
<?php include '../App/views/partials/header.php'; ?>
<style>
    .post {
        margin : 0px 0px 20px
    }

    .post__title {
        margin : 0px 5px;
    }

    .post__title__h3 {
        margin:0px;
        padding: 5px 0px 5px;
    }

    .post__body {
        margin : 0px 5px;
    }

    .post__body__paragraph {
        margin : 5px 0px;
    }
</style>
<body>
    <?php include '../App/views/partials/flash-notification.php'; ?>
    
    <h1>Display Posts</h1>

    <?php foreach ($posts as $currPost) { ?>
        <div class='post'>
            <div class='post__title'>
                <h3 class='post__title__h3'><?= $currPost->title ?></h3>
            </div>

            <div class='post__body'>
                <p class='post__body__paragraph'><?= $currPost->body ?></p>
                <small class='post__body__author'><?= $currPost->author ?></small>
            </div>
        </div>
    <?php } ?>

<?php include '../App/views/partials/scripts.php'; ?>
</body>
</html>