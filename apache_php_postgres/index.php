<?php 
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1); #logs
		error_reporting(E_ALL);

		$dbconn = pg_connect("host=localhost port=5432 dbname=egor user=postgres password=Rasmus1love"); #connection to db
		if(!$dbconn) 
		{
			echo "Ошибка подключения";
		}

		if(isset($_GET['action']) && $_GET['action'] == "delete" && isset($_GET['id']))  #delete query
		{
			pg_query($dbconn, "DELETE FROM users WHERE id = {$_GET['id']}");
		}


		if(isset($_GET['id_edit']) && isset($_GET['name_edit']) && isset($_GET['login_edit'])) #update query
		{
			pg_query($dbconn, "UPDATE users SET name = '{$_GET['name_edit']}', login = '{$_GET['login_edit']}' WHERE id = {$_GET['id_edit']}");
		}


		if(isset($_GET['name_add']) && isset($_GET['login_add'])) #insert query
		{
			pg_query($dbconn, "INSERT INTO users (login, name) VALUES ('{$_GET['login_add']}', '{$_GET['name_add']}')");
		}


		$select_all = pg_query($dbconn, "SELECT * FROM users ORDER BY id");		 #select query
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>View Users</title>
</head>
<body>

	<form action="index.php" method="get">
		
	Login : <input type="text" name="login_add" size="40" required>
 
	Name: <input type="text" name="name_add" size="20" required>

    <input type="submit" value="add new user">

    </form>

    <br>

	<table cellpadding="5" border="1">
		<tr>
			<th>id</th>
			<th>login</th>
			<th>name</th>
		</tr>
	<?php
		while ($new_row = pg_fetch_row($select_all))
		{
			$id = $new_row[0];
			$login = $new_row[1];
			$name = $new_row[2];

			echo "<tr>
				<form action='index.php' method='get'>
					<td> <input type='hidden' name='id_edit' value='$id'> $id</td>
					<td> <input type='text' name='login_edit' value='$login' required></td>
					<td> <input type='text' name='name_edit' value='$name' required></td>
					<th>
						<input type='submit' value='edit'>
					</th>
				</form>
				<th>	
					<button> <a href=index.php?action=delete&id=$id> delete </a> </button>
				</th>
			</tr>";
		}
	?>
	
	</table>


</body>
</html>