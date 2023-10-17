<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of VoyagesControllerTest
 *
 * @author Damien
 */
class VoyagesControllerTest extends WebTestCase{
    public function testAccesPage(){
        $client = static::createClient();
        $client->request('GET', '/voyages');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
    public function testContenuPage(){
        $client = static::createClient();
        $crawler = $client->request('GET', '/voyages');        
        $this ->assertSelectorTextContains('h1',  'Mes voyages');
        $this ->assertSelectorTextContains('th', 'Ville');
        $this ->assertCOunt(4, $crawler->filter('th'));
        $this ->assertSelectorTextContains('h5', 'Blot');
    }
    public function testLinkVille(){
        $client = static::createClient();
        $client ->request('GET,', '/voyages');
        // clic sur un lien (le nom de la ville)
        $client->clickLink('Blot');
        // récupération du résultat du clic
        $response = $client->getResponse();        
        // contrôle si le lien existe
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        // récupération de la route et contrôle qu'elle est correcte
        $uri = $client-> getRequest()->server->get("REQUEST_URI");
        $this->assertEquals('/voyages/voyage/1', $uri);        
    }
    public function testFiltreVIlle(){
        $client = static::createClient();
        $client->request('GET', '/voyages');
        // simulation de la soumission du formulaire
        $crawler = $client->submitForm('filter', [
            'recherche' => 'Blot'
        ]);
        // vérifie le nombre de ligne obtenues
        $this->assertCount(1, $crawler->filter('h5'));
        // vérifie si la ville correspond à la recherche
        $this->assertSelectorTextContains('h5', 'Blot');
    }
}
