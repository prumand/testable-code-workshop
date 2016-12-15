<?php

namespace AppBundle\Interfaces;

interface IDateTimeProvider 
{
    public function getDateTime();
    public function getSeconds();
}