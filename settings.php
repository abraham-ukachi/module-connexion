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
* @name Settings Page - ddd
* @file settings.php
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
* @version: 0.0.1
* 
* Usage:
*   1-|> open http://localhost/module-connexion/settings.php
* 
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
require 'api/ddd.php';
require 'api/internationalization.php';


// Create an instance or object of `DDD` class
$ddd = new DDD();
// get the current language from $ddd as `currentLanguage`
$currentLanguage = $ddd->getCurrentLanguage(); // <- returns eg. 'en', 'fr', ...
// get the current theme from $ddd as `currentTheme`
$currentTheme = $ddd->getCurrentTheme(); // <- returns eg. 'dark', 'light' or 'classic', ...
// get the current page and view of the from $ddd as `page` and `view` respectively;
$currentPage = $ddd->getCurrentPage(DDD::PAGE_SETTINGS, false); // SUGGESTION: create & use a `setCurrentPage()` instead ? 
$currentView = $ddd->getCurrentView(DDD::VIEW_SETTINGS_DEFAULT);


// Create an object of Internationalization named `i18n` with the current language (i.e. $currentLanguage)
$i18n = new Internationalization($currentLanguage);
// get our motto from `i18n`
$motto = $i18n->getString('motto');


// DEBUG [4dbsmaster]: tell me anout it :)
// echo "currentLanguage => $currentLanguage";
// echo "currentTheme => $currentTheme";
// echo "currentPage => $currentPage";
// echo "currentView => $currentView";
// echo "motto => $motto";
// 
// var_dump($i18n::LANGUAGES);


?><!DOCTYPE html>

<!-- HTML -->
<html lang="en">

  <!-- HEAD -->
  <head>
    <!-- Our 4 VIP metas -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="Settings page of ddd / module-connexion">
    
    <!-- Title -->
    <title>Settings - ddd - module-connexion | Abraham Ukachi</title>


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
    <link rel="stylesheet" href="assets/stylesheets/settings-styles.css">
    
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
        page: 'settings',
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
        ddd.onReady();
        
        
      });
 
    </script>
    
    <!-- Double Psych!!! Some more script for ya! #LOL -->
    <script src="script/app.js"></script>
    
  </head>
  <!-- End of HEAD -->
  
  
  <!-- BODY | Default Theme: light -->
  <!-- TODO: replace 'light' with `currentTheme` PHP variable (eg. < ?= $currentTheme ? >) -->
  <body class="theme light" fullbleed>

    <!-- App Layout -->
    <div id="appLayout" class="flex-layout horizontal" fit>
      
      <!-- PHP: Include the vertical & responsive `nav-bar` component here -->
      <?php 
        $_GET['navbar_type'] = 'vertical'; 
        $_GET['navbar_page'] = 'settings'; 
        $_GET['navbar_init'] = 'au'; 
        $_GET['navbar_connected'] = 'true'; 
        $_GET['navbar_res'] = 'true'; 
      ?>

      <?php include 'components/nav-bar.php'; ?>


      <!-- MAIN - App Layout -->
      <main class="flex-layout vertical">

        <!-- App Header -->
        <div id="appHeader">

          <!-- TODO: Use PHP's switch/case statement instead -->

          <!-- PHP: If the current setting's view is language...-->
          <?php if ($ddd->getCurrentView() == DDD::VIEW_SETTINGS_LANGUAGE): ?>
          <!-- PHP: ...show the language header -->

          <!-- App Bar -->
          <div id="appBar" class="app-bar">

            <!-- Return Icon Button -->
            <a href="settings.php" title="Go back">
              <button class="icon-button">
                <span class="material-icons icon">arrow_back</span>
              </button>
            </a>
            
            <!-- Title Wrapper -->
            <div class="title-wrapper">
              <h2 id="appTitle" class="app-title">Languages</h2> <!-- App Title -->
              <h3 id="appSubtitle" class="app-subtitle"><?= $i18n->getString($currentLanguage) ?>&nbsp;&bull;&nbsp;default</h3> <!-- App Subtitle -->
            </div>
            <!-- End of Title Wrapper -->
            
            <!-- <span flex></span> -->
            
            <!-- Done - Icon Button -->
            <button id="doneIconButton" class="icon-button" lang="<?= $currentLanguage ?>" disabled>
              <span class="material-icons icon">done</span>
            </button>
            <!--
            <a href="settings.php?view=lang" title="Done">
              <button id="doneIconButton" class="icon-button">
                <span class="material-icons icon">done</span>
              </button>
            </a> -->
            <!-- End of Done - Icon Button -->
                        
            <!-- Horizontal Divider -->
            <span class="divider horizontal bottom"></span>
          </div>
          <!-- End of App Bar -->

          <!-- PHP: If the current setting's view is theme...-->
          <?php elseif ($ddd->getCurrentView() == DDD::VIEW_SETTINGS_THEME): ?>
          <!-- PHP: ...show the theme header -->

          <!-- App Bar -->
          <div id="appBar" class="app-bar">

            <!-- Return Icon Button -->
            <a href="settings.php" title="Go back">
              <button class="icon-button">
                <span class="material-icons icon">arrow_back</span>
              </button>
            </a>

            <!-- Title Wrapper -->
            <div class="title-wrapper">
              <h2 id="appTitle" class="app-title">Themes</h2> <!-- App Title -->
              <h3 id="appSubtitle" class="app-subtitle" hidden>ddd</h3> <!-- App Subtitle -->
            </div>
            <!-- End of Title Wrapper -->
            
            <!-- <span flex></span> -->
            
            <!-- Done - Icon Button -->
            <a href="settings.php?view=theme" title="Done" hidden>
              <button id="doneIconButton" class="icon-button">
                <span class="material-icons icon">done</span>
              </button>
            </a>
            <!-- End of Done - Icon Button -->
            
            <!-- Horizontal Divider -->
            <span class="divider horizontal bottom"></span>
          </div>
          <!-- End of App Bar -->

          <!-- PHP: If the current setting's view is about...-->
          <?php elseif ($ddd->getCurrentView() == DDD::VIEW_SETTINGS_ABOUT): ?>
          <!-- PHP: ...show the about header -->

          <!-- App Bar -->
          <div id="appBar" class="app-bar">

            <!-- Return Icon Button -->
            <a href="settings.php" title="Cancel">
              <button id="closeIconButton" class="icon-button">
                <span class="material-icons icon">arrow_back</span>
              </button>
            </a>

            <!-- Title Wrapper -->
            <div class="title-wrapper">
              <h2 id="appTitle" class="app-title">About</h2> <!-- App Title -->
              <h3 id="appSubtitle" class="app-subtitle" hidden>ddd</h3> <!-- App Subtitle -->
            </div>
            <!-- End of Title Wrapper -->
            
            <!-- <span flex></span> -->
            
            <!-- Call - Icon Button -->
            <a href="tel:+33758664673" title="Call Me Now :)">
              <button id="callButton" class="icon-button">
                <span class="material-icons icon">phone</span>
              </button>
            </a>
            <!-- End of Call - Icon Button -->
            
            <!-- Horizontal Divider -->
            <span class="divider horizontal bottom"></span>
          </div>
          <!-- End of App Bar -->

          <!-- PHP: Otherwise...-->
          <?php else: ?>
          <!-- PHP: ...show the default settings header -->

          <!-- App Bar -->
          <div id="appBar" class="app-bar">

            <!-- Close Icon Button -->
            <a href="." title="Cancel">
              <button id="closeIconButton" class="icon-button">
                <span class="material-icons icon">close</span>
              </button>
            </a>

            <!-- Title Wrapper -->
            <div class="title-wrapper">
              <h2 id="appTitle" class="app-title">Settings</h2> <!-- App Title -->
              <h3 id="appSubtitle" class="app-subtitle" hidden>ddd</h3> <!-- App Subtitle -->
            </div>
            <!-- End of Title Wrapper -->
            
            <!-- Horizontal Divider -->
            <span class="divider horizontal bottom"></span>
          </div>
          <!-- End of App Bar -->

          <?php endif; ?>
          <!-- End of PHP: If the current setting's view is language -->

        </div>
        <!-- End of App Header -->

        <!-- Content - App Layout -->
        <!-- NOTE: This is arguably the most important content ever!!! -->
        <!-- TODO: (scrollableTarget) - Make it the only scrollable `content` -->
        <div id="content">

          <!-- Changing app's header based on the current value of `view` from GET... -->
          <!-- TODO: Use PHP's switch/case statement instead -->

          <!-- PHP: If the current setting's view is language...-->
          <?php if ($ddd->getCurrentView() == DDD::VIEW_SETTINGS_LANGUAGE): ?>
          <!-- PHP: ...show the languages grid -->
          
          <!-- Languages Grid -->
          <!-- TODO: Seperate this content from the main thread by creating a 'view_settings_language.php' 
                     file in 'components/' folder, and include or require it here -->
          <div id="languagesGrid" class="grid languages">
            <!-- PHP: For each supported language Id in `$i18n` ...-->
            <?php foreach ($i18n->getSupportedLanguages() as $langId) : ?>
            <!-- PHP: ...show the corresponding langauge list item -->

            <!-- Language Button -->
            <button lang="<?php echo $langId ?>" class="language flex-layout vertical" <?php echo ($langId == $currentLanguage) ? 'selected' : '' ?>>
              <!-- HACK: Background -->
              <span class="bg" fit></span>
              
              <!-- Language Greeting -->
              <h2 class="greeting"><?php echo $i18n::LANGUAGES[$langId]['greeting'] ?></h2>
              <!-- Language Text -->
              <p class="text"><?php echo $i18n::LANGUAGES[$langId]['text'] ?></p>
              <!-- Language Name -->
              <h4 class="name"><?php echo $i18n->getString($langId) ?></h4>

            </button>
            <!-- End of Languages Grid -->
            
            <?php endforeach; ?>
            <!-- End of PHP: If the current setting's view is language -->

          </div>
          <!-- End of Languages Grid -->
          
          <!-- PHP: If the current setting's view is theme...-->
          <?php elseif ($ddd->getCurrentView() == DDD::VIEW_SETTINGS_THEME): ?>
          <!-- PHP: ...show the theme content -->

          <!-- Themes List -->
          <!-- TODO: Seperate this content from the main thread by creating a 'view_settings_theme.php' 
                     file in 'components/' folder, and include or require it here -->
          <ul id="themesList" class="list themes">

            <!-- PHP: For each theme in `THEMES` from `DDD` ...-->
            <?php foreach (DDD::THEMES as $index => $theme) : ?>
            <!-- PHP: ...show the corresponding theme as a list item -->

            <!-- List Item -->
            <li class="flex-layout">
              <!-- Button -->
              <button tabIndex="<?= $index + 1 ?>" class="center flex-layout" theme="<?= $theme ?>" <?= $theme == $currentTheme ? 'selected' : '' ?>>

                <!-- Icon -->
                <span class="material-icons icon">
                  <?= $theme == DDD::THEME_DARK ? 'dark_mode' : ($theme == DDD::THEME_LIGHT ? 'light_mode' : 'star_border') ?>
                </span>
                <!-- Label -->
                <p class="label"><?= $i18n->getString($theme) ?></p>
                <!-- Done Icon Button -->
                <span class="material-icons check icon">done</span>

                <!-- HACK: Background -->
                <span class="bg" fit></span>

              </button>
              <!-- End of Button -->
            </li>
            <!-- End of List Item -->

            <?php endforeach; ?>
            <!-- End of PHP: If the current setting's view is language -->

          </ul>
          <!-- End of Themes List -->

          <!-- PHP: If the current setting's view is about...-->
          <?php elseif ($ddd->getCurrentView() == DDD::VIEW_SETTINGS_ABOUT): ?>
          <!-- PHP: ...show the about container -->

          <!-- About Container -->
          <div class="about container vertical flex-layout">
            <!-- Logo Wrapper -->
            <div class="logo-wrapper vertical centered flex-layout">
              <!-- App Logo | 144x144 | Launcher Icon -->
              <img id="appLogo" src="assets/images/manifest/icon-144x144.png" alt="App Logo" class="launcher-icon" />
            </div>
            <!-- End of Logo Wrapper -->

            <!-- App Name -->
            <h2 class="app-name">ddd &bull; module-connexion</h2>
            
            <!-- App Version -->
            <h6 class="app-version caption">version 0.0.1</h6>


            <span flex></span>

            <!-- Social list -->
            <ul class="social list horizontal flex-layout centered" naked>
              <!-- Github Logo -->
              <li class="logo github">
                <a target="_blank" href="https://github.com/abraham-ukachi/module-connexion" title="view code on github">
                  <span class="icon"></span>
                </a>
              </li>

              <!-- LinkedIn Logo -->
              <li class="logo linkedin">
                <a target="_blank" href="https://linkedin.com/in/abraham-ukachi" title="view my linkedIn profile">
                  <span class="icon"></span>
                </a>
              </li>

              <!-- InstaGram Logo-->
              <li class="logo instagram">
                <a target="_blank" href="https://instagram.com/abrahamukachi" title="See my instagram page">
                  <span class="icon"></span>
                </a>
              </li>

              <!-- Twitter -->
              <li class="logo twitter">
                <a target="_blank" href="https://twitter.com/abrahamukachi" title="See my twitter page">
                  <span class="icon"></span>
                </a>
              </li>

            </ul>

            <!-- App Author -->
            <div class="app-author center flex-layout">
              <span>Made with <span class="heart-emoji">&#10084;</span> by</span>
              <a href="abraham-ukachi.students-laplateforme.io" class="flex-layout center" target="_blank">
                <img src="assets/pic.png" alt="Photo of Abraham Ukachi"/>
                <span>Abraham Ukachi</span>
              </a>
            </div>
            
            

            <!-- Copyright -->
            <!-- HACK: To keep my copyright up to date, I used the year from PHP's `date()` function -->
            <div class="copyright vertical flex-layout">
              <p>Copyright © <?= date('Y') ?> Abraham Ukachi. All rights reserved.</p>
              <p>Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so</p>
            </div>
          </div>
          <!-- End of About Container -->


          <!-- PHP: Otherwise...-->
          <?php else: ?>
          <!-- PHP: ...show the default settings content -->

          <!-- Settings list - UL -->
          <ul class="settings list">
            <!-- Language Setting -->
            <li class="language setting">
              <!-- HACK: Background 4 Theme -->
              <span class="bg" fit></span>
              <!-- Link -->
              <a class="link" href="settings.php?view=lang">
                <div>
                  <h5>Language</h5>
                  <p>English</p>
                </div>
                <span class="material-icons icon">arrow_forward_ios</span>
              </a>
            </li>
            <!-- End of Language Setting -->

            <!-- Theme Setting -->
            <li class="theme setting">
              <!-- HACK: Background 4 Theme -->
              <span class="bg" fit></span>
              <!-- Link -->
              <a class="link" href="settings.php?view=theme">
                <div>
                  <h5>Theme</h5>
                  <p>Dark</p>
                </div>
                <span class="material-icons icon">arrow_forward_ios</span>
              </a>
            </li>
            <!-- End of Theme Setting -->

            <!-- About Setting -->
            <li class="about setting">
              <!-- HACK: Background 4 Theme -->
              <span class="bg" fit></span>
              <!-- Link -->
              <a class="link" href="settings.php?view=about">
                <div>
                  <h5>About</h5>
                  <p>ddd&nbsp;&bull;&nbsp;module-connexion</p>
                </div>
                <span class="material-icons icon">arrow_forward_ios</span>
              </a>
            </li>
            <!-- End of About Setting -->

            <!-- Version Setting -->
            <li class="version setting" disabled>
              <!-- HACK: Background 4 Theme -->
              <span class="bg" fit></span>
              <!-- Link -->
              <a class="link">
                <div>
                  <h5>Version</h5>
                  <p><strong>0.0.1</strong></p>
                </div>
              </a>
            </li>
            <!-- End of Version Setting -->
          </ul>
          <!-- End of Settings list - UL -->

      
          
          <!-- Adding a "Delete Your Accout" - Button... -->
          <!-- IDEA: The user should be able to delete his/her account easily. -->
          <!--       I personally hate when website's make it soo difficult to delete your account -->
          <!--       after you were able to easily create it -->

          <!-- TODO: Position this 'deleteYourAccount' button at the bottom of the page -->
          <!-- Delete Account - Button Wrapper -->
          <div class="delete-account button-wrapper">
            <!-- Delete Your Account - Button -->
            <a href="settings.php?dialog=<?= DDD::DIALOG_DELETE_ACCOUNT ?>">
              <button id="deleteYourAccount" tabIndex="-1">Delete your account</button>
            </a>
          </div>

      
          <?php endif; ?>
          <!-- End of PHP: If the current setting's view is language -->

        </div>
        <!-- End of Content - App Layout -->

        <!-- PHP: Include the horizontal `nav-bar` component here -->
        <?php 
          $_GET['navbar_type'] = 'horizontal'; 
          $_GET['navbar_page'] = 'settings'; 
          $_GET['navbar_init'] = 'au'; 
          $_GET['navbar_connected'] = 'true'; 
          $_GET['navbar_res'] = 'true'; 
        ?>
         
        <?php include 'components/nav-bar.php'; ?>





        <!-- NOTE: I run outta time, so decided to use PHP (instead of JS) to quickly display specific dialogs -->
        
        <!-- Backdrop -->
        <div class="backdrop fade-in" fit <?= !isset($_GET[DDD::QUERY_DIALOG]) ? 'hidden' : '' ?>>
          <a href="settings.php" fit></a>
        </div>

        <!-- PHP: If there's a DIALOG query in GET... -->
        <?php if (isset($_GET[DDD::QUERY_DIALOG])) : ?>
        <!-- PHP: show the dialogs-container -->
        
        <!-- Dialogs-Container -->
        <div class="dialogs-container vertical flex-layout centered" fit>
          
          <!-- PHP: Switch / handle all dialog queries  -->
          <?php switch ($_GET[DDD::QUERY_DIALOG]) : 
           
          case DDD::DIALOG_DELETE_ACCOUNT: ?>
              
            <!-- Dialog -->
            <!-- TODO: Create & Use a slide-from-up w/ fade-in animation for each dialog -->
            <div id="deleteAccountDialog" class="dialog fade-in">
              <!-- Dialog Title -->
              <h2 class="dialog-title">Delete Account</h2>
              <!-- Dialog Message -->
              <p class="dialog-msg">Are you sure you want to delete your account? This will permanently erase your account.</p>
              
              <!-- Dialog Buttons -->
              <div class="dialog-buttons">
                <!-- Cancel Button -->
                <a role="button" tabindex="0" href="settings.php" class="dialog-button" default autofocus>Cancel</a>
                <span class="divider horizontal left"></span>
                <!-- Delete Button -->
                <!-- B4: href = api/user_del.php?redirect=settings.php -->
                <a role="button" tabindex="0" href="goodbye.php?token=f8S9283201957393" class="dialog-button" confirm>Delete</a>
              </div>
              <!-- End of Dialog Buttons -->
           </div>
           <!-- End of Dialog -->

         <!-- PHP: switch BREAK of DIALOG_DELETE_ACCOUNT -->
         <?php break; ?>


         <?php endswitch; ?>

        </div>
        <!-- End of Dialogs Container -->

      <?php endif; ?>
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



    <!-- Main Backdrop -->
    <div id="backdrop"></div>


    <!-- Main Dialogs Container -->
    <div id="dialogsContainer"></div>

    <!-- Toast -->
    <div id="toast" hidden></div>
    <!-- End of Toast -->

  </body>
  <!-- End of BODY -->

</html>
<!-- End of HTML -->
