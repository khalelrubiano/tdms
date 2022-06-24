<?php
if (!isset($_SESSION)) {
    session_start();
}

echo $_SESSION["loggedin"] . "<br>";
echo $_SESSION["userId"] . "<br>";
echo $_SESSION["username"] . "<br>";
echo $_SESSION["password"] . "<br>";
echo $_SESSION["firstName"] . "<br>";
echo $_SESSION["middleName"] . "<br>";
echo $_SESSION["lastName"] . "<br>";
echo $_SESSION["permissionId"] . "<br>";


echo $_SESSION["roleName"] . "<br>";
echo $_SESSION["accountType"] . "<br>";
echo $_SESSION["dashboardAccess"] . "<br>";
echo $_SESSION["shipmentAccess"] . "<br>";
echo $_SESSION["employeeAccess"] . "<br>";
echo $_SESSION["subcontractorAccess"] . "<br>";
echo $_SESSION["companyId"] . "<br>";


session_destroy();