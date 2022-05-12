<?php

$link = pg_connect('host=localhost dbname=roman user=roman password=roman123 port=1488')
    or die("Connection to PostgreSQL database failed: ".pg_last_error());
