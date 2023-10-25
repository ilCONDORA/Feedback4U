<?php
// Avvia la sessione
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
?>
<!DOCTYPE html>
<html lang="it-IT">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Header Feedback4U</title>
  <style>
    * {
      padding: 0;
      margin: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    .header {
      z-index: 10;
      position: fixed;
      display: flex;
      top: 0;
      width: 100%;
      flex-direction: row;
      align-items: center;
      background-color: burlywood;
      justify-content: space-between;
      padding: 20px 25px;
      backdrop-filter: blur(10px);
    }

    .logo {
      height: 60px;
    }

    .svg {
      height: 40px;
    }

    .containerIcone {
      display: flex;
      align-items: center;
      justify-content: center;
      column-gap: 0.75rem;
    }

    .cardUser{
      display: flex;
      justify-content: center;
      align-items: center;
      
    }
  </style>
</head>

<body>
  <header class="header">
    <a href="index.php"><img src="./images/logo.png" alt="logo FeedbackForU" class="logo" /></a>
    <div>
      <?php
      if (isset($_SESSION["email"])) {
        $first_name = $_SESSION['name'];
        // The user is logged in
        echo "
              <div class='containerIcone'>
                <div class='cardUser'>
                  <p style='margin-right: 0.5rem'>Benvenuto <b>$first_name</b></p>
                  <a href='accountPage.php'>
                    <img src='./svg/user-2.svg' alt='bottone account' class='svg'/>
                  </a>
                </div>
                <p style='font-size:1.5rem'>|</p>
                <a href='?logout=1' style='margin-right:20px'>
                  <img src='./svg/logout.svg' alt='bottone logout' class='svg'/> 
                </a>
              </div>
            ";
      } else {
        // The user is not logged in
        echo '
              <a href="login.php">
                <img src="./svg/user-2.svg" alt="bottone login" class="svg"/>
              </a>
            ';
      }
      if (isset($_GET['logout'])) {
        // Se il parametro 'logout' è presente nell'URL, termina la sessione
        session_unset();
        session_destroy();
        echo'
              <script>window.location.href="homePage.php";</script>
            ';
        exit();
      }
      ?>
    </div>
  </header>
</body>

</html>