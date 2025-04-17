<?php
// app/Policies/TaskPolicy.php
namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use App\Models\Collaborator;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Task $task): bool
    {
        // Cek apakah user adalah pemilik task
        if ($user->id === $task->user_id) {
            return true;
        }
        
        // Cek apakah user adalah kolaborator dari task
        $isCollaborator = Collaborator::where('task_id', $task->id)
                        ->where('user_id', $user->id)
                        ->exists();
                        
        return $isCollaborator;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Task $task): bool
    {
        // Hanya pemilik dan kolaborator yang bisa update
        return $this->view($user, $task);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Task $task): bool
    {
        // Hanya pemilik yang bisa delete
        return $user->id === $task->user_id;
    }

    /**
     * Determine whether the user can manage collaborators for the task.
     */
    public function manageCollaborators(User $user, Task $task): bool
    {
        // Hanya pemilik yang bisa mengelola kolaborator
        return $user->id === $task->user_id;
    }
}