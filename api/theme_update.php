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
* @name Theme Update - ddd
* @file api/theme_update.php
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
* @version: 0.0.1
* 
* Usage:
*   1-|> header('Location: api/theme_update.php?theme=dark&redirect=settings.php?view=theme');
*   
*   2-|> location.href =  '/module-connexion/api/theme_update.php?theme=dark&redirect=settings.php?view=theme';
*
* ============================
* IMPORTANT: A Web App without an API is like coffee without water :)
* ============================
*/


/*
* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
* MOTTO: I'll always do more 😜!!!
* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
*/

// start a session 
session_start();

// define the base constant variable
define('DIR_BASE', '../');

// get the value `theme` and `redirect` variables from GET,
// NOTE: Use an empty string if none found
$theme = htmlspecialchars(isset($_GET['theme']) ? $_GET['theme'] : '');
$redirect = htmlspecialchars(isset($_GET['redirect']) ? $_GET['redirect'] : '');


// TODO: Do some things with both `theme` and `redirect` variables ;)
// IDEA: 1. Save or insert them to a database ?
//       2. Check if `theme` is supported before proceeding ?


// DEBUG [4dbsmaster]: tell me about it :)
echo "theme => $theme <br>";
echo "redirect => " . $redirect . "<br>";

// if `theme` is not empty...
if (!empty($theme)) {
  // ...update the `theme` session variable
  $_SESSION['theme'] = $theme;


  // If the `redirect` variable is also not empty...
  if (!empty($redirect)) {
    // ...create a URL with the given `redirect` and new `theme` 
    // example: 'settings.php?view=theme&theme=fr&success=1'
    $url = DIR_BASE . $redirect . '&theme=' . $theme . '&success=1'; // <- TODO: create a function to neatly return this URL

    // DEBUG [4dbsmaster]: tell me about it :)
    echo "url => $url";
    
    // redirect the user to this `url`
    header('Location: ' . $url);
    exit(); // <- Let's be safe, and avoid any unwanted behavior #lol

  }

}


?>
