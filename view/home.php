<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Home | PHP Motors</title>
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
      <h1>Welcome to PHP Motors</h1>
      <div>
        <ul class="dmc">
          <li><strong>DMC Delorean</strong></li>
          <li>3 cup holders</li>
          <li>Superman doors</li>
          <li>Fuzy dice</li>
          <li><img id="actionbtn" src="/phpmotors/images/vehicles/own_today.png" alt="Own Today button" ></li>
        </ul>
        
         <img class="carpic" src="/phpmotors/images/vehicles/delorean.jpg" alt="Delorean Car"> 
      
      </div>
  <div class="flex-content">
    <section id="review">
      <h2>DMC Delorean Reviews</h2>
      <ul>
        <li>"So fast its almost like traveling in time." (4/5)</li>
        <li>"Coolest ride on the road." (4/5)</li>
        <li>"I'm feeling McFly!" (5/5)</li>
        <li>"The most futuristic ride of our day." (4.5/5)</li>
        <li>"80's livin and I love it!" (5/5)</li>
      </ul>
    </section>
    <section id="add-ons">
      <h2>Delorean Upgrades</h2>
      <div class="flex">
        <a href="#" title="flux-capacitor">
          <figure>
            <div class="add-col">
              <img src="/phpmotors/images/vehicles/flux-cap.png" alt="Picture of a flux capacitor">
            </div>
            <figcaption>Flux Capacitor</figcaption>
          </figure>
        </a>
        <a href="#" title="flame decals">
          <figure>
            <div class="add-col">
              <img src="/phpmotors/images/vehicles/flame.jpg" alt="Picture of a flame decal">
            </div>
            <figcaption>Flame Decals</figcaption>
          </figure>
        </a>
      </div>
      <div class="flex">
        <a href="#" title="bumper stickers">
          <figure>
            <div class="add-col">
              <img src="/phpmotors/images/vehicles/bumper_sticker.jpg" alt="Picture of Bumper Stickers">
            </div>
            <figcaption>Bumper Stickers</figcaption>
          </figure>
        </a>
        <a href="#" title="hub caps">
          <figure>
            <div class="add-col">
              <img src="/phpmotors/images/vehicles/hub-cap.jpg" alt="Picture of Hub Caps">
            </div>
            <figcaption>Hub Caps</figcaption>
          </figure>
        </a>
    </div>
    </section>
  </div>
  </main>

    <hr>

    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
    </footer>
    

  </div>

</body>

</html>
      