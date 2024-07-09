<?php

$conn = new mysqli("localhost", "rental", "LoricaHouse12345", "loricaresidence_boardinghouse");

if($conn->connect_errno){
    die("Sorry, connection cannot be established").$conn->connect_error;
}