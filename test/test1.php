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


$date= date_create("2022-08-18");
date_add($date,date_interval_create_from_date_string("30 days"));
echo date_format($date,"Y-m-d") . "<br>";

echo $date;
