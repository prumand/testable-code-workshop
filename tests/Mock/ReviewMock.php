<?php

namespace Tests\Mock;

use AppBundle\Entity\Review;

class ReviewMock extends \PHPUnit_Framework_TestCase
{
    public function getReviewMock($params)
    {
        $review = $this->getMockBuilder(Review::class)
            ->getMock();

        $review
            ->method('getId')
            ->willReturn($params['id']);
        $review
            ->method('getTitle')
            ->willReturn($params['title']);
        $review
            ->method('getRating')
            ->willReturn($params['rating']);

        return $review;
    }
}
