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
  <title>User Profile</title>

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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <!--FULLCALENDAR
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/main.min.js"></script>-->
  <link href='fullcalendar/lib/main.css' rel='stylesheet' />
  <script src='fullcalendar/lib/main.js'></script>


  <!--INTERNAL CSS-->
  <style>
    html {
      background-color: #f4faff;
    }

    /*
    @media (min-width: 1000px) {

    }

    
    @media (max-width: 1000px) {

    }
  

    table {
      width: 100% !important;
      table-layout: fixed;
    }

    td,
    th {
      width: 50% !important;
      overflow-y: auto !important;
      text-align: center !important;
    }
  */
    /* width */
    ::-webkit-scrollbar {
      width: 10px !important;
      height: 10px !important;
    }

    /* Track */
    ::-webkit-scrollbar-track {
      background: #f1f1f1;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
      background: #888;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
      background: #555;
    }

    #addressHeader {
      text-transform: uppercase;
    }

    /*
    #addressHeader::first-letter {
      text-transform: capitalize;
    }
*/

    #roleNameTitle {
      font-size: calc(8px + 0.390625vw);
    }

    #nameTitle {
      font-size: calc(12px + 0.390625vw);
    }

    #usernameTitle {
      font-size: calc(8px + 0.390625vw);
    }

    #changePassword {
      font-size: calc(8px + 0.390625vw);
    }

    #companyInfoTitle {
      font-size: calc(14px + 0.390625vw);
    }

    #nameHeader {
      font-size: calc(16px + 0.390625vw);
    }

    #contactHeader {
      font-size: calc(10px + 0.390625vw);
    }

    #addressHeader {
      font-size: calc(6px + 0.390625vw);
    }

    @media (max-width: 1000px) {
      #roleNameTitle {
        font-size: calc(10px + 0.390625vw);
      }

      #nameTitle {
        font-size: calc(14px + 0.390625vw);
      }

      #usernameTitle {
        font-size: calc(10px + 0.390625vw);
      }

      #changePassword {
        font-size: calc(10px + 0.390625vw);
      }

      #companyInfoTitle {
        font-size: calc(16px + 0.390625vw);
      }

      #nameHeader {
        font-size: calc(18px + 0.390625vw);
      }

      #contactHeader {
        font-size: calc(12px + 0.390625vw);
      }

      #addressHeader {
        font-size: calc(8px + 0.390625vw);
      }
    }
  </style>
</head>

<body>
  <div class="main" id="pdfbody">
    <div class="container" style="margin-bottom: 5%;">

      <div class="tile is-ancestor">

        <div class="tile is-parent box m-4" style="border-radius: 5%;">
          <div class="tile is-child has-text-centered p-6">
            <i class="fa-solid fa-user fa-8x mb-4"></i>
            <h1 class="title is-4" id="roleNameTitle"><?php echo $_SESSION['roleName'] ?></h1>

            <p class="title is-3" id="nameTitle"><?php echo $_SESSION['firstName'] . " " . $_SESSION['middleName'] . " " . $_SESSION['lastName'] ?></p>
            <p class="subtitle is-4 mb-6" id="usernameTitle">@<?php echo $_SESSION['username'] ?></p>

            <button class="button is-rounded is-info" id="changePassword" onclick="openEdit()"> <i class="fa-solid fa-pen-to-square mr-3"></i>Change Password</button>
          </div>
        </div>

        <div class="tile is-parent m-4">
          <div class="tile is-child p-6">
            <p class="title is-3 has-text-white box has-background-grey-dark mb-6" id="companyInfoTitle">Company Info</p>
            <h1 class="title is-4" id="nameHeader"></h1>
            <h1 class="subtitle is-5 mb-6" id="contactHeader"></h1>

            <h1 class="title is-6" id="addressHeader"></h1>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- EDIT MODAL -->
  <div class="modal" id="editModal">
    <div class="modal-background" id="editModalBg"></div>
    <div class="modal-card p-4">

      <header class="modal-card-head has-background-light">
        <p class="modal-card-title has-text-black"><i class="fas fa-edit mr-3"></i>Change Password</p>
        <button class="delete" aria-label="close" onclick="closeEdit()"></button>
      </header>

      <section class="modal-card-body">

        <div class="field">
          <label for="" class="label"> New Password</label>
          <div class="control has-icons-left">
            <input type="password" placeholder="Enter password here" class="input is-rounded" name="passwordEdit" id="passwordEdit">
            <span class="icon is-small is-left">
              <i class="fa fa-lock"></i>
            </span>
          </div>
          <p class="help" id="passwordEditHelp"></p>
        </div>

        <div class="field mb-6">
          <label for="" class="label">Confirm New Password</label>
          <div class="control has-icons-left">
            <input type="password" placeholder="Confirm password here" class="input is-rounded" name="confirmPasswordEdit" id="confirmPasswordEdit">
            <span class="icon is-small is-left">
              <i class="fa fa-lock"></i>
            </span>
          </div>
          <p class="help" id="confirmPasswordEditHelp"></p>
        </div>

        <div class="field has-text-centered">
          <button class="button has-background-dark has-text-white is-rounded" name="submitEditForm" id="submitEditForm">
            <i class="fas fa-check mr-3"></i> Save changes
          </button>
          <p class="help" id="submitEditFormHelp"></p>
        </div>

      </section>
    </div>
  </div>
</body>

<!--EXTERNAL JAVASCRIPT-->
<script src="js/user-profile-employee.js"></script>


<!--INTERNAL JAVASCRIPT-->
<script>
  logoutBtn.classList.remove("is-hidden");
  userBtn.innerHTML = "<?php echo $_SESSION['username'] ?>";
  userBtn.classList.remove("is-hidden");

</script>

</html>