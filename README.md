# `module-connexion`
A school project to create a simple website with PHP &amp; SQL (via phpmyadmin) which includes **login**, **register** and **home** pages.

For this project, I decided to create a simple 3D creator page titled **ddd**. 

## Description 
> Original text in French: Vous décidez de créer un module de connexion permettant aux utilisateurs de créer leur compte, de se connecter et de modifier leurs informations. Pour commencer, créez votre base de données nommée “moduleconnexion” à l’aide de phpmyadmin. Dans cette bdd, créez une table “utilisateurs” qui contient les champs suivants : id, int, clé primaire et Auto Incrément; login, varchar de taille 255; prenom, varchar de taille 255; nom, varchar de taille 255; password, varchar de taille 255

You decide to create a login module allowing users to create their account, log in and modify their information. To start, create your **database** named "**moduleconnexion**" using **_phpmyadmin_**. In this database, create a "**users**" table which contains the fields
following:

- **id**, int, primary key and Auto Increment
- **login**, varchar of size 255
- **firstname**, varchar of size 255
- **name**, varchar of size 255
- **password**, varchar of size 255

## Requirements

These are a couple of the main requirements for this school project:

1. Create a user who will be able to access all the information. His login, first name, last name and password are “admin”.
2. A home page that presents your site (index.php)
3. A page containing a registration form (registration.php): The form must contain all the fields present in the “users” table (except “id”) + a password confirmation. As soon as a user fills out this form, the data is inserted into the database and the user is redirected to the login page.
4. A page containing a connection form (connection.php): The form must have two inputs: “login” and “password”. When the form is validated, if there is a user in db corresponding to this information, then the user is considered to be connected and one (or more) session variables are created.
5. A page allowing you to modify your profile (profil.php): This page has a form allowing the user to modify his information. This form is by default pre-filled with the information that is currently stored in the database.
6. An administration page (admin.php): This page is accessible ONLY for the “admin” user. It is used to list all the user information present in the database.


## Jobs
> MOTTO: I'll always do [**more**](#More) 😜

The official deadline of the jobs below - according to [intra](https://intra.laplateforme.io) - was **03-12-2022 at 06:14 A.M**. Here is a list of all the names and files (i.e. `html`, `php`, `css`, etc) to be submitted as well as their corresponding / current **status** for this job:

| No. | Name | File | Status |
|:----|:-----|:-----|:-------|
| 1 | *`Home - Page`* | **index.php** | Pending |
| 2 | *`Register - Page`* | **inscription.php** | Pending |
| 3 | *`Login - Page`* | **connexion.php** | Pending |
| 4 | *`Profile - Page`* | **profil.php** | Pending |
| 5 | *`Database - SQL`* | **moduleconnexion.sql** | Pending |

> NOTE: (\*) = still needs to be updated



## Structure

The folder & file structure of this project:
  
- [**assets**](./assets/)
- - [**logos**](./assets/logos/)
- - [**images**](./assets/images/)
- - ...
- - [**animations**](./assets/animations/)
- - * *fadein-animation.css*
- - * *slide-from-down-animation.css*
- - [**theme**](./assets/theme/)
- - * *color.css*
- - * *typography.css*
- - * *styles.css*
- - [**stylesheets**](./assets/stylesheets)
- - * *splash-screen-styles.css*
- - * *login-styles.css*
- - * *register-styles.css*
- - * *profile-styles.css*
- - * *login-styles.css*
- [**script**](./script/)
- - *app.js*
- ...
- LICENSE
- README.md
- manifest.json
- ...
- **index.php**
- **inscription.php**

> NOTE: This is just a snippet.


---

## Testing

| Browser | Version | Status | Date | Time
|:--------|:--------|:-------|:-----|:-----
| *`Brave`* | **1.45.127** | *Pending* | 28-11-2022 | 12:50
| *`Chrome`* | **-** | *Pending* | - | -
| *`Firefox`* | **-** | *Pending* | - | -
| *`Safari`* | **-** | *Pending* | - | -
| *`Opera`* | **-** | *Pending* | - | -
| *`Edge`* | **-** | *Pending* | - | -
| *`IE`* | **-** | *Pending* | - | -

> NOTE: *`IE`* = Internet Explorer = 👎🏽


## More 

These are some of the things I did or plan to do, in addition to this project's [job requirements](#Requirements):

| No. | Name | File | Status |
|:----|:-----|:-----|:-------|
| 1 | *`SplashScreen - Page`* | **splash-screen.php** | _*In progress*_ |
| 2 | *`Logout - Page`* | **logout.php** | Pending |
| 3 | *`Database - API`* | **database.php** | Pending |

> NOTE: There are a few we must have forgotten or not added yet, so I'll keep the above list updated obv. :)

## TODOs

- [ ] Create a project-specific logo 
- [ ] Add localization / internationalization (at least: **english** & **french**)
- [ ] Add mobile compatibility to all pages (i.e. make it responsive)
- [ ] Optimize all `.php` files
- [ ] Optimize all `.css` files
- [ ] Optimize all `.js` files
- [ ] Remove unnecessary comments
- [ ] Add screenshots


