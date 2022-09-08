<?php
// This is the Search controller

// Create or access a Session
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';
// Get the search model
require_once '../model/search-model.php';
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

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ($action == NULL) {
  $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

switch ($action) {
  // This is the only case statement you need, besides the default statement
  // Your search-page.php should show your results
  case 'addSearch':
    // allow $clientSearch to be pulled from the initial form POST and also the pagination links (through GET)
    $searchText = trim(filter_input(INPUT_POST, 'search', FILTER_SANITIZE_STRING)) ?: trim(filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING));
    if (empty($searchText)) {
      $message('<p class="notice">You must provide a search string.</p>');
      include '../view/search-page.php';
      exit;
    }

    // $page should come through as part of the pagination links
    $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT);
    if (empty($page)) {
      $page = 1;
    }

    $displayLimit = 10;
      $row = 0;

    // Pull initial results to see if any exist, before doing any other logic
    $searchResults = getSearchResults($searchText, $row, $displayLimit);
    $countRows = returnSearch($searchText);
    $message = '<h3 class="notice">These results were found to match ' . $searchText . '.</h3>';
    
//    print_r($searchResults);
//    exit;
    if (count($searchResults) < 1) {
      $searchDisplay = '<h3 class="notice">Sorry, no results were found to match ' . $searchText . '.</h3>';
    } else if (count($searchResults) > 10) {
      
      // How many results per page
      $displayLimit = 10;
      $row = 0;
      // How many pages will we have?
      $totalPages = ceil(count($searchResults) / $displayLimit);
      // Re-run the above query, but use the LIMIT feature of MySQL based on the $page and $displayLimit
      // Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
     

      if (!isset($_GET['page'])) {
        $page = 1;
      } else {
        $page = $_GET['page'];
      }
    //$paginatedResults = getPaginatedResults($clientSearch); // You'll need to figure this one out
      // Build the pagination bar at the bottom of the search page
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
      }

      $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : $page = 1;
      for ($page=1; $page<=$totalPages;$page++) {
      echo '<a href="/phpmotors/search?addSearch=' . $page . '">' . $page . '</a>';
      }

      $paginationBar = returnSearch($totalPages, $row, $displayLimit);
//      $searchDisplay = buildSearch($paginationResults, count($searchResults));

      $searchDisplay = buildSearchResults($searchResults, count($searchResults)); // stub'd in for now, so it works
      
    } else {
      //$message = '<h3 class="notice">These results were found to match ' . $searchText . '.</h3>';
      $searchDisplay = buildSearchResults($searchResults, count($searchResults));
      

    include '../view/search-result.php';
    
    break;
    }

  default:
    // echo "default";
    $classificationList = buildClassificationList($classifications);
    include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/search-page.php';


} 
