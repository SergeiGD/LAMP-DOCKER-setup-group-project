<?php

$link = pg_connect('host=postgres dbname=users user=postgres password=test1')
    or die("Connection to PostgreSQL database failed: ".pg_last_error());