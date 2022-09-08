<?php
// This is the main controller

// Create or access a Session
session_start();

// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/vehicle-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';



// Get the array of classifications
$classifications = getClassifications();
//var_dump($classifications);
	//exit;


// Build a navigation bar using the $classifications array
$navList = navigationBar($classifications);
// $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
// foreach ($classifications as $classification) {
//  $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
// }
// $navList .= '</ul>';

$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

 // Check if the firstname cookie exists, get its value
if(isset($_COOKIE['firstname'])){
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   }

 switch ($action) {
    case 'register':
        include '/phpmotors/view/register.php';

    break;

    case 'login':
        include '/phpmotors/view/login.php';

    break;

    case 'vehicles-management':
        include '/phpmotors/vehicles/index.php';

    break;

    default:
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/home.php';
        break;
}

