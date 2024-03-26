<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TaskAssignedNotification;
use App\Notifications\TaskUpdatedNotification;


class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view task', ['only' => ['index']]);
        $this->middleware('permission:create task', ['only' => ['create', 'store']]);
        $this->middleware('permission:update task', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete task', ['only' => ['destroy']]);
    }
    public function index()
    {
        // Check if the user is an admin or manager
        if (Auth::user()->hasRole(['admin', 'manager'])) {
            $tasks = Task::all(); // Get all tasks for admin and manager
        } else {
            // For regular users, get only the tasks assigned to them
            $tasks = Auth::user()->tasks()->get();
        }

        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function create()
    {
        // Retrieve all users from the database
        $users = User::all();
        //  echo json_encode($users);
        //  die();
        // Pass the $users variable to the 'tasks.create' view
        return view('tasks.create', ['users' => $users]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required|date',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:open,in_progress,completed',
            'user_id' => 'required', // Ensure user_id is required
        ]);

        // Task::create($request->all());
        // Create the task
        $task = Task::create($request->all());

        // Find the user to notify
        // $user = User::find($request->user_id);

        // Notify the user about the task assignment
        // $user->notify(new TaskAssignedNotification($task));

        return redirect()->route('tasks.index')
            ->with('success', 'Task created successfully.');
    }


    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required|date',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:open,in_progress,completed',
        ]);

        $task->update($request->all());

        // if ($task->user) {
        //     $task->user->notify(new TaskUpdatedNotification($task));
        // }

        return redirect()->route('tasks.index')
            ->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Task deleted successfully.');
    }
    public function show($id)
    {
        $task = Task::findOrFail($id); // Fetch the task by its ID
        return view('tasks.show', ['task' => $task]); // Pass the task data to the view
    }
    public function myTasks()
    {
        $user = auth()->user();
        $tasks = $user->tasks()->get(); // Retrieve tasks assigned to the authenticated user

        return view('tasks.my-tasks', compact('tasks'));
    }


}
