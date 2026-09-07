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

## Étape 2 — Configuration d’Eloquent et de la base de données

Cette étape consiste à connecter l'application PHP à MySQL avec Eloquent, à charger les variables d'environnement et à créer la structure initiale de la base de données.

### Branche

```text
feature/02-eloquent
```

Cette branche permet de réaliser la configuration de la base de données et d'Eloquent sans modifier directement la branche principale.

### Configuration des variables d'environnement

Création du fichier `.env.example` :

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

Le fichier `.env` contient les valeurs réellement utilisées en local.

Il ne doit pas être versionné. Il est donc ajouté au `.gitignore`.

```gitignore
.env
/vendor/
```

Le fichier `.env.example` est versionné afin de montrer les variables nécessaires à la configuration du projet sans exposer les informations sensibles.

### Installation des dépendances

Eloquent et Dotenv sont installés avec Composer :

```bash
composer require illuminate/database:^12.0
composer require vlucas/phpdotenv
```

L'option `-W` a été utilisée lors du changement de version d'Eloquent afin de permettre à Composer d'adapter les dépendances déjà présentes dans `composer.lock` :

```bash
composer require illuminate/database:^12.0 -W
```

La version utilisée respecte la version demandée dans le guide du projet :

```text
illuminate/database ^12.0
```

### Chargement des variables d'environnement

Le package `vlucas/phpdotenv` permet de charger les variables présentes dans `.env`.

Dans `config/database.php` :

```php
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
```

Les informations de connexion sont ensuite récupérées depuis `$_ENV`.

Cela permet de ne pas écrire directement les informations de connexion dans le code PHP.

### Configuration d'Eloquent

Eloquent est utilisé sans Laravel grâce à :

```php
Illuminate\Database\Capsule\Manager
```

Dans `config/database.php`, une instance de `Capsule` est créée :

```php
$capsule = new Capsule();
```

La connexion MySQL est ensuite configurée :

```php
$capsule->addConnection([
    'driver' => $_ENV['DB_DRIVER'],
    'host' => $_ENV['DB_HOST'],
    'port' => $_ENV['DB_PORT'],
    'database' => $_ENV['DB_DATABASE'],
    'username' => $_ENV['DB_USERNAME'],
    'password' => $_ENV['DB_PASSWORD'],
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix' => '',
]);
```

Eloquent est ensuite rendu disponible et démarré :

```php
$capsule->setAsGlobal();
$capsule->bootEloquent();
```

### Vérification de la connexion

La connexion a d'abord été testée avec un script temporaire.

La première tentative a donné :

```text
Erreur de connexion : could not find driver
```

Cela venait de l'absence du pilote PHP `pdo_mysql`.

Le pilote a été installé avec :

```bash
sudo apt install php8.3-mysql
```

La présence du pilote a ensuite été vérifiée :

```bash
php -m | grep -E 'PDO|pdo_mysql|mysqli'
```

Résultat :

```text
mysqli
PDO
pdo_mysql
```

La connexion Eloquent a ensuite été vérifiée avec succès :

```text
Connexion à la base de données réussie !
```

Le script de test temporaire a ensuite été supprimé.

### Création des tables

La structure de la base de données est créée avec le Schema Builder d'Eloquent.

La migration se trouve dans :

```text
database/
└── migrations/
    └── 001_create_salles_and_reservations.php
```

La migration crée deux tables :

```text
salles
reservations
```

La table `salles` contient :

```text
id
nom
batiment
capacite
type
active
created_at
updated_at
```

La table `reservations` contient :

```text
id
salle_id
responsable
email
motif
date_debut
date_fin
statut
created_at
updated_at
```

La colonne `salle_id` est une clé étrangère vers `salles.id`.

La relation est donc :

```text
salles
   1
   |
   |
   *
reservations
```

Une salle peut donc posséder plusieurs réservations.

### Exécution de la migration

La migration est exécutée avec :

```bash
php database/migrations/001_create_salles_and_reservations.php
```

Résultat :

```text
Tables créées avec succès.
```

La présence des tables a ensuite été vérifiée dans MySQL :

```sql
SHOW TABLES;
```

Résultat :

```text
reservations
salles
```

La structure des tables a également été vérifiée avec :

```sql
DESCRIBE salles;
DESCRIBE reservations;
```

### Pourquoi les règles métier ne sont pas dans la migration

La migration définit principalement la structure de la base de données.

Les règles métier du projet seront traitées dans la couche `Service`.

Par exemple :

* une salle doit exister ;
* une salle doit être active ;
* la date de début doit être avant la date de fin ;
* une réservation ne doit pas dépasser 4 heures ;
* la réservation doit commencer dans le futur ;
* deux réservations confirmées d'une même salle ne doivent pas se chevaucher.

Ces règles ne sont donc pas placées dans la migration. Elles seront implémentées lors de l'étape consacrée aux services.

### Résumé de l'architecture réalisée

```text
.env
  ↓
Dotenv
  ↓
config/database.php
  ↓
Capsule
  ↓
Eloquent
  ↓
Schema Builder
  ↓
MySQL
  ↓
salles + reservations
```

### Versionnement

#### Branche

```text
feature/02-eloquent
```

#### Commits

Les modifications de l'étape peuvent être organisées avec les commits suivants :

```text
chore: configurer les variables d'environnement
```

Configuration de `.env.example`, `.env` et du `.gitignore`.

```text
chore: installer les dépendances Eloquent
```

Installation d'Eloquent et de Dotenv avec Composer.

```text
chore: configurer Eloquent
```

Configuration de `Capsule\Manager`, chargement des variables d'environnement et démarrage d'Eloquent.

```text
feat: créer les tables de réservation
```

Création de la migration et des tables `salles` et `reservations`.

```text
docs: documenter la configuration Eloquent
```

Documentation des commandes utilisées et des choix réalisés pendant l'étape 2.

#### Tag

```text
v0.2.0
```

Le tag `v0.2.0` représente l'état du projet après la réalisation complète de l'étape 2.



# Étape 3 — Modèles Eloquent

## Objectif

Cette étape consiste à créer les modèles Eloquent correspondant aux tables de la base de données :

* `Salle` pour la table `salles`
* `Reservation` pour la table `reservations`

Les modèles permettent à l'application PHP de manipuler les données de la base de données avec Eloquent ORM.

---

## Branche

La branche utilisée pour cette étape est :

```text
feature/03-modeles
```

Création de la branche :

```bash
git switch -c feature/03-modeles
```

---

## Modèle `Salle`

Fichier :

```text
src/Model/Salle.php
```

Le modèle représente la table `salles`.

```php
<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

final class Salle extends Model
{
    protected $table = 'salles';

    protected $fillable = [
        'nom',
        'batiment',
        'capacite',
        'type',
        'active',
    ];

    protected $casts = [
        'capacite' => 'integer',
        'active' => 'boolean',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
```

### `final`

La classe est déclarée `final` car nous ne prévoyons pas qu'une autre classe hérite de `Salle`.

```php
final class Salle extends Model
```

La classe `Salle` hérite cependant de la classe `Model` d'Eloquent :

```php
class Salle extends Model
```

`Model` fournit les fonctionnalités permettant à Eloquent de communiquer avec la table de base de données.

---

## `$table`

```php
protected $table = 'salles';
```

Cette propriété indique explicitement à Eloquent que le modèle `Salle` utilise la table :

```text
salles
```

---

## `$fillable`

```php
protected $fillable = [
    'nom',
    'batiment',
    'capacite',
    'type',
    'active',
];
```

`$fillable` définit les champs qui peuvent être remplis automatiquement par Eloquent.

Les champs `id`, `created_at` et `updated_at` ne sont pas inclus.

---

## `$casts`

```php
protected $casts = [
    'capacite' => 'integer',
    'active' => 'boolean',
];
```

Les casts permettent à Eloquent de convertir automatiquement les valeurs dans le type attendu.

Par exemple :

* `capacite` devient un entier ;
* `active` devient un booléen.

---

## Relation `Salle` → `Reservation`

```php
public function reservations()
{
    return $this->hasMany(Reservation::class);
}
```

Une salle peut avoir plusieurs réservations.

La relation est donc :

```text
Salle
  │
  ├── Reservation
  ├── Reservation
  └── Reservation
```

Cette relation correspond à la clé étrangère :

```text
reservations.salle_id
        ↓
    salles.id
```

---

# Modèle `Reservation`

Fichier :

```text
src/Model/Reservation.php
```

Le modèle représente la table `reservations`.

```php
<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

final class Reservation extends Model
{
    protected $table = 'reservations';

    protected $fillable = [
        'salle_id',
        'responsable',
        'email',
        'motif',
        'date_debut',
        'date_fin',
        'statut',
    ];

    protected $casts = [
        'date_debut' => 'datetime',
        'date_fin' => 'datetime',
    ];

    public function salle()
    {
        return $this->belongsTo(Salle::class);
    }
}
```

## Relation `Reservation` → `Salle`

```php
public function salle()
{
    return $this->belongsTo(Salle::class);
}
```

Une réservation appartient à une seule salle.

On a donc :

```text
Salle
  1
  │
  │
  *
Reservation
```

---

# Vérification

Les deux fichiers ont été vérifiés avec PHP :

```bash
php -l src/Model/Salle.php
php -l src/Model/Reservation.php
```

Résultat obtenu :

```text
No syntax errors detected in src/Model/Salle.php
No syntax errors detected in src/Model/Reservation.php
```

L'autoloading Composer a également été vérifié.

Un test Eloquent a permis de vérifier que les deux modèles communiquent correctement avec la base de données :

```text
=== TEST DES MODELES ELOQUENT ===
Nombre de salles : 0
Nombre de réservations : 0
=== TEST TERMINE ===
```

Le résultat `0` est normal car les tables existent mais ne contiennent pas encore de données.

Les données initiales seront ajoutées à l'étape 4.

---

# Commit

Les modèles ont été enregistrés avec le commit :

```bash
git add src/Model/
git commit -m "feat: ajouter les modèles Eloquent"
```

Commit :

```text
1f781cb feat: ajouter les modèles Eloquent
```

---

# Tag

L'étape 3 est identifiée par le tag :

```text
v0.3.0
```

Historique :

```text
v0.2.0
   ↓
feature/03-modeles
   ↓
1f781cb
   ↓
v0.3.0
```
## Réponses aux questions

### 1. Quel type de relation Eloquent avez-vous utilisé ?

Nous avons utilisé une relation **un-à-plusieurs (One-to-Many)**.

Une salle possède plusieurs réservations et une réservation appartient à une seule salle.

Dans le modèle `Salle` :

```php
public function reservations()
{
    return $this->hasMany(Reservation::class);
}
```

Dans le modèle `Reservation` :

```php
public function salle()
{
    return $this->belongsTo(Salle::class);
}
```

Ces relations permettent d'utiliser :

```php
$salle->reservations;
```

pour récupérer les réservations d'une salle, et :

```php
$reservation->salle;
```

pour récupérer la salle associée à une réservation.

---

### 2. Pourquoi déclarer `$fillable` ou `$guarded` ?

`$fillable` et `$guarded` permettent de contrôler les attributs qu'Eloquent peut remplir automatiquement.

Dans ce projet, nous utilisons `$fillable` afin de définir explicitement les propriétés pouvant être assignées.

Exemple :

```php
protected $fillable = [
    'nom',
    'batiment',
    'capacite',
    'type',
    'active',
];
```

Cela permet notamment de protéger le modèle contre les problèmes liés au **mass assignment**.

`$fillable` fonctionne comme une liste blanche : seuls les champs indiqués sont autorisés.

---

### 3. Pourquoi convertir `active` en booléen ?

Dans MySQL, la colonne `active` est stockée sous la forme `TINYINT(1)`.

Elle représente deux états :

```text
1 = true
0 = false
```

Nous utilisons donc :

```php
protected $casts = [
    'active' => 'boolean',
];
```

Eloquent convertit automatiquement la valeur en booléen lorsqu'elle est utilisée dans PHP.

Cela permet d'écrire plus naturellement :

```php
if ($salle->active) {
    // La salle est active
}
```

---

### 4. Pourquoi convertir les dates en objets ?

Les champs `date_debut` et `date_fin` sont convertis en objets de date grâce à :

```php
protected $casts = [
    'date_debut' => 'datetime',
    'date_fin' => 'datetime',
];
```

Cela permet de manipuler et de comparer les dates plus facilement dans PHP.

Cette conversion sera particulièrement utile pour les règles métier concernant les réservations, comme la vérification de la durée ou des chevauchements entre réservations.






## Étape 4 — Ajouter les données initiales

### Travail demandé

Un seeder a été créé dans :

```text
database/seed.php
```

Il permet d'ajouter les cinq salles demandées :

| Salle                | Capacité | Type         |
| -------------------- | -------: | ------------ |
| Amphithéâtre A       |      250 | amphitheatre |
| Salle B12            |       40 | cours        |
| Laboratoire Chimie   |       24 | laboratoire  |
| Salle Informatique 1 |       30 | informatique |
| Salle de réunion     |       12 | reunion      |

Le seeder utilise Eloquent pour insérer les données.

Pour éviter les doublons, la méthode `firstOrCreate()` est utilisée.

### Différence entre migration et seeder

Une **migration** sert à créer ou modifier la structure de la base de données.

Exemple :

```text
Créer la table salles
Créer la table reservations
Ajouter une colonne
Créer une clé étrangère
```

Un **seeder** sert à ajouter des données initiales dans les tables.

Exemple :

```text
Ajouter les salles de l'université
Ajouter des utilisateurs de test
Ajouter des données nécessaires au démarrage
```

Donc :

```text
Migration → structure de la base de données

Seeder → données de départ
```

### Pourquoi les données initiales doivent-elles être reproductibles ?

Un seeder doit pouvoir être exécuté plusieurs fois sans créer inutilement les mêmes données.

Par exemple :

```text
1er lancement → 5 salles
2e lancement → toujours 5 salles
3e lancement → toujours 5 salles
```

Cela permet notamment de recréer facilement les données nécessaires dans un environnement de développement ou de test.

### Comment empêcher les doublons ?

La méthode `firstOrCreate()` permet de rechercher une donnée avant de la créer.

```php
Salle::firstOrCreate(
    [
        'nom' => $salle['nom'],
        'batiment' => $salle['batiment'],
    ],
    $salle
);
```

Eloquent recherche d'abord une salle correspondant aux critères.

* Si elle existe → elle n'est pas recréée.
* Si elle n'existe pas → elle est créée.

### Vérification

Le seeder a été exécuté avec succès.

La vérification dans MySQL a donné :

```text
COUNT(*) = 5
```

Les cinq salles sont présentes dans la table `salles`.

Le seeder a ensuite été exécuté une seconde fois.

Le nombre de salles est resté à :

```text
5
```

Cela confirme qu'aucun doublon inutile n'a été créé.

### Versionnement

Branche :

```text
feature/04-donnees-initiales
```

Tag :

```text
v0.4.0
```

## Étape 5 — Créer la validation

### Travail demandé

Un système de validation a été créé dans :

```text
src/Validation/
├── ValidatorInterface.php
├── ValidationResult.php
├── SalleValidator.php
└── ReservationValidator.php
```

La validation utilise la bibliothèque `Respect\Validation`.

### ValidatorInterface

`ValidatorInterface` définit un contrat commun pour tous les validateurs :

```php
interface ValidatorInterface
{
    public function validate(array $data): ValidationResult;
}
```

Les classes `SalleValidator` et `ReservationValidator` implémentent cette interface.

### ValidationResult

`ValidationResult` représente le résultat d'une validation.

Il permet de :

* savoir si les données sont valides avec `isValid()` ;
* récupérer les erreurs avec `errors()` ;
* récupérer les données avec `data()`.

Exemple :

```php
$resultat = $validator->validate($data);

if (!$resultat->isValid()) {
    $errors = $resultat->errors();
}
```

### SalleValidator

Les règles appliquées à une salle sont :

| Champ      | Règle                           |
| ---------- | ------------------------------- |
| `nom`      | obligatoire, 2 à 100 caractères |
| `batiment` | obligatoire, 2 à 100 caractères |
| `capacite` | entier compris entre 1 et 1000  |
| `type`     | valeur autorisée                |
| `active`   | booléen                         |

Les types autorisés sont :

```text
cours
informatique
laboratoire
amphitheatre
reunion
```

### ReservationValidator

Les règles appliquées à une réservation sont :

| Champ         | Règle                |
| ------------- | -------------------- |
| `salle_id`    | entier positif       |
| `responsable` | 2 à 120 caractères   |
| `email`       | adresse email valide |
| `motif`       | 5 à 255 caractères   |
| `date_debut`  | date valide          |
| `date_fin`    | date valide          |

La comparaison entre `date_debut` et `date_fin` n'est pas effectuée par le validateur.

Cette vérification appartient aux règles métier et sera réalisée dans la couche Service.

### Pourquoi séparer la validation syntaxique des règles métier ?

La validation syntaxique vérifie que les données ont une forme correcte.

Exemples :

```text
email → adresse email valide
capacite → entier
nom → longueur correcte
date_debut → date valide
```

Les règles métier vérifient si les données respectent les règles de fonctionnement de l'application.

Exemples :

```text
date_fin doit être après date_debut
une salle ne doit pas avoir deux réservations qui se chevauchent
une salle inactive ne peut pas être réservée
```

Cette séparation permet à chaque couche d'avoir une responsabilité claire.

### Pourquoi créer une interface de validation ?

L'interface impose un contrat commun aux différents validateurs.

Ainsi, `SalleValidator` et `ReservationValidator` possèdent tous les deux la méthode :

```php
validate(array $data): ValidationResult
```

Cela rend l'organisation du code plus cohérente et facilite son évolution.

### Pourquoi le validateur ne doit-il pas enregistrer les données ?

Le validateur a une seule responsabilité :

> vérifier les données.

Il ne doit donc pas enregistrer de données dans la base de données.

L'enregistrement sera effectué plus tard par les couches responsables de cette opération, notamment le Service et le Repository.

Cela respecte le principe de séparation des responsabilités.

### Comment retourner plusieurs erreurs en une seule fois ?

Les erreurs sont stockées dans un tableau :

```php
$errors = [];
```

Chaque erreur est associée au champ concerné :

```php
$errors[$field] = 'La valeur de ce champ est invalide.';
```

Toutes les erreurs sont ensuite transmises à `ValidationResult`.

Ainsi, plusieurs champs incorrects peuvent être signalés lors d'une seule validation.

### Tests effectués

Les quatre classes ont été vérifiées avec PHP :

```bash
php -l src/Validation/ValidatorInterface.php
php -l src/Validation/ValidationResult.php
php -l src/Validation/SalleValidator.php
php -l src/Validation/ReservationValidator.php
```

Des tests ont également été réalisés avec :

* une salle valide ;
* une salle contenant plusieurs erreurs ;
* une réservation valide ;
* une réservation contenant plusieurs erreurs.

Les validateurs retournent correctement un `ValidationResult`.

### Dépendance utilisée

La validation utilise :

```text
respect/validation:^2.4
```

### Versionnement

Branche :

```text
feature/05-validation
```

Tag :

```text
v0.5.0
```
