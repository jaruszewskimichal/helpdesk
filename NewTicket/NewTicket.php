<?php
  $connection = mysqli_connect("localhost", "root", "", "helpdesk");
  if (!$connection) {
    die("Połączenie z bazą danych nie powiodło się: " . mysqli_connect_error());
  }

  $db_select = mysqli_select_db($connection, "helpdesk");
  if (!$db_select) {
    die("Wybór bazy danych nie powiódł się: " . mysqli_connect_error());
  }

  if(isset($_REQUEST["submit"])) //PRZYCISK ZALOGUJ
  {
    // filter przeksztalcajacy pobrane dane w bezpieczny string - aby unimozliwic sql injection
    $TicketName = filter_var($_REQUEST['TicketName'], FILTER_SANITIZE_STRING);
    $TicketDescription = filter_var($_REQUEST['TicketDescription'], FILTER_SANITIZE_STRING);
    $Prio = $_REQUEST['Prio'];
    $userId = $_SESSION['IdCurrentUser'];

    $query =
    "INSERT INTO tickets (Ticket_name, Ticket_description, Id_User, Prio)
    VALUES ('$TicketName', '$TicketDescription', '$userId', '$Prio')";

    // jesli bedzie problem z dodaniem krotki do bazy, wtedy wyskakuje komunikat ze cos sie nie udalo
    (mysqli_query($connection, $query) and header('location: index.php?Main')) or die("Cos poszło nie tak, spróbuj później"); 
    $connection = null;
  }
?>



<div class="container">


    <div class="row">
        <div class="col-sm"></div>
        <div class="col-sm-6">
        

    <div class="card">
        <div class="card-body">
        
            <form method="post">
                <fieldset>
                    <legend>Dodaj nowy ticket</legend>
                    <div class="mb-3">
                    <label for="inputTicketName" class="form-label">Podaj nazwe</label>
                    <input type="text" id="inputTicketName" class="form-control" placeholder="Nazwa Ticketu"
                    name='TicketName' required>
                    </div>
                    <div class="mb-3">
                    <label for="inputTicketDescription" class="form-label">Podaj krótki Opis</label>
                    <input type="textfield" id="inputTicketDescription" class="form-control" placeholder="Opis"
                    name='TicketDescription' required>
                    </div>
                    <label for="customRange2" class="form-label">Priorytet
                    <input type="text" id="textInput" name='Prio' value="2" style='border:0; width:20' readonly>
                    </label>
                      <input type="range" class="form-range" min="1" max="3" id="customRange2" 
                      onchange="updateTextInput(this.value);">
                      

                    <button name='submit' type='submit' class="btn btn-primary">Dodaj</button>
                </fieldset>
            </form>

        </div>
    </div>

        </div>
        <div class="col-sm"></div>
    </div>
</div>

<script>
function updateTextInput(val) {
    document.getElementById('textInput').value=val; 
}
</script>