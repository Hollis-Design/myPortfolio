<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /acme/');
 exit;
}
 
if (isset($_SESSION['message'])){
   $message = $_SESSION['message'];
 }
?>
<!DOCTYPE html>
<!--
This is the product management view.
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
    <main>
      <h1>Product Management</h1>
      <h2>Welcome to the product management page. Please choose an option below.</h2> 
      <ul class='prodMgmt'>
        <li><a href='/acme/products/index.php?action=category'>Add a New Category</a></li>
        <li><a href='/acme/products/index.php?action=newProduct'>Add a New Product</a></li>
      </ul>
      <?php
      
      if (isset($message)){
        echo $message;
      }
      if (isset($prodList)){
        echo $prodList;
      }
      //  echo "<p class='notice'>Does this stupid echo function work at all?</p>"?>
    
     </main>

<!-- php reference in include the footer here -->

     <?php include$_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
     
      <script src="/acme/scripts/hamburger.js"></script>
    </body>
</html>
<?php unset($_SESSION['message']);  ?>
