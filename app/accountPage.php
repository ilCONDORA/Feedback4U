<?php
 // Avvia la sessione
 if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'connection.php';
?>
<!DOCTYPE html>
<html lang="it-IT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Page Feedback4U</title>
    <style>
        main {
            margin-top: 104px;
        }

        .sectionAccount {
            display: flex;
            padding: 2rem;
            min-height: 70vh;
        }

        .card1 {
            width: 25rem;
        }

        .card2 {
            margin-top: 2.5rem;
            width: 50%
        }

        .datiStudenti{
            font-size: 1rem;
        }
    </style>
</head>
<body>
    <main>
        <?php include('header.php'); ?>
        <section class="sectionAccount">
            <div style="width: 50%;">
                <div class="card1">
                    <h1>Account Page</h1>
                    <?php
                    // Verifica se le variabili di sessione esistono
                    if (isset($_SESSION['name']) && isset($_SESSION['surname']) && isset($_SESSION['email'])) {
                        // Recupera i dati dalla sessione
                        $first_name = $_SESSION['name'];
                        $last_name = $_SESSION['surname'];
                        $email = $_SESSION['email'];
                        $idRole = $_SESSION['idRole'];

                        // Visualizza i dati dello studente
                        if ($idRole == 2) {
                            echo"
                                    <p class='datiStudenti'>Nome: $first_name</p>
                                ";
                            echo"
                                    <p class='datiStudenti'>Cognome: $last_name</p>
                                ";
                            echo"
                                    <p class='datiStudenti'>Email: $email</p>
                                ";
                        } /* elseif ($idRole == 1) {
                            echo"
                                    <div style='margin-top: 1rem'>
                                        <p>Salve  $first_name</p>
                                    </div>
                                ";
                        } */
                    } else {
                        echo"
                                <p>Non hai effettuato l'accesso.</p>
                            ";
                    }
                    ?>
                    <h2 style="margin-top: 1rem;">Risultati:</h2><br>
                    <?php
                    if ($idRole == 2) {
                        $sql = "SELECT idVote, vote, date, subject from votes v left join users u on u.idUser = v.idUser right join subjects s on s.idSubject = v.idSubject where u.email = '$email'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo"
                                        <div style='display: flex; flex-direction:column; line-height: 1.5;'>
                                            <p class='datiStudenti'>Voto: ".$row["vote"]."</p>
                                            <p class='datiStudenti'>Materia: ".$row["subject"]."</p>
                                            <p class='datiStudenti'>Data: ".$row["date"]."</p>
                                            <a style='text-decoration: none;color: #f9a339;;cursor:pointer' href='feedback.php?vote_id=".$row["idVote"]."'><b>Lascia un feedback!</b></a>
                                            <br>
                                            <hr>
                                            <br>
                                        </div>
                                    ";
                            }
                        } else {
                            echo"
                                    <p>Nessun voto trovato</p>
                                ";
                        }
                    } elseif ($idRole == 1) {
                        $sql1 = "SELECT idVote, vote, date, subject,first_name, last_name, email from votes v inner join users u on u.idUser = v.idUser inner join subjects s on s.idSubject = v.idSubject";
                        $result1 = $conn->query($sql1);
                        if ($result1->num_rows > 0) {
                            while ($row = $result1->fetch_assoc()) {
                                echo"
                                        <div style='display: flex; flex-direction:column; line-height: 1.5;'>
                                            <p>Studente: ".$row["first_name"]." ".$row["last_name"]."</p>
                                            <p>Email: ".$row["email"]."</p>
                                            <p>Voto: ".$row["vote"]."</p>
                                            <p>Materia: ".$row["subject"]."</p>
                                            <p>Data: ".$row["date"]."</p>
                                            <br>
                                            <hr>
                                            <br>
                                        </div>
                                    ";
                            }
                        } else {
                            echo"
                                    <p>Nessun voto trovato</p>
                                ";
                        }
                    }
                    ?>
                </div>
            </div>

            <div class="card2">
                <?php
                if ($idRole == 1) {
                    echo "<h2>Feedbacks:</h2><br>";
                    $sql = "SELECT first_name, last_name, email, subject, rating ,message from feedbacks f inner join users u on u.idUser = f.idUser inner join subjects s on s.idSubject = f.idSubject";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo"
                                    <div style='display: flex; flex-direction:column; line-height: 1.5;'>
                                        <p>Studente: ".$row["first_name"]." ".$row["last_name"]."</p>
                                        <p>Email: ".$row["email"]."</p>
                                        <p>Materia: ".$row["subject"]."</p>
                                        <p>Rating: ".$row["rating"]."</p>
                                        <article>Feedback:
                                            <p style='background-color:#eaeaea;margin-top:0.5rem;border: 1px solid black;padding: 0.5rem'> ".$row["message"]."</p>
                                        </article>
                                        <br>
                                        <hr>
                                        <br>
                                    </div>

                                ";
                        }
                    } else {
                        echo"
                                <p>Nessun voto trovato</p>
                            ";
                    }
                }
                $conn->close();
                ?>
            </div>
        </section>
        <?php include('footer.php'); ?>
    </main>
</body>
</html>