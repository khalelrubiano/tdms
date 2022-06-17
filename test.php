<?php

if (!isset($_SESSION)) {
  session_start();
}

require_once "config.php";

$configObj = new Config();
$pdoVessel = $configObj->pdoConnect();

$sql = "SELECT 
*
FROM permission
WHERE role = :role 
AND companyName = :companyName";

/*
$stmt = $pdoVessel->prepare($sql);

$stmt->bindParam(":role", $paramRole, PDO::PARAM_STR);
$stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);

$paramRole = 'Admin';
$paramCompanyName = 'samplecompany1';

$stmt->execute();
$row = $stmt->fetch();

$role = $row["role"];
$shipmentAccess = $row["shipmentAccess"];
$companyName = $row["companyName"];

*/

if ($stmt = $pdoVessel->prepare($sql)) {

  $stmt->bindParam(":role", $paramRole, PDO::PARAM_STR);
  $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);

  $paramRole = 'Default';
  $paramCompanyName = 'samplecompany1';

  if ($stmt->execute()) {

      if ($stmt->rowCount() == 1) {
          if ($row = $stmt->fetch()) {

            $role = $row["role"];
            $shipmentAccess = $row["shipmentAccess"];
            $companyName = $row["companyName"];
            echo $role . "<br>" . $shipmentAccess . "<br>" . $companyName;
          }
      }
  } else {

      $_SESSION["prompt"] = "Something went wrong!";
      header('location: ../prompt.php');
      exit();
  }
}










/*
if(password_verify($testPassword, $hashedPassword)){
 echo $username . "<br>" . $testPassword . "<br>" . $accessType . "<br>" . $hashedPassword;
}else{
  echo "Error";
}
*/