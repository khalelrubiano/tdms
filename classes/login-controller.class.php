<?php 
include 'login-model.class.php';

if(isset($_POST["submit"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    $loginObj = new LoginModel($username, $password);
    
    $loginObj->login();
}else{
    echo "FAIL";
}


