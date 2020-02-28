# fil-rouge-api

## 💪 Équipe Groupe 9 - Back

- Kento Monthubert
- Tristan Lemire

## 🐳 Installation Docker 🐳

- Clonez le projet
- Placez-vous à la racine du projet
- Créez un fichier `.env.local` à la racine du projet
- Copiez le contenu du fichier `.env` et collez le dans votre fichier `.env.local`
- Dans les blocs de commentaire `SAMPLE` décommentez la variable `DATABASE_URL` correspondant à `docker project`.
- Dans les blocs de commentaire `SAMPLE` décommentez la variable `CORS_ALLOW_ORIGIN` correspondant à `docker project`.
- Pour démarrer les containeurs -> `docker-compose up -d`
- Pour importer la base de données -> `docker container exec -i fil-rouge-mysql bash -c 'exec mysql -uroot -prootroot' < ./database/DB.sql`
- Rendez-vous sur `localhost:8001`
- Pour accéder à une route : `localhost:8001/index.php/{route}` (temporaire 🥵)

## 💻 Installation normale 💻

- Clonez le projet
- Placez-vous à la racine du projet
- Suivre l'installation de la base de données -> `https://github.com/TristanLemire/HETIC_filrouge_create_db`
- Mettez-vous à la racine du projet et exécutez la commande : `composer install`
- Créez un fichier `.env.local` à la racine du projet
- Copiez le contenu du fichier `.env` et collez le dans votre fichier `.env.local`
- Dans les blocs de commentaire `SAMPLE` décommentez la variable `DATABASE_URL` correspondant à `local project`.
- Modifiez votre `user` et votre `password` par rapport à votre configuration (`mysql://<user>:<password>@127.0.0.1:3306/filrouge`)
- Dans les blocs de commentaire `SAMPLE` décommentez la variable `CORS_ALLOW_ORIGIN` correspondant à `local project`.
- Lancez l'api avec la commande : `./bin/console server:run` ou `symfony serve -d`
- Vous pouvez maintenant aller sur `http://127.0.0.1:8000`

**Documentation de l'API : [ici !](https://greenparis.docs.apiary.io)**
**Twitter de projet: [ici !](https://twitter.com/MarvelousBot)**

## Liste des routes disponibles :

### 🏛️ Monuments

- `/monument` -> Retourne tous les monuments.

- `/monument/1` -> Retourne le monument qui a pour id `1`.

- `/monument-dist-all/20/8000`-> Retourne le nombre de chaque points d'intérêt à `8000` mètres du monument qui a pour id `20`.

- `/monument-dist-all-choice/{id}/{distTrilibs}/{distElecs}/{distTrimobile}/{distVelibe}` -> Retourne le nombre de chaque point d'intérêt du monument qui a pour id `20`, mais vous pouvez choisir la distance pour chaque type de point d'intérêt.

- `/monument-all/20/8000`-> Retourne tous les points d'intérêt à `8000` mètres du monument qui a pour id `20`.

- `/monument-all-choice/{id}/{distTrilibs}/{distElecs}/{distTrimobile}/{distVelibe}` -> Retourne tous les points d'intérêt du monument qui a pour id `20`, mais vous pouvez choisir la distance pour chaque type de point d'intérêt.

\*`/monument-all-dist/{dist}` -> Retourne tous les monuments avec le nombre de point d'intérêt.

\*`/monument-all-dist/{trilibDistParam}/{borneDistParam}/{trimobileDistParam}/{velibDistParam}` -> Retourne tous les monuments avec le nombre de point d'intérêt avec des distances pour chaque point d'intérêt.

### 🗑️ Déchets

- `/waste` -> Retourne tous les déchets.

- `/waste/1` -> Retourne le déchet qui a pour id `1`.

### 🚯 Enregistrements Déchets

- `/records-waste` -> Retourne tous les enregistrements des déchets.

- `/records-waste/1` -> Retourne l'enregistrements de déchet qui a pour id `1`.

- `/records-waste-multiplicateur/2/false` -> Retourne tous les enregistrements des déchets multipliés pour `2` jours et pour la population de Paris (grâce au `false`).

- `/records-waste-multiplicateur/14/true` -> Retourne tous les enregistrements des déchets multipliés pour `14` jours et pour la population Olympique (grâce au `true`).

- `/records-waste-multiplicateur/3/false/1` -> Retourne l'enregistrement de déchet qui a pour id `1` multiplié pour `3` jours et pour la population de Paris (grâce au `false`).

- `/records-waste-multiplicateur/4/true/5` -> Retourne l'enregistrement de déchet qui a pour id `5` multiplié pour `4` jours et pour la population Olympique (grâce au `true`).

### ⚡ Bornes électriques

- `/electricterminal` -> Retourne toutes les bornes électriques.

- `/electricterminal-dist` -> Retourne toutes les distances entre les bornes électriques et les monuments.

- `/electricterminal-dist/21` -> Retourne toutes les distances entre le monument qui a pour id `21` et toutes les bornes électriques.

- `/electricterminal-dist/21/5900` -> Retourne toutes les distances entre le monument qui a pour id `21` et les bornes électriques qui sont à moins de `5 900 mètres` du monument.

### 🚮 Trilibs

- `/trilib` -> Retourne tous les trilibs.

- `/trilib-dist` -> Retourne toutes les distances entre les monuments et les trilibs.

- `/trilib-dist/21` -> Retourne toutes les distances entre le monument qui a pour id `21` et tous les trilibs.

- `/trilib-dist/21/9000` -> Retourne toutes les distances entre le monument qui a pour id `21` et les trilibs qui sont à moins de `9 000 mètres` du monument.

- `/trilibs/{tabId}` -> retourne tout les trilibs si leurs id est dans le tableau `tabId`, exemple `/trilibs/1,4,10`retourne les trilibs qui ont pour id 1 4 et 10.

### 🚚 Trimobiles

- `/trimobile` -> Retourne tous les trimobiles.

- `/trimobile-dist` -> Retourne toutes les distances entre les monuments et les trimobiles.

- `/trimobile-dist/21` -> Retourne toutes les distances entre le monument qui a pour id `21` et tous les trimobiles.

- `/trimobile-dist/21/6800` -> Retourne toutes les distances entre le monument qui a pour id `21` et les trimobiles qui sont à moins de `6 800 mètres` du monument.

- `/trimobiles/{tabId}` -> retourne tout les trimobiles si leurs id est dans le tableau `tabId`, exemple `/trimobiles/1,4,10` retourne les trimobiles qui ont pour id 1 4 et 10.

### 🚲 Velibs

- `/velib` -> Retourne tous les velibs.

- `/velib-dist` -> Retourne toutes les distances entre les monuments et les velibs.

- `/velib-dist/21` -> Retourne toutes les distances entre le monument qui a pour id `21` et tous les velibs.

- `/velib-dist/21/1000` -> Retourne toutes les distances entre le monument qui a pour id `21` et les velibs qui sont à moins de `1 000 mètres` du monument.

### 🙎 Utilisateur

- `/user` -> Retourne tous les utilisateurs.

- `/user/1` -> Retourne l'utilisateur qui a pour id `1`.

### 🏆 Classement des pays

- `/country-ranking` -> Retourne le classement des pays par moyenne des participations.
- `/country-ranking-not-average` -> Retourne le classement des pays par nombre de participations.

### 🌍 Pays

- `/country` -> Retourne tous les pays.

- `/country/1` -> Retourne le pays qui a pour id `1`.

## 🙂 Commandes utiles 🙂

- Mapper sur la base de données -> `./bin/console doctrine:mapping:import "App\Entity" annotation --path=src/Entity`
- Créer une migration -> `./bin/console make:migration`
- Lancer une migration -> `./bin/console doctrine:migrations:migrate`
- Re-générer les `getter` et les `setter` -> `./bin/console make:entity --regenerate App`
