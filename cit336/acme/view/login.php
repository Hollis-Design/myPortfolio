<!DOCTYPE html>

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
       <h2>Acme Login</h2> 
     <!--        <form action="thanks2.html" name="storm" id="weatherEvent">  -->
          <?php
            if (isset($_SESSION['message'])) {
             echo $_SESSION['message'];
            }
           ?>
          <form action="/acme/accounts/index.php" method="post">
             <fieldset>
               <legend><span>Account Information</span></legend>
                 <label><span>Email:</span><input name="clientEmail" type="email" placeholder="email address" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required></label>
                 <label><span>Password:</span><input name="clientPassword" type="password" placeholder="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"></label>
                  <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter, and 1 special character.</span>
             </fieldset>
              <input type="submit" value="Sign In" class="submitBtn">
              <input type="hidden" name="action" value="validateLogin">
              <h3>Not a Member?</h3>
              <a href='/acme/accounts/index.php?action=registration' class="accountBtn">Create An Account</a>
          </form>
      </main>
 <!-- php reference in include the footer here -->

      <?php include$_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>

     <script src="/acme/scripts/hamburger.js"></script>
  </body>
</html>
