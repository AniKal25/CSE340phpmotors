<!DOCTYPE html>
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
        <h1 class="login">Register</h1>
        <?php
        if (isset($message)) {
          echo $message;
        }
        ?>
        <form action="/phpmotors/accounts/index.php" method="post">
          <fieldset>
            <legend>Register Page</legend>
            <label class="info">
            *First Name: <input type="text" name="clientFirstName" title="Please have at least 3 letters entered" pattern="^[a-zA-Z\s\-\.]{3,}$" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} ?> required>
            </label>
            <label class="info">
            *Last Name: <input type="text" name="clientLastName" title="Please have at least 3 letters entered" pattern="^[a-zA-Z\s\-\.]{3,}$" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} ?> required>
            </label>
            <label class="info">
            *Email <input type="email" name="clientEmail" placeholder="info@email.com" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} ?> required>
            </label>
            <label class="info">*Password</label>
            <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span>
            <input type="password" name="clientPassword" placeholder="Password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
            
          </fieldset>
            
            <input class="submit_button" type="submit" value="register">
            <!-- Add the action name - value pair -->
            <input type="hidden" name="action" value="register">
        </form>

      </main>
      <hr>
      <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
      </footer>
    </div>
  </body>
</html>
