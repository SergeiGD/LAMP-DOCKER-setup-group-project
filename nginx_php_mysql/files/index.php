<!DOCTYPE html>
<html>
<head>
<title>Users</title>
<meta charset="utf-8">
</head>
<body>
<?php
$user = "admin";
$password = "1234Asdf";
$database = "grigoryhost";
$table = "Users";
$newname = $_POST["username"];
$newemail = $_POST["useremail"];



try 
{
	$db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);
	$sql = "SELECT * FROM Users";
	$result = $db->query($sql);
	echo "<table><tr><th></th><th><ID></th><th>Name</th><th>Email</th></tr>";
        if(($newname != "") && ($newemail != ""))
        {
                $db -> exec("INSERT INTO grigoryhost.Users (name, emain) VALUES ('$newname', '$newemail')");
        	$newname="";
		$newemail="";
	}

	while($row = $result->fetch()) 
	{
		echo "<tr>";
			echo "<td>" . $row["id"] . "<td>";
                        echo "<td>" . $row["name"] . "<td>";
                        echo "<td>" . $row["emain"] . "<td>";
			echo "<td><a href='user.php?id=" . $row["id"] . "' >Посмотреть</a></td>";
			echo "<td><a href='update.php?id=" . $row["id"] . "'>Обновить</a></td>";
			echo "<td><form action='delete.php' method='post'>
                        <input type='hidden' name='id' value='" . $row["id"] . "' />
                        <input type='submit' value='Удалить'>
                    </form></td>";
		echo "</tr>";
	}
	echo "</table>";
} 
catch (PDOException $e) 
{
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>
<h3>Buttons control</h3>
<form action="add.php">
<input type="submit" value="Добавить">
</form>
</body>
</html>
