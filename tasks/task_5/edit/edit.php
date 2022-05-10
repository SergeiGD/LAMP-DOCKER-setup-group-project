<?php
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		$dbconn = pg_connect("host=localhost port=5432 dbname=users user=sergei password=kingkits1");

		if(!$dbconn)
		{
			echo "Ошибка подключения";
		}

        $user_id = $_GET['id'];

		if(isset($_GET['edit']) && isset($_GET['name_edit']) && isset($_GET['email_edit']) && isset($_GET['phone_edit']) )
		{
			pg_query($dbconn, "UPDATE users SET user_name = '{$_GET['name_edit']}', email = '{$_GET['email_edit']}', phone_num = '{$_GET['phone_edit']}', WHERE user_id = {$user_id}");
		    header("Location: http://192.168.1.57:8083/");
            die();
		}

        $select_user = pg_query($dbconn, "SELECT user_id, user_name, email, phone_num FROM users WHERE user_id = {$user_id}");
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PHP CRUD nginx + postgresql</title>
</head>
<body>

    <?php
        $result = pg_fetch_row($select_user);

        $name = $result[1];
        $email = $result[2];
        $phone = $result[3];
        $photo_path = "photos/mono.png";

        echo "
            <form action='edit.php' method='get'>

                id : {$user_id}
                <br/>
                <input type='hidden' name='id' size='15' value='{$user_id}'>

                Name : <input type='text' name='name_edit' size='15' value='{$name}' required>

                Email: <input type='text' name='email_edit' size='10' value='{$email}' required>

                Phone: <input type='text' name='phone_edit' value='{$phone}' size='10' required>

                <input type='submit' value='edit user' name='edit'>

                <br/>

                Фото: <img src='$photo_path' width='189' height='255' alt='img'>
            </form>
        ";

    ?>



</body>
</html>
