<img class="logo" src="/phpmotors/images/vehicles/logo.png" alt="PHP Logo">
<div class="myaccount">
<?php if(isset($_SESSION['loggedin'])){
 echo "<a href = '/phpmotors//accounts/index.php/?action=none'>Welcome ".$_SESSION['clientData']['clientFirstname']."</a> |";
} 
if (isset($_SESSION['loggedin'])) {
    ?>
    <a href="/phpmotors/accounts/index.php?action=logout">Log Out</a>
    <!-- <a href="/phpmotors/view/search-page.php?action=search"><button onclick="toggleMenu()">&#x1F50D;</button></a> -->
    <?php
}
else {
?>
<a href="/phpmotors/accounts/index.php?action=login">My Account</a>
<a href="/phpmotors/view/search-page.php?action=search">&#x1F50D;</a>
<?php }?>
</div>
