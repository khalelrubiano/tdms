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


  <!--INTERNAL CSS-->
  <style>
    html {
      background-color: #f4faff;
    }

    @media (min-width: 1000px) {

      #calendarTile,
      #listTile {
        padding-left: 5%;
        padding-right: 5%;

      }

      /* width */
      ::-webkit-scrollbar {
        width: 10px;
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

    }


    @media (max-width: 1000px) {

      #calendarTile {
        margin-bottom: 10% !important
      }

      .fc {
        font-size: 1.5vh;
      }
    }

    #eventHeader {
      line-height: 2;
    }

    #listTile {
      height: 50%;
    }
  </style>
</head>

<body>
  <div class="main">



    <div class="container">
      <div class="tile is-ancestor">
        <div class="tile is-parent">
          <div class="tile is-child is-8" id="calendarTile">
            <div class="container box">
              <div id='calendar'>

              </div>
            </div>
          </div>

          <div class="tile is-child box is-4" id="listTile">
            <h1 class="title has-text-centered is-4 mb-6">Event Description</h1>
            <div class="container" id="eventContainer">
              <p class="subtitle is-5" id="eventHeader"></p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!--EVENT MODAL-->
  <div class="modal">
    <div class="modal-background"></div>
    <div class="modal-card">
      <header class="modal-card-head">
        <p class="modal-card-title" id="modalHeader">Modal title</p>
        <button class="delete" aria-label="close"></button>
      </header>
      <section class="modal-card-body">
        <!-- Content ... -->
      </section>
    </div>
  </div>
  <!--EVENT MODAL-->

</body>

<!--EXTERNAL JAVASCRIPT-->
<script src="js/dashboard.js"></script>


<!--INTERNAL JAVASCRIPT-->
<script>
  logoutBtn.classList.remove("is-hidden");
  userBtn.innerHTML = "<?php echo $_SESSION['username'] ?>";
  userBtn.classList.remove("is-hidden");
  dashboardBtn.classList.add("is-active");
</script>

</html>