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
* @name: App
* @type: script
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
*
* Example usage:
*   1-|> let cmApp = new ConnectionModuleApp('en', 'dark', PAGE_HOME);
*    -|>
*    -|> cmApp.installMediaQueryWatcher(460, _onMobileLayout, _onWideLayout);
*
*/


"use strict"; /* <- This keeps me on my toes, as it forces me to use all pre-defined variables 😅 */

/* > I'm so hungry 😭 ...
 * > Guess what I wanna eat right now ? [hint]: JS
 * > -
 * > -
 * > -
 * > JavaScript!!!, Yummy!!! 😛
 */

/* Allow me to eat some more JS please 🙏 */


// Define default constant variables
const LANG = 'en'; // <- default language. Other supported languages include 'fr'(French) and 'ru'(Russian) & 'es'(Spanish).
const THEME = 'dark'; // <- default theme. Other supported themes are 'light' & 'classic'
// main pages
const PAGE_HOME = 'index'; // <- default or home page of the App.
const PAGE_LOGIN = 'connexion';
const PAGE_REGISTER = 'inscription';
const PAGE_PROFILE = 'profil';
const PAGE_SETTINGS = 'settings';
const PAGE_SPLASH_SCREEN = 'splash-screen';

const EXT_PAGE = 'php'; // <- File extension of the above pages. Use 'html' for HTML Pages. 
// layouts
const LAYOUT_MOBILE = 'mobile';
const LAYOUT_LAPTOP = 'laptop';
// dialogs
const DIALOG_THEME = 'theme';
const DIALOG_TRANSLATE = 'translate';


// directories
const DIR_BASE = 'module-connexion'; // <- base
const DIR_API = 'api'; // <- api
// PHP files
const PHP_LANGUAGE_UPDATE = 'lang_update.php';
const PHP_THEME_UPDATE = 'theme_update.php';


// Create a `ConnectionModuleApp` class
// TODO: Rename this class to just `App` ?
class ConnectionModuleApp {
  
  // Define some constant variables
  

  // Define a constructor method that will 
  // be executed automatically when a new object (eg. cmApp) is created.

  /*
   * Constructor of ConnectionModuleApp class
   *
   * @param { String } lang - The language of the web App
   * @param { String } theme - The theme of the web App
   * @param { String } page - The default or home page of the web App
   */
  constructor(lang = 'en', theme = 'dark', page = 'index') {
    // Initialize public attributes
    this.lang = lang;
    this.theme = theme;
    this.page = page;

    // Initialize private attributes
    // this._lang = '';
    // this._theme = '';
    // this._page = '';
    this._supportedLayouts = ['mobile', 'laptop'];

  }




  /* >> Public Setters << */

  /**
   * Sets the value of `lang` in storage, if supported by browser.
   *
   * @param { String } value
   */
  set lang(value) {

    // Carefully set the local storage values with `lang` as item
    this._setLocalStorageItem('lang', value);
 
    // update the private language attributes(i.e. `_lang`) with the given `value`
    this._lang = value;
  }


  /**
   * Sets the value of `theme` in storage, if supported by browser.
   *
   * @param { String } value
   */
  set theme(value) {
    // Carefully set the local storage values with `theme` as item
    this._setLocalStorageItem('theme', value);
 
    // update the private language attributes(i.e. `_theme`) with the given `value`
    this._theme = value;   
  }


  /**
   * Sets the value of `page` in storage, if supported by browser.
   * 
   * @param { String } value
   */
  set page(value) {
    // Carefully set the local storage values with `page` as item
    this._setLocalStorageItem('page', value);
 
    // update the private language attributes(i.e. `_page`) with the given `value`
    this._page = value;
  }


  /**
   * Sets the `_layout` of cmApp to the given `value`
   *
   * @param { String } value
   */
  set currentLayout(value) {
    this._layout = value;
  }


  /* *>> END of Public Setters <<* */







  /* >> Public Getters << */ 

  /**
   * Returns the value of `lang` from the local storage (if possible)
   */
  get lang() {
    
    return this._browserSupportStorage ? localStorage.getItem('lang') : this._lang;
  }
 

  /**
   * Returns the value of `theme` from the local storage (if possible)
   */
  get theme() {
    
    return this._browserSupportStorage ? localStorage.getItem('theme') : this._theme;
  }

  /**
   * Returns the value of `page` from the local storage (if possible)
   */
  get page() {
    
    return this._browserSupportStorage ? localStorage.getItem('page') : this._page;
  }


  /**
   * Returns the current layout (eg. mobile or laptop) of the app. 
   *
   * @return { String } layout
   */
  get currentLayout() {
    return (typeof(this._layout) !== 'undefined') ? this._layout : "";
  }


  /**
   * Returns the dialogs view element
   *
   * @return { Element } dialogsView
   */
  get dialogsView() {
    return document.getElementById('dialogsContainer');
  }
  
  
  /**
   * Returns the done button of the current `page`.
   * NOTE: This element doesn't always exist in all pages, and if so will return `null`.
   *  
   * @return { Element } doneIconButtonEl
   *
   */
  get doneIconButtonEl() {
    return document.getElementById('doneIconButton');
  }

  /**
   * Returns the backdrop element
   *
   * @return { Element } backdropEl
   */
  get backdropEl() {
    return document.getElementById('backdrop');
  }


  /**
   * Returns the id of the currently opened dialog
   *
   * @return { String } 
   */
  get currentDialogId() {
    // get the list of currently opened dialog element as `openedDialog`
    let openDialogList = document.querySelector('.dialog:not([hidden])');
    return openDialogList[0] ? openDialogList[0].id.split('Dialog')[0] : '';
  }

  /* *>> END of Public Getter <<* */





  /* >> Public Methods << */
  

  /**
   * Updates the page of the web App.
   *
   * @param { String } page
   */
  updatePage(page) {
    // Set the `page` from localStorage to the given `page`
    this._setLocalStorageItem('page', page, true);
    // Update the private `_page` variable
    this._page = page;

    // do something after `page` has been updated.
  }

  
  /**
   * Updates the `lang` of the web App.
   *
   * @param { String } lang
   */
  updateLang(lang) {
    // Set the `lang` from localStorage to the given `lang`
    this._setLocalStorageItem('lang', lang, true);
    // Update the private `_lang` variable
    this._lang = lang;

    // do something after `lang` specifically has been update.
  }


  /**
   * Updates the `theme` of the web App.
   *
   * @param { String } theme
   */
  updateTheme(theme) {
    // Set the `theme` from localStorage to the given `theme`
    this._setLocalStorageItem('theme', theme, true);
    // Update the private `_theme` variable
    this._theme = theme;

    // do something after `theme` specifically has been update.
  }



  /**
   * Method used to install a media-query watcher.
   * This method listens for changes in the media-query result of the given `breakpoint`.
   *
   * Example:
   *
   *   let cmApp = new ConnectionModuleApp('fr');
   *   cmApp.installMediaQueryWatcher(460, _onNarrowLayout, _onWideLayout);
   *
   * @param { Number } breakpoint
   * @param { Function } narrowLayoutCallback
   * @param { Function } wideLayoutCallback
   */
  installMediaQueryWatcher(breakpoint, narrowLayoutCallback, wideLayoutCallback) {
    // Create a width media query with the given `breakpoint` as `widthMediaQuery`
    let widthMediaQuery = window.matchMedia(`(min-width: ${breakpoint}px)`);

    // Handle the media query matches
    this._handleMediaMatches(widthMediaQuery.matches, narrowLayoutCallback, wideLayoutCallback,  true);

    // Add a listener to `widthMediaQuery`
    widthMediaQuery.addListener((data) => {
      this._handleMediaMatches(data.matches, narrowLayoutCallback, wideLayoutCallback, false);

      // DEBUG [4dbsmaster]: tell me about it :)
      console.log(`\x1b[34m[installMediaQueryWatcher](2):\x1b[0m data => `, data);
    });


    // DEBUG [4dbsmaster]: tell me about it :)
    console.log(`\x1b[34m[installMediaQueryWatcher](1):\x1b[0m widthMediaQuery => `, widthMediaQuery);

  }

  /**
   * Method used to add event listeners to the given `page`.
   *
   * @param { String } page - A page from the `ConnectionModuleApp` 
   */
  addListenersByPage(page) {
    // Do nothing if there's no `page`
    if (typeof page == 'undefined') { return }

    switch (page) {
      case PAGE_HOME:
        // add listeners for the home page
        break;
      case PAGE_LOGIN:
        // add listeners for the login page
        break;
      case PAGE_REGISTER:
        // add listeners for the register page
        break;
      case PAGE_PROFILE:
        // add listeners for the profile page
        break;
      case PAGE_SETTINGS:
        // adding listeners for the settings page...

        // add language settings listeners
        this._addLanguageSettingsListeners();
        
        // add theme settings listeners
        this._addThemeSettingsListeners();
         
        break;
      case PAGE_SPLASH_SCREEN:
        // add listeners for the splash-screen page
        break;
    }
     
    // DEBUG [4dbsmaster]: tell me about it :)
    console.log(`\x1b[34m[addListenersPage]:\x1b[0m event listeners added for this page => `, page);

  }


 
 /**
  * Opens the dialog with the given `dialogId`
  *
  * @param { String } dialogId - without the 'Dialog' (i.e. 'translate' instead of 'translateDialog')
  */
 openDialogById(dialogId = '') { // <- HACK: not the best method

   // Get the dialog element as `dialogEl`
   let dialogEl = document.getElementById(`${dialogId}Dialog`);

   // DEBUG [4dbsmaster]: tell me about it :)
   console.log(`[openDialogById](1): dialogId => ${dialogId}`);
   console.log(`[openDialogById](2): dialogEl => `, dialogEl);

   // Do nothing if there's no dialog or no `dialogId`
   if (!dialogEl || !dialogId.length) { return }


   // Show the backdrop 
   // by setting the `hidden` attribute of `backdropEl` to `false`
   this.backdropEl.hidden = false;

   // Show the dialogs view 
   // by setting the `hidden` attribute of `dialogsView` to `false`
   this.dialogsView.hidden = false;
  
   // Now, show the dialog element
   dialogEl.hidden = false;

   // DEBUG [4dbsmaster]: tell me about it :)
   // console.log(`[openDialogById](3): dialogEl => `, dialogEl);
  

 }

 
 /**
  * Closes the dialog with the given `dialogId`
  *
  * @param { String } dialogId - withoud the trailing 'Dialog'.
  */
 closeDialogById(dialogId) {
   // Do nothing if there's no `dialogId`
   if (typeof(dialogId) === 'undefined') { return }

   // Get the dialog element as `dialogEl`
   let dialogEl = document.getElementById(`${dialogId}Dialog`);
    
   // Now, hide the dialog element
   // by setting the `hidden` attribute of `dialogEl` to `true`
   dialogEl.hidden = true;

   // Show the dialogs view 
   // by setting the `hidden` attribute of `dialogsView` to `true`
   this.dialogsView.hidden = true;

   // Hide the backdrop 
   // by setting the `hidden` attribute of `backdropEl` to `true`
   this.backdropEl.hidden = true;
 }



 /**
  * Method used to update the current layout with the given `layout`
  *
  * @param { String } layout - currently supported layouts are 'mobile' and 'laptop'
  */
 updateLayout(layout) {
   // DEBUG [4dbsmaster]: tell me about it :)
   console.log(`\x1b[33m[updateLayout]: layout => ${layout}\x1b[0m`);

   // Do nothing if the given layout is not supported
   if (!this._supportedLayouts.includes(layout)) { return }
  
   // Update the current layout with the given `layout`
   this.currentLayout = layout;
   // Notify the layout change
   this._notifyLayoutChange();
 }

 
 
  
  /* *>> END of Public Methods << */




  /* >> Private Methods << */

  /**
   * Handler that is called whenever the `<button id="moreTabButton">` element is clicked.
   *
   * @param { PointerEvent } event
   */
  _handleLanguageButtonClick(event) {

    // Toggling the drawer-opened attribute in <body>
    
    if (document.body.hasAttribute('drawer-opened')) {
      // ... remove the `drawer-opened` attribute
      document.body.removeAttribute('drawer-opened');

    }else {
      // ... add the 'drawer-opened' attribute
      document.body.setAttribute('drawer-opened', '');
    }


    // DEBUG [4dbsmaster]: tell me about it :)
    console.log(`%c[_handleLanguageButtonCick]: event => `, 'background:white;color:black;', event);
  }


  /**
   * Method only used to set the value of the given item in local storage, if it doesn't exist
   *
   * @param { Sring } item
   * @param { String } value 
   * @param { Boolean } update - If TRUE the current storage value of `item` will be overriden by the given `value`
   */
  _setLocalStorageItem(item, value, update = false) {

    // DEBUG [4dbsmaster]: tell me about it :)
    console.log(`\x1b[1m[_setLocalStorageItem](1):\x1b[0m item => ${item} & value => ${value}`);
    console.log(`\x1b[1m[_setLocalStorageItem](2):\x1b[0m this._browserSupportStorage => ${this._browserSupportStorage}`);

    // If the browser supports `Storage`...
    if (this._browserSupportStorage) {
      // ...get the current value of `item` from local storage as `currentValue`
      let currentValue = localStorage.getItem(item);
      
      // Do nothing if `update` is `false` and there's already a current value
      if (!update && currentValue !== null) { return }
      
      // Else, continue and set the item in `Storage` w/ the given `value`
      localStorage.setItem(item, value);
      
      // DEBUG [4dbsmaster]: tell me about it :)
      console.log(`\x1b[32[_setLocalStorageItem](3):\x1b[0m item has been set in local storage`, localStorage);

    }

  }


  /**
   * Method used to handle the media query `matches`
   *
   * @param { Boolean } matches
   * @param { Function } narrowLayoutCallback
   * @param { Function } wideLayoutCallback
   * @param { Boolean } firstQuery
   */
  _handleMediaMatches(matches, narrowLayoutCallback, wideLayoutCallback, firstQuery) {

      // if the data matches (ie. width is more than the breakpoint)...
      if (matches) {
       
        // if theres a wide layout callback or function...
        if (typeof(wideLayoutCallback) == 'function') {
          // run the wide layout callback function w/ the query data
          wideLayoutCallback(firstQuery);
        }
        
        // DEBUG [4dbsmaster]: tell me about it :)
        console.log(`\x1b[35m[_handleMediaMatches](1):\x1b[0m \
          typeof(wideLayoutCallback) => ${typeof(wideLayoutCallback)}`);

      } else {
        // if theres a narrow layout callback or function...
        if (typeof(narrowLayoutCallback) == 'function') {
          // run the narrow layout callback function w/ the query data
          narrowLayoutCallback(firstQuery);
        }

        // DEBUG [4dbsmaster]: tell me about it :)
        console.log(`\x1b[35m[_handleMediaMatches](2):\x1b[0m \
          typeof(narrowLayoutCallback) => ${typeof(narrowLayoutCallback)}`);

      }
      
      // DEBUG [4dbsmaster]: tell me about it :)
      console.log(`\x1b[35m[_handleMediaMatches](3):\x1b[0m firstQuery => ${firstQuery}`);
  }

  
  /**
   * Method used to notify the app of a layout change
   * NOTE: This method updates the `isMobile` and `isLaptop` 
   *       values according to the `currentLayout` value
   */
  _notifyLayoutChange() {
    // If the `currentLayout` is  `mobile`, set `isMobile` to `true`
    this.isMobile = (this.currentLayout == LAYOUT_MOBILE) ? true : false;
    // If the `currentLayout` is  `laptop`, set `isMobile` to `true`
    this.isLaptop = (this.currentLayout == LAYOUT_LAPTOP) ? true : false;

    // TODO: Dispatch a custom event (named 'on-layout-change' ?)

    // DEBUG [4dbsmaster]: tell me about it :)
    console.log(`\x1b[36m[_notifyLayoutChange](1): currentLayout => ${this.currentLayout}\x1b[0m`);
    console.log(`\x1b[36m[_notifyLayoutChange](2): isMobile ? ${this.isMobile}\x1b[0m`);
    console.log(`\x1b[36m[_notifyLayoutChange](3): isLaptop ? ${this.isLaptop}\x1b[0m`);
  }

  
  
  /**
   * Method used to add or install listeners for `lang` view of the settings page.
   */
  _addLanguageSettingsListeners() {

      // Do nothing if there's no 'lang' in the location's search
      if (!location.search.includes('lang')) { return }
      
      // Get a list of all the buttons with `.language` class
      let languageButtons = document.querySelectorAll('button.language');
      
      // For each button element as `buttonEl` in `languageButtons`...
      languageButtons.forEach(buttonEl => {
        // ... Use the `_languageButtonClickHandler()` function to the handle any 
        // 'click' pointer event fired or dispatched by the `buttonEl`
        buttonEl.addEventListener('click', (event) => this._languageButtonClickHandler(event));
      });
      
      // DEBUG [4dbsmaster]: tell me about it :)
      // console.log(`\x1b[32m[_addLanguageSettingsListeners]: location.search => ${location.search} & languageButtons => \x1b[0m `, languageButtons);

      // If there's a done icon button ...
      if (this.doneIconButtonEl) {
        // ...handle the 'click' events of the DONE icon-button element:
        // So, Whenever the `doneIconButtonEl` is clicked...
        this.doneIconButtonEl.onclick = (event) => {
          // .. get this done icon button element as `el`
          let el = event.target;

          // get the value of `lang` attribute from `el`
          let lang = el.getAttribute('lang');

          // update the language of this app
          this.updateLang(lang);
          

          // For redundancy purposes, update the `lang` and `redirect` values of PHP's global SESSION variable,
          // by passing `lang` to the `lang_update.php` file in the `api/` folder via the `GET` method 
          //
          // Example: 
          //    `api/lang_update.php?lang=en&redirect=settings.php?view=lang`

          // create seperately the search string for location as `searchStr`
          let searchStr = `?lang=${lang}&redirect=${PAGE_SETTINGS}.php?view=lang`;
          
          // create the URL to the `lang_update.php` api with `searchStr`
          let url = `${DIR_API}/${PHP_LANGUAGE_UPDATE}` + searchStr;
           
          // Update the `lang` on the server-side of things (i.e. PHP) by redirecting to `url`
          location.href = url;

          // DEBUG [4dbsmaster]: tell me about it :)
          console.log(`\x1b[32m[_addLanguageSettingsListeners] (PAGE_SETTINGS|1): lang => ${lang} & \
            url => ${url} & el => \x1b[0m`, el);

        };

        // DEBUG[4dbsmaster]: tell me about it :)
        console.log(`\x1b[32m[_addLanguageSettingsListeners] (PAGE_SETTINGS|2): this.doneIconButtonEl =>  \x1b[0m`, 
          this.doneIconButtonEl);
      } // <- end of `this.doneIconButtonEl.onclick` event handler
      
      // DEBUG [4dbsmaster]: tell me about it :)
      console.log(`\x1b[32m[_addLanguageSettingsListeners] (PAGE_SETTINGS|3): language buttons => \x1b[0m`, 
        languageButtons);

  }

  
  /**
   * Handler that is called whenever the `<button class='language'>` is clicked.
   * NOTE: The button elements are located in the "settings?view=lang" page.
   *  
   * @param { PointerEvent } event
   */
  _languageButtonClickHandler(event) {
    // get the language button element as `languageButtonEl`
    let languageButtonEl = event.currentTarget;
    // get the value of `lang` attribute from `languageButtonEl` as `langId`
    let langId = languageButtonEl.getAttribute('lang');
    // Set the old & new langs / languages to `this.lang` and `langId` respectively
    let oldLang = this.lang;
    let newLang = langId;

    // Check if the language button is selected or has the `selected` attribute,
    // using our beloved ternary statment ;)
    let isSelected = languageButtonEl.hasAttribute('selected') ? true : false;

    
    // if this button has not yet been selected...
    if (!isSelected) {
      // ...get the currently selected language button element 
      // from the languages page as `selectedLanguageButtonEl`
      let selectedLanguageButtonEl = document.querySelector('button.language[selected]');
      // unselect it or remove its `selected` attribute
      selectedLanguageButtonEl.removeAttribute('selected');

      // Now, select this language button by adding a `selected` attribute to `languageButtonEl`
      languageButtonEl.setAttribute('selected', '');
    }


    if (!this.doneIconButtonEl) { return } // <- At this point, We don't wanna do anything else, if there's no done button 
    
    // update the `doneIconButtonEl`'s value of `lang` attribute to the new lang (i.e. newLang)
    this.doneIconButtonEl.setAttribute('lang', newLang);
    // disable the `doneIconButtonEl` only if `oldLang` is the same as `newLang`
    this.doneIconButtonEl.disabled = (oldLang == newLang) ? true : false;
             
    // DEBUG [4dbsmaster]: tell me about it :)
    console.log(`\x1b[36m[_languageButtonClickHandler](1): oldLang => ${oldLang} & newLang => ${newLang} \x1b[0m`, self);
    // console.log(`\x1b[36m[_languageButtonClickHandler](2): languageButtonEl => \x1b[0m`, languageButtonEl);
    // console.log(`\x1b[36m[_languageButtonClickHandler](3): event => \x1b[0m`, event);
    console.log(`\x1b[36m[_languageButtonClickHandler](4): isSelected ? ${isSelected}`);
  }


  /**
   * Method used to add or install listeners for `theme` view of the settings page.
   */
  _addThemeSettingsListeners() {
    // Do nothing if there's no 'theme' in the location's search
    if (!location.search.includes('theme')) { return }

    // Get a list of all the buttons in `ul.themes` as `themeButtons`
    let themeButtons = document.querySelectorAll('ul.themes button');
    
    // For each button element as `buttonEl` in `themeButtons`...
    themeButtons.forEach(buttonEl => {
      // ... Use the `_themeButtonClickHandler()` function to the handle any 
      // 'click' pointer event fired or dispatched by the `buttonEl`
      buttonEl.addEventListener('click', (event) => this._themeButtonClickHandler(event));
    });

  }


  /**
   * Handler that is called whenever a button (eg. `<button theme='light'>`) is clicked.
   * NOTE: The button elements are located in the "settings?view=theme" page.
   * 
   * @param { PointerEvent } event
   */
  _themeButtonClickHandler(event) {
    // get the theme button element as `themeButtonEl`
    let themeButtonEl = event.currentTarget;
    // get the value of `theme` attribute from `themeButtonEl`
    let theme = themeButtonEl.getAttribute('theme');
    

    // Check if the theme button is selected or has the `selected` attribute,
    // using our beloved ternary statement ;)
    let isSelected = themeButtonEl.hasAttribute('selected') ? true : false;

   
    // Do nothing if the button is already selected
    if (isSelected) { return }

    // DEBUG [4dbsmaster]: tell me about it :)
    // console.log(`\x1b[37m[_themeButtonclickHandler]: isSelected ? ${isSelected}  \x1b[0m`);

    // ...get the currently selected theme button element 
    // from the  page as `selectedThemeButtonEl` 
    let selectedThemeButtonEl = document.querySelector('ul.themes button[selected]');
    // unselect it or remove its `selected` attribute
    selectedThemeButtonEl.removeAttribute('selected');

    // Now, select this `themeButtonEl` by adding a `selected` attribute
    themeButtonEl.setAttribute('selected', '');

    // update the theme of this app
    this.updateTheme(theme);
    
    // For redundancy purposes, update the `theme` and `redirect` values of PHP's global SESSION variable,
    // by passing `theme` to the `theme_update.php` file in the `api/` folder via the `GET` method 
    //
    // Example: 
    //    `api/theme_update.php?theme=dark&redirect=settings.php?view=theme`

    // create seperately the search string for location as `searchStr`
    let searchStr = `?theme=${theme}&redirect=${PAGE_SETTINGS}.php?view=theme`;
    
    // create the URL to the `theme_update.php` api with `searchStr`
    let url = `${DIR_API}/${PHP_THEME_UPDATE}` + searchStr;
     
    // Update the `lang` on the server-side of things (i.e. PHP) by redirecting to `url`
    location.href = url;
 
    // DEBUG [4dbsmaster]: tell me about it :)
    console.log(`\x1b[35m[_themeButtonClickHandler] (PAGE_SETTINGS|1): theme => ${theme} & themeButtonEl =>`, themeButtonEl);
   
  }



  /* *>> END of Private Methods << */







  /* >> Private Setters << */

  /* *>> End of Private Setters <<* */





  /* >> Private Getters << */

  /* 
   * Returns `true` if the browser supports `Storage`
   *
   * @returns { Boolean } 
   */
  get _browserSupportStorage() {
    return (typeof(Storage) !== 'undefined') ? true : false;
  }

  /* *>> END of Private Getters <<* */


};

// END of ConnectionModuleApp class






/* Okay, thanks!! Now let's wait again for the page to load by listening to the `load` event */
/* When the current page is done loading... */
window.addEventListener('load', (event) => {
  // ...create an object of the ConnectionModuleApp class as `cmApp` (a global variable)
  window.cmApp = new ConnectionModuleApp(LANG, THEME, PAGE_HOME);
  // Install Media Query Watcher with a "460px" breakpoint
  window.cmApp.installMediaQueryWatcher(460, _onMobileLayout, _onWideLayout);

  // NOTE2ME: You can add some listeners here
  
  // If the `ddd` object has already been defined...
  // Most likely from the home page (i.e. `index.php`)
  if (typeof ddd === 'object') {
    // ...get the page from `ddd` as `currentPage`
    let currentPage = ddd.page;

    // update the app's page with `currentPage`
    window.cmApp.updatePage(currentPage);
    
    // Now, add the listeners of this `currentPage`
    window.cmApp.addListenersByPage(currentPage);

    // DEBUG [4dbsmaster]: tell me about it :)
    console.log(`[load]: currentPage => ${currentPage}`);
     
    // ...override the `onReady()` function here
    ddd.onReady = () => {
      // DEBUG [4dbsmaster]: tell me about it :)
      console.log(`\x1b[36m[ddd.onReady]: WE ARE READY !!!\x1b[0m`);
      
      // NOTE2ME: Your can add some more listeners here, or do something else. It's up to #moi ;)

    };

  }

   
  /* DEBUG [4dbsmaster]: tell me about it :) */
  //console.log(`[load](1): window.cmApp => `, window.cmApp);
  // console.log(`[load](1): PATH_NAME => ${PATH_NAME}`);
  // console.log(`[load](2): HOSTNAME => ${HOST_NAME}`);

});


/**
 * Handler that is called whenever the window is resized to a mobile layout
 *
 * @param { Boolean } firstQuery
 */
let _onMobileLayout = (firstQuery) => {

  // Update the layout w/ `LAYOUT_MOBILE`
  window.cmApp.updateLayout(LAYOUT_MOBILE); // <- TODO: Insert this into ConnectionModuleApp class
  
  // TODO: Do something else here whenever the layout switches or changes to `narrow` (i.e. mobile)
  
  // DEBUG [4dbsmaster]: tell me about it :)
  console.log(`\x1b[32m[_onMobileLayout]:\x1b[0m firstQuery => ${firstQuery}`);
};


/**
 * Handler that is called whenever the window is resized to a wide layout
 * 
 * @param { Boolean } firstQuery
 */
let _onWideLayout = (firstQuery) => {
  // Update the layout w/ `LAYOUT_LAPTOP`
  window.cmApp.updateLayout(LAYOUT_LAPTOP); // <- TODO: Insert this into ConnectionModuleApp class
  
  // TODO: Do something else here whenever the layout switches or changes to `wide` (i.e. laptop)
  
  // DEBUG [4dbsmaster]: tell me about it :)
  console.log(`\x1b[31m[_onWideLayout]:\x1b[0m firstQuery => ${firstQuery}`);
};


