<?php
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		$dbconn = pg_connect("host=localhost port=5432 dbname=users user=sergei password=kingkits1");

		if(!$dbconn)
		{
			echo "Ошибка подключения";
			return;
		}


        $rows_count = pg_fetch_result(pg_query($dbconn, "SELECT COUNT(*) FROM users"), 0, 0);
	    $pages = ceil($rows_count / 4);

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
	    $select_all = pg_query($dbconn, "SELECT user_id, user_name, email, phone_num FROM users ORDER BY user_id LIMIT {$take} OFFSET {$skip}");
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

            while ($new_row = pg_fetch_row($select_all)):

                $id = $new_row[0];
                $name = $new_row[1];
                $email = $new_row[2];
                $phone = $new_row[3] == null ? "unknown" : $new_row[3];

        ?>
                <tr>
                    <form method='post' action='http://192.168.1.57:8081'>

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
                    <input type='submit' value='prev' name='prev'>
                </td>
                <td align='center'>
                    <?php
                        echo $current_page;
                        echo "<input type='hidden' name='opened_page' value='{$current_page}'>";
                    ?>
                </td>
                <td align='center'>
                    <input type='submit' value='next' name='next'>
                </td>
                <td></td>
                </tr>
        </form>

	</table>


</body>
</html>
