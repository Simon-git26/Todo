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

3. Installer les dépendances

        composer install
        
4. Créer votre BDD:
      ```
      php bin/console doctrine:database:create
      ```

5. Créer vos entités avec le MakerBundle
      ```
      php bin/console make:entity
      ```

6.  Generez les migrations
        ```
        php bin/console make:migration
        ```
      
        ```
        php bin/console doctrine:migrations:migrate
        ```

7.  Chargement des Fixtures

        ```
        php bin/console doctrine:fixtures:load 
        ```

8. Lancer le serveur Symfony
   
        ```
        symfony server:start
        ```  

9. Tests
        Configurez la connexion à votre BDD sur un fichier `.env.test.local`
        Tester une methode en particulier : vendor/bin/phpunit --filter=(Nom de la fonction à tester) > public/resultTest.html
        Obtenir le code coverage : vendor/bin/phpunit --coverage-html public/test-coverage


### Informations concernant la connexion
  * Se connecter en tant que Role User :
     * Email : simoncestmoi@hotmail.fr1 / Mot de passe : Usertest1

  * Se connecter en tant que Role Admin :
     * Email : simoncestmoi@hotmail.fr / Mot de passe : Adminadmin


### Informations concernant les tests

  * Important:
     * Il est important que l'extensions [XDebug](https://xdebug.org/) soit installé sur votre environnement de developpement afin que les tests unitaires et fonctionnels soit lancés correctement.

     * L'extensions XDebug est utile au debogage en fournissant des fonctionnalités comme la générations de rapports d'erreurs détaillés pour faciliter le développement et l'optimisation du code. C'est pour cette raison que l'extension est importante afin de generer notre code coverage grâce à PhpUnit.

     * Vous pouvez utiliser l'assitant [Assistant XDebug](https://xdebug.org/wizard) afin d'avoir une aide pour l'installation de son extension
 
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