<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        main {
            width: 100vw;
            height: 100vh;
            background-color: #DEB887;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .containerFormLogin {
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 25vw;
            height: 38vh;
            row-gap: 0.8rem;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            padding: 2rem;
            background-color: white;
            margin-bottom: 2rem;
        }

        .btnLogin {
            height: 1.5rem;
            background-color: #eaa856;
            border: none;
            cursor: pointer;
            height: 2.5rem;
        }

        .inputLogin {
            height: 2.5rem;
            border: none;
            background-color: #e0e0e0;
            padding-left: 0.5rem;
        }

        a {
            text-decoration: none;
            color: black;
        }

        a:hover {
            color: blue;
        }
    </style>
</head>

<body>
    <main>
        <?php include('header.php'); ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="containerFormLogin">
            <input type="email" name="email" id="email" required placeholder="Email" class="inputLogin">
            <input type="password" name="password" id="password" required placeholder="Password" class="inputLogin">
            <input type="submit" value="Login" class="btnLogin">
            <a href="registration.php">Non hai un account? Registrati qua</a>
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


    </main>
</body>

</html>