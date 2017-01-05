<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CompanyController {

    public function getAction(Request $request)
    {
        return new JsonResponse((int) $request->get('review_id')); 
    }
    
}