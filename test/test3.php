<?php

if (!isset($_SESSION)) {
  session_start();
}

echo $_SESSION["test_var"];

//$_SESSION["test_var"] = "Test Variable v2";

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Test 3</title>
</head>

<body>

</body>

<script>
  //window.location.href = "test3.php";
</script>

</html>