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
    // else{
    //     require_once __DIR__. '/../vendor/autoload.php';
    //     $client=new MongoDB\Client("mongodb://localhost:27017/companydb");
    //     $db = $client->companydb;
    //     $collection = $db->empcollection;
    //     $document = $collection->findOne(['email' => $username]);

    //     $redis->set($username,json_encode($document));
    //     $redis->expire($username,600);
    //     header("Location: login.php");
    //     echo json_encode($document);
    // }
    else{
        echo json_encode(["code" => "404", "msg" => "Failed"]);
        // echo "404";
        // header("Location: login.php");
    }
    
        
      
 
}

?>