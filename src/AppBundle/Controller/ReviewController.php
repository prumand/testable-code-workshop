<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;


use AppBundle\Entity\Review;
use AppBundle\Interfaces\IDateTimeProvider;

class ReviewController
{

    private $save;
    private $findById;
    private $dateTimeProvider;

    public function __construct($save, $findById, IDateTimeProvider $dateTimeProvider)
    {
        if (!is_callable($save) || !is_callable($findById)) {
            throw new \Exception(__CLASS__ . ' params are not callables');
        }
        $this->save = $save;
        $this->findById = $findById;
        $this->dateTimeProvider = $dateTimeProvider;
    }
    /**
     * @Route("/reviews/{id}")
     * @Method({"GET"})
     */
    public function getAction($id, Request $request)
    {
        $review = ($this->findById)($id);

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
        $review->setRating($reviewContent['rating'], $this->dateTimeProvider->getSeconds());

        ($this->save)($review);

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

        $review = ($this->findById)($id);

        if (!$review) {
            return new JsonResponse(['code' => 404, 'message' => 'Review not found'], 404);
        }

        $review->setTitle($reviewContent['title']);
        $review->setRating($reviewContent['rating'], $this->dateTimeProvider->getSeconds());

        ($this->save)($review);

        return new JsonResponse($this->reviewToArray($review));
    }

    private function getJsonBodyAsArray(Request $request)
    {
        $content = $request->getContent();
        if (empty($content)) {
            return new JsonResponse(['code' => 400, 'message' => 'Review not found'], 400);
        }
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
