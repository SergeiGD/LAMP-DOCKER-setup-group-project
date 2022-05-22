<?php
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		$mysqli = new mysqli("localhost", "db_users", "my_pass123", "users", "3444" );

		if(!$mysqli)
		{
			echo "Ошибка подключения";
			return;
		}


		$rows_count = $mysqli->query("SELECT COUNT(*) FROM users")->fetch_row();

	    $pages = ceil($rows_count[0] / 4);

	    if(isset($_GET['opened_page']))
	    {
	        $current_page = $_GET['opened_page'];
	    }
	    else
	    {
	        $current_page = 1;
	    }

	    if(isset($_GET['prev']) && $current_page - 1 > 0)
	    {
	        $current_page = $current_page - 1;
	    }
	    if(isset($_GET['next']) && $current_page + 1 <= $pages)
	    {
	        $current_page = $current_page + 1;
	    }

        $skip = ($current_page - 1) * 4;
        $take = 4;

	    $select_all = $mysqli->query("SELECT user_id, user_name, email, phone_num FROM users ORDER BY user_id LIMIT {$take} OFFSET {$skip}");
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PHP CRUD nginx + postgresql</title>
</head>
<body>

	<table cellpadding="5" border="1">
		<tr>
			<th>id</th>
			<th>name</th>
			<th>email</th>
			<th>phone</th>
		</tr>


        <?php

            while ($new_row = $select_all->fetch_row()):

                $id = $new_row[0];
                $name = $new_row[1];
                $email = $new_row[2];
                $phone = $new_row[3] == null ? "unknown" : $new_row[3];

        ?>
                <tr>
                    <form method='post' action='<?php echo "http://{$_SERVER['SERVER_ADDR']}:8081/"; ?>'>

                        <td> <input type='hidden' name='user_id' value='<?php echo $id; ?>'>
                            <?php echo $id; ?>
                        </td>
                        <td width='200'> <?php echo $name; ?> </td>
                        <td width='200'> <?php echo $email; ?> </td>
                        <td width='200'> <?php echo $phone; ?> </td>
                        <td>
                            <input type='submit' value='edit'>
                        </td>
                    </form>
                </tr>

        <?php
            endwhile;
        ?>


        <form action='users.php' method='get'>
            <tr>
                <td></td>
	            <td align='center'>
	                <?php if ($current_page != 1): ?>
	                    <input type='submit' value='prev' name='prev'>
	                <?php endif; ?>
	            </td>
                <td align='center'>
                    <?php
                        echo $current_page . ' / ' . $pages;
                        echo "<input type='hidden' name='opened_page' value='{$current_page}'>";
                    ?>
                </td>
	            <td align='center'>
	            	<?php if ($current_page != $pages): ?>
	                    <input type='submit' value='next' name='next'>
	                <?php endif; ?>
	            </td>
                <td></td>
                </tr>
        </form>

	</table>


</body>
</html>
