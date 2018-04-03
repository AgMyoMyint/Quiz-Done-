<?php
//Create Coneection

$mysqli = new mysqli("localhost","root","","quiz");

if($mysqli->connect_errno){
    printf("Connection failed : ".$mysqli->connect_error);
    exit();
}
