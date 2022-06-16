<?php
if ( !isset($_SESSION) ) {
  session_start();
}

include 'navbar.php';

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Details</title>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-1.11.0/b-2.0.0/sl-1.3.3/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="Editor-2.0.5/css/editor.dataTables.css">
    
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-1.11.0/b-2.0.0/sl-1.3.3/datatables.min.js"></script>
    <script type="text/javascript" src="Editor-2.0.5/js/dataTables.editor.js"></script>


</head>

<body>
    <section class="hero has-background-white">
        <div class="hero-body">
            <div class="container">
                <div class="columns is-centered">
                    <div class="column box is-6 has-background-white-ter" style="overflow-x:auto;">
                    <h1 class="is-size-3 mb-5 has-text-weight-bold"><i class="fa-solid fa-user-pen mr-3"></i> Account Details </h1>
                    <table class="table is-bordered">
                    <tr>
                      <td class="has-text-weight-bold">Username:</td>
                      <td><?php echo $_SESSION['username'] ?></td>
                    </tr>
                    <tr>
                      <td class="has-text-weight-bold">Password:</td>
                      <td><?php echo $_SESSION['password'] ?></td>
                    </tr>
                    <tr>
                      <td class="has-text-weight-bold">Access Type:</td>
                      <td><?php echo $_SESSION['accessType'] ?></td>
                    </tr>
                    <tr>
                      <td class="has-text-weight-bold">First Name:</td>
                      <td><?php echo $_SESSION['firstName'] ?></td>
                    </tr>
                    <tr>
                      <td class="has-text-weight-bold">Middle Name:</td>
                      <td><?php echo $_SESSION['middleName'] ?></td>
                    </tr>
                    <tr>
                      <td class="has-text-weight-bold">Last Name:</td>
                      <td><?php echo $_SESSION['lastName'] ?></td>
                    </tr>
                    <tr>
                      <td class="has-text-weight-bold">Company Name:</td>
                      <td><?php echo $_SESSION['companyName'] ?></td>
                    </tr>
                  </table>
                  <button class="button has-background-link has-text-white is-rounded" id="changePassword" onclick="openEdit()">Change Account Password</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

<!-- EDIT MODAL -->
<div class="modal" id="editModal">
  <div class="modal-background" id="editModalBg"></div>
  <div class="modal-card">

    <header class="modal-card-head has-background-grey-dark">
      <p class="modal-card-title has-text-white"><i class="fas fa-edit mr-3"></i>Change Account Password</p>
      <button class="delete" aria-label="close" onclick="closeEdit()"></button>
    </header>

    <section class="modal-card-body">

    <div class="field">
              <label for="" class="label"> New Password</label>
              <div class="control has-icons-left">
                <input type="password" placeholder="Enter password here" class="input is-rounded" name="passwordEdit" id="passwordEdit" >
                <span class="icon is-small is-left">
                <i class="fa fa-lock"></i>
                </span>
              </div>
              <p class="help" id="passwordEditHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">Confirm New Password</label>
              <div class="control has-icons-left">
                <input type="password" placeholder="Confirm password here" class="input is-rounded" name="confirmPasswordEdit" id="confirmPasswordEdit" >
                <span class="icon is-small is-left">
                <i class="fa fa-lock"></i>
                </span>
              </div>
              <p class="help" id="confirmPasswordEditHelp"></p>
            </div>

            <div class="field">
              <button class="button has-background-grey-dark has-text-white is-rounded" name="submitEditForm" id="submitEditForm">
              <i class="fas fa-check mr-3"></i> Save changes
              </button>
              <p class="help" id="submitEditFormHelp"></p>
            </div>

    </section>
  </div>
</div>

<script src="js/view-account.js"></script>

<script>
const logoutBtn = document.getElementById('logoutBtn')
const loginBtn = document.getElementById('loginBtn')
const signupBtn = document.getElementById('signupBtn')
const userBtn = document.getElementById('userBtn')
const shipmentBtn = document.getElementById('shipmentBtn')

const trackingBtn = document.getElementById('trackingBtn')
const payslipBtn = document.getElementById('payslipBtn')
const manageBtn = document.getElementById('manageBtn')
const billingBtn = document.getElementById('billingBtn')

var partialType = "<?php echo $_SESSION['accessType']; ?>";

if(<?php echo isset($_SESSION["loggedin"])?> == true ){
    logoutBtn.className = "button has-background-dark is-rounded has-text-white";
    loginBtn.className = "button has-background-grey-lighter is-rounded is-hidden";
    signupBtn.className = "button is-link is-rounded is-hidden";
    userBtn.className = "navbar-item has-text-weight-bold";
}

if(partialType == "Partial"){
  shipmentBtn.className = "navbar-item is-hidden";
  trackingBtn.className = "navbar-item is-hidden";
  payslipBtn.className = "navbar-item is-hidden";
  manageBtn.className = "navbar-item is-hidden";
  billingBtn.className = "navbar-item is-hidden";
}
</script>
</html>