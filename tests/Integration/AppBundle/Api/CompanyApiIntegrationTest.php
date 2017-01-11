<?php
namespace Tests\Integration\AppBundle\Api;

use Pact\Pact;
use GuzzleHttp\Client;

use AppBundle\Api\CompanyApi;
use AppBundle\Entity\Review;


class CompanyApiIntegrationTest extends \PHPUnit_Framework_TestCase
{
    public function testGetCompanyId()
    {
        $client = new Client([
            'base_uri' => 'http://pactmock:38657/web',
        ]);

        $companyProvider = Pact::mockService([
            'consumer' => 'Review Service',
            'provider' => 'Company Provider',
            'port' => 38657,
            'host' => 'pactmock'
        ]);

        $companyProvider
            ->given('A review with id 0 exists')
            ->uponReceiving('a request for a company')
            ->withRequest([
                'method' => 'get',
                'path' => '/web/company',
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'query' => [
                    'review_id' => "0",
                ],
            ])->willRespondWith([
                'status' => 200,
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'body' => 1
            ]);
        $companyApi = new CompanyApi($client);

        $companyProvider->run(function() use ($companyApi) {
            $companyId = $companyApi->getCompanyId(new Review);
        });

        $this->assertTrue(true);
    }
}
