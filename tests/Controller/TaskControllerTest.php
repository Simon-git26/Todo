<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskControllerTest extends WebTestCase
{
    private $client;


    /*
    * En lancant la commande : vendor/bin/phpunit --filter=testListAction > public/resultTest.html pour lancer les tests
    * Et en se rendant sur la page http://127.0.0.1:8000/resultTest.html
    */

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

        $this->client->request('GET', '/tasks');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());

        // DEBUG
        // var_dump($this->client->getResponse()->getContent());

    }


    // Lister les taches is_done
    public function testlistEndingAction()
    {
        $this->loginUser();

        $this->client->request('GET', '/tasks/ending');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }


    // Création de la tache
    public function testCreateAction()
    {
        $this->loginUser();

        $crawler = $this->client->request('GET', '/tasks/create');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
        
        
        //$crawler = $this->client->followRedirect(true);
        // echo "@@@@@@@@@@@@@@@ Je commence le formulaire !!!! @@@@@@@@@@@@@@@";
        // var_dump($this->client->getResponse()->getContent());

        $form = $crawler->selectButton('Ajouter une tache')->form();

        // echo 'jai selectionné le bouton form';

        $form['task[createdAt][date][month]'] = date('M');
        $form['task[createdAt][date][day]'] = date('D');
        $form['task[createdAt][date][year]'] = date('Y');

        $form['task[createdAt][time][hour]'] = date('i');
        $form['task[createdAt][time][minute]'] = date('s');

        $form['task[title]'] = 'Le Titre';
        $form['task[content]'] = 'Le Contenue';

        $form['task[isDone]'] = 1;

        $this->client->submit($form);
        $crawler = $this->client->followRedirect();

        // DEBUG
        // echo "@@@@@@@@@@@@@@@ J'ai passé le formulaire !!!! @@@@@@@@@@@@@@@";
        // echo $this->client->getResponse()->getContent();



        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());

        


        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        // Verifier que j'ai une div qui contient le texte de succé
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
