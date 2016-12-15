<?php

namespace Tests\Unit\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use AppBundle\Controller\ReviewController;
use AppBundle\Entity\Review;
use AppBundle\Provider\DateTimeProvider;
use Tests\Mock\ReviewMock;

class ReviewControllerTest extends WebTestCase
{
    private $container;
    private $review = ['id' => 1, 'title' => 'Unit Test', 'rating' => 3.4];
    private $saveFunctionCalled;
    private $findByIdElement;


    public function setUp()
    {
        $this->saveFunctionCalled = 0;
        $this->findByIdElement = null;
    }

    public function testGet()
    {
        // Arrange
        $request = new Request();
        $id = 1;

        $this->findByIdElement = $this->getReviewMock($this->review);

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
        $this->findByIdElement = $this->getReviewMock($this->review);

        // Act
        $response = $reviewController->putAction($request, 1);

        // Assert
        $this->assertEquals($response, new JsonResponse($this->review));
        $this->assertEquals(1, $this->saveFunctionCalled);
    }

    private function getReviewController()
    {
        $reviewCtrl = $reviewController = new ReviewController(
            $this->getSaveFunction(),
            $this->getFindByIdFunction(),
            $this->getFakeDateTimeProvider()
        );
        return $reviewCtrl;
    }

    private function getReviewMock($params)
    {
        return (new ReviewMock)
            ->getReviewMock($params);
    }

    private function getSaveFunction()
    {
        return function(Review $review) {
            $this->saveFunctionCalled++;
        };
    }

    private function getFindByIdFunction()
    {
        return function($id) {
            return $this->findByIdElement;
        };
    }

    private function getFakeDateTimeProvider()
    {
        return new DateTimeProvider();
    }
}
