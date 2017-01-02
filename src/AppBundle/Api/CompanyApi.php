<?php

namespace AppBundle\Api;

use AppBundle\Interfaces\ICompanyApi;
use AppBundle\Entity\Review;

class CompanyApi implements ICompanyApi
{

    public function getCompanyId(Review $review)
    {
        return 1;
    }
}
