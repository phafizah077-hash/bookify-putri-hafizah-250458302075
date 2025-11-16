<?php

namespace App\Services;

use App\Models\Author;
use Illuminate\Pagination\LengthAwarePaginator;

class AuthorService
{
    public function getPaginatedAuthors(?string $searchQuery = null, int $perPage = 10): LengthAwarePaginator
    {
        $authors = Author::query();

        if ($searchQuery) {
            $authors->where('author', 'like', '%' . $searchQuery . '%');
        }

        return $authors->latest()->paginate($perPage);
    }

    public function createAuthor(array $data): Author
    {
        return Author::create($data);
    }

    public function updateAuthor(Author $author, array $data): Author
    {
        $author->update($data);
        return $author;
    }

    public function deleteAuthor(Author $author): void
    {
        $author->delete();
    }
}
