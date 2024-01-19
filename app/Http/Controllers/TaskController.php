<?php

namespace App\Http\Controllers;

use App\Repositories\TaskRepository;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function index()
    {
        $user_id = auth()->user()->id;
        $tasks = $this->taskRepository->getAllTaskByUserId($user_id);
        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $user_id = auth()->user()->id;

        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $data['user_id'] = $user_id;

        $created = $this->taskRepository->create($data);

        if ($created) {
            return redirect()->route('tasks.index')->with('message', 'Task created successfully');
        }

        return redirect()->back()->with('message', 'Error creating task');
    }

    public function show(string $id)
    {
        $task = $this->taskRepository->find($id);

        if (!$task) {
            abort(404, 'Task not found');
        }

        return view('tasks.show', ['task' => $task]);
    }

    public function edit(string $id)
    {
        $task = $this->taskRepository->find($id);

        if (!$task) {
            abort(404, 'Task not found');
        }

        return view('tasks.edit', ['task' => $task]);
    }

    public function update(Request $request, string $id)
    {
        $task = $this->taskRepository->find($id);

        if (!$task) {
            abort(404, 'Task not found');
        }

        $updated = $this->taskRepository->update($task, $request->except(['_token', '_method']));

        if ($updated) {
            return redirect()->route('tasks.index')->with('message', 'Task updated successfully');
        }

        return redirect()->back()->with('message', 'Error updating task');
    }

    public function destroy(string $id)
    {
        $task = $this->taskRepository->find($id);

        if (!$task) {
            abort(404, 'Task not found');
        }

        $this->taskRepository->delete($task);

        return redirect()->route('tasks.index')->with('message', 'Task deleted successfully');
    }
}
