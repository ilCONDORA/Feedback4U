<?php
    include 'connection.php'; 
    session_start();
    $rating = $_GET['rating'];
    $message = $_GET['message'];
    $subject = $_GET['subject'];
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
        } else {
            echo "errore materie!";
        }
    } else {
        echo "errore";
    }
?>