# fil-rouge-api

## Equipe Groupe 9
- Amandine Donat-filliod
- Kento Monthubert
- Thomas Evano
- Virgil Limongi
- Tristan Lemire

## Installation
* Suivre l'installation de la base de données -> https://github.com/TristanLemire/HETIC_filrouge_create_db
* Mettez-vous a la racine du projet et exécuter la commande : `composer install`
* Lancez l'api avec la commande : `./bin/console server:run`
* Vous pouvez maintenant aller sur http://127.0.0.1:8000

## liste des routes disponibles:

### Monuments
* `/monument` -> Retourne tous les monuments.
* `/monument/1` -> Retourne le monument qui a pour id `1`. 
* `/monument-dist-all/21/8000`-> Retourne le nombres de chaque points d'interets a `8000` metres du monument qui a pour id `21`
* `/monument-dist-all-choice/{id}/{distTrilibs}/{distElecs}/{distTrimobile}/{distVelibe}` ->Retourne le nombres de chaque points d'interets du monument qui a pour id `21`, mais vous pouvez choisir la distance pour chaque type de point d'interets.
* `/monument-all/21/8000`-> Retourne touts les points d'interets a `8000` metres du monument qui a pour id `21`
* `/monument-all-choice/{id}/{distTrilibs}/{distElecs}/{distTrimobile}/{distVelibe}` -> Retourne touts les points d'interets du monument qui a pour id `21`, mais vous pouvez choisir la distance pour chaque type de point d'interets.
*`/monument-all-dist/{dist}` ->  Retourne tous les monuments avec le nombre de point d'interet.
*`/monument-all-dist/{trilibDistParam}/{borneDistParam}/{trimobileDistParam}/{velibDistParam}` -> Retourne tous les monuments avec le nombre de point d'interet avec des distances pour chaque point d'interet.

### Déchets
* `/waste` -> Retourne tous les déchets.
* `/waste/1` -> Retourne le déchet qui a pour id `1`.

### Enregistrements Déchets
* `/records-waste` -> Retourne tous les enregistrements des déchets.
* `/records-waste/1` -> Retourne l'enregistrements de déchet qui a pour id `1`.
* `/records-waste-multiplicateur/2/false` -> Retourne tous les enregistrements des déchets multiplier pour `2` jours et pour la population de Paris (grace au `false`).
* `/records-waste-multiplicateur/14/true` -> Retourne tous les enregistrements des déchets multiplier pour `14` jours et pour la population Olympique (grace au `true`).
* `/records-waste-multiplicateur/3/false/1` -> Retourne l'enregistrements de déchet qui a pour id `1` multiplier pour `3` jours et pour la population de Paris (grace au `false`).
* `/records-waste-multiplicateur/4/true/5` -> Retourne l'enregistrements de déchet qui a pour id `5` multiplier pour `4` jours et pour la population Olympique (grace au `true`).

### Bornes électriques
* `/electricterminal` -> Retourne toutes les bornes électriques.
* `/electricterminal-dist` -> Retourne toutes les distances entre les bornes électriques et les monuments.
* `/electricterminal-dist/21` -> Retourne toutes les distances entre le monument qui a pour id `21` et toutes les bornes électriques.
* `/electricterminal-dist/21/5900` -> Retourne toutes les distances entre le monument qui a pour id `21` et les bornes électriques qui sont a moins de `5 900 mètres` du monument.

### Trilibs
* `/trilib` -> Retourne tous les trilibs.
* `/trilib-dist` -> Retourne toutes les distances entre les monuments et les trilibs.
* `/trilib-dist/21` -> Retourne toutes les distances entre le monument qui a pour id `21` et tous les trilibs.
* `/trilib-dist/21/9000` -> Retourne toutes les distances entre le monument qui a pour id `21` et les trilibs qui sont a moins de `9 000 mètres` du monument.

### Trimobiles
* `/trimobile` -> Retourne tous les trimobiles.
* `/trimobile-dist` -> Retourne toutes les distances entre les monuments et les trimobiles.
* `/trimobile-dist/21` -> Retourne toutes les distances entre le monument qui a pour id `21` et tous les trimobiles.
* `/trimobile-dist/21/6800` -> Retourne toutes les distances entre le monument qui a pour id `21` et les trimobiles qui sont a moins de `6 800 mètres` du monument.

### Velibs
* `/velib` -> Retourne tous les velibs.
* `/velib-dist` -> Retourne toutes les distances entre les monuments et les velibs.
* `/velib-dist/21` -> Retourne toutes les distances entre le monument qui a pour id `21` et tous les velibs.
* `/velib-dist/21/1000` -> Retourne toutes les distances entre le monument qui a pour id `21` et les velibs qui sont a moins de `1 000 mètres` du monument.

## Commandes utiles
* mapper sur la base de données -> `./bin/console doctrine:mapping:import "App\Entity" annotation --path=src/Entity`
* Créer une migration -> `./bin/console make:migration`
* Lancer une migration -> `./bin/console doctrine:migrations:migrate`
* Re-générer les getter et les setter -> `./bin/console make:entity --regenerate App`

