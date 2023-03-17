<?php
if($_POST['profile'])
{
    $redis=new Redis();
    $redis->connect("localhost","6379");
    $username = $_POST["username"];
    $cac=$redis->get($username);
    if($cac)
    {

        echo json_encode(["code" => "200", "user"=>json_decode($cac) ,"msg" => "Success"]);
    
    }
    
    else{
        echo json_encode(["code" => "404", "msg" => "Failed"]);
        // echo "404";
        // header("Location: login.php");
    }
    
        
      
 
}

?>