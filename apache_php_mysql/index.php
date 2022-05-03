<?php
    $link = mysqli_connect("localhost", "root", "Ss_7411227", "DateUsers");

    if ($link == false){
        echo("Ошибка: Невозможно подключиться к MySQLi" . mysqli_connect_error());
    }

    if(isset($_GET['name']) && isset($_GET['phone'])){
        $insert="INSERT INTO Users (Name, Phone) VALUES ('{$_GET['name']}', '{$_GET['phone']}')";
        $insert_user=mysqli_query($link, $insert);
    }

    if(isset($_GET['action']) && $_GET['action']=="delete" && isset($_GET['id'])){
        $delete = "DELETE FROM Users WHERE id = {$_GET['id']}";
        $delete_user =mysqli_query($link, $delete);
    }

    if(isset($_GET['id_edit']) && isset($_GET['name_edit']) && isset($_GET['phone_edit'])){
        $update="UPDATE Users SET Name = '{_GET[name_edit]}', Phone = '{_GET[phone_edit]}' WHERE id = {_GET[id_edit]}";
        $update_user = mysqli_query($link, $update);
    }

    $select ='SELECT id, Name, Phone FROM Users ORDER BY id';
    $select_all = mysqli_query($link, $select);


?>

<!DOCTYPE html>
<html>
    <head>
<title>Php and MySql</title>
<meta charset="utf-8">
</head>
<body>
    <style>
        body{
    background: #333;
    color: #fbceb1;
}
    table{
    border-color: #008a77; /* Цвет границы */
    border-style: dotted; /* Стиль границы */
    padding: 5px;
    }
    th{
    border-color: #008a77; /* Цвет границы */
    border-style: dotted; /* Стиль границы */
    padding: 5px;
    }
    td{
    border-color: #008a77; /* Цвет границы */
    border-style: dotted; /* Стиль границы */
    padding: 5px;
</style>

<form action="index.php" method="get">
<h1>Name : <div></div><input type="text" name="name" size="20"></h1>
<h2>Phone: <div></div><input type="text" name="phone" size="20"></h2>
<input type="submit" value="Add">
</form>
</br>
        <table cellpadding="10" border="2">
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Phone</th>
            </tr>
        <?php
            while ($row = mysqli_fetch_array($select_all)) 
                {
                    $id = $row[0];
                    $Name = $row[1];
                    $Phone = $row[2];

                    echo "<tr>
                        <form action='index.php' method='get'>
                            <td> <input type='hidden' name='id' value='$id'> $id </th>
                            <td> <input type='text' readonly name='name' value='$Name'></td>
                            <td> <input type='text' readonly name='phone' value='$Phone'></td>
                            
                        </form>
                        <th>
                            <button> 
                            <a href=\"index.php?action=delete&id=$id\"> delete </a> 
                            </button>
                        </th>
                    </tr>"; 
                }
            ?>
        </table>
    </body>
</html>
