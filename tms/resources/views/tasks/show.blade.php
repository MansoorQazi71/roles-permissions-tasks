@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- <div class="row">
            <div class="col-md-12">
                <h2>Task Details</h2>
                @if($task)
                    <p><strong>Title:</strong> {{ $task->title }}</p>
                    <p><strong>Description:</strong> {{ $task->description }}</p>
                    <p><strong>Due Date:</strong> {{ $task->due_date->format('Y-m-d') }}</p>
                    <p><strong>Priority:</strong> {{ $task->priority }}</p>
                    <p><strong>Status:</strong> {{ $task->status }}</p>
                @else
                    <p>Task not found.</p>
                @endif
            </div>
        </div> --}}
        {{ dd($task) }}
    </div>
@endsection
