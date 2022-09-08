<?php 
if (!$_SESSION['loggedin']){
    header('Location: /phpmotors/index.php/');
}
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Update Account Information | PHP Motors</title>
    <meta name="description" content= "Enhancement Projects: Web Backend Development at Brigham Young University - Idaho">
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
      <?php //include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/nav.php"
      echo $navList; ?>
    </nav>
    <main>
            <h1>Update Account Information</h1>
            <?php
                if (isset($message)) {
                    echo $message;
                }
            ?>
            <h2>Update Account Info</h2>
            <form action="/phpmotors/accounts/index.php" method="post">
            <fieldset>
                <legend>Update Account</legend>
                <label class="info">
                *First Name: <input type="text" name="clientFirstName" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} elseif(isset($_SESSION['clientData']['clientFirstname'])){echo "value='".$_SESSION['clientData']['clientFirstname']."'";} ?> required>
                </label>
                <label class="info">
                *Last Name: <input type="text" name="clientLastName" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} elseif(isset($_SESSION['clientData']['clientLastname'])){echo "value='".$_SESSION['clientData']['clientLastname']."'";} ?> required>
                </label>
                <label class="info">
                *Email <input type="text" name="clientEmail" placeholder="info@email.com" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} elseif(isset($_SESSION['clientData']['clientEmail'])){echo "value='".$_SESSION['clientData']['clientEmail']."'";} ?> required>
                </label>
                
            </fieldset>
            <input type="submit" name="submit" value="Update Information">
            <input type="hidden" name="action" value="updatePersonal">
            <input type="hidden" name="clientId" <?php if(isset($_SESSION['clientData']['clientId'])){echo "value='".$_SESSION['clientData']['clientId']."'";} ?>> 
            </form>
            <h2>Update Password</h2>
            
            <p>
                Passwords must be at least 8 characters and contain at least 1
                number, 1 capital letter, and 1 special character.
            </p>
            <form action="/phpmotors/accounts/index.php" method="POST">
                
                <label class="info">
                *New Password: <input type="password" name="newPassword" placeholder="Password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
                </label>
                <input type="submit" name="submit" value="Update Password">
                <input type="hidden" name="action" value="updatePassword">
                <input type="hidden" name="clientId" <?php if(isset($_SESSION['clientData']['clientId'])){echo "value='".$_SESSION['clientData']['clientId']."'";} ?>>
            </form>
        </main>

        <hr>

    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
    </footer>
    </div>
  </body>
</html>
