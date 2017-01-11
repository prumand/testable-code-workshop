<?php

namespace AppBundle\Api;

use GuzzleHttp\ClientInterface;

use AppBundle\Interfaces\ICompanyApi;
use AppBundle\Entity\Review;


class CompanyApi implements ICompanyApi
{
    protected $client;

    public function __construct(ClientInterface $client) {
        $this->client = $client;
    }

    public function getCompanyId(Review $review)
    {
        $reviewId = $review->getId() ? $review->getId() : 0;

        $response = $this->client->request(
            'GET',
            '/web/company',
            [
                'query' => ['review_id' => (int) $reviewId],
                'headers' => ['Accept' => 'application/json'],
            ]
        );

        $content = $response->getBody()->getContents();

        return (int) $content;
    }
}
