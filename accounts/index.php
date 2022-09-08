<?php
// This is the Accounts controller

// Create or access a Session
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the accounts model
 require_once '../model/accounts-model.php';
// Get the functions library
require_once '../library/functions.php';

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

 switch ($action){
  // case 'template':
  //   include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/template.php';
  
  // break; 
  // Code to deliver the views will be here

case 'register':
  // Filter and store the data
    $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstName', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $clientLastname = trim(filter_input(INPUT_POST, 'clientLastName', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
    $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $clientEmail = checkEmail($clientEmail);
    $checkPassword = checkPassword($clientPassword);

    $existingEmail = checkExistingEmail($clientEmail);

    // Check for existing email address in the table
    if($existingEmail){
     $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
     include '../view/login.php';
     exit;
    }
  
  // Check for missing data
  if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
    $message = '<p>Please provide information for all empty form fields.</p>';
    include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/register.php';
    exit;
  }
  
  // Hash the checked password
  $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

  // Send the data to the model
  $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);


  // // Check and report the result
  // if($regOutcome === 1){
  //   $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
  //   include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/login.php';
  //   exit;
  // Check and report the result
  // Check and report the result
// if ($regOutcome === 1) {
//   setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
//   $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
//   include '../view/login.php';
//   exit;

if ($regOutcome === 1) {
  setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
  $_SESSION['message'] = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
  header('Location: /phpmptors/accounts/?action=login');
  exit;
  } else {
    $message = '<p class="notice">Sorry $clientFirstName, but the registration failed. Please try again.</p>';
    include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/register.php';
    exit;
  }
  break;

  case 'login':
    include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/login.php';
  
  break; 
 
  case 'register':
    include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/register.php';
  
  break; 

  case 'Login':
    $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
    $clientEmail = checkEmail($clientEmail);
    $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $passwordCheck = checkPassword($clientPassword);

    // Run basic checks, return if errors
    if (empty($clientEmail) || empty($passwordCheck)) {
    $message = '<p class="notice">Please provide a valid email address and password.</p>';
    include '../view/login.php';
    exit;
    }
      
    // A valid password exists, proceed with the login process
    // Query the client data based on the email address
    $clientData = getClient($clientEmail);

    // Compare the password just submitted against
    // the hashed password for the matching client
    $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);

    // If the hashes don't match create an error
    // and return to the login view
    if(!$hashCheck) {
      $message = '<p class="notice">Please check your password and try again.</p>';
      include '../view/login.php';
      exit;
    }
    // A valid user exists, log them in
    $_SESSION['loggedin'] = TRUE;
    // Remove the password from the array
    // the array_pop function removes the last
    // element from an array
    array_pop($clientData);
    // Store the array into the session
    $_SESSION['clientData'] = $clientData;
    // Send them to the admin view
    include '../view/admin.php';
    exit;          
    break;

    case 'updateInfo':
      include '../view/client-update.php';
      break;


    case 'updatePersonal':
      // Get the data from the view.
      $clientFirstName = trim(filter_input(INPUT_POST, 'clientFirstName', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $clientLastName = trim(filter_input(INPUT_POST, 'clientLastName', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
      $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

      // Validate the new email.
      $clientEmail = checkEmail($clientEmail);

      //If email already exist, return client to update page.
      if ($clientEmail !== $_SESSION['clientData']['clientEmail']){
        $accountExists = checkExistingEmail($clientEmail);
        if ($accountExists) {
          $message = "Email already exist, please try a different one.";
          include '../view/client-update.php';
          exit;
        }
      }

      // Check that all the information is present.
      // echo $clientFirstName. "<br>";
      // echo $clientLastName. "<br>";
      // echo $clientEmail. "<br>";
      // echo $clientId. "<br>";
      // exit;

      if(empty($clientFirstName) || empty($clientLastName) || empty($clientEmail) || empty($clientId)){
          $message = '<p>Please provide information for all empty form fields.</p>';
          //$clientInfo = $_SESSION['clientData'];
          include '../view/client-update.php';
          exit;
      }

      // Update the information in the database.
      $resultPersonal = updatePersonal($clientFirstName, $clientLastName, $clientEmail, $clientId);

      // Query the client data based on the email address
      $clientData = getClientId($clientId);
      array_pop($clientData);
      // Store the array into the session
      $_SESSION['clientData'] = $clientData;
      
      // Check and report the result
      if($resultPersonal === 1){
        setcookie("firstname", $clientFirstname, strtotime("+ 1 year"), "/");
        $_SESSION['message'] = "<p class='working'>Account information updated successfully.</p>";

        // $clientData = getClientId($clientId);
        // array_pop($clientData);
        // // Store the array into the session
        // $_SESSION['clientData'] = $clientData;
        header('location: /phpmotors/accounts/');
          exit;
      } else {
          $message = "<p>Sorry, but information update failed. Please try again.</p>";
          header('location: /phpmotors/accounts/');
          exit;
      }
      break;

    case 'updatePassword':
      // Get the new password.
      $newPassword = filter_input(INPUT_POST, 'newPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

      // Validate the password
      $checkPassword = checkPassword($newPassword);

      // Check for missing data
      if(empty($checkPassword)){
          $message = '<p>Please provide information for all empty form fields.</p>';
          include '../view/client-update.php';
          exit; 
      }

      // Hash the checked password
      $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

      // Update the password.
      $resultPassword = updateNewPassword($hashedPassword, $clientId);

      // Check and report the result
      if($resultPassword === 1){
          $message = "<p class='working'>Password update was a success.</p>";
          $_SESSION['message'] = $message;
          header('location: /phpmotors/accounts/');
          exit;
      } else {
          $message = "<p>Sorry, but password update failed. Please try again.</p>";
          $_SESSION['message'] = $message;
          include '../view/client-update.php';
          exit;
      }
      break;
  
  case 'logout':
    session_destroy();
    unset($_SESSION);
    setcookie('PHPSESSID', '', strtotime('-1 hour'), '/');
    header('Location: /phpmotors/');
    break;

  default:
  include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/admin.php';
  break;
}