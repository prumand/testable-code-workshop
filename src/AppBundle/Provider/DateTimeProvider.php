<?php

namespace AppBundle\Provider;

use AppBundle\Interfaces\IDateTimeProvider;

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