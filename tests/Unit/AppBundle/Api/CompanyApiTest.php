<?php

namespace Tests\Unit\AppBundle\Api;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

use AppBundle\Api\CompanyApi;
use AppBundle\Entity\Review;

class CompanyApiTest extends \PHPUnit_Framework_TestCase {

    public function testGetCompanyId()
    {
        $companyApi = $this->getCompanyApi();

        $this->assertSame(
            1,
            $companyApi->getCompanyId(new Review)
        );


    }

    private function getCompanyApi()
    {
        $mock = $this->getMock('\\GuzzleHttp\\ClientInterface');
        $responseMock = $this->getMock('\\Psr\\Http\\Message\\ResponseInterface');
        $responseMock->method('getBody')
            ->willReturn($responseMock);
        $responseMock
            ->method('getContents')
            ->willReturn(1);

        $mock
            ->method('get')
            ->willReturn(
                $responseMock
            );
        return new CompanyApi($mock);
    }
}
