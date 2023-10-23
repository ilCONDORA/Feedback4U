<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FeedbackForU</title>
  <style>
    * {
      padding: 0;
      margin: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    main {
      margin-top: 104px;
    }

    .mainContainer {
      display: flex;
      background-color: #C1C1C1;
      height: 60vh;
      padding: 1rem;
    }

    .card1{
      display: flex;
      flex-direction: column;
      width: 30%;
      justify-content: center;
      padding: 2rem;
    }

    .card1 a{
      display: flex;
      align-items: center;
      margin-top: 1.5rem;
      background-color: #DEB887;
      width:16.5rem;
      justify-content: center;
      text-decoration: none;
      color: black;
      border: 2px solid black;
      box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px;
      height: 3.5rem;
    }

    .card1 a:hover{
      background-color: #f9a339;
      transition-duration: 0.3s;
    }

    .imgLogo{
      width: 15rem;
      margin-bottom: 1.2rem;
    }

    .landing {
      width: 70%;
      background-image: url('./images/heroSection.png');
      background-size: cover;
      display: flex;
      flex-direction: row;
      align-items: end;
      justify-content: center;
    
    }

    .landing h1 {
      font-size: 2rem;
      padding: 15px;
      color: white;
      border-radius: 10px;
      background-color: rgba(0, 0, 0, 0.5);
    }

   

    article {
      display: flex;
      flex-direction: column;
      width: 380px;
    }

    article h3 {
      margin: 15px 0;
    }

    article img {
      border-radius: 15px;
    }
  </style>
</head>

<body>
  <main>
    <?php include('header.php'); ?>
    <section class="mainContainer">
      <div class="card1">
        <img src="./images/logo - Copia.png" alt="" class="imgLogo">
        <h2>
         Visualizza voti e fornisci feedback alle materie.
        </h2>
        <?php
        // Start the session
        if (session_status() == PHP_SESSION_NONE) {
          session_start();
        }

        if (isset($_SESSION["email"])) {
          // The user is logged in
          echo '<a href="accountPage.php"
              ><b>Vai subito al tuo account</b
              ><img src="./svg/user-2.svg" alt="bottone account" style="margin-left: 12px; height: 40px;"
            /></a>';
        } else {
          // The user is not logged in
          echo '<a href="login.php"
              ><b>Vai subito al tuo account</b>
              <img
                src="./svg/user-2.svg"
                alt="bottone login"
                style="margin-left: 12px; height: 40px"
              />
            </a>';
        }
        ?>
      </div>
      <div class="landing">

      </div>
    </section>

    <section style="background-color: rgb(205, 205, 205); padding-bottom: 20px">
      <h2 style="display: flex; justify-content: center; padding: 70px 0 35px 0">
        A cosa serve Feedback4U
      </h2>
      <div style="display: flex; justify-content: center">
        <article>
          <img src="./images/img1why.jpg" alt="registra informazioni accademiche" />
          <h3>Gestione delle Informazioni</h3>
          <p>
            Il sito del registro elettronico consente agli insegnanti di
            inserire voti offrendo agli studenti un quadro completo del loro
            progresso.
          </p>
        </article>
        <article style="margin: 0 100px">
          <img src="./images/img2why.jpg" alt="Comunica efficacemente" />
          <h3>Comunicazione Efficace</h3>
          <p>
            Il registro elettronico facilita la comunicazione tra insegnanti e
            studenti tramite feedback di quest'ultimi.
          </p>
        </article>
        <article>
          <img src="./images/img3why.jpg" alt="Informazioni tracciabili" />
          <h3>Tracciabilità e Archiviazione</h3>
          <p>
            Questa piattaforma registra e archivia dati accademici,
            consentendo alle scuole di analizzare le prestazioni degli
            studenti nel tempo e garantendo la sicurezza delle informazioni.
          </p>
        </article>
      </div>
    </section>
    <section style="background-color: rgb(193, 193, 193); padding-bottom: 25px">
      <h2 style="display: flex; justify-content: center; padding: 70px 0 35px 0">
        Come funziona Feedback4U
      </h2>
      <div style="display: flex; justify-content: center">
        <article style="margin-right: 100px">
          <img src="./images/img1how.jpg" alt="Accesso Personale" />
          <h3>Accesso Personale</h3>
          <p>
            Ogni studente ha un account personale che fornisce accesso al
            registro elettronico. <br />
            Qui possono vedere i voti assegnati per ciascuna materia, esami,
            compiti e progetti.
          </p>
        </article>
        <article>
          <img src="./images/img2how.jpg" alt="Feedback" />
          <h3>Inserimento dei Feedback</h3>
          <p>
            Gli studenti hanno la possibilità di lasciare feedback per ogni
            materia. <br />
            Possono condividere commenti, domande o preoccupazioni
            direttamente attraverso la piattaforma.
          </p>
        </article>
      </div>
    </section>
    <?php include('footer.php'); ?>
  </main>
</body>

</html>