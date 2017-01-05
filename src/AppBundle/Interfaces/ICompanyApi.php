<?php
namespace AppBundle\Interfaces;

use AppBundle\Entity\Review;

Interface ICompanyApi {
    public function getCompanyId(Review $review);
}
