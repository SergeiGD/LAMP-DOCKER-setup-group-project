<?php 
try {
    $conn = new PDO("mysql:host=localhost;dbname=grigoryhost", "admin", "1234Asdf");
}
catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
<head>
<title>UpdateUser</title>
<meta charset="utf-8" />
</head>
<body>
<?php
// если запрос GET
if($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"]))
{
    $userid = $_GET["id"];
    $sql = "SELECT * FROM Users WHERE id = :userid";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(":userid", $userid);
    // выполняем выражение и получаем пользователя по id
    $stmt->execute();
    if($stmt->rowCount() > 0){
        foreach ($stmt as $row) {
            $username = $row["name"];
            $useremail = $row["emain"];
        }
        echo "<h3>Обновление пользователя</h3>
                <form method='post'>
                    <input type='hidden' name='id' value='$userid' />
                    <p>Имя:
                    <input type='text' name='name' value='$username' /></p>
                    <p>Email:
                    <input type='text' name='email' value='$useremail' /></p>
                    <input type='submit' value='Сохранить' />
            </form>";
    }
    else{
        echo "Пользователь не найден";
    }
}
elseif (isset($_POST["id"]) && isset($_POST["name"]) && isset($_POST["email"])) {
      
    $sql = "UPDATE Users SET name = :username, emain = :useremail WHERE id = :userid";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(":userid", $_POST["id"]);
    $stmt->bindValue(":username", $_POST["name"]);
    $stmt->bindValue(":useremail", $_POST["email"]);
          
    $stmt->execute();
    header("Location: index.php");
}
else{
    echo "Некорректные данные";
}
?>
</body>
</html>
