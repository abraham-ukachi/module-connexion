<?php
/*
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
* @name Index Page / ddd
* @file index.php
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
* @version: 0.0.1
* 
* Usage:
*   1-|> open http://localhost/module-connexion/template.php
* 
*
* ============================
*     >>> DESCRIPTION <<<
* ~~~~~~~~ (French) ~~~~~~~~~
* 
* -
* 
* ~~~~~~~~ (English) ~~~~~~~~~
* 
* -
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


# A Web App without a login / registration system should never be deployed!!! :)

?><!DOCTYPE html>

<!-- HTML -->
<html lang="en">

  <!-- HEAD -->
  <head>
    <!-- Our 4 basic metas -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0, user-scalable=yes">
    <meta name="description" content="Index Page of ddd">
    
    <!-- Title -->
    <title>ddd - module-connexion | Abraham Ukachi</title>


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
    <link rel="stylesheet" href="assets/theme/color.css">
    <link rel="stylesheet" href="assets/theme/typography.css">
    <link rel="stylesheet" href="assets/theme/styles.css">
    
    <!-- Stylesheet -->
    <link rel="stylesheet" href="assets/stylesheets/splash-screen-styles.css">
    <!-- <link rel="stylesheet" href="assets/stylesheets/login-styles.css"> -->
    
    <!-- Animations -->
    <link rel="stylesheet" href="assets/animations/fade-in-animation.css">


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
        // ...Define a couple of constants & variables

        // Set some constants
        const TIMEOUT_PROGRESS = 60; // <- in milliseconds (i.e. 1000ms = 1 second)
        const INCREMENT_PROGRESS = 1;
        
        // Intialize the `progressCount` variable
        let progressCount = 0;

        // Now, get the document as doc
        let doc = event.target;


        // Get the app layout element as `appLayoutEl`
        let appLayoutEl = doc.getElementById('appLayout');
        // Get the progress bar element as `progressBarEl`
        let progressBarEl = doc.getElementById('progressBar');
        
        
        // Create a progress handler
        let progressHandler = () => {
          // Update the current progress with the progress bar's value
          progressCount = progressBarEl.value;
          
          // DEBUG [4dbsmaster]: tell me about it :)
          console.log(`[progressHandler](1): progressCount => ${progressCount}`);

          // NOTE: You can do something with `progressCount` here
          // TODO: Import or load 'neccessary files' dynamically

          switch (progressCount) {
            case 5: // <- Do something at 5%
              break;
            case 25: // <- Do something at 25%
              break;
            case 60: // <- AT 60%...
              
              // First check for browser support of `Storage`
              // if the browser supports it...
              if (typeof(Storage) !== 'undefined') {
                // ...get the theme from local storage as `theme`
                let theme = localStorage.getItem('theme');
                // DEBUG [4dbsmaster]: tell me about it :)
                console.log(`[_progressHandler]: theme => ${theme}`);
               
                // if a theme was found in storage...
                if (typeof(theme) == 'string') {
                  // ...remove all the themes in body
                  document.body.classList.remove('classic', 'light', 'dark');
                  // update the theme
                  document.body.classList.add(theme);
                }
              
              }
              break;
            case 75: // <- Do something at 75%
              break;
            case 100: // <- AT 100%...

              // ddd is READY!!!
              ddd.isReady = true;

              // call the `onReady` function of `ddd`
              ddd.onReady();
              
              // Now, stop the progress Timer 
              clearInterval(progressTimer);

              // TODO: Do something else when the `progressCount` is at 100%

              // DEBUG [4dbsmaster]: tell me about it :)
              console.log(`[progressHandler](2): ddd is \x1b[32mReady\x1b[0m !!!`);
              break;
            default:
              // Maybe do something otherwise
          }


          // Increase the progress value by the predefined `INCREMENT_PROGRESS`
          progressBarEl.value += INCREMENT_PROGRESS;

         
        };
        
        // Let's set an interval named `progressTimer` to run our
        // `progressHandler` say, every 60 millisecond ?
        progressTimer = setInterval(progressHandler, TIMEOUT_PROGRESS);

      });

    </script>
    
    <!-- Double Psych!!! Some more script for ya! #LOL -->
    <script src="script/app.js"></script>
    
  </head>
  <!-- End of HEAD -->
  
  
  <!-- BODY | Default Theme: dark -->
  <body class="theme dark" fullbleed>

    <!-- App Layout -->
    <div id="appLayout" class="flex-layout horizontal" fit>

      <!-- Vertical Nav Bar -->
      <nav class="nav-bar vertical flex-layout">
        <!-- Icon-Wrapper -->
        <a href=".#" class="icon-wrapper">
          <!-- App-Logo -->
          <svg class="app-logo"></svg>
          <!-- End of App-Logo -->
        </a>
        <!-- End of Icon-Wrapper -->

        <!-- UL in Vertical Nav Bar -->
        <ul naked></ul>
        <!-- End of UL in Vertical Nav Bar -->
        

        <!-- Horizontal Divider -->
        <span class="divider vertical right"></span>
      </nav>
      <!-- End of Vertical Nav Bar -->


      <!-- MAIN - App Layout -->
      <main class="flex-layout vertical">

        <!-- App Header -->
        <div id="appHeader">

          <!-- App Bar -->
          <div id="appBar" class="bar">
            <!-- Horizontal Divider -->
            <span class="divider horizontal bottom"></span>
          </div>
          <!-- End of App Bar -->
          
          <!-- Header Content  -->
          <div id="headerContent"></div>
          <!-- End of Header Content --> 

        </div>
        <!-- End of App Header -->


        <!-- Content - App Layout -->
        <!-- NOTE: This is arguably the most important content ever!!! -->
        <!-- TODO: (scrollableTarget) - Make it the only scrollable `content` -->
        <div id="content">

          <div class="wrapper">
            <!-- App-Logo -->
            <svg class="app-logo"></svg>
            <!-- End of App-Logo -->
            
            <!-- Progress -->
            <progress id="progressBar" value="10" max="100"></progress>
          </div>

        </div>
        <!-- End of Content - App Layout -->

        <!-- Horizontal Nav Bar | Horizontal -->
        <nav class="nav-bar horizontal">
          <!-- Horizontal Divider -->
          <span class="divider horizontal top"></span>
        </nav>
        <!-- End of Horizontal Nav Bar  -->

        <!-- Footer -->
        <!-- <footer>
          <span class="divider horizontal top"></span>
        </footer> -->
        <!-- End of Footer -->

      </main>
      <!-- End of MAIN - App Layout -->

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
