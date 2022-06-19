<?php 
if ( !isset($_SESSION) ) {
    session_start();
}
include 'delete-tracker-data-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $trackerId = $_POST['trackerId'];

    $deleteObj = new DeleteTrackerModel($trackerId);

    $deleteObj->deleteTrackerRecord();

}