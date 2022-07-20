<?php
if (!isset($_SESSION)) {
    session_start();
}
/*
echo $_SESSION["loggedin"] . "<br>";
echo $_SESSION["employeeId"] . "<br>";
echo $_SESSION["username"] . "<br>";
echo $_SESSION["password"] . "<br>";
echo $_SESSION["firstName"] . "<br>";
echo $_SESSION["middleName"] . "<br>";
echo $_SESSION["lastName"] . "<br>";
echo $_SESSION["permissionId"] . "<br>";


echo $_SESSION["roleName"] . "<br>";
echo $_SESSION["shipmentAccess"] . "<br>";
echo $_SESSION["employeeAccess"] . "<br>";
echo $_SESSION["subcontractorAccess"] . "<br>";
echo $_SESSION["clientAccess"] . "<br>";
echo $_SESSION["billingAccess"] . "<br>";
echo $_SESSION["payrollAccess"] . "<br>";
echo $_SESSION["companyId"] . "<br>";
*/

echo $_SESSION["shipmentId"] . "<br>";
echo $_SESSION["shipmentNumber"] . "<br>";
echo $_SESSION["shipmentStatus"] . "<br>";
echo $_SESSION["startingPoint"] . "<br>";
echo $_SESSION["destination"] . "<br>";
echo $_SESSION["dateOfDelivery"] . "<br>";
echo $_SESSION["plateNumber"] . "<br>";

//session_destroy();