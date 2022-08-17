<?php
if (!isset($_SESSION)) {
  session_start();
}

/*$isOwner = $_SESSION["isOwner"];
$isDriver = $_SESSION["isDriver"];
$isHelper = $_SESSION["isHelper"];

if (true) {
  //echo "Success";
  $switchValue = "Yes";

  switch ($switchValue) {
    case "Yes":
      $sample = "Yes";
      break;
    case "No":
      $sample = "No";
      break;
  }

}*/

echo $_SESSION["isOwner"] . "<br>" . $_SESSION["isDriver"] . "<br>" . $_SESSION["isHelper"];
