<?php
$conn = mysqli_connect("localhost", "root", "", "loginregister");
if(isset($_POST["action"])){
    if($_POST["action"] == "register"){
      register();
    }
}
function register(){
    
  global $conn;
  $redis=new Redis();
  $redis->connect("localhost","6379"); 
  
  $name = $_POST["name"];
  $username = $_POST["username"];
  $password = $_POST["password"];
  $dob=$_POST["dob"];
  $phno=$_POST["phno"];

  if (empty($name) OR empty($username) OR empty($password) OR empty($dob) OR empty($phno)) {
     echo "All fields are required";
     die();
   }
   if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
    echo "Email is not valid";
    die();
   }
   if (strlen($password)<8) {
    echo "Password must be at least 8 charactes long";
    die();
   }

  $user = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");
    $query = "INSERT INTO tb_user (name, username, password) VALUES ( ?, ?, ? )";
    $stmt = mysqli_stmt_init($conn);
              $prepareStmt = mysqli_stmt_prepare($stmt,$query);
              if ($prepareStmt) {
                  mysqli_stmt_bind_param($stmt,"sss",$name, $username, $password);
                  mysqli_stmt_execute($stmt);
                  echo " $username Document inserted in Mysql ";
                }
              else{
                  die("Something went wrong");
              }
    require_once __DIR__. '/../vendor/autoload.php';
    
    $client=new MongoDB\Client("mongodb://localhost:27017/companydb");
    $db = $client->companydb;
    $collection = $db->empcollection;
    if($_POST)
    {
      
        $insert=array(
            'username'=>$username,
            'dob'=>$dob,
            'phno'=>$phno
        );
        $insertOneResult=$collection->insertOne($insert);
        if($insertOneResult)
        {
            echo "Document inserted in MongoDB";
            $redis->set($username,json_encode($insert));
            $redis->expire($username,600);
        }
        else{
          echo "404";
        }
        // printf("Inserted %d document(s)\n", $insertOneResult->getInsertedCount());
        // var_dump($insertOneResult->getInsertedId());  
    }
}
?>