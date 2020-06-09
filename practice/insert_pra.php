<?php

$dsn="mysql:host=localhost;charset=utf8;dbname=invoice";
$pdo=new PDO($dsn,"root","");
date_default_timezone_set("Asia/Taipei");
session_start();

// 新增資料:

// $sql="insert into `table` (`field1`,`field2`,`field3`) values('value1','value2','value3')"




?>