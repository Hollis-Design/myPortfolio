<?php
/*
 *  Products Controller
 *  THIS IS THE PRODUCTS CONTROLLER
 */
//Create or access a session
session_start();


// Get the database connection file
 require_once '../library/connections.php';
 // Get the acme model for use as needed
 require_once '../model/acme-model.php';
 //Get the products model for use as needed
 require_once '../model/products-model.php';
 //Get the upload model for use as needed
 require_once '../model/uploads-model.php';
 //Get the general functions for use as needed
 require_once '../library/functions.php';
 
 // Get the array of categories
	$categories = getCategories();
  
  //Set the Path of home page
 // $path = "/acme/view/product-management.php";
    
  //call buildNavigation function to build the HTML for the navigation bar.
 // $navList = buildNavigation($categories, $path);  
  $navList = buildNavigation($categories);


 $action = filter_input(INPUT_POST, 'action');
if ($action == NULL)
{ $action = filter_input(INPUT_GET, 'action');
}

switch ($action)
{
  case 'newProduct':  //Add a new product link has been selected
    include '../view/new-product.php';
   break;
 
  case 'category':    //Add a new category link has been selected
    include '../view/new-category.php';
  break;

  case 'addCat':     //Information for the new category has been submitted
    $categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_STRING);
        
    //Test to see if any of the fields are empty
    if(empty($categoryName)){
      $message = '<h3>Please enter a new category name.</h3>';
      include '../view/new-category.php';
      exit; 
    }
    //Call the function to add the new category to the database    
    $catOutcome = addCategory($categoryName);      
    if ($catOutcome === 1)
    {
      $categories = getCategories();
      $navList = buildNavigation($categories); 
      include '../view/product-management.php';
      exit;
    }
    else
    {
      $message = "<p>Sorry, but $categoryName failed to be added. Please try again.</p>";
      include '../view/new-category.php';
      exit;
    }
  break;
  
  case 'addProduct':   //Information for the new product has been submitted
    $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
    $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
    $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
    $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_URL);
    $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_URL);
    $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $invPrice = checkPrice($invPrice);
    $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
    $invStock = checkInteger($invStock);
    $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);
    $invSize = checkInteger($invSize);
    $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_INT);
    $invWeight = checkInteger($invWeight);
    $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
    $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
    $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);
       
    //Test to see if any of the fields are empty
    if(empty($categoryId)||empty($invName)||empty($invDescription)||empty($invImage)||empty($invThumbnail)||empty($invPrice)||empty($invStock)||empty($invSize)||empty($invWeight)||empty($invLocation)||empty($invVendor)||empty($invStyle))
    {
      $message = '<h3>All fields are required. Please fill in missing fields.</h3>';
      include '../view/new-product.php';
      exit; 
    }     
    //Call the function to enter the new product into the database           
    $prodOutcome = addProduct($categoryId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invSize, $invStock, $invStyle, $invLocation, $invVendor, $invWeight);
          
    if ($prodOutcome === 1)
    {
      $message = "<p>Congratulations! $invName was successfully added.</p>";
      include '../view/new-product.php';
      exit;
    }
    else
    {
      $message = "<p>Sorry, but $invName failed to be added. Please try again.</p>";
      include '../view/new-product.php';
      exit;
    }
  break;
  
  case 'mod':
    $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $prodInfo = getProductInfo($invId);
    if (count($prodInfo) < 1){
      $message = 'Sorry, no product information could be found.';
    }
    include '../view/prod-update.php';
    exit;
  break;
  
  case 'updateProd':
    $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
    $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
    $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
    $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_URL);
    $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_URL);
    $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $invPrice = checkPrice($invPrice);
    $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
    $invStock = checkInteger($invStock);
    $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);
    $invSize = checkInteger($invSize);
    $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_INT);
    $invWeight = checkInteger($invWeight);
    $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
    $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
    $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);
    $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
       
    if(empty($categoryId)||empty($invName)||empty($invDescription)||empty($invImage)||empty($invThumbnail)||empty($invPrice)||empty($invStock)||empty($invSize)||empty($invWeight)||empty($invLocation)||empty($invVendor)||empty($invStyle))
    {
      $message = '<h3>Error. All fields are required!</h3>';
      include '../view/prod-update.php';
      exit; 
    }     
    //Call the function to enter the new product into the database           
    $updateResult = updateProduct($categoryId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invSize, $invStock, $invStyle, $invLocation, $invVendor, $invWeight, $invId);
          
    if ($updateResult)
    {
      $message = "<h3>Congratulations! $invName was successfully updated.</h3>";
      $_SESSION['message'] = $message;
      header('location: /acme/products');
      exit;
    }
    else
    {
      $message = "<h3>Error. $invName was not updated. Please try again.</h3>";
      include '../view/prod-update.php';
      exit;
    }
  break;
   
  case 'del':
    $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $prodInfo = getProductInfo($invId);
    if (count($prodInfo) < 1){
      $message = 'Sorry, no product information could be found.';
    }
    include '../view/prod-delete.php';
    exit;
  break;
  
  case 'feature':
    $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    //Get product information for past featured item
    $pastFeatured = getCurrentFeatured();
    if (!isset($pastFeatured['invId'])){
      $message = "<p class='notice'>No previous product was featured.<br>";
    }
    else {
      //Unset past featured item
      $success = unsetPastFeatured($pastFeatured['invId']);
    }
    //Set newly featured item
    setNewFeatured($invId);
    $currentFeatured = getCurrentFeatured();
    
    //if current feature was successfully set, print messages to that effect
    if (isset($currentFeatured)){
      if (!isset($message)){
        $message = "<p class='notice'>Previously featured item: $pastFeatured[invName] was cleared.<br>";
      }
        $message .= "New featured item: $currentFeatured[invName] was set.</p>";
      }
    else{
        $message .= "Not able to set new featured product. Please try again.</p>";
      }
      $_SESSION['message'] = $message;
      //include '../view/product-management.php?action=default';
      header('location: /acme/products');
  break;
  
  case 'deleteProd':
    $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
    $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
  
    //Call the function to enter the new product into the database           
    $deleteResult = deleteProduct($invId);
          
    if ($deleteResult)
    {
      $message = "<h3>Congratulations! $invName was successfully deleted.</h3>";
      $_SESSION['message'] = $message;
      header('location: /acme/products');
      exit;
    }
    else
    {
      $message = "<h3>Error. $invName was not deleted. Please try again.</h3>";
      $_SESSION['message'] = $message;
      header('location: /acme/products');
      exit;
    }  
  break;
  
  case 'categoryLinks':
    $categoryName = filter_input(INPUT_GET, 'categoryName', FILTER_SANITIZE_STRING);
    $products = getProductsByCategory($categoryName);
    if(!count($products)){
      $message = "<p class='notice'>Sorry, no $categoryName products could be found.</p>";
    } else {
      $prodDisplay = buildProductsDisplay($products);
    }
    
 //   echo $prodDisplay;
 //   exit;
    include '../view/category.php';
  break;
  
  case 'prodInfo':
    $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_STRING);
    $productInfo = getProductInfo($invId);
    if(!(isset($productInfo))){
      $message = "<p class='notice'>Sorry, no product information could be found.</p>";
    } else {
      // Build the detail page for the specific product
      $prodDisplay = buildProductInfoDisplay($productInfo);
      // Get any and all thumbnail images associated with the product and display them at the bottom of the page
      $thumbnailImages = getThumbnails($invId);
      if (isset($thumbnailImages)){
        $thumbnailDisplay = buildThumbnailDisplay($thumbnailImages);
    }}
    include '../view/product-information.php';
  break;
  
  case 'home':
    include '../view/product-management.php';
  break;

  default:   //Return to the product-management page 
    $products = getProductBasics();
    if (count($products) > 0)
    {
      $prodList = '<table>';
      $prodList .= '<thead>';
      $prodList .= '<tr><th>Product Name</th><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>';
      $prodList .= '<thead>';
      $prodList .= '<tbody>';
      foreach ($products as $product){
        $prodList .= "<tr><td>$product[invName]</td>";
        $prodList .= "<td><a href='/acme/products?action=mod&id=$product[invId]' title='Click to modify'>Modify</a></td>";
        $prodList .= "<td><a href='/acme/products?action=del&id=$product[invId]' title='Click to delete'>Delete</a></td>";
        $prodList .= "<td><a href='/acme/products?action=feature&id=$product[invId]' title='Click to feature'>Feature</a></td></tr>";
      }
      $prodList .= '</tbody></table>';
    }
    else {
      $message = '<p class="notice">Sorry, no products were returned.</p>';
    }
    include '../view/product-management.php';
  break;

}
    

