<?php
    // Po nacisnieciu przycisku wyloguj na pasku nawigacyjnym,
    // zostaje dodany dodana do linku fraza ?logout, po wychwyceniu tego przez 
    // ponizszy warunek zmienne sesyjne zostaja usuniete
    // a strona sie restartuje.
    // Poniewaz nie ma zmiennych sesyjnych zostaje uaktywniony komponent logging
    if (isset($_GET['logout'])) {
        session_destroy();
        header("Location: index.php");
    }
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light addclass">

<div class="container-fluid">
    <a class="navbar-brand" href="?Main">Help Desk Service</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <?php
                if (isset($_GET['Main']))
                    echo '<a class="nav-link active" href="?Main">Aktualne Zadania</a>';
                else
                    echo '<a class="nav-link" href="?Main">Aktualne Zadania</a>';

                if (isset($_GET['NewTicket']))
                    echo '<a class="nav-link active" href="?NewTicket">Dodaj zadanie</a>';
                else
                    echo '<a class="nav-link" href="?NewTicket">Dodaj zadanie</a>';
            ?>
            <a class="nav-link" href="?logout">Wyloguj się</a>
        </div>
    </div>
</div>

</nav>