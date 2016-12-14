<?php

namespace Tests\Unit\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Stopwatch\Stopwatch;

use AppBundle\Controller\ReviewController;

class ReviewControllerTest extends WebTestCase
{
    private $container;
    private $review = ['id' => 1, 'title' => 'Unit Test', 'rating' => 3.4];

    public function setUp()
    {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->container = static::$kernel->getContainer();
    }

    public function testGet()
    {
        // Arrange
        $request = new Request();
        $id = 1;
        $jsonResponse = new JsonResponse($this->review);
        $reviewController = $this->getReviewController();

        // Act
        $response = $reviewController->getAction($id, $request);

        // Assert
        $this->assertEquals($jsonResponse, $response);
    }

    public function testPut()
    {
        // Arrange 
        $request = new Request(
          [],
          [],
          [],
          [],
          [],
          [],
          json_encode($this->review)
        );
        $reviewController = $this->getReviewController();

        // Act 
        $response = $reviewController->putAction($request, 1);

        // Assert
        $this->assertEquals($response, new JsonResponse($this->review));
    }

    private function getReviewController()
    {
        $reviewCtrl = $reviewController = new ReviewController();
        $reviewCtrl->setContainer($this->container);
        return $reviewCtrl;
    }
}