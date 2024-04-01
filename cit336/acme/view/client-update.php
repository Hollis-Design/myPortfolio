<?php
if ($_SESSION['loggedin'] != TRUE) {
 header('location: /acme/accounts');
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
      <h1>Update Account</h1>
      <p class='login'>Use this form to update your name or email information.</p>
      <?php if (isset($message)){
        echo $message;
      }
      ?>
      
      <form method="post" action="/acme/accounts/index.php">
        <fieldset>
    <!--      <legend><span>Product I</span></legend>  -->
            <label><span>First Name:</span><input name="clientFirstname" required type="text" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} elseif(isset($_SESSION['clientData']['clientFirstname'])) {echo "value=".$_SESSION['clientData']['clientFirstname']; }  ?>></label>

            <label><span>Last Name:</span><input name="clientLastname" required type="text" <?php if(isset($clientLastname)){echo "value='$clientLastname'";} elseif(isset($_SESSION['clientData']['clientLastname'])) {echo "value=".$_SESSION['clientData']['clientLastname']; }  ?>></label>

            <label><span>Email Address:</span><input name="clientEmail" required type="text" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} elseif(isset($_SESSION['clientData']['clientEmail'])) {echo "value=".$_SESSION['clientData']['clientEmail']; }  ?>></label> 

              <input type="submit" name="submit" value="Update Account" class="submitBtn">
              <input type="hidden" name="action" value="updateAccount">
              <input type="hidden" name="clientId" value="<?php if(isset($_SESSION['clientData']['clientId'])){ echo $_SESSION['clientData']['clientId'];} elseif(isset($clientId)) {echo $clientId;} ?>">
        </fieldset>
      </form>
      
      <h2 class='pwd'>Password Change</h2>
      <p class='login'>Use this form to change your password.</p>
      <?php if (isset($message)){
        echo $message;
      }
      ?>
      
 <form method="post" action="/acme/accounts/index.php">
      <fieldset>
          <label><span>New Password:</span><input name="clientPassword" type="password" placeholder="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"></label>
                 <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter, and 1 special character.</span>
              <input type="submit" name="submit" value="Change Password" class="submitBtn">
              <input type="hidden" name="action" value="changePwd">
              <input type="hidden" name="clientId" value="<?php if(isset($_SESSION['clientData']['clientId'])){ echo $_SESSION['clientData']['clientId'];} elseif(isset($clientId)) {echo $clientId;} ?>">
        </fieldset>
      </form>
      
     </main>

<!-- php reference in include the footer here -->

     <?php include$_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
     
    <script src="/acme/scripts/hamburger.js"></script>
    </body>
</html>
