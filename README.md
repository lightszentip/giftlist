# Presentlist / Geschenkeliste #
![Libraries.io dependency status for GitHub repo](https://img.shields.io/librariesio/github/lightszentip/giftlist?style=for-the-badge)
![GitHub](https://img.shields.io/github/license/lightszentip/giftlist?style=for-the-badge)
![GitHub release (latest SemVer including pre-releases)](https://img.shields.io/github/v/release/lightszentip/giftlist?include_prereleases&style=for-the-badge)
![GitHub release (latest SemVer)](https://img.shields.io/github/v/release/lightszentip/giftlist?style=for-the-badge)[![SL Scan](https://github.com/lightszentip/giftlist/actions/workflows/shiftleft.yml/badge.svg?branch=main)](https://github.com/lightszentip/giftlist/actions/workflows/shiftleft.yml)
## Installation
### Installation over Release Zip

* Download https://github.com/lightszentip/giftlist/releases/tag/1.0.4 giftlist-main.zip
* unzip in your nginx/apache folder
* set www root to public/
    * nginx: https://www.digitalocean.com/community/tutorials/how-to-install-and-configure-laravel-with-nginx-on-ubuntu-20-04#step-5-setting-up-nginx
    * apache: https://www.hostinger.com/tutorials/how-to-install-laravel-on-ubuntu-18-04-with-apache-and-php/#Using_Laravel_to_Deploy_an_Application
* create .env file in the root dir and set the settings
````shell
php artisan key:generate
php artisan migrate
php artisan db:seed
````

#### Upgrade

* unzip to new/
* replace all files from new or delete and insert all files from new (exclude .env)
* run:
````shell
php artisan migrate
php artisan db:seed
````

### Setup over repo

* clone the repository
* create .env file in the root dir and set the settings
* ```composer update```
* ```npm install```
* ```npm run dev```
* start with ```php artisan server``` or set your www root to public
* install db with ```php artisan migrate```


#### To create default user and permission

````shell
php artisan db:seed
````

#### Upgrade

* git pull
* ```composer update```
* ```npm install```
* ```npm run dev```
````shell
php artisan migrate
php artisan db:seed
````

## Settings

````shell
PRESENTLIST_MAIL_FROM_EMAIL=foobar@xyz.com
PRESENTLIST_MAIL_TITLE=Presentlist
PRESENTLIST_MAIL_FROM_NAME=FOO Bar
PRESENTLIST_CODE=CODE #If you want a auto generate code instead of save user email address to have a link present to user
````

### USER

For first login:
username: noreply@pleasereplacethisdomainemail.com
pw: secret

__HINT:__ Please change the password and user email adress

## Other
http://lightszentip.github.io/giftlist/

=> !! For English => english is under german !!

Presentlist ist eine Geschenkliste auf der man seine Wünsche zur Hochzeit, Geburtstag oder anderen Anlässen auflisten kann. Dabei kann man einen Titel, Beschreibung und auch ein Bild zum Geschnenk angeben, sowie Links zu Händlern oder dem Produkt angeben. Wenn sich dann jemand ein Geschenk von der Liste nimmt, ist es für die anderen nicht mehr sichtbar. Man kann gewählte Geschenke aber auch wieder freigeben und der Administrator sieht nicht wer sich welches Geschenk genommen hat. 

![](https://raw.github.com/lightszentip/giftlist/gh-pages/screenshot03.PNG)
![](https://raw.github.com/lightszentip/giftlist/gh-pages/screenshot04.PNG)

## Funktionen ##
- Geschenkeliste
- Detail Ansicht von Geschenken
- Geschenk auswählen
- Geschenk freigeben
- Geschenk per Mail teilen
- Backend
	- Geschenk anlegen / editieren / löschen
	- Benutzer anlegen
	- Profil editieren
	- Passwort vergessen
	- Login / Logout
	- Wartungsmodus aktivieren
	- Einstellungen ändern

## English ##

The app presentlist is show the wishes from wedding, birthday or from other occasions. You can create a present with a title, description, image and links. If a user take a present from the list, it is not visible for other user.

## Functions ##
- list with presents
- detail view of present
- use a present
- release a gift
- Backend
	- create, edit, delete a present
	- create user
	- edit profile
	- forgotten password
	- Login / Logout
	- maintenance mode
	- change settings


## Instructions ##

Unpack the zip file to the target dir and open the url in your browser. Follow the steps of install wizard. Delete the setup folder and change the password and email address of  admin account.

If you have a question, problems or feedback then you can send a mail or create a new issue.
