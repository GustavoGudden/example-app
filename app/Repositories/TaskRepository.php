<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository
{
    protected Task $task;

    public function __construct()
    {
        $this->task = new Task();
    }

    public function getAllTaskByUserId(int $user_id)
    {
        return $this->task->where('user_id', $user_id)->get();
    }

    public function find($id)
    {
        return $this->task->find($id);
    }

    public function create(array $data)
    {
        return $this->task->create($data);
    }

    public function update(Task $task, array $data)
    {
        $task->update($data);
        return $task;
    }

    public function delete(Task $task)
    {
        $task->delete();
    }
}
