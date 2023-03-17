<?php
$conn = mysqli_connect("localhost", "root", "", "loginregister");
if(isset($_POST["action"])){
    if($_POST["action"] == "login"){
      login();
    }
}
 function login(){
    global $conn;
    $username = $_POST["username"];
    $password = $_POST["password"];
    $sql = "SELECT * FROM tb_user WHERE username = ? AND password = ? ";
    $statement = $conn->prepare($sql);
    $statement->bind_param('ss', $username, $password);
    $statement->execute();
    $result = $statement->get_result();


        $redis=new Redis();
        $redis->connect("localhost","6379"); 
        require_once __DIR__. '/../vendor/autoload.php';
        $client=new MongoDB\Client("mongodb://localhost:27017/companydb");
        $db = $client->companydb;
        $collection = $db->empcollection;
        $document = $collection->findOne(['username' => $username]);

        $redis->set($username,json_encode($document));
        $redis->expire($username,600);

    if ($result->num_rows > 0) {
        echo "Login Successful";
    } else {
        echo "Wrong Password";
    }
}
?>


