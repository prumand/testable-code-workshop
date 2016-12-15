<?php
namespace Tests\Mock;

use AppBundle\Interfaces\IDateTimeProvider;

class FakeDateTimeProvider implements IDateTimeProvider
{
    private $dateTime;
    public function __construct(\DateTime $dateTime)
    {
        $this->dateTime = $dateTime;
    }

    public function getDateTime()
    {
        return $this->dateTime;
    }

    public function getSeconds()
    {
        return $this->dateTime->format('s');
    }
}