<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Doctrine\ORM\EntityManager;


use AppBundle\Entity\Review;

class ReviewController
{

    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/reviews/{id}")
     * @Method({"GET"})
     */
    public function getAction($id, Request $request)
    {
        $review = $this->getReviewEntityManager()
            ->find($id);

        // service
        if (!$review) {
            return new JsonResponse(['code' => 404, 'message' => 'Review not found'], 404);
        }

        return new JsonResponse($this->reviewToArray($review));
    }

    /**
     * @Route("/reviews")
     * @Method({"POST"})
     */
    public function postAction(Request $request)
    {
        $reviewContent = $this->getJsonBodyAsArray($request);

        $review = new Review();
        $review->setTitle($reviewContent['title']);
        $review->setRating($reviewContent['rating'], 0);

        $this->persitReview($review);

        return new JsonResponse(
            $this->reviewToArray($review)
        );
    }

    /**
     * @Route("/reviews/{id}")
     * @Method({"PUT"})
     */
    public function putAction(Request $request, $id)
    {
        $reviewContent = $this->getJsonBodyAsArray($request);

        $review = $this->getReviewEntityManager()
            ->find($id);

        if (!$review) {
            return new JsonResponse(['code' => 404, 'message' => 'Review not found'], 404);
        }

        $review->setTitle($reviewContent['title']);
        $review->setRating($reviewContent['rating'], (new \DateTime())->format('s'));

        $this->persitReview($review);

        return new JsonResponse($this->reviewToArray($review));
    }

    private function persitReview(Review $review)
    {
        $this->entityManager->persist($review);
        $this->entityManager->flush();
    }

    private function getReviewEntityManager()
    {
        return $this->entityManager
            ->getRepository('AppBundle:Review');
    }

    private function getJsonBodyAsArray(Request $request)
    {
        $content = $request->getContent();
        if (empty($content)) {
            return new JsonResponse(['code' => 400, 'message' => 'Review not found'], 400);
        }
        $params = json_decode($content, true);
        return json_decode($content, true);

    }

    private function reviewToArray(Review $review)
    {
        return [
            'id' => $review->getId(),
            'title' => $review->getTitle(),
            'rating' => $review->getRating()
        ];
    }


}
