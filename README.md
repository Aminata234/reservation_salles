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


## Étape 6 — Créer les DTO

### Objectif

Cette étape consiste à créer des objets permettant de transporter les données entre les différentes couches de l'application.

Les DTO créés sont :

```text
src/
└── DTO/
    ├── CreerSalleDTO.php
    └── CreerReservationDTO.php
```

### `CreerSalleDTO`

`CreerSalleDTO` contient les données nécessaires à la création d'une salle :

* `nom` : nom de la salle ;
* `batiment` : bâtiment de la salle ;
* `capacite` : capacité de la salle ;
* `type` : type de salle ;
* `active` : indique si la salle est active.

Les propriétés sont typées et en lecture seule avec `readonly`.

### `CreerReservationDTO`

`CreerReservationDTO` contient les données nécessaires à la création d'une réservation :

* `salleId` : identifiant de la salle ;
* `responsable` : responsable de la réservation ;
* `email` : adresse e-mail du responsable ;
* `motif` : motif de la réservation ;
* `dateDebut` : date et heure de début ;
* `dateFin` : date et heure de fin.

Les dates sont représentées avec `DateTimeImmutable`.

---

### Rôle du DTO

DTO signifie **Data Transfer Object**.

Son rôle est de transporter des données structurées entre les différentes couches de l'application.

Le flux prévu est :

```text
Formulaire HTTP
       ↓
     $_POST
       ↓
   Validation
       ↓
 Transformation des types
       ↓
      DTO
       ↓
    Service
       ↓
  Repository
       ↓
 Modèle Eloquent
       ↓
 Base de données
```

Le Service ne reçoit donc pas directement `$_POST`.

Il reçoit un objet comme `CreerSalleDTO` ou `CreerReservationDTO`.

---

## Questions

### 1. Quelle différence existe entre DTO et modèle Eloquent ?

Le **DTO** sert à transporter des données entre les différentes couches de l'application.

Il ne représente pas une table de la base de données et ne contient pas de logique d'accès à la base.

Le **modèle Eloquent**, lui, représente une entité associée à une table de la base de données et permet de travailler avec cette base grâce à Eloquent.

Dans notre projet :

```text
CreerSalleDTO
    ↓
transporte les données
```

alors que :

```text
Salle
    ↓
représente la table "salles"
    ↓
travaille avec Eloquent
```

On peut donc retenir :

```text
DTO             → transporter les données
Modèle Eloquent → représenter les données persistées
```

---

### 2. Pourquoi le DTO ne doit-il pas appeler `save()` ?

Le DTO ne doit pas appeler `save()` car `save()` appartient au fonctionnement d'**Eloquent**.

Le DTO ne doit connaître ni la base de données ni Eloquent.

Son rôle est uniquement de transporter les données.

Il serait donc incorrect de faire :

```php
$dto->save();
```

La sauvegarde est réalisée par les couches responsables de la persistance :

```text
DTO
 ↓
Service
 ↓
Repository
 ↓
Modèle Eloquent
 ↓
Base de données
```

Cette séparation permet de respecter le principe de responsabilité unique.

---

### 3. À quel moment transforme-t-on les chaînes en dates ?

Les données provenant d'un formulaire HTTP arrivent généralement sous forme de chaînes de caractères.

Par exemple :

```text
"2026-09-10 10:00:00"
```

Après avoir reçu et validé les données, la chaîne est transformée en objet `DateTimeImmutable` avant de construire le DTO.

Exemple :

```php
$dateDebut = new DateTimeImmutable($data['date_debut']);
$dateFin = new DateTimeImmutable($data['date_fin']);
```

Puis ces objets sont transmis au DTO :

```php
$dto = new CreerReservationDTO(
    $salleId,
    $responsable,
    $email,
    $motif,
    $dateDebut,
    $dateFin
);
```

Le DTO reçoit donc des données correctement typées.

La transformation des données HTTP vers les types attendus par le DTO fait partie de la préparation des données avant leur transmission au Service.

---

### 4. Le DTO doit-il contenir la règle de chevauchement ?

**Non.**

Le DTO doit uniquement transporter les données nécessaires à la réservation.

Il contient par exemple :

```text
dateDebut
dateFin
```

mais il ne doit pas décider si la réservation chevauche une autre réservation.

La règle :

> Une salle ne peut pas avoir deux réservations qui se chevauchent.

est une **règle métier**.

Elle doit donc être placée dans la couche Service.

```text
CreerReservationDTO
        ↓
contient les dates
        ↓
ReservationService
        ↓
vérifie le chevauchement
```

Le DTO ne doit donc contenir ni requête SQL, ni appel à `save()`, ni règle de chevauchement.

---

## Différence entre validation, DTO, Service et Repository

Chaque couche possède une responsabilité différente :

```text
Validator
→ vérifie que les données reçues sont valides

DTO
→ transporte les données correctement structurées et typées

Service
→ applique les règles métier

Repository
→ gère l'accès aux données

Model Eloquent
→ représente une entité et fournit le comportement Eloquent
```

### Exemple

Pour une réservation :

```text
"2026-09-10 10:00:00"
        ↓
Validation
        ↓
chaîne valide
        ↓
DateTimeImmutable
        ↓
CreerReservationDTO
        ↓
ReservationService
        ↓
vérification du chevauchement
        ↓
Repository
        ↓
Reservation (Eloquent)
        ↓
Base de données
```

---

## Pourquoi ne pas transmettre directement `$_POST` au Service ?

`$_POST` appartient à la couche HTTP.

Le Service ne doit pas dépendre directement du formulaire.

Transmettre directement `$_POST` au Service créerait un couplage entre la couche HTTP et la couche métier.

Avec un DTO :

```text
Controller → DTO → Service
```

le Service reste indépendant de la manière dont les données ont été reçues.

Les données pourraient venir plus tard d'un formulaire HTML, d'une API ou d'une autre source sans modifier le fonctionnement du Service.

---

## Pourquoi utiliser `readonly` ?

Les propriétés `readonly` ne peuvent pas être modifiées après la création du DTO.

Cela permet de conserver les données telles qu'elles ont été préparées lors de la création de l'objet.

Exemple :

```php
public readonly string $nom
```

Une fois le DTO créé, la propriété `nom` ne peut plus être remplacée.

---

## Tests réalisés

Les deux DTO ont été vérifiés avec :

```bash
php -l src/DTO/CreerSalleDTO.php
php -l src/DTO/CreerReservationDTO.php
```

Résultat :

```text
No syntax errors detected in src/DTO/CreerSalleDTO.php
No syntax errors detected in src/DTO/CreerReservationDTO.php
```

Un test de création de `CreerSalleDTO` et `CreerReservationDTO` a également été réalisé avec des données de test.

Les objets ont été correctement créés avec leurs types attendus.

---

## Principe d'architecture respecté

Les DTO :

* ne contiennent aucune requête SQL ;
* ne communiquent pas avec la base de données ;
* ne lisent pas directement `$_POST` ;
* ne contiennent pas de règles métier ;
* transportent des données structurées et typées ;
* utilisent `readonly` afin d'éviter les modifications après leur création.

### Versionnement

Branche :

```text
feature/06-dto
```

Version :

```text
v0.6.0
```


## Étape 7 — Créer l'accès aux données

### Objectif

Cette étape consiste à isoler l'accès aux données derrière des contrats et des implémentations de Repository.

Les fichiers créés sont :

```text
src/
└── Repository/
    ├── SalleRepositoryInterface.php
    ├── ReservationRepositoryInterface.php
    ├── EloquentSalleRepository.php
    └── EloquentReservationRepository.php
```

### SalleRepositoryInterface

Le contrat `SalleRepositoryInterface` définit les opérations nécessaires pour les salles :

* lister les salles ;
* retrouver une salle ;
* enregistrer une salle.

### ReservationRepositoryInterface

Le contrat `ReservationRepositoryInterface` définit les opérations nécessaires pour les réservations :

* lister les réservations ;
* retrouver une réservation ;
* rechercher un conflit ;
* enregistrer une réservation ;
* annuler une réservation.

### Implémentations Eloquent

Les interfaces sont implémentées par :

* `EloquentSalleRepository` ;
* `EloquentReservationRepository`.

Ces classes utilisent Eloquent pour communiquer avec la base de données.

Les appels comme :

```php
Salle::query()
Reservation::query()
$model->save()
```

sont donc isolés dans les Repositories.

Les contrôleurs ne doivent pas effectuer directement ces opérations.

### Architecture

Le chemin d'accès aux données est :

```text
Controller
    ↓
Service
    ↓
Repository
    ↓
Model Eloquent
    ↓
MySQL
```

Le Repository sert donc d'intermédiaire entre la logique métier et l'accès aux données.

---

## Questions

### 1. Eloquent constitue-t-il déjà un accès aux données ?

Oui.

Eloquent constitue déjà une solution d'accès aux données. Il permet d'interroger et de modifier la base de données à travers les modèles.

Par exemple :

```php
Salle::query()->get();
Salle::query()->find($id);
$salle->save();
```

Eloquent fournit donc déjà les fonctionnalités nécessaires pour communiquer avec la base de données.

---

### 2. Pourquoi ajouter un Repository au-dessus d'Eloquent ?

Même si Eloquent fournit déjà un accès aux données, le Repository permet d'isoler cet accès dans une couche spécifique.

Sans Repository, un contrôleur pourrait contenir directement :

```php
Salle::query()->get();
```

Avec le Repository, le contrôleur demande simplement :

```php
$salleRepository->lister();
```

Le contrôleur ne connaît donc pas la manière utilisée pour récupérer les données.

Cela permet de mieux séparer les responsabilités :

```text
Controller
→ gérer la requête HTTP

Service
→ appliquer les règles métier

Repository
→ accéder aux données

Eloquent
→ communiquer avec la base
```

---

### 3. Cette abstraction est-elle toujours nécessaire ?

Non.

Pour une petite application simple, utiliser directement Eloquent peut être suffisant.

Cependant, dans ce projet, le Repository est utilisé volontairement afin de respecter une architecture séparant les responsabilités.

Il permet également de rendre le code moins dépendant directement d'Eloquent.

---

### 4. Quel avantage apporte-t-elle ?

Le Repository apporte plusieurs avantages :

* séparation des responsabilités ;
* contrôleurs plus simples ;
* services moins dépendants d'Eloquent ;
* code plus facile à tester ;
* accès aux données centralisé ;
* possibilité de modifier l'implémentation plus facilement.

Par exemple, si l'accès aux données devait changer à l'avenir, l'implémentation du Repository pourrait être modifiée sans devoir modifier tous les contrôleurs.

---

## Recherche de conflit

La méthode :

```php
rechercherConflit()
```

permet de rechercher dans la base une réservation existante qui chevauche une période donnée.

Le Repository est responsable de la **recherche dans les données**.

La décision métier reste du côté du Service.

```text
Repository
→ recherche un conflit

Service
→ décide de refuser ou d'accepter la réservation
```

---

## Contraintes respectées

Les contrôleurs ne doivent jamais contenir directement :

```php
Salle::query();
Reservation::where(...);
$model->save();
```

Ces opérations sont isolées dans les Repositories Eloquent.

### Tests réalisés

Les quatre fichiers ont été vérifiés avec `php -l`.

Les tests ont également confirmé que :

* les 5 salles existantes peuvent être récupérées ;
* une salle peut être retrouvée par son identifiant ;
* les réservations peuvent être listées ;
* les Repositories communiquent correctement avec Eloquent et la base de données.

### Versionnement

Branche :

```text
feature/07-repositories
```

Version :

```text
v0.7.0
```


## Étape 8 — Implémenter les règles métier

### Objectif

Cette étape consiste à placer les règles métier concernant les réservations dans des services dédiés.

Les services créés sont :

* `CreerReservationService`
* `AnnulerReservationService`

Les exceptions créées sont :

* `SalleIndisponibleException`
* `ReservationIntrouvableException`

### `CreerReservationService`

Le service de création d'une réservation effectue les vérifications suivantes :

1. retrouver la salle ;
2. vérifier que la salle existe ;
3. vérifier que la salle est active ;
4. vérifier que la date de début précède la date de fin ;
5. vérifier que la durée ne dépasse pas quatre heures ;
6. vérifier que la réservation est prévue dans le futur ;
7. rechercher un éventuel chevauchement ;
8. créer la réservation ;
9. l'enregistrer via le repository ;
10. retourner la réservation créée.

Le service ne dépend ni de `$_POST`, ni de FastRoute, ni des vues, ni du conteneur DI.

### `AnnulerReservationService`

Le service d'annulation :

1. recherche la réservation par son identifiant ;
2. lève `ReservationIntrouvableException` si elle n'existe pas ;
3. demande au repository de l'annuler ;
4. retourne la réservation modifiée.

### Pourquoi les règles métier ne sont-elles pas dans le contrôleur ?

Le contrôleur est principalement responsable de la communication avec HTTP : récupérer la requête, appeler les composants nécessaires et préparer la réponse.

Les décisions métier doivent être dans le service.

Par exemple :

```text
Contrôleur
    ↓
Service
    ↓
Repository
    ↓
Base de données
```

Si la règle « une réservation ne doit pas dépasser quatre heures » était dans le contrôleur, elle serait difficile à réutiliser ailleurs.

En la plaçant dans le service, la même règle peut être utilisée par plusieurs contrôleurs ou interfaces.

### Pourquoi le service dépend-il d'une interface de Repository ?

Le service dépend de :

```php
SalleRepositoryInterface
ReservationRepositoryInterface
```

et non directement de :

```php
EloquentSalleRepository
EloquentReservationRepository
```

Cela permet au service de connaître seulement le contrat dont il a besoin.

Cela facilite également les tests, car on peut injecter un faux repository sans utiliser MySQL.

### Quelle exception doit être levée en cas de conflit ?

Lorsqu'une réservation existe déjà sur la période demandée, le service lève :

```php
SalleIndisponibleException
```

Le repository recherche le conflit, mais c'est le service qui prend la décision métier de refuser la nouvelle réservation.

### Comment tester le service sans MySQL ?

On peut créer des faux repositories qui implémentent les mêmes interfaces que les vrais repositories.

Par exemple :

```text
CreerReservationService
        ↓
ReservationRepositoryInterface
        ↑
FakeReservationRepository
```

Le service ne sait pas qu'il utilise un faux repository.

Cela permet de tester :

* la création d'une réservation ;
* une salle inactive ;
* une durée supérieure à quatre heures ;
* une date dans le passé ;
* un conflit de réservation ;

sans avoir besoin de se connecter à MySQL.

### Résultat

Les tests manuels réalisés ont permis de vérifier les principaux comportements du service :

* réservation correcte acceptée ;
* salle inactive refusée ;
* durée supérieure à quatre heures refusée ;
* date passée refusée ;
* réservation en conflit refusée.

### Architecture obtenue

```text
HTTP
 ↓
Controller
 ↓
Service
 ↓
RepositoryInterface
 ↓
EloquentRepository
 ↓
Eloquent Model
 ↓
MySQL
```

Le service contient les règles métier et le repository contient l'accès aux données.

### Branche et version

Branche :

```text
feature/08-services
```

Version :

```text
v0.8.0
```


# Étape 9 — Créer les contrôleurs et les vues

## Objectif

Cette étape consiste à relier les données reçues par HTTP avec les validateurs, les DTO, les services métier et les vues.

L'objectif est de respecter les responsabilités de chaque couche :

```text
Requête HTTP
     ↓
Controller
     ↓
Validator
     ↓
DTO
     ↓
Service
     ↓
Repository
     ↓
Eloquent / MySQL
```

Après une opération réussie avec `POST`, l'application effectue une redirection afin d'éviter une nouvelle soumission du formulaire.

---

## Contrôleurs créés

Les contrôleurs suivants ont été créés :

```text
src/Controller/
├── SalleController.php
└── ReservationController.php
```

### SalleController

Actions prévues :

```text
index()
show()
create()
store()
edit()
update()
```

Responsabilités :

* afficher la liste des salles ;
* afficher le détail d'une salle ;
* afficher le formulaire de création ;
* recevoir les données du formulaire ;
* appeler `SalleValidator` ;
* construire le DTO ;
* appeler le service concerné ;
* rediriger après une opération réussie ;
* afficher les erreurs dans le formulaire en cas d'échec.

### ReservationController

Actions prévues :

```text
index()
show()
create()
store()
cancel()
```

Responsabilités :

* afficher les réservations ;
* afficher le détail d'une réservation ;
* afficher le formulaire de réservation ;
* recevoir les données HTTP ;
* appeler `ReservationValidator` ;
* construire `CreerReservationDTO` ;
* appeler `CreerReservationService` ;
* gérer les erreurs métier ;
* annuler une réservation ;
* rediriger après succès.

---

## Vues créées

Les vues sont organisées ainsi :

```text
templates/
├── layout/
│   └── base.php
│
├── salle/
│   ├── index.php
│   ├── show.php
│   └── form.php
│
├── reservation/
│   ├── index.php
│   ├── show.php
│   └── form.php
│
└── error/
    ├── 404.php
    └── 405.php
```

### Layout

`templates/layout/base.php` contient la structure commune des pages.

Les différentes pages peuvent réutiliser cette structure afin d'éviter de répéter le même HTML.

### Pages des salles

* `salle/index.php` : liste des salles ;
* `salle/show.php` : détail d'une salle ;
* `salle/form.php` : formulaire de création ou de modification.

### Pages des réservations

* `reservation/index.php` : liste des réservations ;
* `reservation/show.php` : détail d'une réservation ;
* `reservation/form.php` : formulaire de création d'une réservation.

### Pages d'erreur

* `error/404.php` : page introuvable ;
* `error/405.php` : méthode HTTP non autorisée.

---

## Responsabilité de `store()`

Les méthodes `store()` suivent le principe suivant :

```text
1. Lire les données HTTP
        ↓
2. Valider les données
        ↓
3. Afficher le formulaire avec les erreurs
   si les données sont invalides
        ↓
4. Construire le DTO
        ↓
5. Appeler le service métier
        ↓
6. Rediriger après succès
```

Le tableau `$_POST` n'est donc pas transmis directement au service.

Exemple de flux :

```text
$_POST
  ↓
Validator
  ↓
ValidationResult
  ↓
CreerReservationDTO
  ↓
CreerReservationService
  ↓
ReservationRepository
```

---

# Contraintes respectées

### Les contrôleurs ne contiennent pas de requêtes ORM

Le contrôleur n'utilise pas directement :

```php
Salle::query();
Reservation::where(...);
$model->save();
```

L'accès aux données est réalisé par les repositories.

### Les données HTTP sont validées

Les données reçues depuis les formulaires passent par :

```text
SalleValidator
ReservationValidator
```

avant d'être utilisées par les couches suivantes.

### Les DTO sont utilisés

Les services ne reçoivent pas directement `$_POST`.

Les données validées sont transformées en objets :

```text
CreerSalleDTO
CreerReservationDTO
```

### Les vues ne contiennent pas de logique métier

Les vues servent principalement à afficher les données et les erreurs.

Elles n'effectuent pas :

```php
Salle::query()
Reservation::where(...)
```

et ne décident pas si une réservation est autorisée.

### Les sorties dynamiques sont échappées

Les données affichées dans le HTML doivent être échappées avec :

```php
htmlspecialchars($value, ENT_QUOTES, 'UTF-8')
```

afin d'éviter l'injection de contenu HTML ou JavaScript.

### Redirection après POST

Après une création, une modification ou une annulation réussie, l'application effectue une redirection.

Cela suit le principe :

```text
POST
 ↓
Traitement
 ↓
Redirect
 ↓
GET
```

---

# Questions de l'étape 9

## 1. Pourquoi les contrôleurs ne doivent-ils pas contenir la logique métier ?

Le contrôleur est chargé de gérer la requête HTTP.

Il doit recevoir les données, appeler les composants nécessaires et préparer la réponse.

Les règles métier doivent rester dans les services.

Par exemple, le contrôleur ne doit pas décider lui-même :

```text
la durée est-elle supérieure à 4 heures ?
la salle est-elle active ?
y a-t-il un chevauchement ?
```

Ces règles appartiennent à `CreerReservationService`.

### Avantage

Cette séparation rend le code plus facile à comprendre, à tester et à maintenir.

---

## 2. Pourquoi utiliser un DTO entre le contrôleur et le service ?

Le DTO permet de transporter des données déjà préparées et correctement typées.

Par exemple :

```text
salleId     → int
responsable → string
email       → string
motif       → string
dateDebut   → DateTimeImmutable
dateFin     → DateTimeImmutable
```

Le service ne reçoit donc pas directement un tableau `$_POST`.

### Avantage

Le service travaille avec une structure claire et prévisible.

Le DTO sépare également les données HTTP de la logique métier.

---

## 3. Pourquoi effectuer une redirection après un POST réussi ?

Après un `POST`, l'application redirige vers une page `GET`.

Exemple :

```text
POST /reservations
       ↓
création réussie
       ↓
redirect
       ↓
GET /reservations
```

Cela évite qu'un actualisation du navigateur renvoie encore le formulaire en `POST`.

Cette technique suit le principe **Post/Redirect/Get (PRG)**.

---

## 4. Pourquoi les vues ne doivent-elles pas contenir les règles métier ?

Une vue a pour rôle d'afficher les informations.

Elle ne doit pas décider :

* si une salle peut être réservée ;
* si une réservation est en conflit ;
* si la durée dépasse quatre heures ;
* si une réservation doit être acceptée.

Ces décisions sont prises dans les services métier.

Cette séparation permet d'avoir :

```text
Controller → gestion HTTP
Service    → règles métier
Repository → accès aux données
View       → affichage
```

Chaque couche a donc une responsabilité claire.

---

# Résumé de l'architecture

L'étape 9 a permis de relier les couches précédentes avec l'interface web :

```text
Navigateur
    ↓
Controller
    ↓
Validator
    ↓
DTO
    ↓
Service
    ↓
Repository
    ↓
Eloquent
    ↓
MySQL
```

Puis le résultat remonte vers :

```text
MySQL
   ↓
Repository
   ↓
Service
   ↓
Controller
   ↓
View
   ↓
Navigateur
```

---

# Versionnement

Branche :

```text
feature/09-interface-web
```

Commit :

```text
feat: créer les contrôleurs et les vues
```

Tag :

```text
v0.9.0
```

Le tag `v0.9.0` correspond à la fin de l'étape Interface Web.

La configuration Docker est conservée séparément dans :

```text
feature/09-docker
```

avec le commit :

```text
feat: conteneuriser l'application avec Docker
```

Ainsi, le travail fonctionnel de l'étape 9 et le travail Docker restent séparés dans l'historique Git.



# Étape 10 — Configurer FastRoute

## 1. Objectif de l'étape

Cette étape consiste à mettre en place le routage de l'application avec **FastRoute**.

Le routeur permet de faire le lien entre :

* la requête HTTP du navigateur ;
* l'URL demandée ;
* la méthode HTTP utilisée ;
* le contrôleur ;
* l'action du contrôleur ;
* les paramètres présents dans l'URL.

L'objectif est également de séparer les responsabilités.

Le fichier `routes/web.php` déclare les routes, tandis que `public/index.php` exécute le routage.

---

# 2. Qu'est-ce qu'une route ?

Une route est une règle qui indique à l'application :

> Pour telle méthode HTTP et telle URL, quelle action doit être exécutée ?

Par exemple :

```php
$router->addRoute('GET', '/salles', [
    SalleController::class,
    'index'
]);
```

Cette route signifie :

```text
Méthode HTTP : GET
URL          : /salles
Action       : SalleController::index()
```

Donc lorsque l'utilisateur visite :

```text
GET /salles
```

FastRoute doit trouver cette route.

---

# 3. Qu'est-ce que FastRoute ?

**FastRoute** est une bibliothèque PHP spécialisée dans le routage.

Elle ne construit pas les contrôleurs et ne contient pas les règles métier.

Son rôle principal est de répondre à cette question :

> Quelle route correspond à cette requête HTTP ?

Exemple :

```text
GET /salles/5
```

FastRoute cherche une route correspondant à :

```text
GET /salles/{id:\d+}
```

Puis il retourne le handler et les paramètres trouvés.

---

# 4. Déclaration des routes

Les routes sont déclarées dans :

```text
routes/web.php
```

Le fichier contient uniquement les déclarations de routes.

```php
<?php

use App\Controller\ReservationController;
use App\Controller\SalleController;
use FastRoute\RouteCollector;

return function (RouteCollector $router): void {

    $router->addRoute('GET', '/', [
        SalleController::class,
        'index'
    ]);

    $router->addRoute('GET', '/salles', [
        SalleController::class,
        'index'
    ]);

    $router->addRoute('GET', '/salles/create', [
        SalleController::class,
        'create'
    ]);

    $router->addRoute('POST', '/salles', [
        SalleController::class,
        'store'
    ]);

    $router->addRoute('GET', '/salles/{id:\d+}', [
        SalleController::class,
        'show'
    ]);

    $router->addRoute('GET', '/salles/{id:\d+}/edit', [
        SalleController::class,
        'edit'
    ]);

    $router->addRoute('POST', '/salles/{id:\d+}/edit', [
        SalleController::class,
        'update'
    ]);

    $router->addRoute('GET', '/reservations', [
        ReservationController::class,
        'index'
    ]);

    $router->addRoute('GET', '/reservations/create', [
        ReservationController::class,
        'create'
    ]);

    $router->addRoute('POST', '/reservations', [
        ReservationController::class,
        'store'
    ]);

    $router->addRoute('GET', '/reservations/{id:\d+}', [
        ReservationController::class,
        'show'
    ]);

    $router->addRoute('POST', '/reservations/{id:\d+}/cancel', [
        ReservationController::class,
        'cancel'
    ]);
};
```

---

# 5. Explication de `RouteCollector`

Nous importons :

```php
use FastRoute\RouteCollector;
```

`RouteCollector` est l'objet fourni par FastRoute qui permet **d'enregistrer les routes**.

Dans :

```php
function (RouteCollector $router): void
```

`$router` représente l'objet qui reçoit nos routes.

Par exemple :

```php
$router->addRoute(
    'GET',
    '/salles',
    [
        SalleController::class,
        'index'
    ]
);
```

veut dire :

> Ajoute cette route au routeur.

---

# 6. Pourquoi `return function` ?

Dans `web.php`, nous avons :

```php
return function (RouteCollector $router): void {
    // routes
};
```

Le fichier retourne donc une fonction.

Dans `public/index.php` :

```php
$routes = require __DIR__ . '/../routes/web.php';
```

PHP récupère cette fonction et la stocke dans :

```php
$routes
```

On peut ensuite l'exécuter avec :

```php
$routes($router);
```

Cela permet de garder la déclaration des routes séparée de la création du dispatcher.

---

# 7. Le handler

Le **handler** est la cible de la route.

Il indique :

> Quelle classe et quelle méthode doivent traiter cette requête ?

Exemple :

```php
[
    SalleController::class,
    'show'
]
```

Cela signifie :

```text
Classe  → SalleController
Méthode → show
```

Le handler ne construit pas le contrôleur.

Il indique seulement **quelle action doit être exécutée**.

---

# 8. Pourquoi utiliser `SalleController::class` ?

Nous avons :

```php
SalleController::class
```

au lieu de :

```php
'SalleController'
```

`::class` permet d'obtenir le nom complet de la classe avec son namespace.

Notre classe est :

```php
namespace App\Controller;
```

Donc :

```php
SalleController::class
```

correspond à :

```text
App\Controller\SalleController
```

Cela permet au conteneur DI de savoir quelle classe il devra récupérer.

---

# 9. Les paramètres dynamiques

Nous avons cette route :

```php
'/salles/{id:\d+}'
```

La partie :

```text
{id:\d+}
```

représente un paramètre dynamique.

Exemple :

```text
/salles/5
```

donne :

```php
[
    'id' => '5'
]
```

Le `id` est le nom du paramètre.

---

# 10. Pourquoi `\d+` ?

`\d` signifie :

> un chiffre.

Le `+` signifie :

> un ou plusieurs.

Donc :

```text
\d+
```

signifie :

> un ou plusieurs chiffres.

Ainsi :

```text
/salles/5
/salles/10
/salles/125
```

sont acceptés.

Mais :

```text
/salles/abc
/salles/test
```

ne correspondent pas à cette route.

Cette contrainte permet donc de dire que l'identifiant attendu dans l'URL doit être numérique.

---

# 11. Le Front Controller

Notre application utilise :

```text
public/index.php
```

comme point d'entrée unique.

Cela signifie que les requêtes passent par :

```text
public/index.php
```

avant d'arriver au contrôleur.

Le fonctionnement général est :

```text
Navigateur
     ↓
public/index.php
     ↓
FastRoute
     ↓
Recherche de la route
     ↓
Contrôleur
     ↓
Action
```

C'est le principe du **Front Controller**.

---

# 12. Chargement de Composer

Dans `public/index.php`, nous avons :

```php
require_once __DIR__ . '/../vendor/autoload.php';
```

Cette ligne charge l'autoload de Composer.

Elle permet à PHP de retrouver automatiquement les classes du projet et les bibliothèques installées.

Par exemple :

```text
App\Controller\SalleController
App\Model\Salle
FastRoute
PHP-DI
Respect\Validation
```

sans devoir faire manuellement un `require` pour chaque classe.

---

# 13. Chargement des routes

Nous avons :

```php
$routes = require __DIR__ . '/../routes/web.php';
```

Cette ligne récupère la fonction retournée par `web.php`.

On peut donc représenter cela ainsi :

```text
routes/web.php
      ↓
fonction de déclaration des routes
      ↓
$routes
```

---

# 14. Création du dispatcher

Nous avons :

```php
$dispatcher = FastRoute\simpleDispatcher(
    function (FastRoute\RouteCollector $router) use ($routes): void {
        $routes($router);
    }
);
```

Le **dispatcher** est l'objet qui va rechercher quelle route correspond à une requête.

On peut voir son rôle comme celui d'un agent qui reçoit :

```text
GET /salles/5
```

et cherche dans toutes les routes :

```text
Quelle route correspond ?
```

---

# 15. Pourquoi `simpleDispatcher()` ?

```php
FastRoute\simpleDispatcher(...)
```

est une fonction fournie par FastRoute permettant de créer le dispatcher.

Elle reçoit une fonction qui va enregistrer toutes les routes.

À l'intérieur :

```php
$routes($router);
```

nous exécutons notre fonction provenant de `web.php`.

---

# 16. Pourquoi `use ($routes)` ?

Nous avons :

```php
function (FastRoute\RouteCollector $router) use ($routes): void
```

La variable `$routes` a été créée à l'extérieur de cette fonction.

```php
$routes = require ...;
```

`use ($routes)` permet à la fonction d'utiliser cette variable.

Ensuite :

```php
$routes($router);
```

exécute la fonction contenue dans `$routes`.

---

# 17. Récupérer la méthode HTTP

Nous avons :

```php
$httpMethod = $_SERVER['REQUEST_METHOD'];
```

Cette variable permet de connaître la méthode HTTP utilisée.

Exemples :

```text
GET
POST
PUT
DELETE
```

Pour consulter une page :

```text
GET /salles
```

Pour envoyer un formulaire :

```text
POST /salles
```

---

# 18. Récupérer l'URL

Nous avons :

```php
$uri = parse_url(
    $_SERVER['REQUEST_URI'],
    PHP_URL_PATH
);
```

`$_SERVER['REQUEST_URI']` contient l'URI demandée.

Par exemple :

```text
/salles/5?type=cours
```

Mais FastRoute doit travailler avec le chemin :

```text
/salles/5
```

Nous utilisons donc :

```php
parse_url(
    $_SERVER['REQUEST_URI'],
    PHP_URL_PATH
);
```

pour récupérer uniquement le chemin.

---

# 19. Qu'est-ce qu'une query string ?

Dans :

```text
/salles?type=cours
```

la partie :

```text
?type=cours
```

est une **query string**.

Elle contient des paramètres de requête.

Nous ne voulons pas transmettre cette partie au routeur comme faisant partie du chemin.

Ainsi :

```text
/salles?type=cours
```

devient :

```text
/salles
```

pour FastRoute.

---

# 20. Le dispatch

Nous avons :

```php
$routeInfo = $dispatcher->dispatch(
    $httpMethod,
    $uri
);
```

`dispatch()` demande à FastRoute :

> Quelle route correspond à cette méthode HTTP et à cette URI ?

Par exemple :

```text
GET /salles/5
```

FastRoute recherche parmi les routes.

S'il trouve :

```php
GET /salles/{id:\d+}
```

il retourne un résultat `FOUND`.

---

# 21. Les trois résultats principaux

FastRoute peut principalement retourner :

```text
FOUND
NOT_FOUND
METHOD_NOT_ALLOWED
```

## FOUND

Une route correspond.

Exemple :

```text
GET /salles
```

Résultat :

```text
FOUND
```

---

## NOT_FOUND

Aucune route ne correspond.

Exemple :

```text
GET /bonjour
```

Si aucune route `/bonjour` n'existe :

```text
NOT_FOUND
```

Nous retournons alors :

```php
http_response_code(404);
```

Le code HTTP `404` signifie :

> Ressource ou page introuvable.

---

## METHOD_NOT_ALLOWED

Le chemin existe mais la méthode HTTP n'est pas autorisée.

Par exemple, nous avons :

```php
$router->addRoute('GET', '/salles', ...);
```

mais le client envoie :

```text
POST /salles
```

Dans notre application, nous avons également `POST /salles`, donc prenons un exemple comme :

```text
DELETE /salles
```

Si aucune route DELETE n'est déclarée pour `/salles`, FastRoute peut retourner :

```text
METHOD_NOT_ALLOWED
```

Nous envoyons alors :

```php
http_response_code(405);
```

Le code `405` signifie :

> La méthode HTTP utilisée n'est pas autorisée.

---

# 22. Le header `Allow`

L'énoncé demande également d'ajouter :

```php
header(
    'Allow: ' . implode(', ', $routeInfo[1])
);
```

`Allow` indique au client quelles méthodes sont autorisées.

Par exemple :

```text
Allow: GET, POST
```

`implode(', ', ...)` transforme un tableau comme :

```php
[
    'GET',
    'POST'
]
```

en :

```text
GET, POST
```

---

# 23. Le bloc `switch`

Notre code utilise :

```php
switch ($routeInfo[0]) {
```

Il regarde le résultat fourni par FastRoute.

Nous avons :

```php
case FastRoute\Dispatcher::NOT_FOUND:
```

pour le 404.

Puis :

```php
case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
```

pour le 405.

Enfin :

```php
case FastRoute\Dispatcher::FOUND:
```

lorsqu'une route est trouvée.

---

# 24. Récupérer le handler

Lorsque FastRoute trouve une route :

```php
case FastRoute\Dispatcher::FOUND:

    $handler = $routeInfo[1];

    $vars = $routeInfo[2];

    $controllerClass = $handler[0];

    $method = $handler[1];

    break;
```

Le résultat peut être représenté ainsi :

```php
$routeInfo = [
    FOUND,
    [
        SalleController::class,
        'show'
    ],
    [
        'id' => '5'
    ]
];
```

Donc :

```php
$routeInfo[0]
```

contient :

```text
FOUND
```

```php
$routeInfo[1]
```

contient le handler :

```php
[
    SalleController::class,
    'show'
]
```

et :

```php
$routeInfo[2]
```

contient les paramètres :

```php
[
    'id' => '5'
]
```

---

# 25. Pourquoi le routeur ne construit-il pas lui-même le contrôleur ?

Le routeur ne doit pas faire :

```php
new SalleController(...);
```

Son rôle est uniquement de faire correspondre :

```text
Méthode + URL
```

avec :

```text
Handler
```

La création du contrôleur appartient au **conteneur de dépendances**.

Nous voulons donc :

```text
FastRoute
    ↓
trouve le handler
    ↓
[SalleController::class, 'show']
    ↓
Container
    ↓
construit SalleController
    ↓
injecte ses dépendances
```

Cela respecte mieux la séparation des responsabilités.

Le conteneur sera configuré à l'étape suivante avec **PHP-DI**.

---

# 26. Différence entre 404 et 405

## 404

Le chemin demandé n'existe pas.

Exemple :

```text
GET /abc
```

si aucune route `/abc` n'existe.

```text
404 Not Found
```

## 405

Le chemin existe, mais la méthode utilisée n'est pas autorisée.

Exemple :

```text
DELETE /salles
```

alors que seules certaines méthodes sont déclarées pour `/salles`.

```text
405 Method Not Allowed
```

La différence est donc :

```text
404 → le chemin n'est pas trouvé

405 → le chemin existe, mais la méthode HTTP ne convient pas
```

---

# 27. Pourquoi contraindre `id` avec `\d+` ?

Nous avons :

```php
'/salles/{id:\d+}'
```

Cela indique que `id` doit être composé de chiffres.

Cela permet d'éviter qu'une URL comme :

```text
/salles/bonjour
```

soit considérée comme un identifiant valide.

Exemples acceptés :

```text
/salles/1
/salles/10
/salles/250
```

Exemples refusés par cette contrainte :

```text
/salles/abc
/salles/test
```

---

# 28. Quel composant interprète le handler ?

FastRoute **trouve et retourne le handler**.

Il ne construit pas le contrôleur.

Le handler est ensuite interprété par notre code de dispatch dans `public/index.php`.

À l'étape suivante, le **conteneur PHP-DI** permettra de récupérer l'objet correspondant à la classe du handler.

On aura donc :

```text
FastRoute
    ↓
trouve le handler
    ↓
public/index.php
    ↓
Container PHP-DI
    ↓
contrôleur
    ↓
méthode
```

---

# 29. Architecture obtenue

Après cette étape, le chemin d'une requête est :

```text
Navigateur
     ↓
HTTP Request
     ↓
public/index.php
     ↓
FastRoute
     ↓
Recherche de la route
     ↓
Handler
     ↓
Contrôleur
     ↓
Action
```

Par exemple :

```text
GET /salles/5
       ↓
public/index.php
       ↓
FastRoute
       ↓
GET /salles/{id:\d+}
       ↓
[SalleController::class, 'show']
       ↓
id = 5
```

---

# 30. Respect des principes d'architecture

Cette étape respecte plusieurs principes importants.

## Responsabilité unique

`routes/web.php` :

```text
déclarer les routes
```

FastRoute :

```text
chercher une route
```

`public/index.php` :

```text
recevoir la requête et orchestrer le dispatch
```

Le contrôleur :

```text
traiter l'action HTTP
```

Chaque élément possède donc une responsabilité claire.

---

## Dependency Injection

Nous ne faisons pas :

```php
new SalleController(...);
```

dans `web.php`.

Le contrôleur sera obtenu par le conteneur.

Cela permettra d'injecter automatiquement ses dépendances.

---

## Dependency Inversion

Le contrôleur utilise déjà des interfaces comme :

```php
SalleRepositoryInterface
```

et :

```php
ReservationRepositoryInterface
```

Il dépend donc d'abstractions plutôt que directement d'une implémentation concrète.

---

## Pas de logique métier dans le routeur

Le routeur ne vérifie pas :

```text
si une salle est disponible
si une réservation existe déjà
si une durée dépasse 4 heures
```

Ces règles restent dans les services.

Le routeur se contente de diriger la requête.

---

# 31. Code final de `public/index.php`

À la fin de cette étape, nous avons :

```php
<?php

require_once __DIR__ . '/../vendor/autoload.php';

$routes = require __DIR__ . '/../routes/web.php';

$dispatcher = FastRoute\simpleDispatcher(
    function (FastRoute\RouteCollector $router) use ($routes): void {
        $routes($router);
    }
);

$httpMethod = $_SERVER['REQUEST_METHOD'];

$uri = parse_url(
    $_SERVER['REQUEST_URI'],
    PHP_URL_PATH
);

$routeInfo = $dispatcher->dispatch(
    $httpMethod,
    $uri
);

switch ($routeInfo[0]) {

    case FastRoute\Dispatcher::NOT_FOUND:
        http_response_code(404);

        require __DIR__ . '/../templates/error/404.php';

        break;

    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        http_response_code(405);

        header(
            'Allow: ' . implode(', ', $routeInfo[1])
        );

        require __DIR__ . '/../templates/error/405.php';

        break;

    case FastRoute\Dispatcher::FOUND:

        $handler = $routeInfo[1];

        $vars = $routeInfo[2];

        $controllerClass = $handler[0];

        $method = $handler[1];

        break;
}
```

---

# 32. Vérification

Vérification de la syntaxe de `routes/web.php` :

```bash
php -l routes/web.php
```

Résultat attendu :

```text
No syntax errors detected in routes/web.php
```

Vérification de `public/index.php` :

```bash
php -l public/index.php
```

Résultat obtenu :

```text
No syntax errors detected in public/index.php
```

---

# 33. Commandes Git

Créer la branche :

```bash
git switch -c feature/10-router
```

Vérifier les fichiers modifiés :

```bash
git status
```

Ajouter les modifications :

```bash
git add .
```

Créer le commit :

```bash
git commit -m "feat: configurer le routage avec FastRoute"
```

Créer le tag :

```bash
git tag v0.10.0
```

Envoyer la branche :

```bash
git push origin feature/10-router
```

Envoyer le tag :

```bash
git push origin v0.10.0
```

---

# 34. Questions de l'étape 10

### 1. Pourquoi FastRoute ne construit-il pas lui-même le contrôleur ?

Parce que FastRoute est responsable du **routage**, pas de la création des objets.

Son travail est de trouver :

```text
quelle route correspond ?
```

et de retourner le handler.

La création du contrôleur et l'injection de ses dépendances seront confiées au conteneur DI.

---

### 2. Quelle est la différence entre 404 et 405 ?

**404** :

> aucune route ne correspond au chemin demandé.

**405** :

> le chemin existe, mais la méthode HTTP utilisée n'est pas autorisée.

---

### 3. Pourquoi contraindre `id` avec `\d+` ?

Parce que `\d+` signifie :

> un ou plusieurs chiffres.

Cela permet de faire correspondre :

```text
/salles/1
/salles/25
/salles/100
```

mais pas :

```text
/salles/abc
```

Cela permet également d'exprimer clairement que l'identifiant attendu est numérique.

---

### 4. Quel composant interprète le handler ?

FastRoute **retourne** le handler.

Notre code de dispatch dans `public/index.php` récupère ce handler.

Ensuite, le conteneur DI sera chargé de récupérer/construire le contrôleur correspondant.

Le fonctionnement complet sera :

```text
FastRoute
    ↓
trouve le handler
    ↓
public/index.php
    ↓
PHP-DI Container
    ↓
Controller
    ↓
Action
```

---

# 35. Ce que j'ai appris dans cette étape

À la fin de cette étape, je dois être capable de définir :

* une route ;
* un routeur ;
* FastRoute ;
* un dispatcher ;
* un handler ;
* une méthode HTTP ;
* une URI ;
* une query string ;
* un paramètre dynamique ;
* une contrainte `\d+` ;
* une erreur 404 ;
* une erreur 405 ;
* le header `Allow` ;
* le principe du Front Controller ;
* pourquoi le routeur ne doit pas construire directement les contrôleurs ;
* pourquoi le conteneur DI interviendra ensuite.

Le flux à retenir est :

```text
Requête HTTP
     ↓
public/index.php
     ↓
FastRoute
     ↓
Route
     ↓
Handler
     ↓
Container DI
     ↓
Controller
     ↓
Action
```



## Étape 11 — Configurer PHP-DI

### Objectif

Cette étape consiste à intégrer **PHP-DI** dans l'application afin de centraliser la création des objets et leurs dépendances.

Le conteneur permet notamment de créer automatiquement les contrôleurs, services, validateurs et repositories nécessaires au fonctionnement de l'application.

### Configuration du conteneur

Le fichier :

```text
config/container.php
```

contient les définitions du conteneur PHP-DI.

Les classes concrètes simples utilisent l'autowiring :

```php
SalleController::class => autowire(),
ReservationController::class => autowire(),
CreerReservationService::class => autowire(),
```

Les interfaces doivent avoir une définition explicite :

```php
SalleRepositoryInterface::class =>
    autowire(EloquentSalleRepository::class),

ReservationRepositoryInterface::class =>
    autowire(EloquentReservationRepository::class),
```

Cela permet à PHP-DI de savoir quelle classe concrète utiliser lorsqu'une classe demande une interface.

### Injection de dépendances

Une injection de dépendance consiste à fournir à une classe les objets dont elle a besoin.

Par exemple :

```php
public function __construct(
    private SalleRepositoryInterface $salleRepository
) {
}
```

Le contrôleur indique qu'il a besoin d'un `SalleRepositoryInterface`.

Il ne crée pas lui-même le repository.

Le conteneur PHP-DI se charge de fournir l'implémentation correspondante.

### Différence entre injection et conteneur

**Injection de dépendance :**

C'est le fait de donner à une classe ce dont elle a besoin.

**Conteneur :**

C'est l'outil qui connaît les dépendances et qui peut construire les objets nécessaires.

On peut résumer ainsi :

```text
Injection
= donner une dépendance à une classe

Conteneur
= gérer et construire les dépendances
```

### Autowiring

L'autowiring permet à PHP-DI de construire automatiquement une classe concrète en analysant son constructeur.

Par exemple :

```php
CreerSalleService::class => autowire(),
```

Si le service possède :

```php
public function __construct(
    SalleRepositoryInterface $salleRepository
) {
}
```

PHP-DI cherche la définition de `SalleRepositoryInterface` et trouve :

```php
SalleRepositoryInterface::class =>
    autowire(EloquentSalleRepository::class),
```

Il peut alors construire automatiquement le service avec le bon repository.

### Pourquoi les interfaces ont besoin d'une définition ?

Une interface ne peut pas être instanciée directement.

PHP-DI ne peut donc pas faire :

```php
new SalleRepositoryInterface();
```

Il faut lui indiquer quelle classe utiliser :

```php
SalleRepositoryInterface::class =>
    autowire(EloquentSalleRepository::class),
```

On obtient donc :

```text
SalleRepositoryInterface
        ↓
EloquentSalleRepository
```

Le code dépend de l'interface et non directement de l'implémentation.

### Factory pour les objets configurés

Certains objets ont besoin d'une configuration particulière.

Pour `Illuminate\Database\Capsule\Manager`, une factory est utilisée :

```php
Manager::class => factory(function (): Manager {
    // configuration de la connexion MySQL

    return $capsule;
}),
```

Cette factory permet de créer et configurer correctement Eloquent avant son utilisation.

FastRoute utilise également une factory pour construire le dispatcher à partir des routes définies dans :

```text
routes/web.php
```

### Rôle de `public/index.php`

`public/index.php` est le point d'entrée de l'application.

Il crée le conteneur :

```php
$builder = new ContainerBuilder();

$builder->addDefinitions(
    dirname(__DIR__) . '/config/container.php'
);

$container = $builder->build();
```

Puis il récupère les objets nécessaires :

```php
$container->get(Manager::class);

$dispatcher = $container->get(Dispatcher::class);
```

Lorsqu'une route est trouvée, le conteneur récupère le contrôleur :

```php
$controller = $container->get($controllerClass);
```

Le contrôleur est donc construit avec toutes ses dépendances.

### Pourquoi limiter `container->get()` au point d'entrée ?

Le conteneur doit principalement être utilisé au niveau du point d'entrée de l'application.

Les classes métier ne doivent pas recevoir le conteneur uniquement pour rechercher leurs dépendances.

Mauvaise pratique :

```php
final class CreerReservationService
{
    public function __construct(
        private ContainerInterface $container
    ) {
    }
}
```

Bonne pratique :

```php
final class CreerReservationService
{
    public function __construct(
        private SalleRepositoryInterface $salles,
        private ReservationRepositoryInterface $reservations
    ) {
    }
}
```

La classe connaît directement ce dont elle a besoin.

### Anti-pattern : Service Locator

Si toutes les classes utilisent le conteneur pour rechercher elles-mêmes leurs dépendances, on tombe dans un anti-pattern appelé **Service Locator**.

Exemple :

```text
Classe
  ↓
Conteneur
  ↓
Recherche d'une dépendance
```

Cela rend les dépendances moins visibles et rend le code plus difficile à tester et à maintenir.

Avec l'injection de dépendances :

```text
Conteneur
  ↓
Construit la dépendance
  ↓
La donne à la classe
```

### Architecture après PHP-DI

Le fonctionnement de l'application peut être résumé ainsi :

```text
Navigateur
    ↓
public/index.php
    ↓
Conteneur PHP-DI
    ↓
FastRoute
    ↓
Contrôleur
    ↓
Service
    ↓
Repository
    ↓
Eloquent
    ↓
MySQL
```

PHP-DI permet donc de gérer automatiquement la construction des objets et leur injection, sans que les classes aient besoin de connaître le conteneur.

### Questions de l'étape 11

**1. Quelle différence existe entre injection et conteneur ?**

L'injection consiste à fournir une dépendance à une classe. Le conteneur est l'outil qui construit et fournit ces dépendances.

**2. Qu'est-ce que l'autowiring ?**

L'autowiring permet au conteneur de construire automatiquement les classes concrètes en analysant leurs dépendances dans le constructeur.

**3. Pourquoi les interfaces nécessitent-elles une définition ?**

Parce qu'une interface ne peut pas être instanciée. Le conteneur doit connaître l'implémentation à utiliser.

**4. Pourquoi limiter `container->get()` au point d'entrée ?**

Pour éviter que les classes dépendent directement du conteneur et pour conserver une injection de dépendances claire.

**5. Quel anti-pattern apparaît si toutes les classes interrogent le conteneur ?**

Le **Service Locator**.

### Versionnement

Branche :

```text
feature/11-container
```

Version :

```text
v0.11.0
```

Commit principal :

```text
feat: configurer le conteneur PHP-DI
```
