<!DOCTYPE html>
<html lang="en">
<?php
include 'connection.php';
session_start();
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Page</title>
    <style>
        main{
            margin-top:104px;
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
                    echo "Nessun voto trovato";
                }
            } else {
                echo "ID del voto mancante";
                exit; // Esci se l'ID del voto è mancante
            }
        ?>
        <h3>Dettagli del Voto</h3>
            <p>Voto: <?php echo $vote; ?></p>
            <p>Materia: <?php echo $subject; ?></p>
            <p>Data: <?php echo $date; ?></p>
        <form action="" method="post">
            <h3>Lascia un feedback</h3>
            <label for="feedbackScore">Voto (da 0 a 10):</label>
            <input type="number" name="feedbackScore" min="0" max="10">
            <label for="feedbackText">Feedback:</label>
            <textarea name="feedbackText" rows="4" cols="50"></textarea>
            <button type="submit" name="feedbackSubmit">Invia Feedback</button>
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
                            echo "Feedback inserito con successo!";
                        } else {
                            echo "Errore nell'inserimento del feedback: " . $conn->error;
                        }
                    } else {
                        echo "Errore materie!";
                    }
                } else {
                    echo "Errore";
                }
            }
        ?>
        <?php include('footer.php'); ?>
    </main> 
</body>
</html>
