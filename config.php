<?php
$host ="localhost";
$user ="joilnam";
$password="1234";
$dbname="db2";


$dbconn=new mysqli($host,$user,$password,$dbname);

if(!$dbconn){
    echo die($dbconn).mysqli_error();
}else{
    echo "연결성공";
}