<!DOCTYPE html>
<html>
<head>
<title>AddUser</title>
<meta charset="utf-8" />
</head>
<body>
<?php
if (isset($_POST["username"]) && isset($_POST["useremail"])) {
     
    $username = $_POST["username"];
    $userage = $_POST["useremail"];
    try {
        $conn = new PDO("mysql:host=localhost;dbname=grigoryhost", "admin", "1234Asdf");
        $sql = ("INSERT INTO grigoryhost.Users (name, emain) VALUES ('$username', '$useremail')");
        $affectedRowsNumber = $conn->exec($sql);
    }
    catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
}
?>
<h3>Create a new User</h3>
<form action="index.php" method="post">
    <p>User Name:
    <input type="text" name="username" /></p>
    <p>User Email:
    <input type="text" name="useremail" /></p>
    <input type="submit" value="Save">
</form>
</body>
</html>
