<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CompanyController {


    public function getAction(Request $request)
    {
        return new JsonResponse(2);
    }

    public function getProviderStates()
    {
        $consumerContract = json_decode(
            file_get_contents(APP_ROOT_DIR . '/contracts/review_service-company_provider.json'),
            true
        );

        $providerStates = [];

        foreach ($consumerContract['interactions'] as $interaction) {
            $providerStates[] = $interaction['provider_state'];
        }

        $responseArray = [
            $consumerContract['consumer']['name'] => $providerStates
        ];

        return new JsonResponse($responseArray);
    }

    public function activeAction(Request $request)
    {
        file_put_contents(
            '/tmp/test.log',
            print_r($request->query, true)
            . print_r(json_decode($request->getContent(), true), true),
            FILE_APPEND
        );


        return new JsonResponse('hell yeah');
    }
}
