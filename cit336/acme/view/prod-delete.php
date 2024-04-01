<?php

if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /acme/');
 exit;
}

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
        <title><?php if(isset($prodInfo['invName'])){ echo "Delete $prodInfo[invName] ";} ?> | Acme, Inc</title>
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
      <h1><?php if (isset($prodInfo['invName'])){echo "Delete $prodInfo[invName]";}?></h1>
       <h3>Confirm Product Deletion. The delete is permanent!</h3>
       
 <!-- See if there's an error message, if so, echo it to the screen --> 
<?php
//var_dump($prodInfo);
//var_dump($prodInfo[0]['invName']);
if (isset($message)) {
 echo $message;
}
?>
     <form method="post" action="/acme/products/index.php">
        <fieldset>
          <legend><span>Product Information</span></legend>

          <label><span>Product Name:</span><input name="invName" readonly type="text"<?php if(isset($invName)){echo "value='$invName'";} elseif(isset($prodInfo['invName'])) {echo "value='$prodInfo[invName]'"; }  ?>></label>

            <label><span>Product Description:</span><textarea name="invDescription" readonly rows="4" cols="50"><?php if(isset($invDescription)){echo "$invDescription";} elseif(isset($prodInfo['invDescription'])) {echo $prodInfo['invDescription']; }?></textarea></label>      

        </fieldset>
        <input type="submit" name="submit" value="Delete Product?" class="submitBtn">
        <input type="hidden" name="action" value="deleteProd">
        <input type="hidden" name="invId" value="<?php if(isset($prodInfo['invId'])){ echo $prodInfo['invId'];} ?>">
     </form>
    </main>
 <!-- php reference in include the footer here -->

      <?php include$_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>

     <script src="/acme/scripts/hamburger.js"></script>
  </body>
</html>
