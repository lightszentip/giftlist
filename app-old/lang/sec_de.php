<?php

/**
 * Please note: we can use unencoded characters like ö, é etc here as we use the html5 doctype with utf8 encoding
 * in the application's header (in views/_header.php). To add new languages simply copy this file,
 * and create a language switch in your root files.
 */

// login & registration classes
define("MESSAGE_ACCOUNT_NOT_ACTIVATED", "Dein Account ist noch nicht aktiviert. Bitte klicke auf den Best&auml;tigungslink in der Email.");
define("MESSAGE_CAPTCHA_WRONG", "Das Captcha war falsch.");
define("MESSAGE_COOKIE_INVALID", "Das Cookie ist invalide");
define("MESSAGE_DATABASE_ERROR", "Problem mit der Datenbank.");
define("MESSAGE_EMAIL_ALREADY_EXISTS", "Diese Email Adresse wird schon verwendet. Bitte verwende \"I forgot my password\" falls du dich nicht mehr an das Passwort erinnerst.");
define("MESSAGE_EMAIL_CHANGE_FAILED", "Entschuldige, das ändern deiner Email Adresse ist fehlgeschlagen.");
define("MESSAGE_EMAIL_CHANGED_SUCCESSFULLY", "Deine Email Adresse wurde erfolgreich geändert. Deine neue Email Adresse ist ");
define("MESSAGE_EMAIL_EMPTY", "Die Email Adresse darf nicht leer sein");
define("MESSAGE_EMAIL_INVALID", "Deine Email Adresse hat kein gültiges format");
define("MESSAGE_EMAIL_SAME_LIKE_OLD_ONE", "Entschuldige, diese Email Adresse ist die gleiche als die du gerade verwendest. Bitte verwende eine andere.");
define("MESSAGE_EMAIL_TOO_LONG", "Die Email Adresse darf nicht l&auml;nger als 64 Zeichen sein");
define("MESSAGE_LINK_PARAMETER_EMPTY", "Die Parameter sind leer.");
define("MESSAGE_LOGGED_OUT", "Du wurdest ausgeloggt.");
// The "login failed"-message is a security improved feedback that doesn't show a potential attacker if the user exists or not
define("MESSAGE_LOGIN_FAILED", "Login fehlgeschlagen.");
define("MESSAGE_OLD_PASSWORD_WRONG", "Dein altes Password war falsch.");
define("MESSAGE_PASSWORD_BAD_CONFIRM", "Die beiden Passwörter sind nicht die gleichen");
define("MESSAGE_PASSWORD_CHANGE_FAILED", "Entschuldinge, deine Password Änderung ist fehlgeschlagen.");
define("MESSAGE_PASSWORD_CHANGED_SUCCESSFULLY", "Das Passwort wurde erfolgreich geändert!");
define("MESSAGE_PASSWORD_EMPTY", "Das Passwort Feld war leer");
define("MESSAGE_PASSWORD_RESET_MAIL_FAILED", "Die Passwortreset Email wurde nicht erfolgreich versendet! Error: ");
define("MESSAGE_PASSWORD_RESET_MAIL_SUCCESSFULLY_SENT", "Die Passwort Reset Email wurde erfolgreich versendet!");
define("MESSAGE_PASSWORD_TOO_SHORT", "Das Passwort muss mindestens 6 Zeichen lang sein.");
define("MESSAGE_PASSWORD_WRONG", "Falsches Passwort. Versuche es erneut.");
define("MESSAGE_PASSWORD_WRONG_3_TIMES", "Du hast 3mal ein falsches Passwort eingegeben. Bitte warte 30 Sekunden bis du es erneut versuchst.");
define("MESSAGE_REGISTRATION_ACTIVATION_NOT_SUCCESSFUL", "Keine &Uuml;bereinstimmung mit den Parametern gefunden.");
define("MESSAGE_REGISTRATION_ACTIVATION_SUCCESSFUL", "Die Aktivierung war erfolgreich! Du kannst dich jetzt einloggen!");
define("MESSAGE_REGISTRATION_FAILED", "Deine Registrierung ist fehlgeschlagen. Bitte gehe zurück und versuche es erneut.");
define("MESSAGE_RESET_LINK_HAS_EXPIRED", "Dieser Link ist abgelaufen.");
define("MESSAGE_VERIFICATION_MAIL_ERROR", "Es konnte keine Aktivierungsmail verschickt werden. Der Account wurde nicht erstellt");
define("MESSAGE_VERIFICATION_MAIL_NOT_SENT", "Es konnte keine Aktivierungsmail verschickt werden! Error: ");
define("MESSAGE_VERIFICATION_MAIL_SENT", "Der Account wurde erfolgreich erstellt und eine email verschickt. Durch das klicken des Links in der Email wird der Account aktiviert.");
define("MESSAGE_USER_DOES_NOT_EXIST", "Der Benutzer exisitiert nicht.");
define("MESSAGE_USERNAME_BAD_LENGTH", "Der Benutzername muss zwischen 2 und 64 Zeichen lang sein.");
define("MESSAGE_USERNAME_CHANGE_FAILED", "Entschuldige, dein Benutzername konnte nicht geändert werden");
define("MESSAGE_USERNAME_CHANGED_SUCCESSFULLY", "Dein Benutzername wurde erfolgreich geändert. Der neue Benutzername ist ");
define("MESSAGE_USERNAME_EMPTY", "Benutzername war leer");
define("MESSAGE_USERNAME_EXISTS", "Entschuldige, dieser Benutzername wird schon verwendet. Bitte w&auml;le einen anderen.");
define("MESSAGE_USERNAME_INVALID", "Der Benutzername war nicht g&uuml;ltig. Nur a-Z und Nummern sind erlaubt, sowie 2 bis 64 Zeichen");
define("MESSAGE_USERNAME_SAME_LIKE_OLD_ONE", "Entschuldige, aber dieser Benutzername ist der gleiche wie der gerade verwendete. Bitte w&auml;hle einen anderen.");

// views
define("WORDING_BACK_TO_LOGIN", "Zur&uuml;ck zur Login Seite");
define("WORDING_CHANGE_EMAIL", "Email ändern");
define("WORDING_CHANGE_PASSWORD", "Passwort ändern");
define("WORDING_CHANGE_USERNAME", "Benutzername ändern");
define("WORDING_CURRENTLY", "currently");
define("WORDING_EDIT_USER_DATA", "Benutzerdaten ändern");
define("WORDING_EDIT_YOUR_CREDENTIALS", "Du bist eingeloggt und kannst deine Daten editieren");
define("WORDING_FORGOT_MY_PASSWORD", "Passwort vergessen");
define("WORDING_LOGIN", "Log in");
define("WORDING_LOGOUT", "Log out");
define("WORDING_NEW_EMAIL", "Neue Emailadresse");
define("WORDING_EMAIL", "Emailadresse");
define("WORDING_NEW_PASSWORD", "Neues Passwort");
define("WORDING_NEW_PASSWORD_REPEAT", "Neues Passwort wiederholen");
define("WORDING_NEW_USERNAME", "Neuer Benutzername (Der Benutzername darf nicht leer sein und muss die Zeichen azAZ09 enthalten, sowie zwischen 2 und 64 Zeichen lang sein)");
define("WORDING_OLD_PASSWORD", "Dein altes Passwort");
define("WORDING_PASSWORD", "Password");
define("WORDING_PROFILE_PICTURE", "Dein Profilbild (gravatar):");
define("WORDING_REGISTER", "Registrieren");
define("WORDING_REGISTER_NEW_ACCOUNT", "Neuen Account anlegen");
define("WORDING_REGISTRATION_CAPTCHA", "Bitte gebe die Zeichen ein");
define("WORDING_REGISTRATION_EMAIL", "Emailadresse (bitte verwende eine existierende Adresse, es wird ein Link zum aktivieren des Kontos verschickt)");
define("WORDING_REGISTRATION_PASSWORD", "Passwort (min. 6 Zeichen!)");
define("WORDING_REGISTRATION_PASSWORD_REPEAT", "Passwort wiederholen");
define("WORDING_REGISTRATION_USERNAME", "Benutzername (nur Buchstaben und Nummern, 2 bis 64 Zeichen)");
define("WORDING_REMEMBER_ME", "Eingeloggt bleiben (für 2 wochen)");
define("WORDING_REQUEST_PASSWORD_RESET", "Passwort reset. Bitte gebe deinen Benutzername ein und du erh&auml;lst eine Mail mit weiteren Informationen:");
define("WORDING_RESET_PASSWORD", "Resete mein Passwort");
define("WORDING_SUBMIT_NEW_PASSWORD", "Neues Passowrd speichern");
define("WORDING_USERNAME", "Benutzername");
define("WORDING_SUBMIT", "Speichern");
define("WORDING_YOU_ARE_LOGGED_IN_AS", "Du bist eingeloggt als ");
