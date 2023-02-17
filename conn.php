<?php
$website="http://localhost/login_and_registration";
$servername="localhost";
$username="root";
$password="";
$dbname1="login_form";
$conn=mysqli_connect($servername,$username,$password,$dbname1);
if(!$conn)
{
    die("connection failed:".mysqli_connect_error());
}
?>