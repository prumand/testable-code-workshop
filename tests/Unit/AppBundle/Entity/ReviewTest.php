<?php
namespace Tests\Unit\AppBundle\Controller;

use AppBundle\Entity\Review;

class ReviewTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider setRatingProvider
     */
    public function testSetRating($rating, $seconds, $expectedRating)
    {
        // Arrange
        $review = new Review();

        // Act
        $review->setRating($rating, $seconds);

        // Assert
        $this->assertEquals(
            $review->getRating(),
            $expectedRating
        );
    }

    public function setRatingProvider()
    {
        return [
            'rating not augmented' => [
                3.5,
                0,
                3.5,
            ],
            'rating augmented' => [
                3.5,
                1,
                4.5,
            ],
        ];
    }
}
