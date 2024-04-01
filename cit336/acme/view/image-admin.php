<?php
if (isset($_SESSION['message'])) {
 $message = $_SESSION['message'];
} 
?><!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Image Management</title>
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
      <h1>Image Management</h1>
        <p>Welcome to the Image Management Page. Please choose one of the options below:</p>
      <h2>Add New Product Image</h2>
        <?php
         if (isset($message)) {
          echo $message;
         } ?>

        <form action="/acme/uploads/" method="post" enctype="multipart/form-data">
          <label for="invItem">Product</label><br>
          <?php echo $prodSelect; ?><br><br>
          <label>Upload Image:</label><br>
          <input type="file" name="file1"><br>
          <input type="submit" class="submitBtn" value="Upload">
          <input type="hidden" name="action" value="upload">
        </form>
      <hr>
      <h2>Existing Images</h2>
        <p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
        <?php
         if (isset($imageDisplay)) {
          echo $imageDisplay;
         } ?>
     </main>

<!-- php reference in include the footer here -->

     <?php include$_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
     
    <script src="/acme/scripts/hamburger.js"></script>
    </body>
</html>
<?php 
if (isset($_SESSION['message'])){
  unset($_SESSION['message']);
}?>
