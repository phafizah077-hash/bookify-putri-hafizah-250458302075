<?php

namespace App\Services;

use App\Models\Book;
use Illuminate\Pagination\LengthAwarePaginator;

class BookService
{
    public function getPaginatedBooks(
        ?string $searchQuery = null,
        ?int $categoryId = null,
        ?int $authorId = null,
        ?int $publicationYear = null,
        int $perPage = 12
    ): LengthAwarePaginator {
        $books = Book::with(['author', 'category'])->latest();

        if ($searchQuery) {
            $books->where(function ($q) use ($searchQuery) {
                $q->where('title', 'like', '%' . $searchQuery . '%')
                    ->orWhereHas('author', function ($q) use ($searchQuery) {
                        $q->where('author', 'like', '%' . $searchQuery . '%');
                    })
                    ->orWhereHas('category', function ($q) use ($searchQuery) {
                        $q->where('category', 'like', '%' . $searchQuery . '%');
                    });
            });
        }

        if ($categoryId) {
            $books->where('category_id', $categoryId);
        }

        if ($authorId) {
            $books->where('author_id', $authorId);
        }

        if ($publicationYear) {
            $books->where('publication_year', $publicationYear);
        }

        return $books->paginate($perPage);
    }

    public function createBook(array $data): Book
    {
        return Book::create($data);
    }

    public function updateBook(Book $book, array $data): Book
    {
        $book->update($data);
        return $book;
    }
    
    public function deleteBook(Book $book): void
    {
        $book->delete();
    }
}
