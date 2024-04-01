<?php
/*
 *  Accounts Controller
 *  THIS IS THE ACCOUNTS CONTROLLER
 */
//Create or access a session
session_start();

// Get the database connection file
 require_once '../library/connections.php';
 // Get the acme model for use as needed
 require_once '../model/acme-model.php';
 //Get the register accounts model
 require_once '../model/accounts-model.php';
 //Get the functions library
 require_once '../library/functions.php';
 
 // Get the array of categories
	$categories = getCategories();
   
//Set the Path of home page
  //$path = "/acme/index.php";
    
  //call buildNavigation function to build the HTML for the navigation bar.
  //$navList = buildNavigation($categories, $path);  
  $navList = buildNavigation($categories);
  
 $action = filter_input(INPUT_POST, 'action');
if ($action == NULL)
{ $action = filter_input(INPUT_GET, 'action');
}

switch ($action)
{
  case 'login':
    include '../view/login.php';
  break;

  case 'registration':
    include '../view/register.php';
   break;
 
  case 'register':
    $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
    $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
    $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
    $clientEmail = checkEmail($clientEmail);
    $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
    $checkPassword = checkPassword($clientPassword);
      
    //Check for duplicate email in database
    if (checkDuplicateEmail($clientEmail))
    {
      $message = '<p class="notice">Email address already exists. Would you like to login instead?</p>';
      include '../view/login.php';
      exit;
    }

    //Test to see if any of the fields are empty
    if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
      $message = '<p>Please provide information for all empty form fields.</p>';
      include '../view/register.php';
      exit; 
    }
       
    $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);   
    $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);
          
    if ($regOutcome === 1)
    {
      //Create a cookie with users first name
      setCookie('firstName', $clientFirstname, strtotime('+1 year'), '/');
      
      $_SESSION['message'] = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
      header('Location: /acme/accounts/?action=login');
      //include '../view/login.php';
      exit;  
    }
    else
    {
      $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
      include '../view/register.php';
      exit;
    }
  break;  
  
  case 'validateLogin':
    $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
    $clientEmail = checkEmail($clientEmail);
    $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
    $checkPassword = checkPassword($clientPassword);
          
    //Test to see if any of the fields are empty
    if(empty($clientEmail) || empty($checkPassword)){
      $message = '<p class="notice">Please provide information for all empty form fields.</p>';
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
      $_SESSION['message'] = '<p class="notice">Please check your password and try again.</p>';
      //$message = '<p class="notice">Please check your password and try again.</p>';
      include '../view/login.php';
      exit;
    }
    else
    {
      $_SESSION['message'] = '';
    }
    // A valid user exists, log them in
    $_SESSION['loggedin'] = TRUE;
    // Remove the password from the array
    // the array_pop function removes the last
    // element from an array
    array_pop($clientData);
    // Store the array into the session
    $_SESSION['clientData'] = $clientData;
    //Check if firstname cookie is set
    if (isset($_COOKIE['firstName'])){
    //Delte firstname cookie
      setCookie('firstName', '', strtotime('-1 year'), '/');
    }
    // Send them to the admin view
    include '../view/admin.php';
    exit;
  break;
  
  case 'logout':
    $_SESSION = array();
    session_destroy();
    //include '../view/home.php';
     header('location: /acme');
  break;

  case 'clientUpdate':
    include '../view/client-update.php';
  break;

  case 'changePwd':
    $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
    $checkPassword = checkPassword($clientPassword);
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
     if(empty($checkPassword) || empty($clientId)){
      $message = '<p>Password does not meet requirements or ClientId not valid.</p>';
      include '../view/client-update.php';
      exit; 
    }
   
    // A valid password exists, proceed with the update process
    // Query the client data based on the email address
    $clientData = getClientInfo($clientId);
    // Compare the password just submitted against
    // the hashed password for the matching client
    $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
    // If the hashes don't match create an error
    // and return to the login view
    if($hashCheck) {
      $message = '<p class="notice">Your password failed to update.</p>';
      $_SESSION['message'] = $message;
      include '../view/admin.php';
      exit;
    }
   
    $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);   
    $regOutcome = updateClientPwd($hashedPassword, $clientId);
    if ($regOutcome)
    {
      $message = "<p class='notice'>Congratulations, your password has been successfully updated.</p>";
    }
    else
    {
      $message = "<p class='notice'>Sorry, but your password failed to update. Please try again.</p>";
    }
    $_SESSION['message'] = $message;
    include '../view/admin.php';
 break;
  
  case 'updateAccount':
    $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
    $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
    $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
    $clientEmail = checkEmail($clientEmail);
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
   // $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
   // $checkPassword = checkPassword($clientPassword);
       
    //Check if email has been changed and  duplicate email in database
    if (isset($_SESSION['clientData'])){
      if ($clientEmail != $_SESSION['clientData']['clientEmail']){
        if (checkDuplicateEmail($clientEmail)){
          $message = '<p class="notice">Email address already exists.</p>';
          //$_SESSION['message'] = $message;
          include '../view/client-update.php';
          exit;
        }
      }
    }
    //Check if any of the fields are empty.
    if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)){
      $message = '<p>Please provide information for all empty form fields.</p>';
      include '../view/client-update.php';
      exit; 
    }
    //Update the database
    $updateResult = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);
    if ($updateResult)
    {
      $message = "<p class='notice'>Congratulations! ".$clientFirsname." was successfully updated.</p>";
    //  $message = "<p class=>Congratulations! $clientFirstname was successfully updated.</h3>";
    //  $_SESSION['message'] = $message;
    }
    else
    {
      $message = "<p class='notice'>Error. ".$clientFirstname." was not updated.</p>";
    }
    
    $_SESSION['message'] = $message;
    $clientData = getClientInfo($clientId);
    $_SESSION['clientData'] = $clientData;
    $_SESSION['loggedin'] = TRUE;
    include '../view/admin.php';
  break;
  
  case 'loggedIn':
    if ($_SESSION['loggedin'] == TRUE){
      include '../view/admin.php';
    }
    else {
      include '../view/home.php';
    }
  break; 
  
  case 'home':
    include '../view/home.php';
   break;
 
  default:
    include '../view/admin.php';
   break;
}

