<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use Symfony\Component\HttpFoundation\Response;


class UserControllerTest extends WebTestCase
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


    // Lister les Users, ne fonctionne que si ROLE ADMIN
    public function testListUser()
    {
        $this->loginUser();

        $this->client->request('GET', $this->urlGenerator->generate('app_user_list'));
        
        // Je m'attend a : Un statut 200
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        
        // Verifier si la route obtenue est la meme que celle attendu
        $this->assertRouteSame('app_user_list');
    }


    // Créer un User
    public function testCreateUser()
    {
        $this->loginUser();

        $crawler = $this->client->request('GET', $this->urlGenerator->generate('app_user_create'));

        // Recuperer le Formulaire grace à son name et generer les données
        $formUser = $crawler->filter("form[name=user]")->form([
            'user[username]' => 'UserTest',
            'user[password][first]' => 'Password',
            'user[password][second]' => 'Password',
            'user[email]' => 'testfonctionnel@test.com',
        ]);


        // Soumettre le formulaire
        $this->client->submit($formUser);

        // Je m'attend a : Une redirection
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
       
        // Suivre cette redirection
        $this->client->followRedirect();

        // Verifier si la route obtenue est la meme que celle attendu
        $this->assertRouteSame('app_user_list');

        // Verifier que j'ai une div qui contient le texte de succé
        $this->assertSelectorExists('div.alert.alert-success');
    }
    


    // Edit un user
    
    public function testEditUser()
    {
        $this->loginUser();

        $crawler = $this->client->request('GET', '/users/18/edit');

        // Recuperer le Formulaire grace à son name et generer les données
        $formEditUser = $crawler->filter("form[name=user]")->form([
            'user[username]' => 'UserTest',
            'user[password][first]' => 'Passwordtest',
            'user[password][second]' => 'Passwordtest',
            'user[email]' => 'testmodifieuser@user.com',
            'user[roles][0]' => 'ROLE_ADMIN',
        ]);

        // Soumettre le formulaire
        $this->client->submit($formEditUser);

        // Je m'attend a : Une redirection
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
       
        // Suivre cette redirection
        $this->client->followRedirect();

        // Verifier si la route obtenue est la meme que celle attendu
        $this->assertRouteSame('app_user_list');

        // Verifier que j'ai une div qui contient le texte de succé
        $this->assertSelectorExists('div.alert.alert-success');
    }



    // Créer un User method Register
    public function testRegisterUser()
    {
        /** @var UrlGeneratorInterface $urlGenerator */
        $this->urlGenerator = $this->client->getContainer()->get("router");

        $crawler = $this->client->request('GET', $this->urlGenerator->generate('app_register'));

        // Recuperer le Formulaire grace à son name et generer les données
        $form = $crawler->filter("form[name=registration]")->form([
            'registration[email]' => 'register@register.fr',
            'registration[username]' => 'userRegister',
            'registration[motDePasse]' => 'Registertest'
        ]);

        // Soumettre le formulaire
        $this->client->submit($form);

        // Je m'attend a : Une redirection (vers la page accueil)
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
       
        // Suivre cette redirection
        $this->client->followRedirect();

        // Verifier si la route obtenue est la meme que celle attendu
        $this->assertRouteSame('app_login');
    }
}