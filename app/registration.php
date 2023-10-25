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
    <title>Register User Page Feedback4U</title>
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

        .containerFormRegister {
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 25vw;
            height: 50vh;
            row-gap: 0.8rem;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            padding: 2rem;
            background-color: white;
            margin-bottom: 2rem;
        }

        .btnRegister {
            height: 1.5rem;
            background-color: #eaa856;
            border: none;
            cursor: pointer;
            height: 2.5rem;
        }

        .inputRegister {
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
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="containerFormRegister">
            <input type="text" id="first_name" name="first_name" required placeholder="First Name" class="inputRegister">
            <input type="text" id="last_name" name="last_name" required placeholder="Last Name" class="inputRegister">
            <input type="email" id="email" name="email" required placeholder="Email" class="inputRegister">
            <input type="password" id="psw" name="psw" required placeholder="Password" class="inputRegister">
            <input type="password" id="psw2" name="psw2" required placeholder="Conferma Password" class="inputRegister">
            <input type="submit" value="Submit" class="btnRegister">
            <a href="login.php">Hai già un account? Loggati qua</a>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
            $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $psw1 = mysqli_real_escape_string($conn, $_POST['psw']);
            $psw2 = mysqli_real_escape_string($conn, $_POST['psw2']);

            if ($psw1 == $psw2) {
                $sql = "SELECT * FROM users WHERE email = '$email'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    echo "<p>Utente già esistente!</p>";
                } else {
                    $hashed_password = password_hash($psw1, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO users (first_name, last_name, email, password, idRole) VALUES ('$first_name', '$last_name', '$email', '$hashed_password', 2)";
                    if ($conn->query($sql) === TRUE) {
                        $_SESSION["name"] = $first_name;
                        $_SESSION["surname"] = $last_name;
                        $_SESSION["email"] = $email;
                        $_SESSION["idRole"] = 2;

                        echo'
                                <script>window.location.href="index.php";</script>
                            ';
                        exit();
                    } else {
                        echo"
                                <p>Error: " . $sql . "<br>" . $conn->error."</p>
                            ";
                    }
                }
            } else {
                echo"
                        <p>Le password non corrispondono</p>
                    ";
            }

            $conn->close();
        }
        ?>
    </main>
</body>
</html>