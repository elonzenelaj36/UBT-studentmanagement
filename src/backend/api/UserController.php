<?php
header("Content-Type: application/json; charset=UTF-8");
include __DIR__ . '/../database/user.php';
include __DIR__ . '/../database/config/database.php';


    $user = new User((new Database()->getConnection()));

if ($_SERVER["REQUEST_METHOD"] == "POST") {

if (isset($_POST['email']) && isset($_POST['password'])) {

 $logindata = $user->login(strval($_POST['email']), strval($_POST['password'])); 

if ($logindata) {
   
    echo json_encode([
        "success" => true,
        "user" => $logindata
    ]); 
} else {

    echo json_encode([
        "success" => false,
        "message" => "Invalid email or password"
    ]); 
}
}

  if(isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["password"]) && isset($_POST["email"])) {

  $name = $_POST["name"];
$surname = $_POST["surname"];
$email = $_POST["email"];
$password = $_POST["password"];

$s = $user->register($name, $surname, $email, $password);

if($s) {
        echo json_encode([
        "success" => true,
        "message" => "Registered!"
    ]); 
    } else {
         echo json_encode([
        "success" => false,
        "message" => "failed to register"
    ]); 
    }
 }

}

?>