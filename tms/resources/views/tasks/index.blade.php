@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>All Tasks</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Due Date</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->description }}</td>
                                <td>
                                    @if($task->due_date)
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d', $task->due_date)->format('Y-m-d') }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                
                                <td>{{ $task->priority }}</td>
                                <td>{{ $task->status }}</td>
                                <td>
                                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger text-dark" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ route('tasks.create') }}" class="btn btn-success">Create New Task</a>
            </div>
        </div>
    </div>
@endsection
