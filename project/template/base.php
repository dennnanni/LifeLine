<!DOCTYPE html>
<html lang="it">
    <head>
        <title><?php echo $templateParams["title"]; ?></title>
        <meta charset="UTF-8"/>
        <link href="css/style.css" type="text/css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>    
    <body>
        <?php
            require("header.php");
        ?>
        <main>
            <?php
                require($templateParams["active"]);
            ?>
        </main>
        <?php
            require("footer.php");
        ?>
    </body>
</html>