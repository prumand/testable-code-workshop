<?php

namespace Tests\Integration\AppBundle;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use Tests\Mock\FakeDateTimeProvider;

class ReviewControllerIntegrationTest extends WebTestCase
{
    public function testPutingReviews()
    {
        $client = static::createClient();
        $client->getContainer()->set('date_time_provider', $this->getFakeDateTimeProvider());

        $id = 1;

        $review = ['title' => 'hello world', 'rating' => 2.5];
        
        $client->request(
            'POST', '/reviews', [], [],
            [
                'CONTENT_TYPE' => 'application/json',
            ],
            json_encode($review)
        );

        $postResponse = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertArraySubset(
            $review,
            $postResponse
        );
        $this->assertArrayHasKey('id', $postResponse);
    }

    private function getFakeDateTimeProvider()
    {
        return new FakeDateTimeProvider(new \DateTime('2016-12-21 14:30:00'));
    }

}
