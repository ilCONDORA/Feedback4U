<html>
<body>
<?php include 'connection.php'; ?>
Welcome <br>
<?php 
    $psw1 = $_GET['psw'];
    $psw2 = $_GET['psw2'];
    if($psw1 == $psw2){
        $sql = "SELECT * FROM users WHERE email = '$_GET[email]'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "utente già esistente!";
        } else {
            $sql = "INSERT INTO users (first_name, last_name, email, password, idRole) VALUES ('$_GET[first_name]', '$_GET[last_name]', '$_GET[email]', '$_GET[psw]', 2)";
            if ($conn->query($sql) === TRUE) {
              echo "New record created successfully";
            } else {
              echo "Error: ". $sql. "<br>". $conn->error;
            }
        }
    } else {
        echo "Passwords do not match";
    }

    // Start the session
    session_start();
    $_SESSION["name"] = $_Get['first_name'];
    $_SESSION["surname"] = $_Get['last_name'];
    $_SESSION["email"] = $_Get['email'];

    $conn->close();
?>
</body>
</html>
