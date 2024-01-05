<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskControllerTest extends WebTestCase
{
    private $client;

    
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
        $this->client->submit($form, ['_username' => 'simoncestmoi@hotmail.fr', '_password' => 'adminadmin']);
    }


    // Lister les taches
    public function testTasksList()
    {
        $this->loginUser();

        var_dump($this->loginUser());

        $this->client->request('GET', '/tasks');

        // var_dump( $this->client->request('GET', '/tasks'));

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        /*
        * En lancant la commande : vendor/bin/phpunit --filter=testListAction > public/resultTest.html pour lancer les tests
        * Et en se rendant sur la page http://127.0.0.1:8000/resultTest.html
        * J'ai Failed asserting that 302 matches expected 200. je pence car il manque le :8000 sur la redirection apres localhost, 
        * pourquoi ?
        */
    }


    // Création de la tache
    public function testCreateAction()
    {
        $this->loginUser();

        $crawler = $this->client->request('GET', '/tasks/create');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $form = $crawler->selectButton('Ajouter')->form();
        $form['task[title]'] = 'Le Titre';
        $form['task[content]'] = 'Le Contenue';
        $this->client->submit($form);

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());

        $crawler = $this->client->followRedirect();

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals(1, $crawler->filter('div.alert-success')->count());
    }



    // Modification de la tache
    public function testEditAction()
    {
        $this->loginUser();

        $crawler = $this->client->request('GET', '/tasks/edit/testtest33');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $form = $crawler->selectButton('Modifier')->form();
        $form['task[title]'] = 'leTitreModifie';
        $form['task[content]'] = 'leContenueModifie';
        $this->client->submit($form);

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());

        $crawler = $this->client->followRedirect();

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals(1, $crawler->filter('div.alert-success')->count());
    }


    // Marquée comme faite ou non
    public function testToggleTaskAction(): void
    {
        $this->loginUser();

        $this->client->request('GET', '/tasks/4/toggle');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());

        $crawler = $this->client->followRedirect();

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals(1, $crawler->filter('div.alert-success')->count());

    }


    // Delete la tache
    public function testDeleteTaskAction()
    {
        $this->loginUser();

        $this->client->request('GET', '/tasks/5/delete');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());

        $crawler = $this->client->followRedirect();

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals(1, $crawler->filter('div.alert-success')->count());
    }
}
