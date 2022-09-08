<?php

/*
* This is the Search Model
*/
//Get the searched vehicles to display

function getSearchResults($searchText, $row, $displayLimit) {
    $db = phpmotorsConnect();
    $sql = "SELECT invId, invYear, invMake, invModel, invDescription, invPrice, invMiles, invColor, classificationName 
    FROM inventory as i join carclassification as c ON i.classificationId = c.classificationId 
    WHERE CONCAT(invMake,invModel,invDescription,invColor) LIKE CONCAT('%', :qString, '%') ORDER BY invModel ASC LIMIT $row," . $displayLimit;
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':qString', $searchText, PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $results;
  }

  //The function gets a search and limits the number of vehicles displayed
  function returnSearch($qString){
    $db = phpmotorsConnect();
    $sql = "SELECT (invId) FROM inventory WHERE CONCAT(invMake,invModel,invDescription,invColor) LIKE CONCAT('%', :qString, '%') LIMIT 10 OFFSET 5"; 
    //$sql = 'SELECT * FROM inventory LIMIT 0, 10'; 
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':qString', $qString, PDO::PARAM_INT);
    $stmt->execute();
    $search = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $search;
}
?> 



 