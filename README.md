# Reservation Salles

Application de gestion et de réservation de salles développée en PHP orienté objet.

Le projet est réalisé progressivement afin de comprendre et de mettre en pratique les bonnes pratiques de développement : Git, Composer, programmation orientée objet, architecture en couches, tests et gestion d'une base de données.

---

# Déroulement du projet

## Étape 0 — Initialiser le dépôt

### Travail demandé

1. Initialiser Git.
2. Créer la branche `main`.
3. Préparer `.gitignore`.
4. Créer `README.md` et `CHANGELOG.md`.
5. Créer le premier commit.
6. Version attendue : `v0.0.0`

### Pourquoi cette étape ?

Cette étape sert à préparer le projet avant de commencer à développer.

Git permet de suivre les modifications du projet et de revenir à une version précédente si nécessaire.

La branche `main` représente la version principale et stable du projet.

Le fichier `.gitignore` permet d'indiquer à Git les fichiers qu'il ne doit pas envoyer dans le dépôt.

Le `README.md` explique le projet et permet à une autre personne de comprendre comment l'utiliser.

Le `CHANGELOG.md` permet de garder une trace des changements importants effectués dans le projet.

La version `v0.0.0` représente l'état initial du projet, avant l'ajout des fonctionnalités.

---

# Étape 1 — Initialiser le projet Composer

## Travail demandé

1. Créer `composer.json`.
2. Configurer l'autoloading PSR-4.
3. Installer les dépendances.
4. Créer l'arborescence.
5. Vérifier que Composer charge une classe `App\Application`.

---

## 1. Création de `composer.json`

Le fichier `composer.json` contient les informations nécessaires à Composer pour gérer le projet.

Il permet notamment de déclarer :

* le nom du projet ;
* les dépendances ;
* les dépendances utilisées uniquement pendant le développement ;
* la configuration de l'autoloading.

Dans notre projet, le namespace principal est :

```text
App\
```

et il correspond au dossier :

```text
src/
```

La configuration utilisée est :

```json
"autoload": {
    "psr-4": {
        "App\\": "src/"
    }
}
```

### Pourquoi ?

Nous faisons cela pour que Composer puisse retrouver automatiquement nos classes PHP.

Par exemple, si nous avons :

```text
src/Application.php
```

avec :

```php
namespace App;

class Application
{
}
```

le nom complet de la classe est :

```text
App\Application
```

Composer comprend alors que `App\` correspond à `src/` et peut retrouver automatiquement `Application.php`.

---

# 2. Autoloading PSR-4

L'autoloading signifie que PHP peut charger automatiquement une classe lorsqu'on en a besoin.

Sans autoloading, il faudrait écrire beaucoup de :

```php
require '...';
require '...';
require '...';
```

pour charger chaque classe.

Avec Composer et PSR-4, nous n'avons pas besoin de faire un `require` pour chaque classe.

Nous avons seulement besoin de charger une fois :

```php
require __DIR__ . '/vendor/autoload.php';
```

Ensuite, Composer s'occupe de trouver les classes.

### Pourquoi utiliser PSR-4 ?

PSR-4 donne une règle claire pour organiser les namespaces et les fichiers.

Dans notre projet :

```text
App\Application
```

correspond à :

```text
src/Application.php
```

Cela permet d'avoir une organisation propre et évite de charger manuellement toutes les classes.

---

# 3. Installation des dépendances

Les dépendances sont des bibliothèques ou des outils externes dont notre projet peut avoir besoin.

Composer permet de les installer automatiquement.

La commande utilisée est :

```bash
composer install
```

Cette commande lit `composer.json` et `composer.lock`, puis installe les dépendances nécessaires dans le dossier :

```text
vendor/
```

### Pourquoi ?

Nous utilisons Composer pour éviter d'installer et de gérer manuellement les bibliothèques utilisées par le projet.

Cela permet également de travailler avec les mêmes versions de dépendances sur plusieurs machines.

---

# 4. Création de l'arborescence

L'arborescence du projet est organisée de cette manière :

```text
reservation-salles/
├── config/
│   ├── container.php
│   └── database.php
├── database/
│   ├── migrations/
│   └── seed.php
├── public/
│   ├── assets/
│   │   └── style.css
│   └── index.php
├── routes/
│   └── web.php
├── src/
│   ├── Controller/
│   ├── DTO/
│   ├── Exception/
│   ├── Model/
│   ├── Repository/
│   ├── Service/
│   ├── Validation/
│   └── View/
├── templates/
│   ├── error/
│   ├── layout/
│   ├── reservation/
│   └── salle/
├── tests/
│   ├── Unit/
│   └── Integration/
├── .env.example
├── .gitignore
├── CHANGELOG.md
├── composer.json
├── composer.lock
├── phpunit.xml
└── README.md
```

### Pourquoi créer cette arborescence ?

Nous séparons les différentes responsabilités du projet.

Par exemple :

* `Controller/` contient les contrôleurs.
* `Model/` contient les modèles.
* `Repository/` s'occupe de l'accès aux données.
* `Service/` contient la logique métier.
* `DTO/` sert à transporter des données.
* `Validation/` contient les règles de validation.
* `Exception/` contient les exceptions personnalisées.
* `View/` contient la partie liée à l'affichage.
* `templates/` contient les fichiers HTML/PHP affichés à l'utilisateur.
* `public/` contient le point d'entrée public de l'application.
* `config/` contient la configuration.
* `database/` contient les éléments liés à la base de données.
* `tests/` contient les tests.

Cette séparation permet de mieux comprendre le projet et d'éviter de mettre tout le code dans un seul fichier.

---

# 5. Vérification de `App\Application`

Pour vérifier que Composer fonctionne correctement, nous avons créé :

```text
src/Application.php
```

avec :

```php
<?php

namespace App;

class Application
{
    public function run(): void
    {
        echo "Application chargée avec succès !";
    }
}
```

Puis nous chargeons Composer :

```php
require __DIR__ . '/vendor/autoload.php';
```

et nous pouvons utiliser la classe :

```php
use App\Application;

$app = new Application();

$app->run();
```

Si le message suivant apparaît :

```text
Application chargée avec succès !
```

cela signifie que Composer a correctement trouvé et chargé la classe.

### Pourquoi faire cette vérification ?

Avant de commencer à créer beaucoup de classes, nous voulons vérifier que l'autoloading fonctionne.

Cela permet de détecter rapidement une erreur dans :

* le namespace ;
* le chemin du dossier ;
* la configuration PSR-4 ;
* Composer.

---

# Questions de l'étape 1

## 1. Quel est le rôle de Composer ?

Composer est un outil qui permet de gérer les dépendances d'un projet PHP.

Une dépendance est une bibliothèque ou un outil externe dont notre projet a besoin.

Composer permet principalement de :

* installer les dépendances ;
* gérer leurs versions ;
* enregistrer les dépendances dans `composer.json` ;
* installer les versions exactes avec `composer.lock` ;
* charger automatiquement nos classes avec l'autoloading.

### Pourquoi l'utiliser ?

Sans Composer, nous devrions gérer manuellement les bibliothèques et charger beaucoup de fichiers avec `require`.

Composer automatise cette gestion et rend le projet plus facile à maintenir.

---

## 2. Quelle différence existe entre `require` et `require-dev` ?

`require` contient les dépendances nécessaires au fonctionnement de l'application.

Par exemple, si une bibliothèque est indispensable pour que l'application fonctionne, elle doit être dans :

```json
"require": {}
```

`require-dev` contient les outils nécessaires uniquement pendant le développement.

Par exemple :

```text
PHPUnit
```

est utilisé pour effectuer des tests.

Il peut donc être placé dans :

```json
"require-dev": {}
```

### Pourquoi faire cette différence ?

Parce qu'un outil utilisé uniquement pour développer ou tester l'application n'est pas forcément nécessaire lorsque l'application est utilisée en production.

On sépare donc :

```text
require
    dépendances nécessaires à l'application

require-dev
    outils nécessaires au développement
```

---

## 3. Pourquoi faut-il versionner `composer.lock` ?

Le fichier `composer.lock` contient les versions exactes des dépendances installées.

Par exemple, si une bibliothèque existe en plusieurs versions :

```text
bibliothèque 1.0
bibliothèque 1.1
bibliothèque 2.0
```

`composer.lock` permet de conserver la version exacte utilisée par le projet.

### Pourquoi ?

Imaginons que deux développeurs travaillent sur le même projet.

Sans `composer.lock`, Composer pourrait installer des versions différentes des dépendances.

Cela pourrait créer des différences ou des erreurs entre leurs environnements.

Avec `composer.lock`, les développeurs utilisent les mêmes versions.

C'est pourquoi, pour une application, nous versionnons `composer.lock` dans Git.

---

## 4. Pourquoi ne versionne-t-on pas `vendor/` ?

Le dossier `vendor/` contient les bibliothèques installées par Composer.

Nous ne le mettons pas dans Git parce qu'il peut être très volumineux et qu'il peut être recréé automatiquement.

Nous versionnons plutôt :

```text
composer.json
composer.lock
```

Puis une autre personne peut récupérer le projet et exécuter :

```bash
composer install
```

Composer lit les fichiers de configuration et recrée le dossier :

```text
vendor/
```

### Pourquoi ?

Cela évite de stocker dans Git des milliers de fichiers qui peuvent être téléchargés automatiquement.

Notre `.gitignore` contient donc :

```text
/vendor/
```

---

# Versionnement

## Branche

```text
feature/01-composer
```

Cette branche est utilisée pour travailler sur l'étape Composer sans modifier directement la branche principale.

## Tag

```text
v0.1.0
```

Le tag représente la version du projet après la réalisation de l'étape Composer.

## Commits possibles

```text
init: créer le projet PHP
```

Création et initialisation du projet PHP.

```text
chore: configurer l'autoloading
```

Configuration de l'autoloading PSR-4 et vérification du chargement des classes.

```text
chore: installer les dépendances
```

Installation et configuration des dépendances du projet.

---

# Commandes principales utilisées

Créer la branche :

```bash
git switch -c feature/01-composer
```

Installer les dépendances :

```bash
composer install
```

Régénérer l'autoloading :

```bash
composer dump-autoload
```

Vérifier l'état Git :

```bash
git status
```

Créer un commit :

```bash
git add .
git commit -m "chore: configurer l'autoloading"
```

Créer le tag :

```bash
git tag v0.1.0
```
