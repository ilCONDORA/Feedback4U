<!DOCTYPE html>
<html lang="en">
    <?php include 'connection.php';?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="getFeedback.php" method="get">
        <select name="subject">
        <?php 
            session_start();
            $sql = "SELECT subject from subjects";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value=". $row["subject"]. ">". $row["subject"]. "</option>";
                }
            } else {
                echo "Non ci sono materie!";
            }
        ?>
        </select>
        <label for="rating">Valutazione:</label>
        <input type="number" name="rating" id="rating">
        <label for="message">Message</label>
        <textarea name="message" id="message"></textarea>
        <input type="submit" value="Submit">
    </form>
</body>
</html>