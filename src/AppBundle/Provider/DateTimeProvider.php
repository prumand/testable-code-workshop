<?php

namespace AppBundle\Provider;

use AppBundle\Interfaces;

class DateTimeProvider implements IDateTimeProvider
{

    public function getDateTime()
    {
        return new \DateTime();
    }

    public function getSeconds()
    {
        return $this->getDateTime()
            ->format('s');
    }
}