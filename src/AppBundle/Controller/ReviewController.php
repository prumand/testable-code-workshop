<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use AppBundle\Entity\Review;

class ReviewController extends Controller
{

    /**
     * @Route("/reviews/{id}")
     * @Method({"GET"})
     */
    public function getAction($id)
    {
        $review = $this->getDoctrine()
            ->getRepository('AppBundle:Review')
            ->find($id);

        return new JsonResponse([
            'id' => $review->getId(),
            'title' => $review->getTitle(),
        ]);
    }

    /**
     * @Route("/reviews/{id}")
     * @Method({"PUT"})
     */
    public function putAction(Request $request, $id)
    {
        $review = new Review;
        $review->setTitle('Hello World');
        $review->setRating(5.25);

        $em = $this->getDoctrine()->getManager();
        $em->persist($review);
        $em->flush();

        return new JsonResponse([
            'hello put'
        ]);
    }
}
