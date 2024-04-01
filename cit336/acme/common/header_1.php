<header>
  <div class="headerItems">
    <figure class="icon"><a href='/acme/accounts/index.php?action=home'>
      <picture>
         <source srcset="/acme/images/site/logo_small.jpg" media="(max-width: 37.5em)">
         <source srcset="/acme/images/site/logo_med.jpg" media="(max-width: 64em)">
         <source srcset="/acme/images/site/logo_med.jpg">
         <img src="/acme/images/site/logo.gif" alt="Acme Logo">
      </picture> </a>      
     </figure>
    
       <div class="folder">
         <?php if (isset($cookieFirstName))
        {
          echo "<span>Welcome $cookieFirstName</span>";
        } ?>
        <a href='/acme/accounts/index.php?action=login'>
        <picture>
          <img src="/acme/images/site/account_resize.gif" alt="Picture of Account Folder">
        </picture>
          My Account</a>
      </div>
  </div>
                  
</header>