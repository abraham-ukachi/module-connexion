<?php
/*
* Job: 04
* Day: 08 - (Wednesday)
* Name: 'Jour 8 - Session / Cookies'
* File: index.php
* Author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
* Version: -?-
* 
* Usage:
*   1-|> open http://localhost/runtrack2/jour08/job04/index.php
*
*
* ======== Job 04 ==========
*      >>> DESCRIPTION <<<		
* ~~~~~~~~ (French) ~~~~~~~~~
*
* - Créez un formulaire de connexion qui contient un input de type de text nommé “prenom” 
*   et un bouton submit nommé “connexion”. 
* - Lorsque l’on valide le formulaire, le prénom est ajouté dans un cookie. 
* - Si un utilisateur a déjà entré son prénom, n'affichez plus le formulaire de connexion. 
* - A la place, écrivez “Bonjour prenom !” et ajouter un bouton “Déconnexion” nommé “deco”.
* - Lorsque l’utilisateur se déconnecte, il faut à nouveau afficher le formulaire de connexion.
*
* ~~~~~~~~ (English) ~~~~~~~~
* 
* - Create a login form that contains a text type input named “first name” and a 
*   submit button named “connection”. 
* - When the form is validated, the first name is added to a cookie. 
* - If a user has already entered their first name, no longer display the login form.
* - Instead, write “Hello first name!” and add a “Disconnect” button named “deco”. 
* - When the user logs out, the login form must be displayed again.
*
* ============================
* WARNING: This task/job was done in a hurry; my code is therefore not as 'pretty'. #LOL
* ============================
*/

/*
* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
* MOTTO: I'll always do more 😜!!!
* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
*/


# YESS!!!! We are still in session, about to eat some cookies !!!!!!! :)


// Creating some "constant" variables without using PHP's built-in `declare()` function...

// action constant variables
$ACTION_LOGIN = 'login';
$ACTION_LOGOUT = 'logout';
// status constant variables
$STATUS_CONNECTED = 'connected';
$STATUS_NOT_CONNECTED = 'not_connected';


// Intialize the `userConnected` variable
$userConnected = false;


/**
 * Updates our cookie with the given `firstname`.
 *
 * @param string $firstname - the first name
 * @param int $timeout - timeout of the cookie
 * @param string $dir - directory / pages in the website for cookie availability
 *
 * @return bool $updated - returns `true` if the cookie 'firstname' has been updated successfully.
 */
function updateCookie($firstname, $timeout = 3600, $dir = '/') {
  // Initialize the `fnameAdded` variable
  $updated = false;

  // If there's a valid `firstname` given...
  if (isset($firstname)) {
    // ...add the value of `firstname` to the cookie
    // (i.e. create / set make the most delicious cookie in the world),
    // using our predefined timeout and directory
    setcookie('firstname', $firstname, time() + $timeout, $dir);

    // update the `updated` variable
    $updated = true;
  }

  // Return `updated`
  return $updated;
}






/**
 * Returns the current status of user.
 *
 * @return string $currentStatus - `connected` or `not_connected`
 */
function getCurrentStatus($userConnected = false) {
  // TODO: Uncomment the code below, to use our beloved ternary statment instead
  // return (isset($_COOKIE['firstname'])) ? 'connected' : 'not_connected';

  // Intialize the `currentStatus` variable to 'not_connected'
  $currentStatus = 'not_connected';
  
  // If there's a cookie 'firstname'...
  if (isset($_COOKIE['firstname']) || $userConnected) {
    // ...set `currentStatus` to `connected`
    $currentStatus = 'connected';
  } 

  // Return the current status
  return $currentStatus;
}



/**
 * Returns the user's first name based on his/her current status.
 * 
 * @return string $firstname
 */
function getFirstname() {
  // initialize the firstname variable
  $firstname = '';
  
  // echo ">> firstname = $firstname & STATUS_CONNECTED => " . echo $STATUS_CONNECTED . "<br>";

  // If the current user is connected...
  if (getCurrentStatus($userConnected) == 'connected') {
    // ...update `firstname` from cookie
    $firstname = $_COOKIE['firstname'];

  }else if (isset($_POST['prenom'])) { # <- 'prenom' was required in this job/task
    // update `firstname` from POST
    $firstname = $_POST['prenom'];
  }

  // return `firstname`
  return $firstname;

  // return ($getCurrentStatus() == $STATUS_CONNECTED) ? $_COOKIE['firstname'] : $_POST['firstname'];
}


/**
 * Returns the login/logout action of the user
 *
 * @return $string $action - 'login' or 'logout'
 */
function getAction() {
  // Initialize the `action` variable
  $action = '';

  // If the user POSTed 'connexion'...
  if (isset($_POST['connexion'])) {
    // ...update `action` to login
    $action = 'login';

  }else if (isset($_POST['deco'])) { # <- user POSTed 'deco'...
    // ...update `action` to logout
    $action = 'logout';
  }

  // Return the `action` variable
  return $action;
}


/**
 * Login the user.
 * NOTE: This will add the user's firstname to a cookie
 *
 * @return bool - `true` if the user was logged in successfully
 */
function login() {
  // Get the user's firstname as `firstname`
  $firstname = getFirstname();

  // update our cookie with `firstname` and return the result accordingly
  return updateCookie($firstname);
}



/**
 * Logout the user.
 * NOTE: This will delete / expire the cookie 'firstname'
 */
function logout() {
  // clear the `$_COOKIE['firstname']` value
  unset($_COOKIE['firstname']);

  // set the expiration date of cookie 'firstname' to 2 hour ago
  setcookie('firstname', '', time() - 7200, '/'); # <- empty value and old timestamp
}


// If the current user is already connected...
if (getCurrentStatus($userConnected) == $STATUS_CONNECTED) {
  // ...TODO: do something here ;)

  // But, if the user wants to log out...
  if (getAction() == $ACTION_LOGOUT) {
    // ...who are we to say no? Remember, "The client is always right" ;)
    // So, log him/her/they *OUT&, using our `logout()` function
    logout();
  }

}else { # <- User is not connected
  // ...TODO: do something here ;)
 
  // If the user wants to log in...
  if (getAction() == $ACTION_LOGIN) {
    // ...log him/her/they *IN*, using our `login()` function,
    // and update the `userConnected` variable accordingly
    $userConnected = login();
  }
}


// DEBUG [4dbsmaster]: tell me about it :)
// echo "getFirstname() => " . getFirstname() . "<br>";
// echo "getAction() => " . getAction() . "<br>";
// echo "getCurrentStatus() => " . getCurrentStatus($userConnected) . "<br>";


// DEBUG [4dbsmaster]: tell me about the COOKIE's content :)
// print_r($_COOKIE);


?><!DOCTYPE html>

<!-- HTML -->
<html lang="en">
  <!-- HEAD -->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge, chrome=1">
    <!-- <meta http-equiv="content-type" content="text/html; charset=utf-8"> -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0, user-scalable=yes">
    <meta name="description" content="Job4 of Day8 - Runtrack2">

    <title>Job04 - Jour08 | Runtrack2</title>


    <!-- Material Icons - https://github.com/google/material-design-icons/tree/master/font -->
    <!-- https://material.io/resources/icons/?style=baseline -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>

            
      /* ==== MATERIAL ICONS ==== */

      /* Material Icons  */
      .material-icons {
        font-family: 'Material Icons';
        font-weight: normal;
        font-style: normal;
        font-size: 48px; /* Preferred icon size */
        display: inline-block;
        line-height: 1;
        text-transform: none;
        letter-spacing: normal;
        word-wrap: normal;
        white-space: nowrap;
        direction: ltr;

        /* Support for all Webkit browsers. */
        -webkit-font-smoothing: antialiased;
        /* Support for Safari and Chrome. */
        text-rendering: optimizeLegibility;

        /* Support for Firefox. */
        -moz-osx-font-smoothing: grayscale;
  
        /* Support for IE. */
        font-feature-settings: 'liga';
      }

      /* === END of MATERIAL ICONS === */



      /* Body */
      body {
        width: 100%;
        height: 100vh;
        background: #1a1a1a;
        color: #e7e7e7;
        font-size: 18px;
        font-family: courier;

        /* Webkit Browsers */
        -webkit-font-smoothing: antialiased;
        /* Safari & Chrome */
        text-rendering: optimizeLegibility;
        /* Firefox */
        -moz-osx-font-smoothing: grayscale;
      }

      /* Direct code of the body */
      body > code {
        opacity: 0.5;
      }

      /* H2 - Title */
      h2 {
        color: yellow;
        /* font-family: cursive; */
      }


      /* Any link in H2 - Title */
      h2 a {
        text-decoration: none;
        color: inherit;
      }

      /* Underline link in H2 - Title when user hover's over it */
      h2 a:hover {
        text-decoration: underline;
      }

      /* Main & Aside */
      main, aside {
        display: block;
        position: relative;
        width: 100%;
        height: auto;
      }

      /* All Containers */
      .container {
        position: relative;
        width: inherit;
        height: inherit;
      }

      /* Main */
      main {
        width: 100%;
        height: 100%;
        min-height: 300px;
        padding: 48px;
        justify-content: start;
      }

      /* H1 in main*/
      main > h1 {
        font-size: 72px;
      }


      /* Main Container */
      main > .container {
        /* top: -50px; */
      }

      /* Aside */
      aside {
        position: fixed;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 5;
        opacity: 0.95;

        transform: translateY(65%);

        -webkit-transition: transform 200ms ease-in-out;
        -moz-transition: transform 200ms ease-in-out;
        transition: transform 200ms ease-in-out;

      }

      /* Opened Aside */
      aside[opened] {
        transform: translateY(0%);
      }

      /* When Aside is closed */
      aside:not([opened]) {
        cursor: pointer;
      }
      
      /* Whenever Aside is closed and the user hovers over it,
       * change the handle's background to white */
      aside:not([opened]):hover #handle {
        background: white;
      }
      
      /* Aside Container */
      aside > .container {
        background: #2c2c2c;
        overflow: hidden;
        border-radius: 24px 24px 00 0;
        max-width: 600px;
        margin: 0 auto;
      }

      /* Handle */
      #handle {
        width: 30%;
        height: 5px;
        background: #7b7b7b;
        margin: 16px;
        border-radius: 5px;
        cursor: pointer;
      }

      #handle:hover {
        background: yellow;
      }

      /* If aside/drawer is closed, 
       * remove pointer events of the drawer's handle */
      aside:not([opened]) #handle {
        pointer-events: none;
      }

      /* Form */
      form {
        width: 90%;
        height: auto;
      }

      /* Label */
      label {
        font-family: monospace;
        color: #9c9c9c;
      }

      /* Input */
      input, select {
        border-radius: 5px;
        background: #343434;
        border: 0;
        padding: 8px 16px;
        margin: 8px 0 16px;
        font-size: 24px;
        color: white;
      }

      /* Hover styles of all inputs except the submit input button */
      input:not([type="submit"]):hover, select:hover {
        outline: 2px solid white;
      }

      input:not([type="submit"]):focus, select:focus {
        outline: 2px solid yellow;
      }

      /* Submit Input */
      input[type="submit"] {
        background: #f0ed0f;
        color: black;
        border-radius: 5px;
        text-transform: uppercase;
        font-size: medium;
        font-weight: bold;
        padding: 16px;
        letter-spacing: 1.5px;
        cursor: pointer;
        margin-top: 24px;
      }

      /* Reset Submit Button - Input */
      input[type="submit"][name="reset"] {
        margin: 0 0 24px 0;
        background: white;
      }

      select {
        flex: 1;
        /* height: 40px; */
        /* padding: 0 12px; */
        margin-left: 12px;
        overflow: hidden;
        cursor: pointer;
      }

      /* Toast */
      .toast {
        background: darkgreen;
        color: white;
        /* padding: 8px 16px; */
        border-radius: 0 0 16px 16px;
        width: 90%;
        font-size: 14px;
        font-family: monospace;
        max-width: 600px;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        font-weight: bold;
        margin: 0 auto;
        text-align: center;
        z-index: 10;
      }

      /* Span in Toast */
      .toast span {
        color: #b9ff9d;
      }

      /* Code in Toast */
      .toast code {
        position: absolute;
        left: 20px;
        font-weight: bold;
        opacity: 0.3;
      }


      /* Error Toast */
      .toast.error {
        background: #752116;
      }

      /* Span in Good Toast */
      .toast.error span {
        color: #edb2b8;
      }


      /* Set the maximum width of all forms and div.toast */
      /* form, .toast { max-width: 600px; } */

      
      /* We alway need our fullbleed :) */
      [fullbleed] {
        margin: 0;
        padding: 0;
      }

      /*** Flex Layout Styles ***/

      /* Layout */
      .layout {
        display: flex;
      }
      
      /* Vertical Layout*/
      .vertical.layout {
        flex-direction: column;
      }

      /* Horizontal Layout */
      .horizontal.layout {
        flex-direction: row;
      }

      /* Centered Layout */
      .centered.layout {
        justify-content: center;
        align-items: center;
      }

      /* Just center the items in the layout */
      .center.layout {
        align-items: center;
      }


      /* First names */
      ul#firstnames {
        list-style: none;
        font-size: 24px;
        width: 100%;
        padding: 0;
        max-width: 80%;
      }

      /* Fname */
      .fname {
        padding: 8px 16px;
        border-bottom: 1px solid #404040;
      }

      /* ==< App Styles >== */

      /* Apps  */
      ul#apps {
        list-style: none;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-auto-rows: minmax(100px, auto);
        gap: 10px;
        padding: 0;
      }

      /* All apps */
      li.app {
        overflow: visible;
        width: 100px;
        height: 100px;
        cursor: pointer;
      }

      /* Icon Wrapper in app */
      li.app .icon-wrapper {
        box-sizing: border-box;
        background: rgba(255,255,255,0.1);
        border-radius: 12px;
        width: 100%;
        height: 100%;
      }


      /* Hover all apps and affect the icon wrapper */
      li.app:hover > .icon-wrapper {
        border: 2px solid white;
      }

      /* app-name - H3 */
      h3.app-name {
        text-align: center;
        font-size: 12px;
        font-weight: 300; 
      }


      /* ==> End of App Styles <== */
      
      
      
      /*** Wide Layout - Media Query ***/
      @media (min-width: 460px) {
        
        /* H1 in main*/
        main > h1 {
          font-size: 144px;
          margin: 24px;
        }

        /* H2 - Title */
        h2 {
          font-size: 50px;
        }

        /* Aside */
        aside {
          transform: translateY(60%);
        }

        /* Toast */
        .toast {
          width: 70%;
          font-size: 16px;
          /* padding: 12px 24px; */
        }


        /* Apps  */
        ul#apps {
          grid-auto-rows: minmax(200px, auto);
          gap: 24px;
          margin: 48px 0;
        }

        /* App */
        li.app {
          width: 200px;
          height: 200px;
        }


        /* app-name - H3 */
        h3.app-name {
          font-size: 20px;
        }

        .material-icons {
          font-size: 72px;
        }

      }

      /*** END of Wide Layout - Media Query ***/

    </style>

    
    <!-- Just a little JS 🙏 -->
    <script>

    /*
     * Handler that is called whenever the `<aside>` element is clicked or tapped.
     *
     * @param { PointerEvent } event
     * @param { Element } asideEl
     */
    var handleAsideClick = (event, asideEl) => {
      // Get the aside eleemnt as `asideEl`
      //let asideEl = event.target;
      // Check if the aside element is opened using...
      // ...you guessed it ! "A TERNARY STATMENT !!!"
      let isOpened = asideEl.hasAttribute('opened') ? true : false;

      // Do nothing if the aside element is already opened.
      if (isOpened) { return }

      // Open the aside / drawer by setting or adding a 'opened' attribute.
      asideEl.setAttribute('opened', '');

      // DEBUG [4dbsmaster]: tell me about it :)
      // console.log(`[handleAsideClick]: asideEl => `, asideEl);
      // console.log(

    };


    /*
     * Toggles the Drawer 
     * This method toggles the 'opened' attribute of `<aside id="drawer">`.
     */
    var toggleDrawer = (event) => {
      // Stop Propagation of the event
      event.stopPropagation();
      
      // Get the drawer element as `drawerEl`
      let drawerEl = document.getElementById('drawer');

      // Toggle the 'opened' attribute of `drawerEl`
      drawerEl.toggleAttribute('opened');

      // DEBUG [4dbsmaster]: tell me about it :)
      // console.log(`[toggleDrawer](1): drawerEl => `, drawerEl);
      // console.log('[toggleDrawer](2): event => ', event);
    };
    

    </script>

  </head>
  <!-- End of HEAD -->

  <!-- BODY -->
  <body class="vertical layout centered" fullbleed>

    <!-- Result - MAIN -->
    <main id="result" class="vertical layout center">
      
      <!-- PHP: if the user *IS* connected... --> 
      <?php if (getCurrentStatus($userConnected) == $STATUS_CONNECTED) { ?>
      <!-- ...show the apps  -->

      <!-- Apps -->
      <ul id="apps">

        <!-- Messages - App -->
        <li id="messagesApp" class="app">
          <!-- Icon-Wrapper -->
          <div class="icon-wrapper vertical layout centered">
            <span class="material-icons">message</span>
          </div>
          <!-- App Name -->
          <h3 class="app-name">Messages</h3>
        </li>
        <!-- End of Messages - App -->


        <!-- Music - App -->
        <li id="musicApp" class="app">
          <!-- Icon-Wrapper -->
          <div class="icon-wrapper vertical layout centered">
            <span class="material-icons">play_arrow</span>
          </div>
          <!-- App Name -->
          <h3 class="app-name">Music</h3>
        </li>
        <!-- End of Music - App -->


        <!-- Photos - App -->
        <li id="photosApp" class="app">
          <!-- Icon-Wrapper -->
          <div class="icon-wrapper vertical layout centered">
            <span class="material-icons">photo_camera</span>
          </div>
          <!-- App Name -->
          <h3 class="app-name">Photos</h3>
        </li>
        <!-- End of Photos - App -->

      </ul>
      <!-- End of Apps -->

      
      <?php } ?>
      <!-- End of PHP: ..show the apps -->

    </main>
    <!-- End of Result - MAIN -->
    
    <!-- Drawer - ASIDE -->
    <aside id="drawer" opened onclick="handleAsideClick(event, this)">
      
      <!-- Aside Container -->
      <div class="container vertical layout center">
        <!-- Handle -->
        <div id="handle" onclick="toggleDrawer(event)"></div>
        
        <!-- H2 Title -->
        <h2 title="Job 04 of Day8">Job 04 - Day8</h2>


        <!-- PHP: if the user *IS* connected... --> 
        <?php if (getCurrentStatus($userConnected) == $STATUS_CONNECTED) { ?>
        <!-- ...show the logout form  -->

        <!-- Logout Form -->
        <form id="logoutForm" class="vertical layout" method="post">
  
          <!-- Logout - Submit - Button -->
          <input type="submit" name="deco" value="Log Out <?php echo "- " . getFirstname() ?>">

        </form>
        <!-- End of Logout Form -->

        
        <!-- PHP: (However|Else) if the user *IS NOT* connected -->
        <?php } else { ?>
        <!-- ...show the login form  -->
        
        
        <!-- Login Form -->
        <form id="loginForm" class="vertical layout" method="post">

          <!-- Inputs-Wrapper -->
          <div class="inputs-wrapper vertical layout">

            <!-- Firstname Input -->
            <label for="fnameInput">First name</label>
            <input id="fnameInput" required autofocus
              type="text"
              name="prenom"
              title="First Name"
              placeholder="Elon"
            /> <!-- End of Firstname Input -->

          </div>
          <!-- End of Inputs-Wrapper -->

        
          <!-- Login - Submit - Button -->
          <input type="submit" name="connexion" value="Log In">

          <!-- Reset - Button -->
          <!-- <input type="submit" name="reset" value="Reset"> -->

        </form>
        <!-- End of Login Form -->

      
        <?php } ?>
        <!-- End of PHP: (However|Else) if the user *IS NOT* connected -->

      </div>
      <!-- End of Aside Container -->
    </aside>
    <!-- End of Drawer - ASIDE -->



    
 
    <!-- PHP: If there's a first name... -->
    <?php if (getCurrentStatus($userConnected) == $STATUS_CONNECTED) { ?>
    <!-- ...show the Toast -->

    <!-- Toast -->
    <div class="toast">
      <p><code>👋</code> Bonjour <span><?php echo getFirstname() ?></span> !</p>
    </div>
    <!-- End of Toast -->

    <?php } ?>
    <!-- End of PHP: 'If the width *IS NOT* valid...' -->


  </body>
  <!-- End of BODY -->

</html>
<!-- End of HTML -->

