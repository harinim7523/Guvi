<?php
$redis=new Redis();
$redis->connect("localhost","6379"); 
$redis->delete($_POST["username"]);
echo "200";
// header("Location: ../login.html");
?>


