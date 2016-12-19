<?php

namespace Tests\Unit\AppBundle\Factory;

use AppBundle\Factory\Controller;
use AppBundle\Controller\ReviewController;
use Doctrine\ORM\EntityManager;

class ControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetReviewController()
    {
        // Arrange
        $entityManagerMock  = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $factory = new Controller($entityManagerMock);

        // Act
        $reviewController = $factory->getReviewController();

        // Assert
        $this->assertEquals(true, $reviewController instanceof ReviewController);
    }
}