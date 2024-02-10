<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use Symfony\Component\HttpFoundation\Response;

class TaskControllerTest extends WebTestCase
{
    
    /*
    * En lancant la commande : vendor/bin/phpunit --filter=testListAction > public/resultTest.html pour lancer les tests
    * Et en se rendant sur la page http://127.0.0.1:8000/resultTest.html
    */
    
    private $client;
    private $urlGenerator;


    public function setUp(): void
    {
        // Simuler un navigateur, dans l'application nous connecté a la page
        $this->client = static::createClient();
    }
    

    // Connexion user et verification de la redirection sur la page accueil
    public function loginUser(): void
    {
        /** @var UrlGeneratorInterface $urlGenerator */
        $this->urlGenerator = $this->client->getContainer()->get("router");

        $crawler = $this->client->request('GET', $this->urlGenerator->generate('app_login'));

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


    // Login qui n'existe pas
    /*
    public function testLoginWithBadCredentials()
    {

        $this->urlGenerator = $this->client->getContainer()->get("router");

        $crawler = $this->client->request('GET', $this->urlGenerator->generate('app_login'));

        // Recuperer le Formulaire grace à son name et generer les données
        $form = $crawler->filter("form[name=login]")->form([
            '_username' => 'simoncestmoi@hotmail.fr',
            '_password' => 'existepas'
        ]);

        // Soumettre le formulaire
        $this->client->submit($form);

        // Je m'attend a : Une redirection (vers la page accueil)
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
       
        // Suivre cette redirection
        $this->client->followRedirect();

        // Verifier si la route obtenue est celle du login, ce qui veut dire invalid credentials
        $this->assertRouteSame('app_login');

        $this->assertSelectorExists('.alert.alert-danger');
    }
    */


    // Lister les taches
    public function testTasksList()
    {
        $this->loginUser();

        $this->client->request('GET', $this->urlGenerator->generate('app_task_list'));
        
        // Je m'attend a : Un statut 200
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        
        // Verifier si la route obtenue est la meme que celle attendu
        $this->assertRouteSame('app_task_list');
    }


    // Lister les taches is_done
    public function testListEndingAction()
    {
        $this->loginUser();

        $this->client->request('GET', $this->urlGenerator->generate('app_task_list_ending'));
        
        // Je m'attend a : Un status 200
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        
        // Verifier si la route obtenue est la meme que celle attendu
        $this->assertRouteSame('app_task_list_ending');
    }


    // Création de la tache
    public function testCreateAction()
    {
        $this->loginUser();

        $crawler = $this->client->request('GET', $this->urlGenerator->generate('app_task_create'));

        // Recuperer le Formulaire grace à son name et generer les données
        $formTache = $crawler->filter("form[name=task]")->form([
            'task[title]' => 'Le Titre',
            'task[content]' => 'Le Contenue',
        ]);


        // Soumettre le formulaire
        $this->client->submit($formTache);

        // Je m'attend a : Une redirection (vers la page accueil)
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
       
        // Suivre cette redirection
        $this->client->followRedirect();

        // Verifier si la route obtenue est la meme que celle attendu
        $this->assertRouteSame('app_default');

        // Verifier que j'ai une div qui contient le texte de succé
        $this->assertSelectorExists('div.alert.alert-success');
    }


    // Modification de la tache
    public function testEditAction()
    {
        $this->loginUser();

        // Faire passé mon slug
        $crawler = $this->client->request('GET', '/tasks/edit/Le+Titre');

        // Recuperer le Formulaire grace à son name et generer les données
        $formEdit = $crawler->filter("form[name=task]")->form([
            'task[title]' => 'Le Titre en edit',
            'task[content]' => 'Le Contenue en edit',
        ]);

        // Soumettre le formulaire
        $this->client->submit($formEdit);

        // Je m'attend a : Une redirection
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
       
        // Suivre cette redirection
        $this->client->followRedirect();

        // Verifier si la route obtenue est la meme que celle attendu
        $this->assertRouteSame('app_task_list');

        // Verifier que j'ai une div qui contient le texte de succé
        $this->assertSelectorExists('div.alert.alert-success');
    }

    
    // Marquée comme faite ou non
    public function testToggleTaskAction(): void
    {
        $this->loginUser();

        $this->client->request('GET', '/tasks/1/toggle');

        // Je m'attend a : Une redirection (vers la page accueil)
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
       
        // Suivre cette redirection
        $this->client->followRedirect();

        // Verifier si la route obtenue est la meme que celle attendu
        $this->assertRouteSame('app_task_list_ending');

        // Verifier que j'ai une div qui contient le texte de succé
        $this->assertSelectorExists('div.alert.alert-success');

    }
    
    

    
    // Delete la tache
    public function testDeleteTaskAction()
    {
        $this->loginUser();

        $this->client->request('GET', '/tasks/1/delete');

        // Je m'attend a : Une redirection (vers la page accueil)
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
       
        // Suivre cette redirection
        $this->client->followRedirect();

        // Verifier si la route obtenue est la meme que celle attendu
        $this->assertRouteSame('app_default');

        // Verifier que j'ai une div qui contient le texte de succé
        $this->assertSelectorExists('div.alert.alert-success');
    }
    
    
}
