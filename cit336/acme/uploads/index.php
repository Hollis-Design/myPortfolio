<?php

/* 
 * This is the IMAGE UPLOADS CONTROLLER
*/
session_start();

/* Library of functions this index file will require  */
require_once '../library/connections.php';
require_once '../model/acme-model.php';
require_once '../model/products-model.php';
require_once '../model/uploads-model.php';
require_once '../library/functions.php';

$categories = getCategories();
  
  //Set the Path of home page
 // $path = "/acme/view/product-management.php";
    
  //call buildNavigation function to build the HTML for the navigation bar.
 // $navList = buildNavigation($categories, $path);  
$navList = buildNavigation($categories);


/* Collect the "action" value from the "post" or "get" options of the "request" from the browser */
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
 $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

/* Build the navigation list */
//$navList = buildNav;

/* * ****************************************************
* Variables for use with the Image Upload Functionality
 * $image_dir is the folder where the images will be stored
 * $image_dir_path is the path to the folder where the images are stored
* **************************************************** */
// directory name where uploaded images are stored
$image_dir = '/acme/images/products';
// The path is the full path from the server root
$image_dir_path = $_SERVER['DOCUMENT_ROOT'] . $image_dir;

switch ($action){
  case 'upload':
    // Store the incoming product id
    $invId = filter_input(INPUT_POST, 'invId', FILTER_VALIDATE_INT);
    // Store the name of the uploaded image
    $imgName = $_FILES['file1']['name'];
    
    $imageCheck = checkExistingImage($imgName);
    
    if ($imageCheck){
      $message = '<p class="notice">An image by that name already exists.</p>';
    } elseif (empty($invId) || empty($imgName)){
      $message = '<p class="notice">You must select a product and image file for the product.</p>';
    } else {
        // Upload the image, store the returned path to the file
        $imgPath = uploadFile('file1');
      
        //Insert the image information to the database, get the result
        $result = storeImages($imgPath, $invId, $imgName);
      
        // Set a message based on the insert result
        if ($result) {
        $message = '<p class="notice">The upload succeeded.</p>';
        } else {
          $message = '<p class="notice">Sorry, the upload failed.</p>';
        }
      }
      
      // Store message to session
      $_SESSION['message'] = $message;
      
      // Redirect to this controller for default action
      header('location: .');
  break;
  case 'delete':
    // Get the image name and id
    $filename = filter_input(INPUT_GET, 'filename', FILTER_SANITIZE_STRING);
    $imgId = filter_input(INPUT_GET, 'imgId', FILTER_VALIDATE_INT);
    
    //Build the full path to the image to be deleted, using $image_dir_path, set before switch statement
    $target = $image_dir_path . '/' . $filename;
    
    //Check the file exists in that location
    if (file_exists($target)){
      //Deletes the file in the folder
      $result = unlink($target);
    }
    
    //Remove from database only if physical file deleted
    if ($result) {
      $remove = deleteImage($imgId);
    }

    if ($remove){
      $message = "<p class='notice'>$filename was successsfully deleted.</p>";
    } 
    else {
      $message = "<p class='notice'>$filename was NOT deleted.</p>";
    }
    
    //Store message to session
    $_SESSION['message'] = $message;
    
    //Redirect to this controller for default action
    header('location: .');
  break;
  default:
    //Call a function to return image info from the database
    $imageArray = getImages();
    
    //Build the image information into HTML for display
    if (count($imageArray)){
      $imageDisplay = buildImageDisplay($imageArray);
    }
    else {
      $imageDisplay = '<p class="notice">Sorry, no images could be found.</p>';
    }
    
    //Get inventory information (a list of products) from the database
    $products = getProductBasics();
    //Build a select list of product information for the view
    $prodSelect = buildProductsSelect($products);
    include '../view/image-admin.php';
  break;
}