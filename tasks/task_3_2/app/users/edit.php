<?php
    require_once '../include/postgresql.php';
    require_once '../include/postgresql_function.php';

    if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['id'])) {
        if (isset($_GET['error'])) {
            echo "<div class='alert alert-danger'>Some field is empty!</div>";
        }

        $id = $_GET['id'];
        $user = get_user($link, $id);

    } elseif (isset($_POST['id']) && isset($_POST['login']) && isset($_POST['password'])) {

        $id = $_POST['id'];
        $login = $_POST['login'];
        $password = $_POST['password'];

        if ($login == "" || $password == "") {
            header("Location: edit.php?id={$id}&error=empty_field");
        } elseif (update_user($link, $id, $login, $password)) {
            header("Location: ../users.php");
        }

    } else {
        header('HTTP/1.1 404 Not Found');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit user</title>
</head>
<body>
    <?php include "../include/base.php"?>
    <div class="container">
        <h1 class='text-center text-warning'>Edit <span class='font-weight-bold'>"<?=$user['login']?>"</span></h1>
        <form action='edit.php' method="post" class='w-25 m-auto'>
            <div class="form-group">
                <label for="login">Login</label>
                <input type="text" name="login" placeholder="User login" class="form-control" value="<?=$user['login']?>" />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="User password" class="form-control" value="<?=$user['password']?>" />
            </div>
            <div class="form-group">
                <input type="hidden" name='id' value=<?=$user['id']?>>
                <input type="submit" class="btn btn-primary btn-block" value="Save" />
            </div>
        </form>
    </div>
</body>
</html>