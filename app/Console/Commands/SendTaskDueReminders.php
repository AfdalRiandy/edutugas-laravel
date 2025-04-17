<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Models\User;
use App\Notifications\TaskDueNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendTaskDueReminders extends Command
{
    protected $signature = 'tasks:send-due-reminders';
    protected $description = 'Send reminders for tasks due within 24 hours';

    public function handle()
    {
        // Ambil semua tugas yang belum selesai dan jatuh tempo dalam 24 jam
        $tasks = Task::where('is_completed', false)
                ->whereBetween('due_date', [
                    Carbon::now(),
                    Carbon::now()->addHours(24)
                ])
                ->get();

        $count = 0;

        foreach ($tasks as $task) {
            // Kirim notifikasi ke pemilik tugas
            $task->user->notify(new TaskDueNotification($task));
            
            // Kirim notifikasi ke semua kolaborator
            foreach ($task->collaborators as $collaborator) {
                $collaborator->notify(new TaskDueNotification($task));
            }
            
            $count++;
        }

        $this->info("Sent reminders for {$count} tasks.");
        
        return 0;
    }
}