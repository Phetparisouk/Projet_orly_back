# Projet_orly_back
Back end du projet Orly (M1 php)

# Bienvenue au projet OrLit !!! Trouvez la destination de vos reves !

> Projet realise par Audrey LOPEZ-CORREIA, Phetparisouk SOUVANNASACD, Bernard HOUNKONNOU, Mohammed EL ASSOURI, Theo LAURENT

# Introduction
Veuillez mettre votre ceinture avant le decollage.
Le projet **Orly** est une application web ayant pour but de vous donner une liste de villes voyageable depuis l'aeroport Orly en fonction vos criteres choisis.


# Organisation

Vous trouverez ci-joint les 2 depots du projet :

 1. **[Backend](https://github.com/Phetparisouk/Projet_orly_back)**
 2. **[Frontend](https://github.com/Phetparisouk/Projet_orly_front)**


## Etapes a suivre

 1. Creer un repertoire projet 
 
 2. Cloner les 2 projets dans le repertoire avec la commande ;
	 -git clone https://github.com/Phetparisouk/Projet_orly_front.git
	 -git clone https://github.com/Phetparisouk/Projet_orly_back.git
	 
 3. Installer Composer dans le dossier Back.
 
 4. Activer XAMPP
 
 5. Ouvrez une console de commande et entrez les commandes suivantes 1 par 1 (toujours dans le dossier Back) ;
	-symfony console make:migration
	-symfony console doctrine:migration:migrate
	-symfony console server:run
 
 6. Installer [node](https://nodejs.org/en/) sur la machine si cela n'a pas encore ete fait.
 
 7. Ensuite deplacez-vous dans le dossier Front depuis la console de commande, et entrez les cmmande suivantes :
	 -npm install
	 -npm run serve
	 
 8. Lancez l'application depuis votre navigateur avec l'URL suivant : 
		http://localhost:8080
