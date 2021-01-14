<?php

$connection = mysqli_connect("localhost", "root", "", "helpdesk");
if (!$connection) {
  die("Połączenie z bazą danych nie powiodło się: " . mysqli_connect_error());
}

$db_select = mysqli_select_db($connection, "helpdesk");
if (!$db_select) {
  die("Wybór bazy danych nie powiódł się: " . mysqli_connect_error());
}
$idCurrentUser = $_SESSION['IdCurrentUser'];
$result=mysqli_query($connection,"SELECT * FROM tickets WHERE Id_User='$idCurrentUser'");

try {
    $countRow = mysqli_num_rows($result);
}
catch(Exception $e){
    $countRow = 0;
}


?>

<div class="container">
  <div class="row">
    <div class="col-sm-4">
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

        <?php
        
            
            if ($countRow > 0){
                while ($row = mysqli_fetch_assoc($result)) { 
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
                    echo "<a href='?id=$idTicket' class='card-link'>Usuń</a>";
                    echo '</div>';
                    echo '</div>';
               }

            }else {
                echo "<h2>Niestety, nie masz jeszcze żadnego ticketu</h2>";
            }
            



        ?>


    </div>
  </div>
</div>