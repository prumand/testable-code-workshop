<?php
namespace AppBundle\Factory;

use AppBundle\Controller\ReviewController;
use AppBundle\Entity\Review;
use Doctrine\ORM\EntityManagerInterface;

class Controller {

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getReviewController()
    {
        return new ReviewController(
            $this->getSaveFunction(),
            $this->getFindByIdFunction()
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
}
