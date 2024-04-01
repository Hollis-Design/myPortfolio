<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Acme</title>
        <meta name="author" content="Christy Hollis">
        <meta name="description" content="Acme Recipes">
        <!-- external style references in the proper cascading order -->
        <!-- Google API font reference -->
            <link href="https://fonts.googleapis.com/css?family=Chicle" rel="stylesheet">
            <link href="/acme/css/normalize.css" rel="stylesheet"> <!-- normalize useragent/browser defaults -->
            <link href="/acme/css/main.css" rel="stylesheet">    <!-- default styles - small/phone views -->
            <link href="/acme/css/medium.css" rel="stylesheet">  <!-- medium/tablet views -->
            <link href="/acme/css/large.css" rel="stylesheet">      <!-- large/wide/desktop views -->
           <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>  
    </head>
    <body>
<!-- php reference to include the header -->
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>

<!-- php reference to include the navigation bar -->
      <nav>
        <button onclick="toggleNavMenu()">&#9776;</button>
        <?php echo $navList; ?>
      </nav>

<!-- main goes here -->
      <main>
       <h2>Acme Registration</h2>
       <h4>All fields are required.</h4>
       
 <!-- See if there's an error message, if so, echo it to the screen --> 
<?php
if (isset($message)) {
 echo $message;
}
?>
     <form method="post" action="/acme/accounts/index.php">
             <fieldset>
               <legend><span>Account Information</span></legend>
                 <label><span>First Name:</span><input name="clientFirstname" type="text" pattern="[A-Za-z -._]{2,99}" title="Name must be 2 characters in length" placeholder="John" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?> required></label>
                 <label><span>Last Name:</span><input  name="clientLastname" type="text" pattern="[A-Za-z -._]{2,99}" title="Name must be 2 characters in length" placeholder="Doe" <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?> required></label>      
                 <label><span>Email:</span><input name="clientEmail" type="email" placeholder="email address" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required></label>
                 <label><span>Password:</span><input name="clientPassword" type="password" placeholder="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"></label>
                 <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter, and 1 special character.</span>
              </fieldset>
              <input type="submit" name="submit" value="Register" class="submitBtn">
              <input type="hidden" name="action" value="register">
         </form>
      </main>
 <!-- php reference in include the footer here -->

      <?php include$_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>

     <script src="/acme/scripts/hamburger.js"></script>
  </body>
</html>
