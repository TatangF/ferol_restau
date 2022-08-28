# ferol_restau
L’application ferol_restau est-une application web qui représente les menus, vins et autres d’un restaurant nommé RESTAURANT PREMIER, 

elle est faite en langage Web Backend php5 et Frontend html+ le framework css Bootstrap qui prend les liens cdn (en ligne, mode connecté) ou SCSS (non connecté) et les librairies javascript de bootstrap sont importées. C’est une application faite en SPA (Single Page Application): toutes les fonctionnalités sont représentées sur la page d’accueil.

i.	Fonctionnement

Pour le fonctionnement de l’application ferol_restau: tout d’abord 
	copier le dossier ferol_restau dans le disque C; C:\xampp\htdocs, 

	Démarrer xampp ainsi que les serveurs :
	Base de données MySQL (start MySQL) et Web Apache (start apache)

	Créer et importer la base de données food-order dans phpMyAdmin.
	Ouvrir un onglet du navigateur et lancer l’application en local: 
	localhost/ferol_restau: 		
•	la page principale (index.php) s’affiche on y voit le menu de navigation (lien vers les pages de l’appli) vers les différentes pages de l’application web. 

Fonctionnalités de chaque page de l’application. 
	Le lien Home affiche tous les éléments du site sur une page 
	Le lien About (lien vers about.php) donne une description globale du restaurant
	La page categories présente les différents menus du restaurant stockés dans la table tbl_category
	La page menu (lien vers menu.php) affiche les différents menus de la table tbl_food
	La page contact (lien vers contact.php) elle permet aux utilisateurs et visiteurs de faire des posts sur l’appli web, ces posts sont stockés dans la table « message »
	La page Login permet aux utilisateurs de se connecter (s’ils sont enregistrés dans la table users) ou s’inscrire lien vers register.php au cas contraire  
