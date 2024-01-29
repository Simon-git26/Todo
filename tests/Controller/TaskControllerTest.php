<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\BrowserKit\Response;

use App\Repository\UserRepository;

class TaskControllerTest extends WebTestCase
{
    
    private $client;
    
    /*
    public function testAuthPageIsRestricted(): void
    {
        // Simuler un navigateur, dans l'application nous connecté a la page
        $client = static::createClient();
        $client->request('GET',  '/login');
        $this->assertResponseStatusCodeSame(Response::HTTP_UNAUTHORIZED);
    }


    public function testRedirectToLogin(): void
    {
        // Simuler un navigateur, dans l'application nous connecté a la page
        $client = static::createClient();
        $client->request('GET',  '/login');
        $this->assertResponseRedirects('/login');
    }
    */

    
    /*public function testDisplayLogin()
    {
        // Simuler un navigateur, dans l'application nous connecté a la page
        $this->client = static::createClient();

        $this->client->request('GET',  '/login');
        
        // Je m'attend à avoir un code status 200
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        // Je m'attend à avoir un element h2 value Se connnecter !
        $this->assertSelectorTextContains('h2', 'Se connecter !');

        // Je ne doit pas avoir de class danger
        $this->assertSelectorNotExists('.alert.alert-danger');
    }*/


    // Login qui n'existe pas
    /*public function testLoginWithBadCredentials()
    {
        $this->client = static::createClient();
        $crawler =  $this->client->request('GET',  '/login');

        $form = $crawler->selectButton('Se connecter')->form([
            '_username' => 'simoncestmoi@hotmail.fr',
            '_password' => 'existepas'
        ]);
        
        $this->client->submit($form);

        $this->assertResponseRedirects('/login');
        $this->client->followRedirect();

        $this->assertSelectorExists('.alert.alert-danger');
    }*/


    // Login existant qui se connecte
    /*
    public function testSuccessFullLogin()
    {
        $this->client = static::createClient();
        $crawler =  $this->client->request('GET',  '/login');

        // Je m'attend à avoir un code status 200
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        
        // Je m'attend à avoir un element h2 value Se connnecter !
        $this->assertSelectorTextContains('h2', 'Se connecter !');

        $form = $crawler->selectButton('Se connecter')->form([
            '_username' => 'simoncestmoi@hotmail.fr',
            '_password' => 'Adminadmin'
        ]);

        $this->client->submit($form);
    }
    */




    // Login existant qui se connecte
    /*
    * Recuperer la route du login
    * Soumettre le formulaire
    * Etre redirigé sur la page accueil, ce qui voudra dire qu'on s'est bien connecté
    */
    /*
    public function testSuccessFullLogin()
    {

        $this->client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);

        // retrieve the test user
        $testUser = $userRepository->findOneByEmail('simoncestmoi@hotmail.fr');

        // simulate $testUser being logged in
        $this->client->loginUser($testUser);

        // tester d'aller sur ma page d'accueil
        $this->client->request('GET', '/');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h4', 'Bienvenue sur Todo List, l\'application vous permettant de gérer l\'ensemble de vos tâches !');
    }
    */

    public function testSuccessFullLogin()
    {
        $this->client = static::createClient();
        
        /** @var UrlGeneratorInterface $urlGenerator */
        $urlGenerator = $this->client->getContainer()->get("router");

        $crawler = $this->client->request('GET', $urlGenerator->generate('app_login'));

        // Recuperer le Formulaire grace à son name et generer les données
        $form = $crawler->filter("form[name=login]")->form([
            '_username' => 'simoncestmoi@hotmail.fr',
            '_password' => 'Adminadmin'
        ]);

        // Soumettre le formulaire
        $this->client->submit($form);

        // Je m'attend a : Une redirection (vers la page accueil)
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
       
        // Suivre cette redirection
        $this->client->followRedirect();

        // Verifier si la route obtenue est la meme que celle attendu
        $this->assertRouteSame('app_default');

    }



    // Login existant qui se connecte
    /*public function testTasksList()
    {

        // $this->testSuccessFullLogin();

        $this->client = static::createClient();

        $this->client->request('GET', '/tasks');


        // Je m'attend à avoir un code status 200
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        
        // Je m'attend à avoir un element h2 value Se connnecter !
        $this->assertSelectorTextContains('a', 'Créer une tâche');

        // Je ne doit pas avoir de class danger
        $this->assertSelectorNotExists('.alert.alert-danger');
    }*/



    /*
    * En lancant la commande : vendor/bin/phpunit --filter=testListAction > public/resultTest.html pour lancer les tests
    * Et en se rendant sur la page http://127.0.0.1:8000/resultTest.html
    */

    /*
    public function setUp(): void
    {
        // Simuler un navigateur, dans l'application nous connecté a la page
        $this->client = static::createClient();
    }
    

    // Connexion user
    public function loginUser(): void
    {
        $crawler = $this->client->request('GET', '/login');
        $form = $crawler->selectButton('Se connecter')->form();
        $this->client->submit($form, ['_username' => 'simoncestmoi@hotmail.fr', '_password' => 'Adminadmin']);

        $this->client->request('GET', '/');
        $this->client->followRedirect();
        
    }
    */


    // Lister les taches
    /*public function testTasksList()
    {
        /*
        $this->loginUser();

        $this->client->request('GET', '/tasks');
        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
        $this->client->followRedirect(true);
        */
        //var_dump($this->client->getResponse()->getContent());

        /*$this->loginUser();

        $this->client->request('GET', '/tasks');
        // $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
        $this->client->followRedirect();

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }*/


    // Lister les taches is_done
    /*public function testlistEndingAction()
    {
        $this->loginUser();

        $this->client->request('GET', '/tasks/ending');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());

        $this->client->followRedirect(true);

        //var_dump($this->client->getResponse()->getContent());
    }*/


    // Création de la tache
    /*public function testCreateAction()
    {
        $this->loginUser();

        $crawler = $this->client->request('GET', '/tasks/create');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
        
        $crawler = $this->client->followRedirect(true);


        echo "@@@@@@@@@@@@@@@ Je commence le formulaire !!!! @@@@@@@@@@@@@@@";
        // var_dump($this->client->getResponse()->getContent());

        $formTache = $crawler->selectButton('Ajouter une tache')->form();

        $formTache['task[createdAt][date][month]'] = date('M');
        $formTache['task[createdAt][date][day]'] = date('D');
        $formTache['task[createdAt][date][year]'] = date('Y');

        $form['task[createdAt][time][hour]'] = date('i');
        $form['task[createdAt][time][minute]'] = date('s');

        $formTache['task[title]'] = 'Le Titre';
        $formTache['task[content]'] = 'Le Contenue';

        $formTache['task[isDone]'] = 1;

        $this->client->submit($formTache);
        $crawler = $this->client->followRedirect(true);


        echo "@@@@@@@@@@@@@@@ dump de mon form @@@@@@@@@@@@@@@";
        var_dump($formTache);
        echo "@@@@@@@@@@@@@@@ Jai passé le formulaire !!!! @@@@@@@@@@@@@@@";


        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        // Verifier que j'ai une div qui contient le texte de succé
        $this->assertEquals(1, $crawler->filter('div.alert-success')->count());
    }*/



    // Modification de la tache
    /*public function testEditAction()
    {
        $this->loginUser();

        $crawler = $this->client->request('GET', '/tasks/edit/testtest33');
        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());

        $form = $crawler->selectButton('Modifier')->form();
        $form['task[title]'] = 'leTitreModifie';
        $form['task[content]'] = 'leContenueModifie';
        $this->client->submit($form);

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());

        $crawler = $this->client->followRedirect();

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals(1, $crawler->filter('div.alert-success')->count());
    }*/


    // Marquée comme faite ou non
    /*public function testToggleTaskAction(): void
    {
        $this->loginUser();

        $this->client->request('GET', '/tasks/4/toggle');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());

        $crawler = $this->client->followRedirect();

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals(1, $crawler->filter('div.alert-success')->count());

    }*/


    // Delete la tache
    /*public function testDeleteTaskAction()
    {
        $this->loginUser();

        $this->client->request('GET', '/tasks/5/delete');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());

        $crawler = $this->client->followRedirect();

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals(1, $crawler->filter('div.alert-success')->count());
    }*/
}
