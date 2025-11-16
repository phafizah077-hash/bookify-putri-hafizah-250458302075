<?php

namespace App\Services;

use App\Models\Loan;
use App\Models\Notification;
use Carbon\Carbon;

class NotificationService
{
    public function sendDueDateWarnings(int $daysBefore = 3): int
    {
        $targetDate = Carbon::now()->addDays($daysBefore)->toDateString();
        $loans = Loan::where('status', 'borrowed')
            ->whereDate('due_date', $targetDate)
            ->get();

        foreach ($loans as $loan) {
            Notification::create([
                'user_id' => $loan->user_id,
                'message' => "Peminjaman buku '{$loan->book->title}' akan jatuh tempo dalam {$daysBefore} hari pada tanggal {$loan->due_date->format('d-m-Y')}.",
                'type' => 'due_date_warning',
            ]);
        }

        return $loans->count();
    }

    public function sendOverdueAlerts(): int
    {
        $today = Carbon::now()->startOfDay();
        $loans = Loan::where('status', 'borrowed')
            ->where('due_date', '<', $today)
            ->get();

        foreach ($loans as $loan) {
            Notification::firstOrCreate(
                [
                    'user_id' => $loan->user_id,
                    'type' => 'overdue_alert',
                    'message' => "Peminjaman buku '{$loan->book->title}' telah melewati tanggal jatuh tempo ({$loan->due_date->format('d-m-Y')}). Mohon segera kembalikan."
                ]
            );
        }

        return $loans->count();
    }
}
