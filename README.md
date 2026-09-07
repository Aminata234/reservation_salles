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




# Étape 2 — Configurer Eloquent

## Travail demandé

1. Ajouter `.env.example`.
2. Charger les variables d'environnement.
3. Configurer `Capsule\Manager`.
4. Démarrer Eloquent.
5. Vérifier la connexion.
6. Créer les tables.

---

## 1. Préparation de la base de données

Pour ce projet, nous avons choisi MySQL comme système de gestion de base de données.

Nous avons créé la base de données :

```text
reservation_salles
```

La commande utilisée est :

```sql
CREATE DATABASE reservation_salles
DEFAULT CHARACTER SET utf8mb4;
```

### Pourquoi ?

La base de données est nécessaire pour stocker les informations de l'application, notamment les salles et les réservations.

`utf8mb4` permet à MySQL de gérer correctement les caractères Unicode, notamment les accents et différents caractères spéciaux.

Pour vérifier que la base existe, nous avons utilisé :

```sql
SHOW DATABASES;
```

Puis nous avons sélectionné la base avec :

```sql
USE reservation_salles;
```

Enfin, nous avons vérifié la base actuellement utilisée avec :

```sql
SELECT DATABASE();
```

Le résultat attendu est :

```text
reservation_salles
```

---

## 2. Configuration de la connexion MySQL

Pour le développement local, la connexion utilisée est :

```text
Hôte : 127.0.0.1
Port : 3306
Utilisateur : root
Base de données : reservation_salles
```

Les informations de connexion sont placées dans un fichier `.env`.

---

## 3. Création de `.env.example`

Nous avons créé le fichier :

```text
.env.example
```

avec les variables suivantes :

```env
APP_ENV=development
APP_DEBUG=true

DB_DRIVER=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=reservation_salles
DB_USERNAME=root
DB_PASSWORD=
```

### Pourquoi utiliser `.env.example` ?

`.env.example` sert de modèle de configuration.

Il permet à une autre personne de savoir quelles variables sont nécessaires pour faire fonctionner le projet sans recevoir notre configuration personnelle.

Le fichier `.env.example` peut être versionné dans Git.

---

## 4. Création du fichier `.env`

Nous avons créé le fichier `.env` à partir du modèle :

```bash
cp .env.example .env
```

Le fichier `.env` contient la configuration réellement utilisée sur notre machine.

Il contient actuellement :

```env
APP_ENV=development
APP_DEBUG=true

DB_DRIVER=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=reservation_salles
DB_USERNAME=root
DB_PASSWORD=
```

### Pourquoi `.env` n'est-il pas versionné ?

Le fichier `.env` contient la configuration réelle de l'environnement.

Dans un projet réel, il peut notamment contenir des mots de passe, des clés ou d'autres informations qui ne doivent pas être envoyées sur Git.

C'est pourquoi `.gitignore` contient :

```text
.env
```

---

## 5. Installation de Eloquent

Eloquent est l'ORM utilisé pour communiquer avec la base de données.

Nous avons installé le composant `illuminate/database` avec :

```bash
composer require illuminate/database
```

### Pourquoi ?

`illuminate/database` fournit le composant Eloquent sans avoir besoin d'installer tout Laravel.

Il permettra à notre application PHP d'utiliser des modèles et de manipuler les données de la base de données avec PHP.

---

## 6. Installation de phpdotenv

Nous avons installé :

```text
vlucas/phpdotenv
```

avec :

```bash
composer require vlucas/phpdotenv
```

### Pourquoi ?

Cette bibliothèque permet de charger les variables présentes dans le fichier `.env`.

Elle permettra notamment de récupérer :

```text
DB_HOST
DB_PORT
DB_DATABASE
DB_USERNAME
DB_PASSWORD
```

pour configurer la connexion à MySQL.

---

## 7. Mise à jour de l'autoloading Composer

Après les modifications des dépendances, nous avons utilisé :

```bash
composer dump-autoload
```

Cette commande reconstruit les fichiers d'autoloading de Composer.

### Pourquoi ?

Elle permet à Composer de retrouver automatiquement les classes du projet et les classes fournies par les dépendances.

---

## 8. Configuration d'Eloquent avec Capsule

Eloquent peut être utilisé sans Laravel grâce au composant :

```text
Illuminate\Database\Capsule\Manager
```

`Capsule\Manager` permet de configurer le gestionnaire de base de données utilisé par Eloquent.

La configuration sera réalisée dans :

```text
config/database.php
```

Ce fichier sera responsable de la configuration de la connexion à la base de données.

### Pourquoi mettre cette configuration dans `config/database.php` ?

La connexion à la base de données est une configuration technique.

Elle ne doit pas être répétée dans les différents modèles ou services de l'application.

Nous voulons donc avoir une seule configuration de la connexion.

---

## 9. Chargement de `.env`

La bibliothèque `phpdotenv` sera utilisée pour charger les variables du fichier `.env`.

Le principe est :

```text
.env
 ↓
phpdotenv
 ↓
variables de configuration
 ↓
Capsule\Manager
 ↓
Eloquent
 ↓
MySQL
 ↓
reservation_salles
```

Les classes métier ne doivent pas appeler directement `getenv()`.

La configuration doit être centralisée afin que les classes métier restent indépendantes de l'environnement.

---

## 10. Vérification de la connexion

Avant de créer les tables, nous devons vérifier qu'Eloquent arrive à communiquer avec MySQL.

La vérification doit confirmer que :

```text
PHP
 ↓
Eloquent
 ↓
MySQL
 ↓
reservation_salles
```

fonctionne correctement.

Les erreurs de connexion doivent être gérées afin que l'application ne produise pas une erreur incompréhensible pour l'utilisateur.

---

# Questions de l'étape 2

## 1. Quel rôle joue `Capsule\Manager` ?

`Capsule\Manager` est une classe fournie par le composant `illuminate/database`.

Elle permet de configurer et de démarrer le gestionnaire de base de données utilisé par Eloquent.

Elle permet notamment de fournir les informations nécessaires à la connexion :

```text
driver
host
port
database
username
password
```

Elle permet ensuite de démarrer Eloquent.

---

## 2. Pourquoi Eloquent peut-il fonctionner sans Laravel ?

Eloquent fait partie des composants développés par Laravel, mais il peut être installé séparément.

Avec Composer, nous pouvons installer uniquement le composant dont nous avons besoin :

```bash
composer require illuminate/database
```

Nous n'avons donc pas besoin d'installer tout le framework Laravel.

Notre projet reste une application PHP sans framework complet.

---

## 3. Où doit se trouver le démarrage de l'ORM ?

Le démarrage de l'ORM doit se trouver dans une partie de configuration ou de démarrage de l'application.

Dans notre projet, la configuration de la base de données se trouve dans :

```text
config/database.php
```

L'objectif est que la connexion soit configurée une seule fois.

Les modèles, services et autres classes métier ne doivent pas recréer la connexion à chaque utilisation.

---

## 4. Quelle différence existe entre ORM et SQL écrit à la main ?

Avec SQL écrit à la main, le développeur écrit directement les requêtes SQL.

Par exemple :

```sql
SELECT * FROM salles;
```

Avec un ORM comme Eloquent, le développeur peut manipuler les données avec des objets et des modèles PHP.

Par exemple :

```php
Salle::all();
```

L'ORM fait ensuite le travail nécessaire pour communiquer avec la base de données.

### Pourquoi utiliser un ORM ?

L'ORM permet notamment :

* de travailler davantage avec les objets PHP ;
* de réduire la quantité de SQL écrit directement ;
* de centraliser la logique liée aux modèles ;
* de faciliter certaines opérations courantes sur les données.

Cependant, connaître SQL reste important, car l'ORM ne remplace pas la compréhension des bases de données.

---

# Commandes utilisées pour l'étape 2

Créer la branche :

```bash
git switch -c feature/02-eloquent
```

Créer la base de données :

```sql
CREATE DATABASE reservation_salles
DEFAULT CHARACTER SET utf8mb4;
```

Vérifier les bases :

```sql
SHOW DATABASES;
```

Sélectionner la base :

```sql
USE reservation_salles;
```

Vérifier la base sélectionnée :

```sql
SELECT DATABASE();
```

Installer Eloquent :

```bash
composer require illuminate/database
```

Installer phpdotenv :

```bash
composer require vlucas/phpdotenv
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
git commit -m "chore: configurer Eloquent"
```

Créer le tag final de l'étape :

```bash
git tag v0.2.0
```

---

# Versionnement de l'étape 2

## Branche

```text
feature/02-eloquent
```

Cette branche permet de réaliser la configuration de la base de données et d'Eloquent sans modifier directement la branche principale.

## Tag

```text
v0.2.0
```

Ce tag représentera la version du projet après la réalisation complète de l'étape 2.

## Commits

Les commits peuvent être organisés ainsi :

```text
chore: configurer les variables d'environnement
```

Configuration de `.env.example` et du système de variables d'environnement.

```text
chore: installer les dépendances Eloquent
```

Installation de `illuminate/database` et `vlucas/phpdotenv`.

```text
chore: configurer Eloquent
```

Configuration de `Capsule\Manager` et démarrage d'Eloquent.

```text
docs: documenter la configuration Eloquent
```

Documentation des commandes et des choix réalisés pendant l'étape 2.
