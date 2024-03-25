@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>My Tasks</h1>

        @if ($tasks && !$tasks->isEmpty())
            <ul>
                @foreach ($tasks as $task)
                    <li>{{ $task->title }} - {{ $task->description }}</li>
                @endforeach
            </ul>
        @else
            <p>No tasks assigned to you.</p>
        @endif
    </div>
@endsection
