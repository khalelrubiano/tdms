
<?php
//PART OF NEW SYSTEM
include 'sign-up-company-model.class.php';

if (isset($_POST["submit"])) {
    $employeeNumberAdd = $_POST["employeeNumberAdd"];
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

    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) {
                $fileNameNew = uniqid('', true) . '.' . $fileActualExt;
                $fileDestination = '../uploads/' . $fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                //header("Location: temporary.php?uploadsuccess");
            } else {
                echo 'SIZE ERROR';
            }
        } else {
            echo 'FILE ERROR';
        }
    } else {
        echo "TYPE ERROR";
    }

    $signUpCompanyObj = new SignUpCompanyModel($employeeNumberAdd, $username, $password, $companyName, $companyEmail, $companyNumber, $companyAddress, $region, $province, $city, $barangay, $tin, $fileNameNew);

    $signUpCompanyObj->signUpCompany();
}
