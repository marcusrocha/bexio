<?php

namespace App\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\ApiToken;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ProductTest extends ApiTestCase
{
    use RefreshDatabaseTrait;

    private const API_TOKEN = '12f3600378cbb476613d4cec52b56730bc0bcf77d5925538eeffd8dde2d3c4d71e8bb741f0b8cd6f090c328a7535340bf0e7121786566f1f60501d29';

    private EntityManagerInterface $entityManager;

    private HttpClientInterface $client;

    protected function setUp(): void
    {
        $this->client = $this->createClient();
        $this->entityManager = $this->client->getContainer()->get('doctrine')->getManager();

        $user = new User();
        $user->setEmail('marcus.rocha@bexio.com');
        $user->setPassword('123456');
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $apiToken = new ApiToken();
        $apiToken->setToken(self::API_TOKEN);
        $apiToken->setUser($user);
        $this->entityManager->persist($apiToken);
        $this->entityManager->flush();
    }
    


    public function testGetCollection(): void
    {
        $response = $this->client->request('GET', '/api/products',[
            'headers' => ['x-api-key' => self::API_TOKEN]
        ]);
        
        $this->assertResponseIsSuccessful();

        $this->assertResponseHeaderSame(
            'content-type', 'application/ld+json; charset=utf-8'
        );

        $this->assertJsonContains([            
                    "@context" => "/api/contexts/Product",
                    "@id" => "/api/products",
                    "@type" => "hydra:Collection",                
                    "hydra:totalItems" => 100,
                    "hydra:view" => [
                    "@id" => "/api/products?page=1",
                    "@type"=> "hydra:PartialCollectionView",
                    "hydra:first" => "/api/products?page=1",
                    "hydra:last" => "/api/products?page=4",
                    "hydra:next" => "/api/products?page=2"
                    ]
                ]);

        $this->assertCount(30,$response->toArray()['hydra:member']);
    }

    public function testCreateProduct(): void
    {
        $response = $this->client->request('POST', '/api/products', [
            'headers' => ['x-api-key' => self::API_TOKEN],
            'json' => [                
                    "name" => "Teste Name",
                    "value" => 15,
                    "createdAt" => "2022-12-29",
                    "manufacturer" => "/api/manufacturers/1"                
            ]            
        ]);
        
        $this->assertResponseStatusCodeSame(201);

        $this->assertResponseHeaderSame(
            'content-type', 'application/ld+json; charset=utf-8'
        );

        $this->assertJsonContains([                                                    
            "name" => "Teste Name",
            "value" => 15,
            "createdAt" => "2022-12-29T00:00:00+00:00",
            "manufacturer" => "/api/manufacturers/1"                  
        ]);
    }
}

