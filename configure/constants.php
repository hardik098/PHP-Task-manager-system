<?php
//Creating a session for every page
session_start();

//Here we creates constants like this :

define('LOCALHOST','localhost');
define('USER','root');
define('PASSWORD','');
define('DATABASE','task__manager');

$conn=mysqli_connect(LOCALHOST,USER,PASSWORD,DATABASE);
    if($conn)
    {
        // echo'Database Connected';
    }
    else
    {
        die(mysqli_connect_error());
    }
define('URL','http://localhost/login/');
?>