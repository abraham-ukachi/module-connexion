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
* @name Login Page - ddd
* @file connexion.php
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
* @version: 0.0.1
* 
* Usage:
*   1-|> open http://localhost/module-connexion/connexion.php
* 
*
* ============================
*     >>> DESCRIPTION <<<
* ~~~~~~~~ (French) ~~~~~~~~~
* 
* - Le formulaire doit avoir deux inputs : “login” et “password”. 
* - Lorsque le formulaire est validé, 
*   s’il existe un utilisateur en bdd correspondant à ces informations, alors l’utilisateur est considéré 
*   comme connecté et une (ou plusieurs) variables de session sont créées. 
* 
* ~~~~~~~~ (English) ~~~~~~~~~
* 
* - A page containing a connection form (connection.php): 
*   The form must have two inputs: “login” and “password”. 
** - When the form is validated, if there is a user in db corresponding to this information, 
*   then the user is considered to be connected and one (or more) session variables are created.
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


?><!DOCTYPE html>

<!-- HTML -->
<html lang="en">

  <!-- HEAD -->
  <head>
    <!-- Our 4 VIP metas -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="Login page of ddd / module-connexion">
    
    <!-- Title -->
    <title>Connexion - ddd - module-connexion | Abraham Ukachi</title>


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
    <link rel="stylesheet" href="assets/stylesheets/login-styles.css">
    
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
        ddd.onReady('login');
        
        
      });


      /*
       * Toggles the password's visibility of password-input element with the given id.
       *
       * @param { String } id
       */
      let togglePassword = (id) => {
        // get the password input element as `passwordInputEl`
        let passwordInputEl = document.getElementById(id);

        // Do nothing if `passwordInputEl` doesn't exist
        if (!passwordInputEl) { return }
        
        // toggle the `type` of `passwordInputEl` between 'text' and 'password',
        // using our beloved ternary statement :)
        passwordInputEl.type = (passwordInputEl.type == 'password') ? 'text' : 'password';

        // restore the focus of `passwordInputEl`
        passwordInputEl.focus();

        // DEBUG [4dbsmaster]: tell me about it :)
        console.log(`[togglePassword](1): passwordInputEl.type => ${passwordInputEl.type}`);
        console.log(`[togglePassword](2): passwordInputEl => `, passwordInputEl);

      };


      /**
        * Handler that is called whenever the `value` of the given `inputEl` changes 
        * 
        * @param { Element } inputEl
       */
      let handleInputValue = (inputEl) => {
        // Do nothing if there's no inputEl
        if (typeof(inputEl) == 'undefined' || !inputEl) { return }

        // get the value from the input element
        let value = inputEl.value;
        // get the label of this input element using its id
        let labelEl = document.querySelector(`label[for="${inputEl.id}"]`);

        // if the input has some value...
        if (value.length) {
          //...create and attribute named 'has-value'
          // and add it to the given input element (i.e. `inputEl`)
          inputEl.setAttribute('has-value', ''); // <- An empty value should turn our attribute into a 'property'
            
          // HACK: If this input element has an element...
          if (labelEl) {
            // ...set an attribute `raised` to the label element
            labelEl.setAttribute('raised', '');
          }

        } else { // <- no value was found in input
          // So, remove the 'has-value' attribute from `inputEl`
          inputEl.removeAttribute('has-value');

          // HACK: If this input element has an element...
          if (labelEl) {
            // ...remove the attribute `raised` from the label element
            labelEl.removeAttribute('raised');
          }

        }

        // DEBUG [4dbsmaster]: tell me about it :)
        console.log(`[handleInputValue](1): value => ${value}`);
        // console.log(`[handleInputValue](2): inputEl => `, inputEl);

      };
      
    </script>
    
    <!-- Double Psych!!! Some more script for ya! #LOL -->
    <script src="script/app.js"></script>
    
  </head>
  <!-- End of HEAD -->
  
  
  <!-- BODY | Default Theme: light -->
  <body class="theme light" fullbleed>

    <!-- App Layout -->
    <div id="appLayout" class="flex-layout horizontal" fit>
      
      <!-- Vertical Nav Bar -->
      <nav class="nav-bar vertical flex-layout">
        <!-- Icon-Wrapper -->
        <a href=".#" class="icon-wrapper">
          <!-- App-Logo -->
          <span class="app-logo"></span>
          <!-- End of App-Logo -->
        </a>
        <!-- End of Icon-Wrapper -->
        
        <span flex></span>
         
        <!-- Home - Nav-Link -->
        <a title="Home" href="" class="nav-link">
          <span class="material-icons nav-icon">view_in_ar</span> <!-- UX: Use `home` instead -->
        </a>
        <!-- End of Home Nav-Link -->

        
        <!-- Profile - Nav-Link -->
        <a title="Profile" href="profil.php" class="nav-link">
          <span class="material-icons nav-icon">account_circle</span>
        </a>
        <!-- End of Profile Nav-Link -->

        <span class="divider horizontal"></span>

        
        <!-- Settings - Nav-Link -->
        <a title="Settings" href="settings.php" class="nav-link">
          <span class="material-icons nav-icon">settings</span>
        </a>
        <!-- End of Settings Nav-Link -->
        

        <span flex></span>

        
        <!-- LogOut - Nav-Link -->
        <a title="Log out" href="logout.php" class="nav-link"> 
          <span class="material-icons nav-icon">power_settings_new</span>
        </a>
        <!-- End of Profile Nav-Link -->

        <!-- Horizontal Divider -->
        <span class="divider vertical right"></span>
      </nav>
      <!-- End of Vertical Nav Bar -->

      <!-- MAIN - App Layout -->
      <main class="flex-layout vertical">

        <!-- App Header -->
        <div id="appHeader">

          <!-- App Bar -->
          <div id="appBar" class="app-bar">
            <!-- Close - Icon Button -->
            <button id="closeIconButton" class="icon-button"><span class="material-icons icon">close</span></button>
            <!-- Title Wrapper -->
            <div class="title-wrapper">
              <h2 id="appTitle" class="app-title">Log in</h2> <!-- App Title -->
              <h3 id="appSubtitle" class="app-subtitle" hidden>abraham-ukachi</h3> <!-- App Subtitle -->
            </div>
            <!-- End of Title Wrapper -->
            
            <!-- <span flex></span> -->

            <!-- More - Icon Button -->
            <button id="moreIconButton" class="icon-button"><span class="material-icons icon">more_vert</span></button>

            <!-- Horizontal Divider -->
            <span class="divider horizontal bottom"></span>
          </div>
          <!-- End of App Bar -->

        </div>
        <!-- End of App Header -->

        <!-- Content - App Layout -->
        <!-- NOTE: This is arguably the most important content ever!!! -->
        <!-- TODO: (scrollableTarget) - Make it the only scrollable `content` -->
        <div id="content">
          <!-- Login Form -->
          <form id="loginForm" class="flex-layout vertical" action="" method="get" target="_self">
            
            <!-- Username / Input-Wrapper -->
            <!-- NOTE: Use `[has-error]` attribute on `.input-wrapper` when there's an error --> 
            <div class="username input-wrapper vertical flex-layout">
              <!-- Username Input -->
              <label for="usernameInput">Username</label>
              <input required aria-required="true" oninput="handleInputValue(this)" 
                id="usernameInput" 
                type="text" 
                name="login" 
              />
              
              <!-- Username Indicator -->
              <!-- NOTE: Use `error` class and `[no-effect]` attribute on `.input-indicator`
                         when there's an error --> 
              <span id="usernameIndicator" class="input-indicator">
                <!-- Indicator Bar -->
                <span bar></span> 
                <!-- Indicator Value -->
                <span val></span>
              </span>
              <!-- End of Username Indicator -->

              <!-- Input Message -->
              <!-- NOTE: Use `error` class to make turn this `.input-message` an error -->
              <p class="input-message fade-in" hidden>Please enter a valid username</p>
              <!-- End of Input Message -->

            </div>
            <!-- End of Username / Input-Wrapper -->
            
            
            <!-- Password / Input-Wrapper -->
            <div class="password input-wrapper vertical flex-layout">
              <!-- Password Input -->
              <label for="passwordInput">Password</label>

              <!-- DIV w/ Horizontal Flex-Layout -->
              <div class="horizontal flex-layout">
                <input required aria-required="true" oninput="handleInputValue(this)"
                  id="passwordInput" 
                  type="password" 
                  name="password" 
                />
                <!-- Toggle Password - Icon button -->
                <button class="icon-button" onclick="togglePassword('passwordInput')" 
                  id="togglePasswordIconButton" 
                  type="button"
                  tabIndex="-1">
                  <span class="material-icons">visibility</span>
                </button>

                <!-- Password Indicator --> 
                <span id="passwordIndicator" class="input-indicator">
                  <!-- Indicator Bar -->
                  <span bar></span>             
                  <!-- Indicator Value -->
                  <span val></span> 
                </span>
                <!-- End of Password Indicator -->

              </div>
              <!-- End of DIV w/ Horizontal Flex-Layout -->

              <!-- Input Message  -->
              <!-- NOTE: Use `error` class to make turn this `.input-message` an error -->
              <p class="input-message fade-in error" hidden>Incorrect password</p>
              <!-- End of Input Message -->

            </div>
            <!-- End of Password / Input-Wrapper -->


            <!-- Login-Button / Input-Wrapper -->
            <div class="login-button input-wrapper vertical flex-layout">
              <!-- Login Button -->
              <!-- TODO: Use a `<button>` to submit the form -->
              <input id="loginButton" type="submit" value="Log In" />
            </div>
            <!-- End of Login-Button / Input-Wrapper -->
            
            
            <!-- Register Link -->
            <a class="register-link" title="Register / Sign Up" href="inscription.php">Create an account</a>

          </form>
          <!-- End of Login Form -->

        </div>
        <!-- End of Content - App Layout -->

        <!-- Nav Bar -->
        <nav class="nav-bar horizontal flex-layout center">
          <span class="divider horizontal top"></span>

          <!-- Home - Nav-Link -->
          <a title="Home" href="" class="nav-link">
            <span class="material-icons nav-icon">view_in_ar</span> <!-- UX: Use `home` instead -->
          </a>
          <!-- End of Home Nav-Link -->


          <span flex></span> <!-- HACK: Just a temp. fix :) -->
          
          <!-- App Logo -->
          <span class="app-logo"></span>
           
          <span flex></span> <!-- HACK: Just a temp. fix :) -->
          
          <!-- Profile - Nav-Link -->
          <a title="Profile" href="profil.php" class="nav-link">
            <span class="material-icons nav-icon">account_circle</span>
          </a>
          <!-- End of Profile Nav-Link -->

        </nav>
        <!-- End of Nav Bar -->
        
      </main>
      <!-- End of MAIN - App Layout -->

      <!-- Details Container | ASIDE -->
      <aside id="detailsContainer" class="vertical flex-layout centered">

        <!-- Divider @ Vertical Left -->
        <span class="divider vertical left"></span>

        <!-- Outlined App Logo -->
        <span class="app-logo" outlined></span>
        
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
