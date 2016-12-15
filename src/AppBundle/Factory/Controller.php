<?php
namespace AppBundle\Factory;

use AppBundle\Controller\ReviewController;
use AppBundle\Entity\Review;
use AppBundle\Interfaces\IDateTimeProvider;
use Doctrine\ORM\EntityManagerInterface;

class Controller {

    private $entityManager;
    private $dateTimeProvider;

    public function __construct(EntityManagerInterface $entityManager, IDateTimeProvider $dateTimeProvider)
    {
        $this->entityManager = $entityManager;
        $this->dateTimeProvider = $dateTimeProvider;
    }

    public function getReviewController()
    {
        return new ReviewController(
            $this->getSaveFunction(),
            $this->getFindByIdFunction(),
            $this->getDateTimeProvider()
        );
    }

    private function getSaveFunction()
    {
        return function(Review $review) {
            $this->entityManager->persist($review);
            $this->entityManager->flush();
        };
    }

    private function getFindByIdFunction()
    {
        return function($id) {
            return $this->entityManager
                ->getRepository('AppBundle:Review')
                ->find($id);
        };
    }

    private function getDateTimeProvider()
    {
        return $this->dateTimeProvider;
    }
}
