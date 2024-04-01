<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en-us">
    <head>
        <meta charset="utf-8"/>
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
            <link href="/acme/css/large.css" rel="stylesheet">   <!-- large/wide/desktop views -->
           <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>  
    </head>

    <body>
<!-- php reference to include the header -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>

   <nav>
      <button onclick="toggleNavMenu()">&#9776;</button>
<!-- php reference to include the navigation bar -->
<!-- php include $_SERVER['DOCUMENT_ROOT'] . '/Acme/common/nav.php'; ?> -->
      <?php echo $navList; ?>
    </nav>

<!-- main goes here -->
    <main>
      <h1>Welcome to Acme!</h1>
      <?php echo $featureDisplay; ?>
<!--      <div class="rocket_pic">
        <ul class = "get_it_now">
        <li><h2>Acme Rocket</h2></li>
        <li>Quick lighting fuse</li>
        <li>NHTSA approved seat belts</li>
        <li>Mobile launch stand included</li>
        <li><a href="/acme/cart/"><img id="actionbtn" alt="Add to cart button" src="/acme/images/site/iwantit.gif"></a></li>
        </ul>
      </div>
      
      <section class="mainInfo">
        <div class="gridItem">
          <h2>Acme Rocket Reviews</h2>
            <ul class="reviews">
              <li>"I don't know how I ever caught roadrunners before this." (4/5)</li>
              <li>"That thing was fast!" (4/5)</li>
              <li>"Talk about fast delivery." (5/5)</li>
              <li>"I didn't even have to pull the meat apart." (4.5/5)</li>
              <li>"I'm on my thirtieth one. I love these things!" (5/5)</li>
            </ul>
        </div>
        -->
        <article class="recipes">
          <h2>Featured Recipes</h2>
          <div class="menu">
            <div class="gridItem">
              <img src="/acme/images/recipes/bbqsand.jpg" alt="Pulled Roadrunner BBQ">
              <a href="home.php">Roadrunner BBQ</a>
            </div>
            <div class="gridItem">
              <img src="/acme/images/recipes/potpie.jpg" alt="Roadrunner Pot Pie">
              <a href="home.php">Roadrunner Pot Pie</a>
            </div>
            <div class="gridItem">
              <img src="/acme/images/recipes/soup.jpg" alt="Roadrunner Soup">
              <a href="home.php">Roadrunner Soup</a>
            </div>
            <div class="gridItem">
              <img src="/acme/images/recipes/taco.jpg" alt="Roadrunner Taco">
              <a href="home.php">Roadrunner Taco</a>
            </div>
          </div>
        </article>
     </main>

<!-- php reference in include the footer here -->

     <?php include$_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
     
    <script src="/acme/scripts/hamburger.js"></script>
    </body>
</html>
