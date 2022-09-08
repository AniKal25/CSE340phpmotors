<?php
    if (!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] <= 1){
        header('Location: /phpmotors/index.php');
    }
    if (isset($_SESSION['message'])) {
      $message = $_SESSION['message'];
     }  
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Content Title | PHP Motors</title>
    <!-- device-width is the width of the screen in CSS pixels -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- screen is used for computer screens, tablets, smart-phones etc. -->
    <link href="/phpmotors/css/normalize.css" type="text/css" rel="stylesheet" media="screen">
    <link href="/phpmotors/css/style.css" type="text/css" rel="stylesheet" media="screen">
    <link href="/phpmotors/css/large.css" type="text/css" rel="stylesheet" media="screen">
    <link href="https://fonts.googleapis.com/css?family=Share+Tech+Mono&display=swap" rel="stylesheet">
  </head>
  <body>
    
    <div id="wrapper">
      <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/header.php" ?>
      </header>
      <nav>
        <?php echo $navList;
        //include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/nav.php" ?>
      </nav>

      
      <main>
      <h1>Vehicle Management</h1>
      <?php
        if (isset($message)) {
          echo $message;
        }
        ?>
        <ul>
          <li><a href="/phpmotors/vehicles/index.php?action=newClass" title="myaccount">Add Classification</a></li>
          <li><a href="/phpmotors/vehicles/index.php?action=newVehicle" title="myaccount">Add Vehicle</a></li>
        </ul>

        <?php
        if (isset($message)) { 
            echo $message; 
            } 
            if (isset($classificationList)) { 
            echo '<h2>Vehicles By Classification</h2>'; 
            echo '<p>Choose a classification to see those vehicles</p>'; 
            echo $classificationList; 
        }
        ?>
        <noscript>
            <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
        </noscript>
        <table id="inventoryDisplay"></table>

      </main>
      <hr>
      <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
      </footer>
    </div>
    <script src="../js/inventory.js"></script>
  </body>
</html><?php unset($_SESSION['message']); ?>
