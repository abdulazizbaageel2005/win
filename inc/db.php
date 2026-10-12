<?php
$conn = mysqli_connect('localhost', 'root', '', 'win');

    if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }