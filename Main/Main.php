<?php
$connection = mysqli_connect("localhost", "root", "", "helpdesk");
if (!$connection) {
die("Połączenie z bazą danych nie powiodło się: " . mysqli_connect_error());
}
$idCurrentUser = $_SESSION['IdCurrentUser'];

$Tickets = mysqli_query($connection, "SELECT * FROM tickets WHERE Id_User='$idCurrentUser'");
if (mysqli_num_rows($Tickets) > 0)
    $countRow = mysqli_num_rows($Tickets);
else
    $countRow = 0;

?>

<div class="container">
  <div class="row">
    <div class="col-sm-3">
        <div class="card text-center">
            <div class="card-header">
                
            </div>
            <div class="card-body">
                <h5 class="card-title">
                    <?php
                        echo "Witaj, ", $_SESSION['UserName'];
                    ?>
                </h5>
                <p class="card-text">
                    <?php
                        echo "Dodawaj i usuwaj tickety z zadaniami </br>";
                        echo "Aktualnie masz: ";
                        if ($countRow == 1)
                            echo "jeden ticket";
                        else
                            echo $countRow, " tickety";
                    ?>
                </p>
            </div>
            <div class="card-footer text-muted">
            </div>
        </div>
    
    </div>
    <div class="col-sm-6">

        <h3>Aktualne Tickety</h3>
        <?php
            

            if (mysqli_num_rows($Tickets) > 0){
                while ($row = mysqli_fetch_assoc($Tickets)) { 
                    $rows[] = $row; 
                } 
               
               for($i=0;$i<count($rows);$i++) {
                    $idTicket = $rows[$i]['Id_Tickets'];
                    $mysqldate = $rows[$i]['Date_addition'];
                    echo '<div class="card w-100 myEdit" style="width: 18rem;">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">#', $idTicket, ' ',$rows[$i]['Ticket_name'], "</h5>";
                    echo '<h6 class="card-subtitle mb-2 text-muted">', $mysqldate, '</h6>';
                    echo '<p class="card-text">', $rows[$i]['Ticket_description'], '</p>';
                    echo '<h6 class="card-subtitle mb-2 text-muted">Priorytet: '.$rows[$i]['Prio'] .'</h6>';
                    echo "<a href='?id=$idTicket' class='card-link'>Usuń</a>";
                    echo '</div>';
                    echo '</div>';
               }

            }else {
                echo "<h5>Niestety, nie masz jeszcze żadnego ticketu</h5>";
            }

            $Tickets->close();
            $connection->close();

            $connection = null;
        ?>


    </div>

    <div class="col-sm-3">
        <h3>Wykonane tickety</h3>
    <?php

            $connection = mysqli_connect("localhost", "root", "", "helpdesk");
            if (!$connection) {
            die("Połączenie z bazą danych nie powiodło się: " . mysqli_connect_error());
            }

            $TicketsArchiv = mysqli_query($connection, "SELECT * FROM ticketsarchiv WHERE Id_User='$idCurrentUser'");

            if (mysqli_num_rows($TicketsArchiv) > 0){
                while ($row2 = mysqli_fetch_assoc($TicketsArchiv)) { 
                    $rows2[] = $row2; 
                } 
                
                for($i=0;$i<count($rows2);$i++) {
                    $idTicketArchiv = $rows2[$i]['Id_Tickets'];
                    echo '<div class="card w-100 myEdit" style="width: 18rem;">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">#', $idTicketArchiv, ' ',$rows2[$i]['Ticket_name'], "</h5>";
                    echo '<p class="card-text">', $rows2[$i]['Ticket_description'], '</p>';
                    echo '</div>';
                    echo '</div>';
                }

            }else {
                echo "<h5>Niestety, nie masz jeszcze żadnego zarchiwizowanego ticketu</h5>";
            }
            mysqli_close($connection);

    ?>
    
    
    </div>
  </div>
</div>