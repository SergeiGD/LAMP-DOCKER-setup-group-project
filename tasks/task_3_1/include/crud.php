<?php


function get_users($link, $page, $page_size) {

    $sql = 'SELECT * FROM users ORDER BY id LIMIT '.$page_size;

    if ($page > 1) {
        $offset = ($page - 1) * $page_size;

        $sql = 'SELECT * FROM users ORDER BY id LIMIT '.$page_size.' OFFSET '.$offset;
    }

    $result = mysqli_query($link, $sql);

    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $users;
}

function get_users_count($link, $page_size) {
    $sql = 'SELECT id FROM users';

    $result = mysqli_query($link, $sql);

    $count = mysqli_num_rows($result);

    return ceil($count / $page_size);
}

function get_user($link, $id) {
    $sql = 'SELECT * FROM users WHERE id = '.$id;

    $result = mysqli_query($link, $sql);

    $user = mysqli_fetch_assoc($result);

    return $user;
}

function update_user($link, $id, $login, $password) {
    $sql = "UPDATE users SET login = '$login', password = '$password' WHERE id = '$id'";

    return mysqli_query($link, $sql);
}
