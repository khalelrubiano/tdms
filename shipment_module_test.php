<?php
include 'navbar.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index New</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>

    </style>
</head>

<body>
    <section class="section">
        <div class="container">

            <div class="tabs is-centered">
                <ul>
                    <li class="is-active"><a>All</a></li>
                    <li><a>Pending</a></li>
                    <li><a>Completed</a></li>
                    <li><a>Cancelled</a></li>
                </ul>
            </div>

            <div class="columns">
                <div class="column is-2 is-offset-1" id="date_column">
                    <div class="field">
                        <label class="label">Start Date:</label>
                        <div class="control">
                            <input type="date" class="input">
                        </div>
                        <p class="help"></p>
                    </div>

                    <div class="field">
                        <label class="label">End Date:</label>
                        <div class="control">
                            <input type="date" class="input">
                        </div>
                        <p class="help"></p>
                    </div>

                    <div class="field">
                        <div class="control">
                            <button class="button">
                                Filter
                            </button>
                        </div>
                        <p class="help"></p>
                    </div>

                </div>

                <div class="column is-4 is-offset-1" id="main_column">


                    <div class="card mb-4">
                        <header class="card-header">
                            <p class="card-header-title">
                                2GO Inc.
                            </p>
                            <button class="card-header-icon" aria-label="more options">

                                Pending
                            </button>
                        </header>
                        <div class="card-content">
                            <div class="content">
                                <p class="title is-4">209567218</p>

                                <time>2022-06-09</time>
                            </div>
                        </div>
                        <footer class="card-footer">
                            <a href="#" class="card-footer-item">View</a>
                            <a href="#" class="card-footer-item">Edit</a>
                            <a href="#" class="card-footer-item">Delete</a>
                        </footer>
                    </div>
                    <div class="card mb-4">
                        <header class="card-header">
                            <p class="card-header-title">
                                2GO Inc.
                            </p>
                            <button class="card-header-icon" aria-label="more options">

                                Pending
                            </button>
                        </header>
                        <div class="card-content">
                            <div class="content">
                                <p class="title is-4">209567218</p>

                                <time>2022-06-09</time>
                            </div>
                        </div>
                        <footer class="card-footer">
                            <a href="#" class="card-footer-item">View</a>
                            <a href="#" class="card-footer-item">Edit</a>
                            <a href="#" class="card-footer-item">Delete</a>
                        </footer>
                    </div>
                    <div class="card mb-4">
                        <header class="card-header">
                            <p class="card-header-title">
                                2GO Inc.
                            </p>
                            <button class="card-header-icon" aria-label="more options">

                                Pending
                            </button>
                        </header>
                        <div class="card-content">
                            <div class="content">
                                <p class="title is-4">209567218</p>

                                <time>2022-06-09</time>
                            </div>
                        </div>
                        <footer class="card-footer">
                            <a href="#" class="card-footer-item">View</a>
                            <a href="#" class="card-footer-item">Edit</a>
                            <a href="#" class="card-footer-item">Delete</a>
                        </footer>
                    </div>
                    <nav class="pagination" role="navigation" aria-label="pagination">
                        <a class="pagination-previous">Previous</a>
                        <a class="pagination-next">Next page</a>
                        <ul class="pagination-list">
                            <li>
                                <a class="pagination-link" aria-label="Goto page 1">1</a>
                            </li>
                            <li>
                                <span class="pagination-ellipsis">&hellip;</span>
                            </li>
                            <li>
                                <a class="pagination-link" aria-label="Goto page 45">2</a>
                            </li>
                            <li>
                                <a class="pagination-link is-current" aria-label="Page 46" aria-current="page">3</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
    </section>

</body>
<script>
    /*
    //let sample_array = [1, 2, 3];

    let main_column = document.getElementById('main_column')

    //CREATE CARD
    let shipment_card = document.createElement('div');
    //ADD CLASSES TO CARD
    shipment_card.classList.add("card", "mb-6", "box");


    main_column.appendChild(shipment_card);
/*
    //CREATE CARD HEADER
    let card_header = document.createElement('header');
    card_header.classList.add("card-header");
    shipment_card.appendChild(card_header);



/*
    let shipment_card = document.createElement('div');
    let shipment_card = document.createElement('div');
    let shipment_card = document.createElement('div');

    //firstP.setAttribute("id","firstPracPara");

    sample_header_1.innerHTML = "THIS";
    sample_header_2.innerHTML = "STATIC ELEMENTS";

    main.appendChild(sample_header_2);
    main.appendChild(sample_header_1);
    main.removeChild(sample_header_2);
*/
</script>

</html>