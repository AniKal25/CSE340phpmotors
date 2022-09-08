<?php 
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Search | PHP Motors, Inc.</title>
    <!-- device-width is the width of the screen in CSS pixels -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- screen is used for computer screens, tablets, smart-phones etc. -->
    <link href="/phpmotors/css/normalize.css" type="text/css" rel="stylesheet" media="screen">
    <link href="/phpmotors/css/style.css" type="text/css" rel="stylesheet" media="screen">
    <link href="/phpmotors/css/large.css" type="text/css" rel="stylesheet" media="screen">
    <link href="https://fonts.googleapis.com/css?family=Share+Tech+Mono&display=swap" rel="stylesheet">

    <?php
    $displayLimit = 10;
    $row = 0;
    
    if (isset($_POST['but-prev'])) {
        $row = $_POST['row'];
        $row -= $displayLimit;
        if ($row < 0) {
          $row = 0;
        }
      }

      if (isset($_POST['but-next'])) {
        $row = $_POST['row'];
        $all_counts = returnSearch($searchText);

        $val = $row + $displayLimit;
        if ($val < $allcount) {
          $row = $val;
        }
      }?>
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
        <h1>Search Result</h1>
        <?php
        if (isset($message)) {
          echo $message;
        } ?>

<?php if(isset($searchDisplay)){
        echo $searchDisplay; } ?>
        <form action="/phpmotors/search?addSearch=" method="post">
           <input type="hidden" name="row" value="<?php echo $row; ?>">
            <input type="hidden" name="all_counts" value="<?php echo $all_counts; ?>">
            <input type="submit" name="action" value="but-prev">
            <input type="submit" name="action" value="but-next">
        </form>

        
            
      </main>
      <hr>
      <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
      </footer>
    </div>
  </body>
</html>