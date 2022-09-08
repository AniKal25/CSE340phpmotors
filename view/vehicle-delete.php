<?php
if (!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] <= 1){
  header('Location: /phpmotors/index.php');

}

?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
		echo "Delete $invInfo[invMake] $invInfo[invModel]";} 
	elseif(isset($invMake) && isset($invModel)) { 
		echo "Delete $invMake $invModel"; }?> | PHP Motors</title>
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
        <h1 class="login"><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
            echo "Delete $invInfo[invMake] $invInfo[invModel]";} 
        elseif(isset($invMake) && isset($invModel)) { 
            echo "Delete $invMake $invModel"; }?></h1>
            <p>Confirm Vehicle Deletion. The delete is permanent.</p>
        <?php
        if (isset($message)) {
          echo $message;
        }
        ?>
        <form action="/phpmotors/vehicles/index.php?action=addVehicle" method="POST">
        
          <fieldset>
            <legend>Delete Vehicle</legend>

            <label class="info">
            *Make <input type="text" name="invMake" placeholder="Make" <?php if(isset($invMake)){echo "value='$invMake'";} ?> readonly>
            </label>
            <label class="info">
            *Model <input type="text" name="invModel" placeholder="Model" <?php if(isset($invModel)){echo "value='$invModel'";} ?> readonly>
            </label>
            <label class="info">
            *Description <textarea name="invDescription" cols="20" rows="5"><?php if(isset($invDescription)){echo $invDescription;} ?></textarea> 
            </label>
            
          </fieldset>
            
            <input class="submit_button" type="submit" value="Delete Vehicle">
            <input type="hidden" name="action" value="deleteVehicle">
            <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} ?>">
            
        </form>
      </main>
        <hr>

        <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
      </footer>
    </div>
  </body>
</html>