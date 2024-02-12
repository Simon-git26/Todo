ToDoList
========
Project 8: Améliorez une application existante de ToDo & Co


## Pre-requisites
- [Link](https://symfony.com/doc/5.x/setup.html#technical-requirements) verifier les exigences requises par Symfony

- PHP 7.2.5 minimum / MySQL 5.7 minimum

## Informations

Vous pouvez accéder aux informations de contribution en cliquant [ici](https://github.com/Simon-git26/Todo/blob/master/contribution.md)

## Installation

1. Cloner le repository 

        git clone https://github.com/Simon-git26/Todo.git

2. Configurez la connexion à votre BDD sur un fichier `.env.local`

3. Installer les dependances

        composer install
        
4.  Créer votre BDD

        php bin/console doctrine:database:create

4.  Chargement des Fixtures

        php bin/console doctrine:fixtures:load 

5.  Créer vos entitées avec le MakerBundle
        
6. Migrer vos tables en BDD

        php bin/console make:migration
        php bin/console doctrine:migrations:migrate 

8. Lancer le serveur Symfony
   
        symfony server:start
        
        
9. Tests
        Configurez la connexion à votre BDD sur un fichier `.env.test.local`
        Tester une methode en particulier : vendor/bin/phpunit --filter=(Nom de la fonction à tester) > public/resultTest.html
        Obtenir le code coverage : vendor/bin/phpunit --coverage-html public/test-coverage

### Informations concernant les tests

  * Important:
     * Il faut impérativement que [XDebug](https://xdebug.org/) soit installé afin que les tests unitaires et fonctionnels soit lancés correctement.
 
 ## Outils utilisés

  * [Symfony](https://symfony.com/)
  * [Composer](https://getcomposer.org/)
  * [Bootstrap](https://getbootstrap.com/)
  * [Twig](https://twig.symfony.com/)
  * [Phpunit](https://phpunit.de/)
  * [Code Climate](https://codeclimate.com/)
  * [Codacy](https://www.codacy.com/)
  
## Auteur

  * Balleux Simon