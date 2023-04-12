# PHP - Web Page
## Tom Sikora TD3
## Installation / Configuration
- `php -S localhost:8000` : Lancement du serveur interne.

- `php -S localhost:8000 -t public` : Option -t permet de désigner le répertoire comme racine des ressources.

- `php -d display_errors -S localhost:8000` : Retour rapide sur les erreurs d'écriture en PHP.

## Sommaire
- ✔️ 1. Versionnage du projet
- ✔️ 2. S'abstraire de la génération manuelle de la page Web
- ✔️ 3. Tests de votre classe
- ✔️ 4. Documentation du projet
- ✔️ 5. Utilisation de la classe WebPage
- ✖️ 6. Sujet complémentaire

## Structure du projet
___php-webpage/___ est le dossier racine du projet.
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ___autoload.php___ est un script de configuration de l'auto-chargement.
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ___phpunit.xml___ est un script de configuration de PHPUnit.
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ___README.md___ est un fichier qui résume les actions effectuées sur ce projet.
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ___public/___ est le dossier qui regroupe les fichiers permettant de retourner le code HTML.
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ___pageweb.php___ retourne le code HTML vers un site.
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ___src/___ est le dossier qui regroupe les fichiers permettant de retourner l'affichage graphique du code HTML.
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ___WebPage.php___ retourne l'affichage graphique du code HTML.
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ___tests/___ est le dossier qui regroupe les fichiers permettant de vérifier la bonne écriture du code HTML.
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ___WebPageHtmlOutputTest.php___ est un fichier qui vérifie l'affichage graphique du code HTML.
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ___WebPageTest.php___ est un fichier qui vérifie le code HTML.

## Mise en route
Pour lancer le serveur Web local (en partant du dossier racine du projet), il faut utiliser la commande :

`php -d display_errors -S localhost:8000 -t public/`

Le lien pour consulter le contenu est http://localhost:8000/.

<br>

## Tests
- Le lien vers le site de PHPUnit est https://phpunit.de/.
- La commande `phpunit --version` permet de vérifier la version de PHPUnit.
- La commande `phpunit` permet de lancer les tests du code HTML et des méthodes.