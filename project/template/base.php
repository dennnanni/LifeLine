<!DOCTYPE html>
<html lang="it">
    <head>
        <title><?php echo $templateParams["title"]; ?></title>
        <meta charset="UTF-8"/>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
        <link href='https://fonts.googleapis.com/css?family=Meow Script' rel='stylesheet'>

        <?php if(isset($templateParams["js"])): ?>
            <script type="text/javascript" src="js/<?php echo $templateParams["js"]?>"></script>
        <?php endif; ?>
    </head>
    
    <body class="d-flex flex-column min-vh-100">
        <main>
            <?php require($templateParams["active"]); ?>
        </main>
    </body>
</html>