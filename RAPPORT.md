# Rapport sur l'application de suivi de modules

## Schéma de fonctionnement

> ```mermaid
> graph TD;
>    A(Frontend) -- Requête HTTP --> B(Backend)
>    B -- Génère données aléatoires --> D(Générateur de données)
>    D -- Données aléatoires --> C(Base de données)
>    C -- Données --> B
>    B -- Données --> A
> ```

## Introduction
L'application de suivi de modules permet de surveiller en temps réel diverses métriques de différents modules. Ces métriques comprennent des données telles que la température, le nombre de passagers, la distance parcourue, etc.

## Fonctionnement
Lorsque l'utilisateur accède à l'application via l'interface utilisateur (Frontend), une requête HTTP est envoyée au Backend. Le Backend est responsable de la gestion des données et des opérations logiques de l'application.

### Génération des données
Avant que les données ne soient disponibles pour être récupérées, le Backend les génère aléatoirement à l'aide d'un générateur de données. Ces données simulées sont ensuite stockées dans une base de données.

### Récupération des données
Lorsqu'une demande est faite pour récupérer les données, le Backend interroge la base de données pour obtenir les données les plus récentes. Une fois récupérées, ces données sont envoyées à l'interface utilisateur pour affichage.

# Technologies utilisées
Voici l'inventaire des technologies utilisées dans l'application ```CaptionMe``` :

1. **Frontend :**
   - HTML, CSS, JavaScript pour la création de l'interface utilisateur.
   - Bibliothèque Chart.js pour la création de graphiques interactifs.
   - Bootstrap pour la mise en page et la conception réactive.
   
2. **Backend :**
   - PHP pour la logique côté serveur.
   - Framework ```Laravel``` pour la gestion des requêtes HTTP, l'interaction avec la base de données, et d'autres fonctionnalités.
   
3. **Base de données :**
   - MySQLpour stocker les données des modules.
   
4. **Autres outils :**
   - AJAX pour les requêtes asynchrones entre le frontend et le backend.

## Conclusion
L'application de suivi de modules offre une solution efficace pour surveiller et visualiser diverses métriques de manière centralisée. Grâce à son architecture modulaire, elle peut être facilement adaptée pour surveiller différents types de modules dans différents environnements.