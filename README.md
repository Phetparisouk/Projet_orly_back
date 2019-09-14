# Projet_orly_back
Back end du projet Orly (M1 PHP)

## Bienvenue au projet OrLit !!! Trouvez la destination de vos reves ! et Dormez Riche !

> Projet realisé par 
> * **Audrey LOPES-CORREIA**
> * **Phetparisouk SOUVANNASACD**
>  * **Bernard HOUNKONNOU**
>  * **Mohammed EL ASSOURI** 
>  * **Theo LAURENT**

# Introduction
Veuillez mettre votre ceinture avant le décollage.
Le projet **Orly** est une application web ayant pour but de vous donner une liste de villes voyageable depuis l’aéroport Orly en fonction vos critères choisis.


# Organisation

Vous trouverez ci-joint les 2 dépôts du projet :

 1. **[Backend](https://github.com/Phetparisouk/Projet_orly_back)**
 2. **[Frontend](https://github.com/Phetparisouk/Projet_orly_front)**


## Étapes a suivre pour le projet

 1. Créer un répertoire projet 
 
 2. Cloner les 2 projets dans le repertoire avec la commande ;
	 * **git clone https://github.com/Phetparisouk/Projet_orly_front.git**
	 * **git clone https://github.com/Phetparisouk/Projet_orly_back.git**

## Étapes a suivre pour le projet

 3. Dans le dossier Back : composer install.
 
 4. Activer WAMP ou XAMPP
 
 5. Ouvrez une console de commande et entrez les commandes suivantes 1 par 1 (toujours dans le dossier Back) ;
	* **symfony console make:migration**
	* **symfony console doctrine:migration:migrate**
	
6. Enfin exécuter les script pour insérer des valeurs


7. Voila le back est pret a fonctionner :
	* **symfony console server:run**
