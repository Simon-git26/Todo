ToDoList
========
Project 8: Améliorez une application existante de ToDo & Co


## Pre-requisites
- [Link](https://symfony.com/doc/5.x/setup.html#technical-requirements) verifier les exigences requises par Symfony

- PHP 7.2.5 minimum / MySQL 5.7 minimum

## Installation

1. Cloner le repository 

        git clone https://github.com/Simon-git26/Todo.git

2. Configurez la connexion à votre BDD sur un fichier `.env.local`

3. Installer les dependances

        composer install
        
4.  Créer votre BDD

        php bin/console doctrine:database:create

5.  Créer vos entitées avec le MakerBundle
        
6. Migrer vos tables en BDD

        php bin/console make:migration
        php bin/console doctrine:migrations:migrate 

8. Lancer le serveur Symfony
   
        symfony server:start
        
        
9. Tests
        vendor/bin/phpunit --filter=(Nom de la fonction à tester) > public/resultTest.html
