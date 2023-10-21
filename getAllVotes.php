<html>
<body>
<?php include 'connection.php'; ?>
Welcome <br>
<?php 
    session_start();
    $email = $_SESSION["email"];
    $first_name = $_SESSION["name"];
    $last_name = $_SESSION["surname"];
    echo "voti dell'alunno ". $first_name. " ". $last_name. "<br>";
    $sql = "SELECT vote, date, subject from votes v left join users u on u.idUser = v.idUser right join subjects s on s.idSubject = v.idSubject where u.email = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "voto: ". $row["vote"]. " materia ". $row["subject"]. " data: ". $row["date"]. "<a href='Feedback.php'>leave a feedback</a><br>";
        }
    } else {
        echo "Nessun voto trovato";
    }
    $conn->close();
?>
</body>
</html>
