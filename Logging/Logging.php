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
    $user=$_REQUEST["user"];
    $pass=$_REQUEST["pass"];

    $userSafe = htmlentities($user, ENT_QUOTES, "UTF-8");
    $passSafe = htmlentities($pass, ENT_QUOTES, "UTF-8");


    // zabezpieczenia przed sql injection
    $query=mysqli_query($connection,sprintf("SELECT * FROM users WHERE Login='%s' && Password='%s'",
    mysqli_real_escape_string($connection, $userSafe),
    mysqli_real_escape_string($connection, $passSafe)));
    $rowcount=mysqli_num_rows($query);
    

    if($rowcount){

        while ($row = mysqli_fetch_assoc($query)) { 
            $rows[] = $row; 
        }
        $_SESSION['user'] = $user;
        $_SESSION['IdCurrentUser'] = $rows[0]['Id'];
        $_SESSION['UserName'] = $rows[0]['Name'];
        $_SESSION['UserSurname'] = $rows[0]['Surname'];

        
        header('location: index.php?Main');
    }
    else
      $InCorrectLogging = true;
      // jesli nie zostanie dopasowany login oraz haslo incorrectlogin ustawi sie flga true
  }
?>
<div class="container">
  <h1>Zaloguj się do systemu <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-down-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
      <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5A.5.5 0 0 1 8 4z"/>
      </svg>
  </h1>

    <div class="card w-100">
      <div class="card-body">
            <form method="post">
              
              <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Login</label>
                <div class="col-sm-10">
                  <input class="form-control" id="inputLogin" name='user' required>
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Hasło</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="pass" name='pass' required>
                </div>
              </div>

              <div class="button-center-position">
                <button type='submit' name='submit' class="btn btn-primary addmycss">Zaloguj się</button>
              </div>
              <h4 class="WrongPasswordOrLogin">
                <?php
                  if (isset($InCorrectLogging)){
                    echo "Niepoprawny Login lub hasło";
                    $InCorrectLogging = false;
                  }
                ?>
              </h4>    
          </form>

        </div> 
    </div>
  
</div>



