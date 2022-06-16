<?php
require_once "config.php";

$testUsername = "sampleadmin";
$testPassword = "password";

$configObj = new Config();
$pdoVessel = $configObj->pdoConnect();

$sql = "SELECT 
        username, 
        password, 
        accessType,
        firstName,
        middleName,
        lastName, 
        companyName 
        FROM user
        WHERE username = :username";

$stmt = $pdoVessel->prepare($sql);

$stmt->bindParam(":username", $paramUsername, PDO::PARAM_STR);
$paramUsername = $testUsername;

$stmt->execute();
$row = $stmt->fetch();

$username = $row["username"];
$accessType = $row["accessType"];
$firstName = $row["firstName"];
$middleName = $row["middleName"];
$lastName = $row["lastName"];
$companyName = $row["companyName"];
$hashedPassword = $row["password"];

if(password_verify($testPassword, $hashedPassword)){
 echo $username . "<br>" . $testPassword . "<br>" . $accessType . "<br>" . $hashedPassword;
}else{
  echo "Error";
}
