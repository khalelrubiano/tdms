<?php
//SESSION START
if (!isset($_SESSION)) {
    session_start();
}

/*
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["dashboardAccess"] === 'No') {
    header("location: dashboard-default.php");
    exit;
}
*/

include_once 'navbar.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!--JQUERY CDN-->
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <!--AJAX CDN-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!--BULMA CDN-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <!--FONTAWESOME CDN-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!--NAVBAR CSS-->
    <link rel="stylesheet" href="navbar.css">


    <!--FULLCALENDAR
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/main.min.js"></script>-->
    <link href='fullcalendar/lib/main.css' rel='stylesheet' />
    <script src='fullcalendar/lib/main.js'></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-1.11.0/b-2.0.0/sl-1.3.3/datatables.min.css" />
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>


    <!--INTERNAL CSS-->
    <style>
        html {
            background-color: #f4faff;
        }
    </style>
</head>

<body>
    <div class="main">
        <section class="hero has-background-white">
            <div class="hero-body">
                <div class="container">
                    <div class="columns is-centered">
                        <div class="column is-full">
                            <h1 class="is-size-3 mb-5 has-text-weight-bold"><i class="fa-solid fa-clipboard-list mr-3"></i> Log </h1>
                            <table id="logTable" class="table is-bordered is-narrow is-hoverable is-fullwidth">
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>Timestamp</th>
                                    </tr>
                                </thead>
                            </table>

                            <button class="button is-success is-rounded mt-6" onclick="refreshTable()"> <i class="fas fa-redo mr-3"></i>Refresh </button>
                            <button class="button has-background-grey-light is-rounded mt-6 has-text-white" onclick="returnTo()"> <i class="fa-solid fa-arrow-left mr-3"></i>Return </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <p class="is-hidden" id="access1"><?php echo $_SESSION['shipmentAccess'] ?></p>
    <p class="is-hidden" id="access2"><?php echo $_SESSION['employeeAccess'] ?></p>
    <p class="is-hidden" id="access3"><?php echo $_SESSION['subcontractorAccess'] ?></p>
    <p class="is-hidden" id="access4"><?php echo $_SESSION['clientAccess'] ?></p>
    <p class="is-hidden" id="access5"><?php echo $_SESSION['billingAccess'] ?></p>
    <p class="is-hidden" id="access6"><?php echo $_SESSION['payrollAccess'] ?></p>
</body>

<!--EXTERNAL JAVASCRIPT-->
<script src="js/log.js"></script>


<!--INTERNAL JAVASCRIPT-->
<script>
    let access1 = document.getElementById('access1');
    let access2 = document.getElementById('access2');
    let access3 = document.getElementById('access3');
    let access4 = document.getElementById('access4');
    let access5 = document.getElementById('access5');
    let access6 = document.getElementById('access6');

    logoutBtn.classList.remove("is-hidden");
    userBtn.innerHTML = "<?php echo $_SESSION['username'] ?>";
    userBtn.classList.remove("is-hidden");
    //dashboardBtn.classList.add("is-active");

    //alert();

    if (access1.innerHTML == 'false') {
        shipmentBtn.classList.add("is-hidden");
    }
    if (access2.innerHTML == 'false') {
        employeeBtn.classList.add("is-hidden");
    }
    if (access3.innerHTML == 'false') {
        subcontractorBtn.classList.add("is-hidden");
    }
    if (access4.innerHTML == 'false') {
        clientBtn.classList.add("is-hidden");
    }
    if (access5.innerHTML == 'false') {
        billingBtn.classList.add("is-hidden");
    }
    if (access6.innerHTML == 'false') {
        payrollBtn.classList.add("is-hidden");
    }
</script>

</html>