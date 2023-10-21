<?php include 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Page</title>
    <style>
        main{
            margin-top: 104px;
        }
    </style>
</head>
<body>
    <main>
        <?php include('header.php'); ?>
        <h1>Account Page</h1>
        <?php
        // Inizia la sessione (se non è già stata iniziata)
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Verifica se le variabili di sessione esistono
        if (isset($_SESSION['name']) && isset($_SESSION['surname']) && isset($_SESSION['email'])) {
            // Recupera i dati dalla sessione
            $first_name = $_SESSION['name'];
            $last_name = $_SESSION['surname'];
            $email = $_SESSION['email'];
            $idRole = $_SESSION['idRole'];

            // Visualizza i dati dello studente
            if ($idRole == 2) {
                echo "<p>Nome: $first_name</p>";
                echo "<p>Cognome: $last_name</p>";
                echo "<p>Email: $email</p>";
            } elseif ($idRole == 1) {
                echo "<p>Salve Admin</p>";
            } 
        } else {
            echo "Non hai effettuato l'accesso.";
        }
        ?>
        <h2>Risultati</h2>
        <?php
        if ($idRole == 2) {
            $sql = "SELECT idVote, vote, date, subject from votes v left join users u on u.idUser = v.idUser right join subjects s on s.idSubject = v.idSubject where u.email = '$email'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "voto: ". $row["vote"]. " materia ". $row["subject"]. " data: ". $row["date"]. "<a href='feedback.php?vote_id=".$row["idVote"]."'>leave a feedback</a><br>";
                }
            } else {
                echo "Nessun voto trovato";
            }
        } elseif ($idRole == 1) {
            $sql1 = "SELECT idVote, vote, date, subject,first_name, last_name, email from votes v inner join users u on u.idUser = v.idUser inner join subjects s on s.idSubject = v.idSubject";
            $result1 = $conn->query($sql1);
            if ($result1->num_rows > 0) {
                while($row = $result1->fetch_assoc()) {
                    echo "studente: ". $row["first_name"]. " ". $row["last_name"]. "<br>email: ". $row["email"]. "<br>";
                    echo "voto: ". $row["vote"]. " materia ". $row["subject"]. " data: ". $row["date"]. "<br><br>";
                }
            } else {
                echo "Nessun voto trovato";
            }
        }
        ?>
        <?php
        if ($idRole == 1) {
            echo "<h2>Feedbacks</h2>";
            $sql = "SELECT first_name, last_name, email, subject, stars ,message from feedbacks f inner join users u on u.idUser = f.idUser inner join subjects s on s.idSubject = f.idSubject";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "studente: ". $row["first_name"]. " ". $row["last_name"]. "<br>email: ". $row["email"]. "<br>";
                    echo "Rating: " .$row["stars"]. "<br>Feedback: " .$row["message"]. "<br><br>";
                }
            } else {
                echo "Nessun voto trovato";
            }
        }
        $conn->close();
        ?>
        <?php include('footer.php'); ?>
    </main>
</body>
</html>
