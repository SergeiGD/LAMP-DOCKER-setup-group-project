<?php


function get_users($link, $page, $page_size) {
    
    $sql = 'SELECT * FROM users ORDER BY id LIMIT '.$page_size;

    if ($page > 1) {
        $offset = ($page - 1) * $page_size;

        $sql = 'SELECT * FROM users ORDER BY id LIMIT '.$page_size.' OFFSET '.$offset;        
    }

    $result = pg_query($link, $sql);

    $users = pg_fetch_all($result, PGSQL_ASSOC);

    return $users;
}

function get_users_count($link, $page_size) {
    $sql = 'SELECT id FROM users';

    $result = pg_query($link, $sql);

    $count = pg_num_rows($result);
    
    return ceil($count / $page_size);
}

function get_user($link, $id) {
    $sql = 'SELECT * FROM users WHERE id = '.$id;

    $result = pg_query($link, $sql);
    
    $user = pg_fetch_assoc($result);

    return $user;
}

function delete_user($link, $id) {
    $sql = 'DELETE FROM users WHERE id = '.$id;

    return pg_query($link, $sql);
}

function insert_user($link, $login, $password) {
    $sql = "INSERT INTO users (login, password) VALUES ('$login', '$password')";

    return pg_query($link, $sql);
}

function update_user($link, $id, $login, $password) {
    $sql = "UPDATE users SET login = '$login', password = '$password' WHERE id = '$id'";

    return pg_query($link, $sql);
}
