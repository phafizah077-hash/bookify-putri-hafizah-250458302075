<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Rating;
use App\Models\Review;
use App\Models\User;
use Exception;

class RatingService
{
    public function createRating(User $user, int $bookId, int $ratingValue): Rating
    {
        if ($ratingValue < 1 || $ratingValue > 5) {
            throw new Exception('Rating harus antara 1 sampai 5.');
        }

        $book = Book::findOrFail($bookId);

        return Rating::updateOrCreate(
            [
                'user_id' => $user->id,
                'book_id' => $book->id,
            ],
            [
                'rating' => $ratingValue,
            ]
        );
    }

    public function addReviewToRating(Rating $rating, string $comment): Review
    {
        return Review::updateOrCreate(
            [
                'rating_id' => $rating->id,
            ],
            [
                'comment' => $comment,
            ]
        );
    }
}
