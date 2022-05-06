<?php
  include_once 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hotel Covid</title>
    <!-- font-awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
    />

    <!-- styles -->
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body>
    <button class="sidebar-toggle">
      <i class="fas fa-bars"></i>
    </button>
    <aside class="sidebar">
      <div class="sidebar-header">
        <button class="close-btn"><i class="fas fa-times"></i></button>
      </div>
      <!-- links -->
      <ul class="links">
        <li>
          <a href="Main.php">Home</a>
        </li>
        <li>
          <a href="Services.php">Services</a>
        </li>
        <li>
          <a href="Statistics.php">Statistics</a>
        </li>
        <li>
          <a href="Sales.php">Sales</a>
        </li>
        <li>
            <a href="More_info.php">More info</a>
          </li>
      </ul>
    </aside>
    <h1 id="welcome_message" style="text-align:left">Welcome to ASDF Palace</h1>

    <!-- javascript -->
    <script src="app.js"></script>
    <img src="hotel_image.jpg" style="vertical-align:middle;margin:0px 220px">
  </body>
</html>