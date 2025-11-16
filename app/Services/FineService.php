<?php

namespace App\Services;

use App\Models\Fine;
use App\Models\Loan;
use Carbon\Carbon;

class FineService
{
    const FINE_RATE_PER_DAY = 1000; 

    public function createFineIfOverdue(Loan $loan): ?Fine
    {
        $dueDate = Carbon::parse($loan->due_date);
        $returnDate = Carbon::now();

        if ($returnDate->isAfter($dueDate)) {
            $overdueDays = $returnDate->diffInDays($dueDate);
            $amount = $overdueDays * self::FINE_RATE_PER_DAY;

            return Fine::create([
                'loan_id' => $loan->id,
                'user_id' => $loan->user_id,
                'amount' => $amount,
                'status' => 'pending',
            ]);
        }

        return null;
    }

    public function markAsPaid(Fine $fine): Fine
    {
        $fine->update([
            'status' => 'paid',
            'paid_at' => Carbon::now(),
        ]);

        return $fine;
    }
}
