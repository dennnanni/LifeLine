<!DOCTYPE html>
<html lang="it">
    <head>
        <title><?php echo $templateParams["title"]; ?></title>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
        <link href='https://fonts.googleapis.com/css?family=Meow Script' rel='stylesheet'>
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
        <script src="https://kit.fontawesome.com/711c6e0480.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script type="text/javascript" src="js/base.js"></script>

        <?php if(isset($templateParams["js"])): ?>
            <script type="text/javascript" src="js/<?php echo $templateParams["js"]?>"></script>
        <?php endif; ?>
    </head>
    
    <body class="d-flex flex-column min-vh-100">
        <?php require($templateParams["active"]); ?>
    </body>
</html>