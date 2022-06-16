<?php 
include 'sign-up-model.class.php';

if(isset($_POST["submit"])){

    $username = $_POST["username"];
    $password = $_POST["password"];
    $companyName = $_POST["companyName"];
    $companyEmail = $_POST["companyEmail"];
    $companyNumber = $_POST["companyNumber"];
    $companyAddress = $_POST["companyAddress"];
    $region = $_POST["region"];
    $province = $_POST["province"];
    $city = $_POST["city"];
    $barangay = $_POST["barangay"];

    $signUpObj = new SignUpModel($username, $password, $companyName, $companyEmail, $companyNumber, $companyAddress, $region, $province, $city, $barangay);

    $signUpObj->signUp();

}


