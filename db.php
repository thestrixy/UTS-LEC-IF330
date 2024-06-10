<?php
//DB Credentials
define('DSN', 'mysql:host=localhost;dbname=utswebproglec');
define('DBUSER', 'root');
define('DBPASS', '');

//1. connect to DB
$db = new PDO(DSN, DBUSER, DBPASS);
