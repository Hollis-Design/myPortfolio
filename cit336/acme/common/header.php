<header>
  <div class="headerItems">
    <figure class="icon"><a href='/acme/index.php?action=home'>
      <picture>
         <source srcset="/acme/images/site/logo_small.jpg" media="(max-width: 37.5em)">
         <source srcset="/acme/images/site/logo_med.jpg" media="(max-width: 64em)">
         <source srcset="/acme/images/site/logo_med.jpg">
         <img src="/acme/images/site/logo.gif" alt="Acme Logo">
      </picture> </a>      
     </figure>
    
       <div class="folder">
         <?php 
         if (isset($cookieFirstName))
          {
            echo "<span>Welcome $cookieFirstName</span>";
          } 
          if (isset($_SESSION['loggedin']))
          { 
           // echo "<span>Welcome {$_SESSION['clientData']['clientFirstname']}</span>";
             echo "<a href='/acme/accounts/index.php?action=loggedIn'><span>Welcome {$_SESSION['clientData']['clientFirstname']}</span></a>";
             echo "<span>|</span>";
             echo "<a href='/acme/accounts/index.php?action=logout'>Logout</a>";
           // echo "<a href='/acme/accounts/index.php?action=logout'><img src='/acme/images/site/account_resize.gif' alt='Picture of Account Folder'>_Logout</a>";
          }
          else
          {
            echo "<a href='/acme/accounts/index.php?action=login'><img src='/acme/images/site/account_resize.gif' alt='Picture of Account Folder'>_My Account</a>";
          }        
        ?>
      </div>
  </div>
                  
</header>