

<?php
//PART OF NEW SYSTEM
session_start();
include 'navbar.php';

header("Refresh: 10; url = index.php");

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prompt</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<section class="hero has-background-white">
  <div class="hero-body">
    <div class="container">
      <div class="columns is-centered">
        <div class="column is-6">
            <article class="message is-info">
                <div class="message-header">
                <p class="is-size-3">Attention!</p>
                </div>

                <div class="message-body">
                    <p class="is-size-4"> <?php echo $_SESSION['prompt'] . "<br>" . "Redirecting in 10 secs..."; ?> </p>
                </div>
            </article>

        </div>
      </div>
    </div>
  </div>
</section>

</body>
</html>