<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Http\Adapter\Guzzle6\Client;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Madkom\PactBrokerClient\HttpBrokerClient;
use Madkom\PactBrokerClient\RequestBuilder;

class AppToPactBrokerCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:to-pact-broker')
            ->setDescription('Pushes the the generated contracts to the defined pact-broker')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //post the contract to pact broker
        $output->writeln('Get contract.');
        $reviewCompanyPact =  APP_ROOT_DIR . '/contracts/review_service-company_provider.json';
        $client = new HttpBrokerClient('pactbroker:5000', new Client(), new RequestBuilder());
        $response = $client->publishPact('Company Provider', 'Review Service', '1.0.5', $reviewCompanyPact);

    }

}
