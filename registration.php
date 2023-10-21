<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        main{
            margin-top:104px;
        }
    </style>
</head>
<body>
    <main>
        <?php include('header.php'); ?>    
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="first_name">First name</label>
            <input type="text" id="first_name" name="first_name" required>
            <label for="last_name">Last name</label>
            <input type="text" id="last_name" name="last_name" required>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            <label for="psw">Password</label>
            <input type="password" id="psw" name="psw" required>
            <label for="psw2">Conferma password</label>
            <input type="password" id="psw2" name="psw2" required>
            <input type="submit" value="Submit">
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Include il file di connessione al database
            include 'connection.php';

            $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
            $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $psw1 = mysqli_real_escape_string($conn, $_POST['psw']);
            $psw2 = mysqli_real_escape_string($conn, $_POST['psw2']);

            if ($psw1 == $psw2) {
                $sql = "SELECT * FROM users WHERE email = '$email'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    echo "Utente già esistente!";
                } else {
                    $hashed_password = password_hash($psw1, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO users (first_name, last_name, email, password, idRole) VALUES ('$first_name', '$last_name', '$email', '$hashed_password', 2)";
                    if ($conn->query($sql) === TRUE) {
                        /* echo "New record created successfully"; */

                        // Avvia la sessione
                        if (session_status() == PHP_SESSION_NONE) {
                            session_start();
                        }

                        $_SESSION["name"] = $first_name;
                        $_SESSION["surname"] = $last_name;
                        $_SESSION["email"] = $email;
                        $_SESSION["idRole"] = 2;

                        header("Location: homePage.php");
                        exit();
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
            } else {
                echo "Le password non corrispondono";
            }

            $conn->close();
        }
        ?>
        <br>
        <a href="login.php">Hai già un account? Loggati qua</a>        
    </main>
</body>
</html>
