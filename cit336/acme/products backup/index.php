<?php
/*
 *  Products Controller
 *  THIS IS THE PRODUCTS CONTROLLER
 */
// Get the database connection file
 require_once '../library/connections.php';
 // Get the acme model for use as needed
 require_once '../model/acme-model.php';
 //Get the products model for use as needed
 require_once '../model/products-model.php';
 
 // Get the array of categories
	$categories = getCategories();
    
 // Build a navigation bar using the $categories array
 $navList = '<ul id="primaryNav" class="hide">';
 $navList .= "<li><a href='index.php' title='View the Acme home page'>Home</a></li>";
 /* 
  *  This is a list item with a link that points to the controller in the acme folder, but this time it is followed by a question mark (e.g. ?) and then by a key - value pair. The key is action and the value is the category name inside of the $category variable. The $category['categoryName'] is inside of a PHP function - urlencode - which takes care of any spaces or other special characters so they are valid HTML. The whole piece is concatenated into the string as a whole. As with all previous code in this example, the string is being added to the $navList variable.
  */
 foreach ($categories as $category) 
 {
    $navList .= "<li><a href='/acme/index.php?action=".urlencode($category['categoryName'])."' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
 }
 $navList .= '</ul>';
 
 //Building a drop-down list of categories
 //$catList = '<select name="categories">';
 $catList = "";
 foreach ($categories as $category)
 {
   $catList .= "<option value=".urlencode($category['categoryID']).">".urlencode($category['categoryName'])."</option>";
 }
 
 //var_dump($catList);
 //echo $catList;
 //exit;
 
 $action = filter_input(INPUT_POST, 'action');
if ($action == NULL)
{ $action = filter_input(INPUT_GET, 'action');
  if ($action == NULL)
  { $action = 'home';
  }
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
    $categoryName = filter_input(INPUT_POST, 'categoryName');
       
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
      $navList = newNavigation($categories);
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
    $categoryID = filter_input(INPUT_POST, 'categoryID');
    $invName = filter_input(INPUT_POST, 'invName');
    $invDescription = filter_input(INPUT_POST, 'invDescription');
    $invImage = filter_input(INPUT_POST, 'invImage');
    $invThumbnail = filter_input(INPUT_POST, 'invThumbnail');
    $invPrice = filter_input(INPUT_POST, 'invPrice');
    $invStock = filter_input(INPUT_POST, 'invStock');
    $invSize = filter_input(INPUT_POST, 'invSize');
    $invWeight = filter_input(INPUT_POST, 'invWeight');
    $invLocation = filter_input(INPUT_POST, 'invLocation');
    $invVendor = filter_input(INPUT_POST, 'invVendor');
    $invStyle = filter_input(INPUT_POST, 'invStyle');
    
    //Test to see if any of the fields are empty
    if(empty($categoryID)||empty($invDescription)||empty($invImage)||empty($invThumbnail)||empty($invPrice)||empty($invStock)||empty($invSize)||empty($invWeight)||empty($invLocation)||empty($invVendor)||empty($invStyle))
    {
      $message = '<h3>All fields are required. Please fill in missing fields.</h3>';
      include '../view/new-product.php';
      exit; 
    }     
    //Call the function to enter the new product into the database           
    $prodOutcome = addProduct($categoryID, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invSize, $invStock, $invStyle, $invLocation, $invVendor, $invWeight);
          
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
  
  default:   //Return to the product-management page
    include '../view/product-management.php';
  break;
}

