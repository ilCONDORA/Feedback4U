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
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
            <input type="submit" value="Login">
        </form>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Include il file di connessione al database
                include 'connection.php';

                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $password = mysqli_real_escape_string($conn, $_POST['password']);

                $sql = "SELECT * FROM users WHERE email = '$email'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        if (password_verify($password, $row['password'])) {
                            // Avvia la sessione
                            if (session_status() == PHP_SESSION_NONE) {
                                session_start();
                            }

                            $_SESSION["name"] = $row['first_name'];
                            $_SESSION["surname"] = $row['last_name'];
                            $_SESSION["email"] = $email;
                            $_SESSION["idRole"] = $row['idRole'];

                            header("Location: homePage.php");
                            exit();
                        } else {
                            echo "Password errata";
                        }
                    }
                } else {
                    echo "Utente non trovato!";
                }

                $conn->close();
            }
        ?>
        <br>
        <a href="registration.php">Non hai un account? Registrati qua</a></main>
</body>
</html>
