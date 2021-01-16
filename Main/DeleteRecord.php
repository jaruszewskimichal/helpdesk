<?php

// jesli nie ma aktywnej sesji usera, nie bedzie mozna wpisac z reki podanego linku
// aby usunac record
if (!$_SESSION['user'])
    header("Location: index.php");


$connection = mysqli_connect("localhost", "root", "", "helpdesk");
if (!$connection) {
  die("Połączenie z bazą danych nie powiodło się: " . mysqli_connect_error());
}

$db_select = mysqli_select_db($connection, "helpdesk");
if (!$db_select) {
  die("Wybór bazy danych nie powiódł się: " . mysqli_connect_error());
}

// pobieramy z linku wartosc id konkretnego ticketu.
$id = $_GET['id'];

$query = "SELECT * FROM tickets WHERE Id_Tickets=$id";

$result = mysqli_query($connection, $query) or die("Coś poszło nie tak");
$countRow = mysqli_num_rows($result);

if ($countRow > 0){
  while ($row = mysqli_fetch_assoc($result)) { 
      $rows[] = $row; 
  } 
  $ticketName = $rows[0]['Ticket_name'];
  $ticketDescription = $rows[0]['Ticket_description'];
  $IdUser = $rows[0]['Id_User'];
}

$query = "DELETE FROM tickets WHERE Id_Tickets=$id";
mysqli_query($connection, $query) or die("Coś poszło nie tak");

$query = "INSERT INTO ticketsarchiv (Id_Tickets, Ticket_name, Ticket_description, Id_User)
VALUES ('$id', '$ticketName', '$ticketDescription', '$IdUser')";

(mysqli_query($connection, $query) and header("Location: index.php?Main")) or die("Coś poszło nie tak");


mysqli_close($connection);

?>