<?php
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		$dbconn = pg_connect("host=localhost port=5432 dbname=users user=sergei password=kingkits1");

		if(!$dbconn)
		{
			echo "Ошибка подключения";
		}

        $select_all = pg_query($dbconn, "SELECT user_id, user_name, email, phone_num FROM users ORDER BY user_id");
        $rows_count = pg_query($dbconn, "SELECT count(*) FROM users");
        $rows_count = pg_num_rows($select_all);
	    $pages = ceil($rows_count / 4);
	    $current_page = 1;

	    if(!isset($_GET['opened_page']))
	    {
	        $current_page = 1;
	    }
	    else
	    {
	        $current_page = $_GET['opened_page'];
	    }

	    if(isset($_GET['prev']) && $current_page - 1 > 0)
	    {
	        $current_page = $current_page - 1;
	    }
	    if(isset($_GET['next']) && $current_page + 1 <= $pages)
	    {
	        $current_page = $current_page + 1;
	    }
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PHP CRUD nginx + postgresql</title>
</head>
<body>

    <br/>

	<table cellpadding="5" border="1">
		<tr>
			<th>id</th>
			<th>name</th>
			<th>email</th>
			<th>phone</th>

		</tr>
	<?php


	    //echo $current_page;
        //$loaded_rows = 0;

        //for($loaded_rows = 0; $loaded_rows < 40 && $new_row = pg_fetch_row($select_all); $loaded_rows++)
        for($loaded_rows = 0; $loaded_rows < 4 && ($loaded_rows + 1) * $current_page < $rows_count; $loaded_rows++)
        {





        }

        for($row = ($current_page - 1) * 4; $row <= ($current_page * 4) - 1 && $row < count(pg_fetch_all($select_all)); $row++)
            {

                $new_row = pg_fetch_all($select_all)[$row];

                $id = $new_row["user_id"];
                $name = $new_row["user_name"];
                $email = $new_row["email"];
                $phone = $new_row["phone_num"] == null ? "unknown" : $new_row["phone_num"];
                //$id = $new_row[0];
                //$name = $new_row[1];
                //$email = $new_row[2];
                //$phone = $new_row[3] == null ? "unknown" : $new_row[3];



                echo "<tr>
                    <form action='users.php' method='get'>
                        <td> <input type='hidden' name='id_edit' value='$id'>  $id </td>
                        <td> $name </td>
                        <td> $email </td>
                        <td> $phone </td>
                        <td>
                            <button> <a href='http://192.168.1.57:8081/?id=$id' style='text-decoration:none; color : black'> edit </a> </button>
                        </td>
                    </form>
                </tr>";
            }

		while ($new_row = pg_fetch_row($select_all))
		{


		}
	?>

    <?php
        echo "<form action='users.php' method='get'>
             <tr>
                <td></td>
                <td>
                    <input type='submit' value='prev' name='prev'>
                </td>
                <td>
                    $current_page
                    <input type='hidden' name='opened_page' value='$current_page'>
                </td>
                <td>
                    <input type='submit' value='next' name='next'>
                </td>
                <td></td>
             </tr>
         </form>";
     ?>

	</table>


</body>
</html>
