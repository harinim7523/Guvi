<?php
$conn = mysqli_connect("localhost", "root", "", "loginregister");
update();
function update(){
  $redis=new Redis();
  $redis->connect("localhost",6379);
  global $conn;

  $username = $_POST["username"];
  $dob=$_POST["dob"];
  $phno=$_POST["phno"];
  $redis->delete($username);

  if(empty($dob) || empty($username) || empty($phno)){
    echo "Please Fill Out The Form!";
    exit;
  }
        require_once __DIR__. '/../vendor/autoload.php';
        $client=new MongoDB\Client("mongodb://localhost:27017/companydb");
        $db = $client->companydb;
        $collection = $db->empcollection;
        $updateResult = $collection->updateOne(
            [ 'username' => $username ],
            [ '$set' => [ 'dob' => $dob ,'phno'=>$phno]]
        );
        
        if($updateResult->getModifiedCount()==1)
        {
          $dat=['username' => $username,'dob' => $dob ,'phno'=>$phno];
            $redis->set($username,json_encode($dat));
            $redis->expire($username,600);
            echo "200";
            
            // echo json_encode(["code" => true, "msg" => "Success : Update successful" ]);
        }
        else{
           echo "404";
            //echo json_encode(["code" => false, "msg" => "Failure : Cannot update"]);
        }

}
?>