<?php

/* 
 * Products Model
 */

function addCategory($categoryName)
{
  //Create a connection object from acme connection function
  $db = acmeConnect();
  // The SQL staement (query) to be used with the database (ascending order)
  $sql = 'INSERT INTO categories (categoryName) VALUES (:categoryName)';
  
  /*The next line creates the prepared statement using the acme connection
   * (calls the prepare function inside the db object) 
  // Returns an instance of the connection object, prepared for execution
   */
  echo $sql;
  echo $categoryName;
  $stmt = $db->prepare($sql);
  //Replace placeholders with actual data
  $stmt->bindValue(':categoryName', $categoryName, PDO::PARAM_STR);
  
  //Execute the database request
  $stmt->execute();
  //Ask how many rows changed as a result of our insert
  $rowsChanged = $stmt->rowCount();
  //Close the database interaction
  $stmt->closeCursor();
  //Return indicator of success:
  return $rowsChanged;
}

function addProduct($categoryId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invSize, $invStock, $invStyle, $invLocation, $invVendor, $invWeight)
{
  $db = acmeConnect();
  
  $sql = 'INSERT INTO inventory (invName, invDescription, invImage, invThumbnail, invPrice, invSize, invStock, invStyle, invLocation, invVendor, invWeight, categoryId) VALUES (:invName, :invDescription, :invImage, :invThumbnail, :invPrice, :invSize, :invStock, :invStyle, :invLocation, :invVendor, :invWeight, :categoryId)';
  
  $stmt = $db->prepare($sql);
  
  $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
  $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
  $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
  $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
  $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
  $stmt->bindValue(':invSize', $invSize, PDO::PARAM_STR);
  $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
  $stmt->bindValue(':invStyle', $invStyle, PDO::PARAM_STR);
  $stmt->bindValue(':invLocation', $invLocation, PDO::PARAM_STR);
  $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_STR);
  $stmt->bindValue(':invVendor', $invVendor, PDO::PARAM_STR);
  $stmt->bindValue(':invWeight', $invWeight, PDO::PARAM_STR);
  
  $stmt->execute();
  
  $rowsChanged = $stmt->rowCount();
  
  $stmt->closeCursor();
  
  return $rowsChanged;
}

function newNavigation($categories)
{  
 // Build a navigation bar using the $categories array
 $navList = '<ul id="primaryNav" class="hide">';
 $navList .= "<li><a href='../index.php' title='View the Products Management home page'>Home</a></li>";
 /* 
  *  This is a list item with a link that points to the controller in the acme folder, but this time it is followed by a question mark (e.g. ?) and then by a key - value pair. The key is action and the value is the category name inside of the $category variable. The $category['categoryName'] is inside of a PHP function - urlencode - which takes care of any spaces or other special characters so they are valid HTML. The whole piece is concatenated into the string as a whole. As with all previous code in this example, the string is being added to the $navList variable.
  */
 foreach ($categories as $category) 
 {
    $navList .= "<li><a href='/acme/index.php?action=".urlencode($category['categoryName'])."' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
 }
 $navList .= '</ul>';

 return $navList;
}

function getProductBasics()
{
  $db = acmeConnect();
  $sql = 'SELECT invName, invId FROM inventory ORDER BY invName ASC';
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $products;
}

function getProductInfo($invId)
{
  $db = acmeConnect();
  $sql = 'SELECT * FROM inventory WHERE invId = :invId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->execute();
  $product = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $product;
}

function updateProduct($categoryId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invSize, $invStock, $invStyle, $invLocation, $invVendor, $invWeight, $invId)
{
  $db = acmeConnect();
  
  $sql = 'UPDATE inventory SET invName = :invName, invDescription = :invDescription, invImage = :invImage, invThumbnail = :invThumbnail, invPrice = :invPrice, invSize = :invSize, invStock = :invStock, invStyle = :invStyle, invLocation = :invLocation, invVendor = :invVendor, invWeight = :invWeight, categoryId = :categoryId WHERE invId = :invId';
  
  $stmt = $db->prepare($sql);
  
  $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
  $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
  $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
  $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
  $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
  $stmt->bindValue(':invSize', $invSize, PDO::PARAM_STR);
  $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
  $stmt->bindValue(':invStyle', $invStyle, PDO::PARAM_STR);
  $stmt->bindValue(':invLocation', $invLocation, PDO::PARAM_STR);
  $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_STR);
  $stmt->bindValue(':invVendor', $invVendor, PDO::PARAM_STR);
  $stmt->bindValue(':invWeight', $invWeight, PDO::PARAM_STR);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  
  $stmt->execute();
  
  $rowsChanged = $stmt->rowCount();
  
  $stmt->closeCursor();
  
  return $rowsChanged;
}

// Deletes a product from the database
function deleteProduct($invId)
{
  $db = acmeConnect();
  
  $sql = 'DELETE FROM inventory WHERE invId = :invId';
  
  $stmt = $db->prepare($sql);
  
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  
  $stmt->execute();
  
  $rowsChanged = $stmt->rowCount();
  
  $stmt->closeCursor();
  
  return $rowsChanged;
}

//Get an inventory list based on the categoryName
function getProductsByCategory($categoryName)
{ 
 $db = acmeConnect();
 $sql = 'SELECT * FROM inventory WHERE categoryId IN (SELECT categoryId FROM categories WHERE categoryName = :categoryName)';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':categoryName', $categoryName, PDO::PARAM_STR);
 $stmt->execute();
 $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $products;  
}

function getCurrentFeatured(){

  $db = acmeConnect();
  $sql = 'SELECT * FROM inventory WHERE invFeatured = 1';
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $pastFeatured = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $pastFeatured;
}

function unsetPastFeatured($invId){
  $db = acmeConnect();
  $sql = 'UPDATE inventory SET invFeatured = NULL WHERE invId = :invId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->execute();    
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}

function setNewFeatured($invId){
  $db = acmeConnect();
  $sql = 'UPDATE inventory SET invFeatured = TRUE WHERE invId = :invId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}

