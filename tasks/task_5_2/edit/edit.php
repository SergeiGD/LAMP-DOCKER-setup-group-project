<?php
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		$dbconn = pg_connect("host=db port=5432 dbname=users user=sergei password=kingkits1");

		if(!$dbconn)
		{
			echo "Ошибка подключения";
			return;
		}

        $user_id = $_POST['user_id'];

		if(isset($_POST['edit_info']) && isset($_POST['name_edit']) && isset($_POST['email_edit']) && isset($_POST['phone_edit']) )
		{
			pg_query($dbconn, "UPDATE users SET user_name = '{$_POST['name_edit']}', email = '{$_POST['email_edit']}', phone_num = '{$_POST['phone_edit']}' WHERE user_id = {$user_id}");
		    header("Location: http://{$_SERVER['SERVER_ADDR']}:8083");
            die();
		}

		if(isset($_POST['edit_photo']) && $_FILES['photo_to_upload']['error'] != UPLOAD_ERR_NO_FILE)
		{
		    $photos_dir = "images/";
            $check = getimagesize($_FILES["photo_to_upload"]["tmp_name"]);
            if($check == false)
            {
                return;
            }

            $old_photo = pg_fetch_row(pg_query($dbconn, "SELECT photo FROM users WHERE user_id = {$user_id}"))[0];

            if(!is_null($old_photo))
            {
                if (file_exists($old_photo)) 
                {
                    unlink($old_photo);
                }
                pg_query($dbconn, "UPDATE users SET photo = null WHERE user_id = {$user_id}");
            }

            $img_extention = pathinfo($_FILES["photo_to_upload"]["name"]);
            $img_name = $photos_dir . $_POST['user_id'] . "." . $img_extention['extension'];
            move_uploaded_file($_FILES["photo_to_upload"]["tmp_name"], $img_name);
            pg_query($dbconn, "UPDATE users SET photo = '{$img_name}' WHERE user_id = {$user_id}");

		}

		if(isset($_POST['delete_photo']))
		{
		    $old_photo = pg_fetch_row(pg_query($dbconn, "SELECT photo FROM users WHERE user_id = {$user_id}"))[0];

            if(!is_null($old_photo))
            {
                unlink($old_photo);
                pg_query($dbconn, "UPDATE users SET photo = null WHERE user_id = {$user_id}");
            }

            pg_query($dbconn, "UPDATE users SET photo = null WHERE user_id = {$user_id}");
		}

		if(isset($_POST['go_back']))
		{
		    header("Location: http://{$_SERVER['SERVER_ADDR']}:8083/");
            die();
		}

        $select_user = pg_query($dbconn, "SELECT user_id, user_name, email, phone_num, photo FROM users WHERE user_id = {$user_id}");
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
        $photo_path = $result[4];

    ?>

    <form action='edit.php' method='POST'>

        id : <?php echo $user_id; ?>
        <br/>
        <input type='hidden' name='user_id' size='15' value='<?php echo $user_id; ?>'>

        Name : <input type='text' name='name_edit' size='15' value='<?php echo $name; ?>' required>

        Email: <input type='text' name='email_edit' size='10' value='<?php echo $email; ?>' required>

        Phone: <input type='text' name='phone_edit' value='<?php echo $phone; ?>' size='10' required>

        <input type='submit' value='save info and go back' name='edit_info'>

         <br/>

    </form>

    <form action='edit.php' method='POST' enctype='multipart/form-data'>
        

        <input type='hidden' name='user_id' size='15' value='<?php echo $user_id; ?>'>
        
        <?php if (!is_null($photo_path)): ?>
            Photo: <img src='<?php echo $photo_path . "?" . date('dmyhis'); ?>' width='300' height='200' alt='img'>
        <?php else: ?>
            Photo: absent
        <?php endif; ?>

        <br/>

        Upload: <input type='file' name='photo_to_upload' id='photo_to_upload'>

        <input type='submit' value='save photo' name='edit_photo'>

        <br/>

        <input type='submit' name='delete_photo' value='delete photo'>

        <br/>

        <input type='submit' name='go_back' value='go back to users'>

    </form>

</body>
</html>
