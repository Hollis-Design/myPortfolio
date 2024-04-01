<?php
  if (!$_SESSION['loggedin']) {
   header('Location: /acme/accounts/?action=login'); 
  } 
  ?><!DOCTYPE html>

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
            <link href="/acme/css/large.css" rel="stylesheet">  <!-- large/wide/desktop views -->
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
<!--Array ( [clientId] => 14 [clientFirstname] => Bill [clientLastname] => Hickock [clientEmail] => wildbill@ok.com [clientLevel] => 1 [clientPassword] => $2y$10$BhuiPAAubX... ) -->

    <main>
      <p class='login'>You are logged in.</p>
      <?php 
     
      if (isset($_SESSION['message'])){
        echo $_SESSION['message'];
      }
      
      echo "<h1 class='client'>{$_SESSION['clientData']['clientFirstname']} {$_SESSION['clientData']['clientLastname']}</h1>";
     
      echo "<ul class='user'>"; 
      echo "<li>First Name: {$_SESSION['clientData']['clientFirstname']}";
      echo "<li>Last Name: {$_SESSION['clientData']['clientLastname']}";
      echo "<li>Email Address: {$_SESSION['clientData']['clientEmail']}";
      echo "</ul>";
      echo "<p><a href='/acme/accounts/index.php?action=clientUpdate'>Update Account Information</a></p>";
      if ($_SESSION['clientData']['clientLevel'] > 1){
        echo "<h2 class='admin'>Administrative Functions</h2>";
        echo "<p class='login'>Use the link below to manage products.</p>";
        echo "<p><a href ='/acme/products/index.php'>Products Page</a></p>";
      }
      ?>
      
    </main>

<!-- php reference in include the footer here -->

     <?php include$_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
     
    <script src="/acme/scripts/hamburger.js"></script>
    </body>
</html>
