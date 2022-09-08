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
        <h1 class="login">Login</h1>
        <?php
        if (isset($_SESSION['message'])) {
          echo $_SESSION['message'];
         }
        // if (isset($message)) {
        //   echo $message;
        // }
        ?>
        <form action="/phpmotors/accounts/index.php" method="post">
          <fieldset>
            <legend>Login Page</legend>
            <label class="info">
            *Email <input type="email" name="clientEmail" placeholder="info@email.com" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} ?> required>
            </label>
            <label class="info">*Password</label>
            <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span>
            <input type="password" name="clientPassword" placeholder="Password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
            
          </fieldset>
            
            <input class="submit_button" type="submit" value="Login">
            <input type="hidden" name="action" value="Login">
        </form>
        <p class="register">Not a member? <a href="/phpmotors/accounts/index.php?action=register">Register</a></p>
      </main>
      <hr>
      <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
      </footer>
    </div>
  </body>
</html>
