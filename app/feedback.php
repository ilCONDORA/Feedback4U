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
    <title>Feedback Page Feedback4U</title>
    <style>
        main {
            margin-top: 104px;
        }

        .datiStudenti {
            font-size: 1rem;
        }

        textarea {
            margin-top: 1rem;
            height: 150px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            resize: none;
        }
        .containerFeedback{
            padding: 2rem;
            height: 70vh;
        }
        .btnSubmit{
            background-color: #DEB887;
            color: black;
            border: 1px solid black;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            height: 2.5rem;
            width: 8rem;
            margin-bottom: 1rem;
        }
        .btnSubmit:hover{
            cursor: pointer;
            background-color: #f9a339;
            transition-duration: 0.3s;
        }
    </style>
</head>

<body>
    <main>
        <?php include('header.php'); ?>
        <?php
        if (isset($_GET['vote_id'])) {
            $idVote = $_GET['vote_id'];
            $sql = "SELECT idVote, vote, date, subject from votes v left join users u on u.idUser = v.idUser right join subjects s on s.idSubject = v.idSubject where v.idVote = '$idVote'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $vote = $row["vote"];
                $subject = $row["subject"];
                $date = $row["date"];
            } else {
                echo "<p>Nessun voto trovato</p>";
            }
        } else {
            echo "<p>ID del voto mancante</p>";
            exit; // Esci se l'ID del voto è mancante
        }
        ?>
        <br>
        <div class="containerFeedback">
            <h1>Dettagli Voto</h1>
            <br>
            <p class="datiStudenti">Voto: <?php echo $vote; ?></p>
            <p class="datiStudenti">Materia: <?php echo $subject; ?></p>
            <p class="datiStudenti">Data: <?php echo $date; ?></p>
            <br>
            <form action="" method="post">
                <h3>Lascia un feedback</h3>
                <br>
                <div>
                    <label for="feedbackScore">Voto (da 0 a 10):</label>
                    <input type="number" name="feedbackScore" min="0" max="10">
                </div>
                <div>
                    <textarea name="feedbackText" rows="4" cols="50" placeholder="Scrivi il tuo feedback..."></textarea>
                </div>
                <br>
                <button type="submit" name="feedbackSubmit" class="btnSubmit"><b>Invia Feedback</b></button>
            </form>
            <?php
            if (isset($_POST['feedbackSubmit'])) {
                $rating = mysqli_real_escape_string($conn, $_POST['feedbackScore']);
                $message = mysqli_real_escape_string($conn, $_POST['feedbackText']);
                $email = $_SESSION["email"];

                $sql1 = "SELECT u.idUser from users u left join feedbacks f on f.idUser = u.idUser where u.email = '$email'";
                $result1 = $conn->query($sql1);

                if ($result1->num_rows > 0) {
                    $row1 = $result1->fetch_assoc();
                    $idUser = $row1['idUser'];
                    $sql2 = "SELECT s.idSubject from subjects s where subject = '$subject'";
                    $result2 = $conn->query($sql2);

                    if ($result2->num_rows > 0) {
                        $row2 = $result2->fetch_assoc();
                        $idSubject = $row2['idSubject'];
                        $sql3 = "INSERT INTO feedbacks (idUser, idSubject, stars, message) VALUES ('$idUser', '$idSubject', '$rating', '$message')";
                        $result3 = $conn->query($sql3);
                        if ($result3) {
                            echo "<p>Feedback inserito con successo!</p>";
                        } else {
                            echo "<p>Errore nell'inserimento del feedback: $conn->error</p>";
                        }
                    } else {
                        echo "<p>Errore materie!</p>";
                    }
                } else {
                    echo "<p>Errore</p>";
                }
            }
            ?>
        </div>

        <?php include('footer.php'); ?>
    </main>
</body>

</html>