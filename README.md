<p align="center"><a href="https://github.com/darkTravus/WeBreathe-WebTest.git" target="_blank"><img src="https://cdn.pixabay.com/photo/2023/04/04/15/11/logo-7899578_1280.png" width="400" alt="Laravel Logo"></a></p>

<h1 align="center" style="color: black;">CaptionMe</h1>





## Comment bien lancer le projet

#### Inventaire des commandes Laravel

1. **Création de la base de données**
   ```bash
   php artisan create-database
   ```
   Crée tout simplement la base de données 🙂.
---
2. **Migration de la base de données :**
   ```bash
   php artisan migrate
   ```
   Crée les différentes tables de la BDD.
   > **NOTE**
   > Assurez-vous que la configuration de la base de données dans le fichier `.env` est correcte, en particulier la base de données nommée [webreathe_modules](./.env).
---
3. **Remplir les différentes tables**
   ```bash
    php artisan db:seed --class=CategoriesTableSeeder
    php artisan db:seed --class=EntitiesTableSeeder
    php artisan db:seed --class=ModulesTableSeeder
   ```
   Cela permettra de peuplé les tables de votre BDD
---
4. **Lancement du serveur local :**
   ```bash
   php artisan serve
   ```
   Lancement du serveur à l'adresse suivante : [http://localhost:8000](http://localhost:8000).
---
4. **Génération aléatoire des données :**
   ```bash
   php artisan schedule:work
   ```
   La toute dernière commande qui permettra de générer les données des différents modules
   > **NOTE**
   > Un module ne génère pas de données s'il n'est pas ```Operationaly``` (Opérationnel en français).