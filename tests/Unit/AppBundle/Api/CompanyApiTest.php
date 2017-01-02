<?php

namespace Tests\Unit\AppBundle\Api;

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
        return new CompanyApi;
    }
}
