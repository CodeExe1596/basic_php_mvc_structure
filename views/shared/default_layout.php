<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Fav Icon -->
        <link rel = "shortcut icon" href = "<?= WEB_ROOT . 'app/img/static_img/...' ?>">
        <!-- Title -->
        <title> <?= $title ?></title>
        <!-- CSS -->
        <link rel = "stylesheet" type = "text/css" href = "<?= WEB_ROOT . 'app/css/app.css' ?>">
        <!-- JS -->
        <script src = "<?= WEB_ROOT . 'app/js/app.js' ?>"></script>
    </head>
    <body>
        
        <!-- header -->
        <?php require_once(ROOT . 'views/inc/header.php'); ?>

        <div id = "main-body" tabindex = "1">
            <!-- View -->
            <?= $content ?>
        </div>
    
        <!-- footer -->
        <?php require_once(ROOT . 'views/inc/footer.php'); ?>
    </body>
</html>