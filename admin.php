<?php
/**
* @license
* ddd / module-connexion
* Copyright (c) 2022 Abraham Ukachi
*
* Permission is hereby granted, free of charge, to any person obtaining a copy
* of this software and associated documentation files (the "Software"), to deal
* in the Software without restriction, including without limitation the rights
* to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
* copies of the Software, and to permit persons to whom the Software is
* furnished to do so, subject to the following conditions:
*
* The above copyright notice and this permission notice shall be included in all
* copies or substantial portions of the Software.
*
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
* AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
* OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
* SOFTWARE.
*
* @project module-connexion
* @name Admin Page - ddd
* @file admin.php
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
* @version: 0.0.1
* 
* Usage:
*   1-|> open http://localhost/module-connexion/admin.php
* 
*
* ============================
*     >>> DESCRIPTION <<<
* ~~~~~~~~ (French) ~~~~~~~~~
* 
* - Une page d’administration (admin.php) :
*   Cette page est accessible UNIQUEMENT pour l’utilisateur “admin”. 
*   Elle permet de lister l’ensemble des informations des utilisateurs présents dans la base de données. 
*
* ~~~~~~~~ (English) ~~~~~~~~~
* 
* - An administration page (admin.php):
*   This page is accessible ONLY for the “admin” user. 
*   It allows to list all the information of the users present in the database.
* 
* ============================
* IMPORTANT: A Web App without a login / registration feature should never be deployed!!! :)
* ============================
*/


/*
* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
* MOTTO: I'll always do more 😜!!!
* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
*/

// Using our own APIs ;)
require_once __DIR__ . '/api/ddd.php';
require_once __DIR__ . '/api/internationalization.php';


// Create an instance or object of `DDD` class as `$ddd`
$ddd = new DDD();
// Get the current language from `$ddd` as `currentLanguage`
$currentLanguage = $ddd->getCurrentLanguage(); # <- returns eg.: 'en', 'fr', 'es' or 'ru'
// Get the current theme from `$ddd` as `currentTheme`
$currentTheme = $ddd->getCurrentTheme(); # <- returns eg.: 'dark', 'light' or 'classic'
// Get the current page, route and view of the from `$ddd` as `page` and `view` respectively
$currentPage = $ddd->getCurrentPage(DDD::PAGE_ADMIN, false); # <- SUGGESTION: Create & use a `setCurrentPage()` instead ?
$currentRoute = $ddd->getCurrentRoute();
$currentView = $ddd->getCurrentView();


// Create an object of our `Internationalization` class named `i18n`, using the current language (i.e. `$currentLanguage`)
$i18n = new Internationalization($currentLanguage);


$simulation = array();

$simulation['users'] = array(
  array(
    "id" => "1",
    "login" => "abraham-ukachi", 
    "firstname" => "Abraham", 
    "lastname" => "Ukachi",
    "password" => '$2y$10$n6lpV7M40m0E/idZPpYHjOFBa2fnLbCTDO87EWNkcSbal8Sl.Xcyu'
  ),
  array(
    "id" => "2",
    "login" => "rim", 
    "firstname" => "Rim", 
    "lastname" => "Moghlali",
    "password" => '$2y$10$n6lpV7M40m0E/idZPpYHjOFBa2fnLbCTDO87EWNkcSbal8Sl.Xcyu'
  ),
  array(
    "id" => "3",
    "login" => "chris-ceccaldi", 
    "firstname" => "Chris", 
    "lastname" => "Ceccaldi",
    "password" => '$2y$10$n6lpV7M40m0E/idZPpYHjOFBa2fnLbCTDO87EWNkcSbal8Sl.Xcyu'
  ),
  array(
    "id" => "4",
    "login" => "hajar-aslan", 
    "firstname" => "Hajar", 
    "lastname" => "Aslan",
    "password" => '$2y$10$n6lpV7M40m0E/idZPpYHjOFBa2fnLbCTDO87EWNkcSbal8Sl.Xcyu'
  )


);


/**
 * Color Set for Initials
 */
$initialsColorSet = array(
  'a' => ['bgColor' => 'darkorange', 'fgColor' => 'white'],
  'b' => ['bgColor' => 'darkred', 'fgColor' => 'white'],
  'c' => ['bgColor' => 'darkgreen', 'fgColor' => 'white'],
  'd' => ['bgColor' => 'darkyellow', 'fgColor' => 'white'],
  'e' => ['bgColor' => 'darkblue', 'fgColor' => 'white'],
  'f' => ['bgColor' => '#13005A', 'fgColor' => 'white'],
  'g' => ['bgColor' => '#0A2647', 'fgColor' => 'white'],
  'h' => ['bgColor' => '#1A120B', 'fgColor' => 'white'],
  'i' => ['bgColor' => '#453C67', 'fgColor' => 'white'],
  'j' => ['bgColor' => '#2D033B', 'fgColor' => 'white'],
  'k' => ['bgColor' => '#00005C', 'fgColor' => 'white'],
  'l' => ['bgColor' => '#000000', 'fgColor' => 'white'],
  'm' => ['bgColor' => '#404258', 'fgColor' => 'white'],
  'n' => ['bgColor' => '#3F3B6C', 'fgColor' => 'white'],
  'o' => ['bgColor' => '#4C0033', 'fgColor' => 'white'],
  'p' => ['bgColor' => '#182747', 'fgColor' => 'white'],
  'q' => ['bgColor' => '#16213E', 'fgColor' => 'white'],
  'r' => ['bgColor' => '#472D2D', 'fgColor' => 'white'],
  's' => ['bgColor' => '#2C3333', 'fgColor' => 'white'],
  't' => ['bgColor' => '#2E0249', 'fgColor' => 'white'],
  'u' => ['bgColor' => '#180A0A', 'fgColor' => 'white'],
  'v' => ['bgColor' => '#46244C', 'fgColor' => 'white'],
  'w' => ['bgColor' => '#191919', 'fgColor' => 'white'],
  'x' => ['bgColor' => '#041C32', 'fgColor' => 'white'],
  'y' => ['bgColor' => '#1F1D36', 'fgColor' => 'white'],
  'z' => ['bgColor' => '#420516', 'fgColor' => 'white']
);



?><!DOCTYPE html>

<!-- HTML -->
<html lang="en">

  <!-- HEAD -->
  <head>
    <!-- Our 4 VIP metas -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="Admin page of module-connexion / ddd">
    
    <!-- Title -->
    <title>Admin Page - module-connexion / ddd | by Abraham Ukachi</title>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Mulish - Font -->
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <!-- Material Icons - https://github.com/google/material-design-icons/tree/master/font -->
    <!-- https://material.io/resources/icons/?style=baseline -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  
     
    <!-- Base -->
    <base href="module-connexion">

    <!-- Logo - Icon -->
    <link rel="icon" href="assets/images/favicon.ico">

    <!-- See https://goo.gl/OOhYW5 -->
    <link rel="manifest" href="manifest.json">

    <!-- See https://goo.gl/qRE0vM -->
    <meta name="theme-color" content="#A67C52">

    <!-- Add to homescreen for Chrome on Android. Fallback for manifest.json -->
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="application-name" content="ddd">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="ddd">

    <!-- Homescreen icons -->
    <link rel="apple-touch-icon" href="assets/images/manifest/icon-48x48.png">
    <link rel="apple-touch-icon" sizes="72x72" href="assets/images/manifest/icon-72x72.png">
    <link rel="apple-touch-icon" sizes="96x96" href="assets/images/manifest/icon-96x96.png">
    <link rel="apple-touch-icon" sizes="144x144" href="assets/images/manifest/icon-144x144.png">
    <link rel="apple-touch-icon" sizes="192x192" href="assets/images/manifest/icon-192x192.png">




    <!-- Theme -->
    <!-- TODO: Rename `styles.css` to `style.css` -->
    <link rel="stylesheet" href="assets/theme/color.css">
    <link rel="stylesheet" href="assets/theme/typography.css">
    <link rel="stylesheet" href="assets/theme/styles.css">
    
    <!-- Stylesheet -->
    <link rel="stylesheet" href="assets/stylesheets/home-styles.css">
    <link rel="stylesheet" href="assets/stylesheets/admin-styles.css">
    
    <!-- Animations -->
    <!-- <link rel="stylesheet" href="assets/animations/fade-in-animation.css"> -->
    <!-- <link rel="stylesheet" href="assets/animations/slide-from-down-animation.css"> -->


    <!-- Script -->
    <!-- ^^^^^^ Like previously stated, "A little JS doesn't hurt ;)" -->
    <script>
      /*
       * Once again, I'm well aware that this project doesn't require a script but
       * I couldn't help myself. So.... Bite me twice!! ;)
       */

      // Create `ddd` object variable with a `isReady` key 
      var ddd = { 
        isReady: false,
        onReady: () => {} 
      }; // <- `false` 'cause duh!! We ain't ready yet!! 


      // Let's do some stuff when this page loads...
      // NOTE: This is again, just a simulation!
      window.addEventListener('load', (event) => { 
        // ...get the document as doc
        let doc = event.target;


        // Get the app layout element as `appLayoutEl`
        let appLayoutEl = doc.getElementById('appLayout');


        // if the browser supports it...
        if (typeof(Storage) !== 'undefined') {
          // ...get the theme from local storage as `theme`
          let theme = localStorage.getItem('theme');
          // DEBUG [4dbsmaster]: tell me about it :)
          console.log(`[_progressHandler]: theme => ${theme}`);
         
          // if a theme was found in storage...
          if (typeof(theme) == 'string') {
            // ...remove all the themes in body
            doc.body.classList.remove('classic', 'light', 'dark');
            // update the theme
            doc.body.classList.add(theme);
          }
        
        }


        // ddd is READY!!!
        ddd.isReady = true;

        // call the `onReady` function of `ddd`
        ddd.onReady('admin');
        
        
      });

      
    </script>
    
    <!-- Double Psych!!! Some more script for ya! #LOL -->
    <script src="script/app.js"></script>
    
  </head>
  <!-- End of HEAD -->
  
  
  <!-- BODY | Default Theme: light -->
  <body class="theme light" fullbleed>

    <!-- App Layout -->
    <div id="appLayout" class="flex-layout horizontal" fit>
      
      <!-- PHP: Include the vertical & responsive `nav-bar` component here -->
      <?php 
        $_GET['navbar_type'] = 'vertical'; 
        $_GET['navbar_page'] = $currentPage; 
        $_GET['navbar_route'] = $currentRoute; 
        $_GET['navbar_init'] = 'au'; 
        $_GET['navbar_connected'] = 'true'; 
        $_GET['navbar_res'] = 'true'; 
      ?>

      <?php include 'components/nav-bar.php'; ?>

      <!-- MAIN - App Layout -->
      <main class="flex-layout vertical">

        <!-- App Header -->
        <div id="appHeader">

          <!-- PHP (10): If the current route is 'users' ...-->
          <?php if ($currentRoute == DDD::ROUTE_ADMIN_USERS) : ?> 
          <!-- PHP (10): ...show a 'users' specific app-bar -->
          
          <!-- App Bar -->
          <div id="appBar" class="users app-bar">

            <!-- Return Icon Button -->
            <a role="icon-button" tabindex="0" href="admin.php" title="Go Back">
              <span class="material-icons icon">arrow_back</span>
            </a>
            <!-- End of Return Icon Button -->
            
            <!-- Title Wrapper -->
            <div class="title-wrapper">
              <!-- App Title -->
              <h2 id="appTitle" class="app-title">Users</h2>
              <!-- App Subtitle -->
              <h3 id="appSubtitle" class="app-subtitle">230 active users</h3>
            </div>
            <!-- End of Title Wrapper --> 
            
            <!-- <span flex></span> -->

            <!-- More - Icon Button -->
            <a role="icon-button" tabindex="0" title="More">
              <span class="material-icons icon">more_vert</span> 
            </a>
            <!-- End of More - Icon Button -->
             
            <!-- Horizontal Divider -->
            <span class="divider horizontal bottom"></span>

          </div>
          <!-- End of App Bar -->


          <!-- PHP (10|Else)  -->
          <?php else : ?>

          <!-- App Bar -->
          <div id="appBar" class="app-bar">


            <span flex></span>

            <!-- Settings - Icon Button -->
            <a id="settingsIconButton" role="icon-button" tabindex="0" href="settings.php" title="Settings">
              <span class="material-icons icon">settings</span>
            </a>
            <!-- End of Settings - Icon Button -->
        
          </div>
          <!-- End of App Bar -->
          
          <?php endif; ?>
          <!-- End of PHP (10) -->


        </div>
        <!-- End of App Header -->

        <!-- Content - App Layout -->
        <!-- NOTE: This is arguably the most important content ever!!! -->
        <!-- TODO: (scrollableTarget) - Make it the only scrollable `content` -->
        <div id="content">

          <!-- PHP (11): If the current route is 'users' ...-->
          <?php if ($currentRoute == DDD::ROUTE_ADMIN_USERS) : ?> 
          <!-- PHP (11): ...show a 'users' specific container -->

          <!-- [online] Container -->
          <div class="container vertical flex-layout" online>
            
            <!-- Users List -->
            <ul id="usersList" class="list vertical flex-layout" naked>

              <!-- PHP (12): For each user in `users`... -->
              <?php foreach ($simulation['users'] as $user) :?>
              <!-- PHP (12): ...show the user -->

              <!-- User -->
              <li id="<?= $user['login'] ?>" class="user horizontal flex-layout center">
                <!-- Avatar -->
                <div class="avatar vertical flex-layout centered">
                  <!-- Initials -->
                  <span class="initials txt upper vertical flex-layout centered">au</span>
                  <!-- Photo -->
                  <!-- <img class="photo" /> -->

                </div>
                
                <!-- Details -->
                <div class="details vertical flex-layout">
                  <!-- Fullname -->
                  <span class="fullname" title="<?= $user['firstname'] . " " . $user['lastname'] ?>"><?= $user['firstname'] . " " . $user['lastname'] ?></span>
                  <!-- Username -->
                  <span class="username txt caption" title="<?= $user['login']?>"><?= $user['login'] ?></span>
                  <!-- Password -->
                  <span class="password txt caption" title="<?= $user['password'] ?>">&#128273;&nbsp;<?= $user['password'] ?></span>
                </div>
                <!-- End of Details -->
                
                <!-- Delete - Icon Button -->
                <a role="icon-button" href="admin.php?route=users&delete=abraham-ukachi" class="delete-icon-button">
                  <span class="material-icons icon">delete</span>
                </a>

              </li>


              <?php endforeach; ?>
              <!-- End of PHP (12) -->
            
            
            </ul>
            <!-- End of Users List -->

          </div>
          <!-- End of [online] Container -->

           
          
          <!-- PHP (11|else)  -->
          <?php else : ?>
          
          <!-- [online] Container -->
          <div class="container vertical flex-layout" online>

            <!-- Home Title -->
            <h3 class="home-title txt capitalize">&#9728;&#65039; Good morning, <span>Abraham</span></h3>

            <!-- Home Description -->
            <p class="home-description">Never underestimate the power of <strong>administration</strong> :)</p>

            <!-- Home-Menu -->
            <menu class="home-menu">

              <!-- Users - Route -->
              <li><a href="admin.php?route=users">
                <!-- Doodle Wrapper -->
                <div class="doodle-wrapper">
                  <!-- Doodle -->
                  <span class="doodle users-doodle"></span>
                </div>
                
                <!-- Label -->
                <span class="label">Users</span>
              </a></li> 


              <!-- [disabled] Dashboard - Route -->
              <li disabled aria-disabled="true"><a tabindex="-1" href="admin.php?route=dashboard">
                <!-- Doodle Wrapper -->
                <div class="doodle-wrapper">
                  <!-- Doodle -->
                  <span class="doodle dashboard-doodle"></span>
                </div>

                <!-- Label -->
                <span class="label">Dashboard</span>
              </a></li> 

              <!-- Dividers -->
              <div class="dividers" fit>
                <span class="divider vertical top left"></span>
              </div>
              
            </menu>
            <!-- End of Home-Menu -->

          </div>
          <!-- End of [online] Container -->


          <?php endif; ?>
          <!-- End of PHP (11) -->


        </div>
        <!-- End of Content - App Layout -->

        <!-- PHP: Include the horizontal `nav-bar` component here -->
        <?php 
          $_GET['navbar_type'] = 'horizontal'; 
          $_GET['navbar_page'] = $currentPage; 
          $_GET['navbar_route'] = $currentRoute; 
          $_GET['navbar_init'] = 'au'; 
          $_GET['navbar_connected'] = 'true'; 
          $_GET['navbar_res'] = 'true'; 
        ?>

        <?php include 'components/nav-bar.php'; ?>
        
      </main>
      <!-- End of MAIN - App Layout -->

      <!-- Details Container | ASIDE -->
      <aside id="detailsContainer" class="vertical flex-layout centered">
        <!-- Outlined App Logo -->
        <span class="app-logo" outlined></span>

        <!-- Divider @ Vertical Left -->
        <span class="divider vertical left"></span>
      </aside>
      <!-- Details Container | ASIDE -->

    </div>
    <!-- End of App Layout -->


    <!-- Backdrop -->
    <div id="backdrop" hidden></div>


    <!-- Dialogs Container -->
    <div id="dialogsContainer" hidden></div>
    <!-- End of Dialogs Container -->


    <!-- Toast -->
    <div id="toast" hidden></div>
    <!-- End of Toast -->

  </body>
  <!-- End of BODY -->

</html>
<!-- End of HTML -->
