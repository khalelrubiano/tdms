<?php
if (!isset($_SESSION)) {
    session_start();
}
//PART OF NEW SYSTEM

if (!isset($_SESSION["loggedin"]) || !isset($_SESSION["shipmentAccess"])) {
    header("location: homepage.php");
    exit;
}

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["shipmentAccess"] === 'No') {
    header("location: dashboard-default.php");
    exit;
}

include_once 'navbar.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View List</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="navbar.css">
    <style>
        table {
            border: 1px solid #ccc;
            width: 100%;
            margin: 0;
            padding: 0;
            border-collapse: collapse;
            border-spacing: 0;
        }

        table tr {
            border: 1px solid #ddd;
            padding: 5px;
            background: #fff;

        }

        table th,
        table td {
            padding: 10px;
            text-align: center;

        }

        table th {
            text-transform: uppercase;
            letter-spacing: 1px;
        }


        @media screen and (max-width: 600px) {

            #card table {
                border: 0;
            }

            #card table thead {
                display: none;
            }

            #card table tr {
                margin-bottom: 20px;
                display: block;
                border-bottom: 2px solid #ddd;
                box-shadow: 2px 2px 1px #dadada;

            }

            #card table td {
                display: block;
                text-align: right;
                font-size: 13px;
            }

            #card table td:last-child {
                border-bottom: 0;
            }

            #card table td::before {
                content: attr(data-label);
                float: left;
                text-transform: uppercase;
                font-weight: bold;
            }

            #card tbody {
                line-height: 0 !important;
            }

        }
    </style>
</head>

<body>
    <div class="main">
        <section class="section">
            <div id="card" class="mb-4">
                <table>
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Role</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody id="tableTbody">
                        <!--
                        <tr>
                        <td data-label="First Name"> John</td>
                        <td data-label="Last Name">Doe</td>
                        <td data-label="Address">123 Main Street</td>
                        <td data-label="City">Anytown</td>
                        <td data-label="State">MN</td>
                        <td data-label="Zip"> 12345</td>
                        </tr>
                        -->
                    </tbody>
                </table>
            </div>
            <nav class="pagination" role="navigation" aria-label="pagination">
                <a class="pagination-previous is-disabled" title="This is the first page">Previous</a>
                <a class="pagination-next">Next page</a>
                <ul class="pagination-list">
                    <li>
                        <a class="pagination-link is-current">1</a>
                    </li>
                </ul>
            </nav>
        </section>
    </div>


</body>

<script src="js/default-users-view-list.js"></script>

<script>
    let clientTrackingBtn = document.getElementById('clientTrackingBtn')


    let signupBtn = document.getElementById('signupBtn')
    let loginBtn = document.getElementById('loginBtn')
    let logoutBtn = document.getElementById('logoutBtn')

    if (<?php echo isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true ?>) {

        logoutBtn.classList.remove("is-hidden");
    }

    defaultViewListBtn.classList.add("is-active");
</script>

</html>