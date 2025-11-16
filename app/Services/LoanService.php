<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
use Exception;

class LoanService
{
    public function getLoanHistoryForUser(User $user): Collection
    {
        return $user->loans()->with('book')->latest()->get();
    }

    public function createLoan(int $userId, int $bookId, int $librarianId, int $loanDays = 7): Loan
    {
        $book = Book::findOrFail($bookId);

        if (!$book->isAvailable()) {
            throw new Exception('Buku tidak tersedia untuk dipinjam.');
        }

        $book->decrement('stock');

        return Loan::create([
            'user_id' => $userId,
            'book_id' => $bookId,
            'librarian_id' => $librarianId,
            'loan_date' => Carbon::now(),
            'due_date' => Carbon::now()->addDays($loanDays),
            'status' => 'borrowed',
        ]);
    }

    public function returnLoan(Loan $loan): Loan
    {
        if ($loan->status === 'returned') {
            throw new Exception('Buku ini sudah dikembalikan sebelumnya.');
        }

        $loan->update([
            'status' => 'returned',
        ]);


        $loan->book->increment('stock');


        $loan->returnBook()->create([
            'librarian_id' => Auth::id(), 
            'return_date' => Carbon::now(),
        ]);

        return $loan;
    }
}
