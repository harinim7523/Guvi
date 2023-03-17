<?php  
$redis=new Redis();
$redis->connect("localhost","6379");
if($redis)
{
    echo "connection open";
    $redis->set("hel","harini");
    echo $redis->get("hel");
}
?>