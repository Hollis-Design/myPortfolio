<?php

if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /acme/');
 exit;
}

 $catList = '<select name="categoryId">';
 $catList .= "<option>Choose A Category</option>";
 foreach ($categories as $category) {
   $catList .= "<option value='$category[categoryId]'";
   if(isset($categoryId)){
     if($category['categoryId'] === $categoryId){
       $catList .= ' selected ';
     }
   }
   elseif(isset($prodInfo['categoryId'])){
     if($category['categoryId'] === $prodInfo['categoryId']){
       $catList .= 'selected';
     }
   }
   $catList .= ">$category[categoryName]</option>";
 }
 $catList .= '</select>';
 ?>
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
       <h1>Add Product</h1>
       <h3>Add a new product below. All fields are required!</h3>
       
 <!-- See if there's an error message, if so, echo it to the screen --> 
<?php
if (isset($message)) {
 echo $message;
}
?>
     <form method="post" action="/acme/products/index.php">
             <fieldset>
               <legend><span>Product Information</span></legend>
               <label><span>Category:</span>
                 <?php echo $catList; ?> 
               </label>
                 <label><span>Product Name:</span><input name="invName" required type="text"<?php if(isset($invName)){echo "value='$invName'";}  ?>></label>
                 <label><span>Product Description:</span><textarea name="invDescription" required rows="4" cols="50"><?php if(isset($invDescription)){echo "$invDescription";}?></textarea></label>      
                 <label><span>Product Image (path to image):</span><input name="invImage" type="text" pattern="[A-Za-z-._/\]{1,50}" placeholder="/acme/images/no-image.png" <?php if(isset($invImage)){echo "value='$invImage'";}  ?> required></label>
                 <label><span>Product Thumbnail (path to thumbnail):</span><input name="invThumbnail" type="text" pattern="[A-Za-z-._/\]{1,50}" placeholder="/acme/images/no-image.png" <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";}  ?> required></label>
                 <label><span>Product Price:</span><input name="invPrice" type="text" pattern="[0-9]{0,7}[.][0-9]{0,2}" <?php if(isset($invPrice)){echo "value='$invPrice'";}  ?> required></label>
                 <label><span># in Stock:</span><input name="invStock" type="number" <?php if(isset($invStock)){echo "value='$invStock'";}  ?> required></label>
                 <label><span>Shipping Size (W x H x L in inches):</span><input name="invSize" type="number" <?php if(isset($invSize)){echo "value='$invSize'";}  ?> required></label>
                 <label><span>Weight (lbs.):</span><input name="invWeight" type="number" <?php if(isset($invWeight)){echo "value='$invWeight'";}  ?> required></label>
                 <label><span>Location (city name):</span><input name="invLocation" type="text" <?php if(isset($invLocation)){echo "value='$invLocation'";}  ?> required></label>
                 <label><span>Vendor Name:</span><input name="invVendor" type="text" <?php if(isset($invVendor)){echo "value='$invVendor'";}  ?> required></label>
                 <label><span>Primary Material:</span><input name="invStyle" type="text" <?php if(isset($invStyle)){echo "value='$invStyle'";}  ?> required></label>
              </fieldset>
              <input type="submit" name="submit" value="Add Product" class="submitBtn">
              <input type="hidden" name="action" value="addProduct">
         </form>
      </main>
 <!-- php reference in include the footer here -->

      <?php include$_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>

     <script src="/acme/scripts/hamburger.js"></script>
  </body>
</html>
