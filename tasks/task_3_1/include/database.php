<?php

$link = mysqli_connect('localhost', 'roman', 'Roman123!', 'roman');
if(mysqli_connect_errno()) {
    echo 'Connection error';
    exit();
}
