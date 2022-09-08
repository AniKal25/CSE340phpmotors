<?php
// This is the Accounts controller

// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';


// Get the array of classifications
$classifications = getClassifications();
//var_dump($classifications);
	//exit;

// Build a navigation bar using the $classifications array
$navList = '<ul>';
$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
 $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .= '</ul>';

$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

 switch ($action) {
    default:
      include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/home.php';
      break;
  }



  $classificationList = "<select name='classificationId'><option value=''>Choose Car Classification</option>";
  foreach ($classifications as $classification) {
    $classificationList .= "<option value='$classification[classificationId]'";
    if (isset($classificationId)) {
      if ($classification['classificationId'] === $classificationId) {
        $classificationList .= '  selected ';
      }
    };
    $classificationList .= ">$classification[classificationName]</option>";
  }
  $classificationList .= "</select>";

  // $searchId = filter_input(INPUT_POST, 'searchId', FILTER_VALIDATE_INT);
	// $searchText = filter_input(INPUT_POST, 'searchText', FILTER_SANITIZE_SPECIAL_CHARS);
  // if(empty($searchId) || empty($searchText) ){
  //   $message = '<p>Please provide information for all empty form fields.</p>';
  //   include '../view/search-page.php.';
  //   exit;

// }

$sql = "SELECT invId, invYear, invMake, invModel, invDescription, invPrice, invMiles, invColor, classificationName FROM inventory as i join carClassification as c ON i.classificationId = c.classificationId WHERE CONCAT(invMake,invModel,invDescription,invColor) LIKE CONCAT('%', :qString, '%') ORDER BY invModel ASC";

// search-model.php
function getSearchResults($qString) {
  $db = phpmotorsConnect();
  $sql = "SELECT invId, invYear, invMake, invModel, invDescription, invPrice, invMiles, invColor, classificationName FROM inventory as i join carClassification as c ON i.classificationId = c.classificationId WHERE CONCAT(invMake,invModel,invDescription,invColor) LIKE CONCAT('%', :qString, '%') ORDER BY invModel ASC";
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':qString', $qString, PDO::PARAM_STR);
  $stmt->execute();
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $results;
}

//functions.php
// Build the individual search result display
function buildSearchResults($sResults)
{
  $sd = '<div class="resultsDisplay">';
  foreach ($sResults as $item) {
    $sd .= '<h2><a href="/phpmotors/vehicles/?action=vehicle&vid=' . $item['invId'] . '" title="View the ' . $item['invYear'] . ' ' . $item['invMake'] . ' ' . $item['invModel'] . '">' . $item['invYear'] . ' ' . $item['invMake'] . ' ' . $item['invModel'] . '</a></h2>';
    $sd .= '<p>' . $item['invDescription'] . '</p>';
  }
  $sd .= '</div>';
  return $sd;
}
//search-model.php
function addSearch($searchId){
  // //Create a connection object using the phpmotors connection function
   $db = phpmotorsConnect();
  //The SQL statement
  $sql = ' SELECT * FROM search WHERE searchId = :searchId)';
  // //$sql = ' SELECT * FROM search WHERE search (searchText, invId, searchId) VALUES (:searchText, :invId, :searchId)';
  //Create the prepared statement using the phpmotors connection
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':searchId', $searchId, PDO::PARAM_INT);
  //Insert the data
  $stmt->execute();
  //Ask how many rows changed as a result of our insert
  $rowsChanged = $stmt->rowCount();
  //Close the database interaction
  $stmt->closeCursor();
  //Return the indication of success (rows changed)
  return $rowsChanged;
   }
  
  //The function gets search for an inventory item.
  function getInventorySearch($invId){
      $db = phpmotorsConnect();
      $sql = 'SELECT r.searchId, r.searchText, r.invId, FROM search JOIN inventory ON search.invId = inventory.invId';
      $stmt = $db->prepare($sql);
      $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
      $stmt->execute();
      $searchList = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $stmt->closeCursor();
      return $searchList;
  }
  
  //The function gets a search from search id
  function getSearch($searchId){
      $db = phpmotorsConnect();
      $sql = 'SELECT r.searchId, r.searchText, r.invId, FROM search  JOIN inventory ON search.invId = inventory.invId';
      $stmt = $db->prepare($sql);
      $stmt->bindValue(':searchId', $searchId, PDO::PARAM_INT);
      $stmt->execute();
      $search = $stmt->fetch(PDO::FETCH_ASSOC);
      $stmt->closeCursor();
      return $search;
  }




// search-index.php
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
 if ($action == NULL){
  $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

echo $action;
switch ($action){


  case 'addSearch':
    // Get the input
    //$searchId = filter_input(INPUT_POST, 'searchId', FILTER_VALIDATE_INT);
    $searchText = filter_input(INPUT_POST, 'searchText', FILTER_SANITIZE_SPECIAL_CHARS);
    

    $addSearchReport = getSearchResults($searchText);
    // Check for missing data
    if(empty($searchText) ){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/search-page.php';
  
//Add the review to the database.


// // Check and report the result
// if($addSearchReport === 1){
//     $message = "<p>Found the following.</p>";
//     header('location: /phpmotors/search/');
//     exit;
// } else {
//     $message = "<p>Sorry, there was an error. Please try again.</p>";
//     header('location: /phpmotors/search/');
//     exit;
// }

   break; 
        }

  case 'returnSearch':
    $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $invInfo = getInvItemInfo($invId);

    if(empty($invInfo)) {
      $message = "<p>Sorry, no information on $invId could be found.</p>";
      include '../view/search-page.php';
  } else {
     
      $searchDisplay = buildSearchResults($searchId);
      
      include '../view/search-page.php';
  }
  break;

    break;
  
  

 default:
  // echo "default";
  $classificationList = buildClassificationList($classifications);
  include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/search-page.php';
  

} 


//search-index.php
 case 'returnSearch':
  $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $invInfo = getInvItemInfo($invId);

  if (empty($invInfo)) {
    $message = "<p>Sorry, no information on $invId could be found.</p>";
    include '../view/search-page.php';
  } else {

    $searchDisplay = buildSearchResults($searchId);

    include '../view/search-page.php';
  }
  break;

  break;
}


//DEFINE LIMIT for PER PAGE now 25 is page limit
$limit      = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 25;
	
//DEFAULT PAGE NUMBER if No page in url
  $page       = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;

//Number of frequency links to show at one time ; 
  $links      = ( isset( $_GET['links'] ) ) ? $_GET['links'] : 7;
 
 //your query here in query varriable
  $query  = "Select * from customers  ";

//create a paging class object with connection and query parameters
  $Paginator  = new Paginator( $conn, $query );

//get the results from paginator class
  $results    = $Paginator->getData( $limit, $page ); 





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

    // Pull initial results to see if any exist, before doing any other logic
    $searchResults = getSearchResults($searchText);
    $message = '<h3 class="notice">These results were found to match ' . $searchText . '.</h3>';
    
//    print_r($searchResults);
//    exit;
    if (count($searchResults) < 1) {
      $searchDisplay = '<h3 class="notice">Sorry, no results were found to match ' . $searchText . '.</h3>';
    } else if (count($searchResults) > 10) {
      
      // How many results per page
      $displayLimit = 10;
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
      $current_page = ($page-1) * $displayLimit;
      $limit = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 10;

      //$paginationBar = buildPaginationBar($totalPages, $page, $clientSearch); // You'll need to figure this one out
      // build the page based on the new paginationResults
      $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : $page = 1;
      for ($page=1; $page<=$totalPages;$page++) {
      echo '<a href="/phpmotors/search?addSearch=' . $page . '">' . $page . '</a>';
      }
//      $searchDisplay = buildSearch($paginationResults, count($searchResults));

      $searchDisplay = buildSearchResults($searchResults, count($searchResults)); // stub'd in for now, so it works
      
    } else {
      //$message = '<h3 class="notice">These results were found to match ' . $searchText . '.</h3>';
      $searchDisplay = buildSearchResults($searchResults, count($searchResults));
      

    include '../view/search-page.php';
    
    break;
    }

  default:
    // echo "default";
    $classificationList = buildClassificationList($classifications);
    include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/search-page.php';


} 
