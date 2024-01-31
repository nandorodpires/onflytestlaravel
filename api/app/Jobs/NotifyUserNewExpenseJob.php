<?php

namespace App\Jobs;

use App\Models\Expense;
use App\Models\User;
use App\Notifications\ExpenseCreatedNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class NotifyUserNewExpenseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected User $user;
    protected Expense $expense;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, Expense $expense)
    {
        $this->user = $user;
        $this->expense = $expense;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Notification::send($this->user, new ExpenseCreatedNotification($this->expense));
    }
}
