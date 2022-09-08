<?php
    if (!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] <= 1){
        header('Location: /phpmotors/index.php');

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
        <h1 class="login">Add Classification Page</h1>
        <?php
        if (isset($message)) {
          echo $message;
        }
        ?>
         <form action="/phpmotors/vehicles/index.php?action=addClass" method="POST">
        
          <fieldset>
            <legend>Add Classification</legend>
            <label class="info">
            <span>Classification Name should not be more than 30 Characters</span>
            
            *Classification Name <input type="text" name="classificationName" placeholder="Classification Name" maxlength="30" required>
            </label>
          
          </fieldset>
            
            <input class="submit_button" type="submit" value="Add Classification">
            
            
        </form>
        
      </main>
      <hr>
      <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
      </footer>
    </div>
  </body>
</html>
