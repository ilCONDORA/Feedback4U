<!DOCTYPE html>
<html>
  <head>
    <meta charset="ISO-8859-1" />
    <title>FeedbackForU</title>
    <link rel="icon" type="image/x-icon" href="./resources/img/s.png" />
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
        backdrop-filter: blur(6px);
      }
      .logo {
        height: 60px;
      }
      .svg {
        height: 40px;
      }
    </style>
  </head>
  <body>
    <header class="header">
      <a href="homePage.php"
        ><img src="./images/logo.png" alt="logo FeedbackForU" class="logo"
      /></a>
      <div>
        <?php
          // Start the session
          if (session_status() == PHP_SESSION_NONE) {
            session_start();
          }
          if (isset($_SESSION["email"])) {
            // The user is logged in
            echo '<a href="?logout=1" style="margin-right:20px"><img src="./svg/logout.svg" alt="bottone logout" class="svg"
            /></a>
          <a href="accountPage.php"
            ><img src="./svg/user-2.svg" alt="bottone account" class="svg"
          /></a>';
          
          } else {
            // The user is not logged in
            echo '<a href="login.php"
            ><img src="./svg/login.svg" alt="bottone login" class="svg"
          /></a>';
          }
          if (isset($_GET['logout'])) {
            // Se il parametro 'logout' è presente nell'URL, termina la sessione
            session_unset();
            session_destroy();
            header("Location: homePage.php"); // Reindirizza alla pagina di accesso o a qualsiasi altra pagina desiderata
            exit();
        }
        ?>
      </div>
    </header>
  </body>
</html>
