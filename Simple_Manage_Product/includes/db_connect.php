<?php
$host = 'localhost';
$user = 'nhaquyen';
$pass = '25112003';
$db = 'test_final_gpt_2';
$connect = new MySQLi($host,$user,$pass,$db);
if($connect->connect_error)
{
	die('Ket noi that bai: '.$connect->connect_error);
}
?>