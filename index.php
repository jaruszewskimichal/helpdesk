<!DOCTYPE HTML>
<html lang="pl-PL">

    <head>
        <title>Help Desk</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script
        src="http://code.jquery.com/jquery-3.5.1.slim.js"
        integrity="sha256-DrT5NfxfbHvMHux31Lkhxg42LY6of8TaYyK50jnxRnM="
        crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">      
        <link rel="stylesheet" type="text/css" href="Logging/Login-style.css">
        <script src="Logging/Login.js"></script>
        <link rel="stylesheet" type="text/css" href="Nav/Navbar-Style.css">
        <link rel="stylesheet" type="text/css" href="Main/Main-Style.css">
    </head>

    <body>
    <?php

        // jedyne miejsce w ktorym ustawiona jest sesja
        // poniewaz strona nie bedzie przekierowwywac na inne podstrony
        // bedzie podmieniac tylko komponenety
        session_start();




        // Jesli nie jest ustawiona zmienna sesyjna user,
        // strona przekierowuje do komponentu Logging, aby mozna bylo sie zalogowac
        if (!isset($_SESSION['user']))
            include_once("Logging/Logging.php");

        //Zostaje dodana zawartosc paska nawigacyjnego strony,
        // w zaleznosci od linku czy konczy sie na ?NewTicket czy na ?Main
        // strona podmienia wlasciwy komponent
        else{
            include_once('Nav/Navbar.php');

            if (isset($_GET['NewTicket']))
                include_once('NewTicket/NewTicket.php');

            if (isset($_GET['Main']))
                include_once('Main/Main.php');

            if (isset($_GET['id']))
                include_once('Main/DeleteRecord.php');
        }
    ?>
</body>
</html>