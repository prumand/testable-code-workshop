<?php
namespace Tests\Unit\AppBundle\Controller;

use AppBundle\Entity\Review;

class ReviewTest extends \PHPUnit_Framework_TestCase
{
    public function testSetRating()
    {
        $rating = 3.5;
        $review = new Review();
        $review->setRating($rating);

        $this->assertEquals(
            $review->getRating(),
            $rating
        );
    }
}
