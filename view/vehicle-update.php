<?php
if (!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] <= 1){
  header('Location: /phpmotors/index.php');

}

// Build a car classification drop down list.
  $classificationList = '<select name="classificationId">';
  foreach ($classifications as $classification) {
    $classificationList .= "<option value='$classification[classificationId]'";
    if (isset($classificationId)) {
      if ($classification['classificationId'] == $classificationId) {
        $classificationList .= '  selected ';
      }
    } elseif(isset($invInfo['classificationId'])){
    if($classification['classificationId'] == $invInfo['classificationId']){
     $classificationList .= ' selected ';
    }
   }
    $classificationList .= ">$classification[classificationName]</option>";
  }
  $classificationList .= '</select>';

?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
		echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
	elseif(isset($invMake) && isset($invModel)) { 
		echo "Modify $invMake $invModel"; }?> | PHP Motors</title>
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
            echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
        elseif(isset($invMake) && isset($invModel)) { 
            echo "Modify$invMake $invModel"; }?></h1>
        <?php
        if (isset($message)) {
          echo $message;
        }
        ?>
        <form action="/phpmotors/vehicles/index.php?action=addVehicle" method="POST">
        
          <fieldset>
            <legend>Update Vehicle</legend>
            <label class="info">
            Choose car classification
            <?php echo $classificationList; ?>
            </label>
            <label class="info">
            *Make <input type="text" name="invMake" placeholder="Make" <?php if(isset($invMake)){echo "value='$invMake'";} elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?> required>
            </label>
            <label class="info">
            *Model <input type="text" name="invModel" placeholder="Model" <?php if(isset($invModel)){echo "value='$invModel'";} elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?> required>
            </label>
            <label class="info">
            *Description <textarea name="invDescription" cols="20" rows="5"><?php if(isset($invDescription)){echo $invDescription;} elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?></textarea> 
            </label>
            <label class="info">
            *Image Path <input type="text" name="invImage" placeholder="Image Path" value="phpmotors/images/no-image/no-image.png" <?php if(isset($image)){echo "value='$image'";} elseif(isset($invInfo['invImage'])) {echo "value='$invInfo[invImage]'"; } ?> required>
            </label>
            <label class="info">
            *Thumbnail Path <input type="text" name="invThumbnail" placeholder="Thumbnail" value="phpmotors/images/no-image/no-image.png" <?php if(isset($thumb)){echo "value='$thumb'";} elseif(isset($invInfo['invThumbnail'])) {echo "value='$invInfo[invThumbnail]'"; } ?> required>
            </label>
            <label class="info">
            *Price <input type="number" name="invPrice" placeholder="Price" <?php if(isset($invPrice)){echo "value='$invPrice'";} elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'"; }?> required>
            </label>
            <label class="info">
            *In Stock <input type="number" name="invStock" placeholder="Stock" <?php if(isset($invStock)){echo "value='$invStock'";} elseif(isset($invInfo['invStock'])) {echo "value='$invInfo[invStock]'"; } ?> required>
            </label>
            <label class="info">
            *Color <input type="text" name="invColor" placeholder="Color" <?php if(isset($invColor)){echo "value='$invColor'";} elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'"; } ?> required>
            </label>
          </fieldset>
            
            <input class="submit_button" type="submit" value="Update Vehicle">
            <input type="hidden" name="action" value="updateVehicle">
            <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} elseif(isset($invId)){ echo $invId; } ?>">
            
        </form>
      </main>
        <hr>

        <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
      </footer>
    </div>
  </body>
</html>