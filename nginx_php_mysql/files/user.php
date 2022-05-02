<!DOCTYPE html>
<html>
<head>
<title>UserDB</title>
<meta charset="utf-8" />
</head>
<body>
<?php
if(isset($_GET["id"]))
{
    try {
        $conn = new PDO("mysql:host=localhost;dbname=grigoryhost", "admin", "1234Asdf");
        $sql = "SELECT * FROM Users WHERE id = :userid";
        $stmt = $conn->prepare($sql);
        // привязываем значение параметра :userid к $_GET["id"]
        $stmt->bindValue(":userid", $_GET["id"]);
        // выполняем выражение и получаем пользователя по id
        $stmt->execute();
        if($stmt->rowCount() > 0){
            foreach ($stmt as $row) {
              $username = $row["name"];
              $useremail = $row["emain"];
             
              echo "<div>
                    <h3>Информация о пользователе</h3>
                    <p>Имя: $username</p>
                    <p>Email: $useremail</p>
                </div>";
            }
        }
        else{
            echo "Пользователь не найден";
        }
    }
    catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
}
?>
<form action="index.php" method="POST">
<input type="submit" value="Назад">
</form>
</body>
</html>
