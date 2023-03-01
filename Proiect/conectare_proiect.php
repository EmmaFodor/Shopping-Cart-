<?php
$hostname='localhost';
$username='root';
$password='';
$db='proiect';
$mysqli=new mysqli($hostname,$username,$password,$db);
if(!mysqli_connect_errno())
{
	echo 'Conectat la baza de date: '.$db;
}
else
{
	echo 'Nu se poate conecta';
	exit();
}
?>