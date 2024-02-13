# Guide d'utilisation du framework

Ce petit framework php a été développé dans un cadre scolaire. L'objectif est de pouvoir proposer des fonctionnalités simples pour le développement d'un application web en php

## Table des matières

- [Prérequis](#les-prérequis)
- [Configuration du projet](#setup-du-projet)
- [Développement](#commencer-le-développement)
- [Ajout d'une route](#ajouter-une-route)
- [Retour d'une vue](#retourner-une-vue)
- [Utilisation des repositories](#utilisation-des-repositories)
- [Utilisation de l'entity manager](#utilisation-de-lentity-manager)
- [Sécurité avec un jeton CSRF](#ajouter-la-sécurité-avec-un-jeton-csrf)
- [Exécution des migrations](#exécuter-les-migrations)
- [Ajout du CSS et du JS](#ajouter-du-css-et-du-js)

## Les prérequis :

- Docker
- Makefile (natif sur mac et linux)


## Setup du projet

- Lancer le script ./bin/init.sh
- Lancer l'application sur le navigateur :

        localhost:8080 pour du http

        localhost:8443 pour du https

## Commencer le développement

Le framework 3i-frame fonctionne avec l'architecture MVC (Modèle Vue Contrôleur).

Pour développer une fonctionnalité vous pouvez créer une entité dans le dossier ```src/Entity``` puis créer un contrôleur dans le dossier ```src/Controller```. Chaque nouveau contrôleur doit hériter de la classe ```AbstractController```.

Pour les vues qui sont rattachées aux controleurs, elle sont situées dans ```templates/```

Par défaut, nous avons créé un autoloading personnalisé qui charge les classes situées dans ```src/``` avec le namespace ```App\```.

Tous les fichiers propores au fonctionnement métier du framework sont situés dans le dossier ```lib/```.

## Ajouter une route

Ce framework fonctionne avec un sytème de route. Le router est situé dans le dossier ```lib/Router```. Pour ajouter une route vous devez suivre les étapes suivantes :

- Se rendre dans le fichier : ```config/routes.json```
- Ajouter votre route avec la structure suivante :

```json
"url" => {
    "controller" : "namespace du controller",
    "method" : "nom de la méthode",
    "name" : "nom de la route"
}
```
## Retourner une vue

Pour afficher le contenu d'une vue, vous devez utiliser la fonction ```renderView()``` présente dans chaque contrôleurs. Voici un exemple d'utilisation :

```php
$this->renderView('nom de la vue', [tableau des paramètres]);
```

## Utilisation des repositories

Lorsque vous créez une entité, vous avez la possibilité de créer un repository associé à cette entité. Les repositories sont dans le dossier ```src/Repository```. Le repository crée devra hérité de la classe ```BaseRepository```.

## Utilisation de l'entity manager

Dans chaque contrôleur une instance de l'entité manager est disponible en faisant ```$this->em```.

Avec cette entité manager vous pouvez construire le repository de l'entité recherchée en faisant ```$this->em->getRepository(Entity::class)```

À partir de l'instance de ce repository vous avez accés à plusieurs méthodes :

- La méthode ```find(int $id)``` qui permet de récupérer une instance d'un élément en fonction de son id

- La méthode ```findOneBy(array $filters)``` qui permet de récupérer une instance d'un élément en fonction de plusieurs critères

- La méthode ```findAll()``` qui permet de récupérer toutes les instances d'une entité

- La méthode ```findBy(array $filters, array $orders = [], int $limit = null, int $offset = null)``` qui permet de récupérer plusieurs instances d'une entité en fonction de plusieurs paramètres

- La méthode ```add(array $classData)``` qui permet d'ajouter un élément en base de données

- La méthode ```edit(int $id, array $classData)``` qui permet de modifier un élément en base de données

- La méthode ```delete(int $id)``` qui permet de supprimer un élément en base de données.

## Ajouter la sécurité avec un jeton CSRF
Lors de la création d'un formulaire, rajouter la ligne :

```html
<input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
```

## Exécuter les migrations
Pour setup les migrations :

    make migration-setup

Pour lancer les migrations :

    make migration-migrate

Pour générer un fichier de migration :

    make migration-generate

Pour annuler une migration :

    make migration-rollback

## Ajouter du css et du js

Dans ce framework, nous utilisons tailwind. Toutes les classes sont directements chargées au besoins. Libre à vous de changer ce processus en créeant vos propres classes ou en modifiant le chargement du css dans le fichier ```templates/main.php```

```html
 <!-- Chargement des ressources -->
<script src="https://cdn.tailwindcss.com"></script>
```

Les fichier javascript sont gérés comme des modules. Lors de la création d'un nouveau fichier, vous dever créer un nouveau dossier dans ```assets/js/components```

Et vous devez importer votre nouveau composant dans le fichier app.js :

```js
import './component/mon-composant.js';
```
