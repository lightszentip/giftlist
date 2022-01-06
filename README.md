# Presentlist / Geschenkeliste #
![Libraries.io dependency status for GitHub repo](https://img.shields.io/librariesio/github/lightszentip/giftlist?style=for-the-badge)
![GitHub](https://img.shields.io/github/license/lightszentip/giftlist?style=for-the-badge)
![GitHub release (latest SemVer including pre-releases)](https://img.shields.io/github/v/release/lightszentip/giftlist?include_prereleases&style=for-the-badge)
![GitHub release (latest SemVer)](https://img.shields.io/github/v/release/lightszentip/giftlist?style=for-the-badge)
## Installation
### Installation over Release Zip

* unzip
* set www root to public/
* run install_sql.sql on your database
* create .env file in the root dir and set the settings

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


## Requirements ##

- PHP 5.3.7 oder höher
- MySQL Datenbank (andere sind aktuell nur durch bearbeiten der Sources möglich)
- PHP PDO Support für MySQL aktiv (extension=php_pdo_mysql.dll)


## Anleitung ##

Die Zip Datei im gewüschten Ordner entpacken und die Url zum Ordner aufrufen. Danach wird man auf den Install Wizard weitergeleitet. Nach dem ausführen des Install Wizard den setup Ordner löschen. Danach sich anmelden und das Passwort und die Email Adresse des Admin Benutzers ändern. Durch das Ändern des Benutzernamens wird zudem die Sicherheit erhöht.

Bei Fragen/Problemen/Erweiterungen und Feedback stehe ich gerne zur Verfügung. Entweder per Email oder durch erstellen eines Issues.

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


## Requirements ##

- PHP 7.4 or higher
- MySQL Database (other database only support by you edit the source files)
- PHP PDO Support for MySQL active (extension=php_pdo_mysql.dll)


## Instructions ##

Unpack the zip file to the target dir and open the url in your browser. Follow the steps of install wizard. Delete the setup folder and change the password and email address of  admin account.

If you have a question, problems or feedback then you can send a mail or create a new issue.
