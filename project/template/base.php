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

        <?php if(isset($templateParams["js"])): ?>
            <script type="text/javascript" src="js/<?php echo $templateParams["js"]?>"></script>
        <?php endif; ?>
    </head>
    
    <body class="d-flex flex-column min-vh-100">
        <?php require($templateParams["active"]); ?>
    </body>
</html>