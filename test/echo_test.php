<?php
require_once "config.php";



$configObj = new Config();
$pdoVessel = $configObj->pdoConnect();

$sql = "SELECT * FROM permission WHERE permission_id = :permission_id";

$stmt = $pdoVessel->prepare($sql);

$stmt->bindParam(":permission_id", $paramPermissionId, PDO::PARAM_STR);

$paramPermissionId = '7';

if ($stmt->execute()) {
    $row = $stmt->fetch();

    echo $row[0];
}
