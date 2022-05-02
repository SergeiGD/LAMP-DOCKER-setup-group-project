<?php
if(isset($_POST["id"]))
{
    try {
        $conn = new PDO("mysql:host=localhost;dbname=grigoryhost", "admin", "1234Asdf");
        $sql = "DELETE FROM Users WHERE id = :userid";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":userid", $_POST["id"]);
        $stmt->execute();
        header("Location: index.php");
    }
    catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
}
?>
