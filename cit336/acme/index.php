<?php
/*
 *  Acme Controller
 */
//Create or access a session
session_start();

// Get the database connection file
 require_once 'library/connections.php';
 // Get the acme model for use as needed
 require_once 'model/acme-model.php';
 //Get the general functions for use as needed
 require_once 'library/functions.php';
 //Get the products model for featured product
 require_once 'model/products-model.php';
 
 // Get the array of categories
	$categories = getCategories();
  
//Set the Path of home page
 // $path = "/acme/index.php";
    
  //call buildNavigation function to build the HTML for the navigation bar.
 // $navList = buildNavigation($categories, $path);  
  $navList = buildNavigation($categories);
  
  if (isset($_COOKIE['firstName']))
  {
    $cookieFirstName = filter_input(INPUT_COOKIE, 'firstName', FILTER_SANITIZE_STRING);
  }


 $action = filter_input(INPUT_POST, 'action');
if ($action == NULL)
{ $action = filter_input(INPUT_GET, 'action');
  if ($action == NULL)
  { $action = 'home';
  }
}

switch ($action)
{
  case 'home':
    $featured = getCurrentFeatured();
    $featureDisplay = buildFeaturedDisplay($featured);
    include 'view/home.php';
  break;

  default:
    $featured = getCurrentFeatured();
    $featureDisplay = buildFeaturedDisplay($featured);
    include 'view/home.php';
  break;
}

