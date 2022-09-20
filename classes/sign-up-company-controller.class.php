
<?php 
//PART OF NEW SYSTEM
include 'sign-up-company-model.class.php';

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
    $tin = $_POST["tin"];

    $signUpCompanyObj = new SignUpCompanyModel($username, $password, $companyName, $companyEmail, $companyNumber, $companyAddress, $region, $province, $city, $barangay, $tin);

    $signUpCompanyObj->signUpCompany();

}


