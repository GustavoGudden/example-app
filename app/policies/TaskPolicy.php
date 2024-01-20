<?
use App\Models\Task;

class TaskPolicy
{
    public function update(User $user, Task $task)
    {
        // Check if the user can update the task
        return $user->id === $task->user_id;
    }

    public function delete(User $user, Task $task)
    {
        // Check if the user can delete the task
        return $user->id === $task->user_id;
    }
}