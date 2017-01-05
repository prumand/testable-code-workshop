<?php

namespace Tests\AppBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Controller\CompanyController;

class CompanyControllerTest extends \PHPUnit_Framework_TestCase
{

    public function testCompanyGet()
    {

        $companyController = new CompanyController;

        $excepted = new JsonResponse(0);

        $this->assertEquals(
            $excepted,
            $companyController->getAction(new Request(['review_id' => 0]))
        );
    }
}
