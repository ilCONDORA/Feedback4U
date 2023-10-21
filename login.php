<html>
<body>
<?php include 'connection.php'; ?>
Welcome <br>
<?php 
$sql = "SELECT * FROM users WHERE email = '$_GET[email]'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if($row['password'] == $_GET['password']){
            echo "Name: " . $row["first_name"]. " " . $row["last_name"]. "<br>";

            // Start the session
            session_start();
            $_SESSION["name"] = $row['first_name'];
            $_SESSION["surname"] = $row['last_name'];
            $_SESSION["email"] = $_GET['email'];
            echo "Name: ". $_SESSION["name"]. " Last_name ". $_SESSION["surname"]. "<br>";
            echo "<a href='getAllVotes.php'>get all votes</a>";

        } else {
            echo "wrong password";
        }
    }
  } else {
    echo "utente non trovato!";
    header('Location: /login.html');
    // or die();
    exit();
  }
    $conn->close();
?>

</body>
</html>
