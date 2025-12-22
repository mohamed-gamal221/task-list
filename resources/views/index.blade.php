@extends('layouts.app')

{{-- Page title --}}
@section('title', 'The list of tasks')

@section('styles')
<style>
/* Full page background */
.task-page {
    min-height: 100vh;
    background: linear-gradient(135deg, #667eea, #764ba2);
    display: flex;
    justify-content: center;
    padding-top: 40px;
}

/* White card */
.task-container {
    background: white;
    max-width: 600px;
    width: 100%;
    padding: 24px;
    border-radius: 10px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

/* Top navigation */
.task-nav {
    margin-bottom: 20px;
    text-align: right;
}

/* Add task link */
.add-task {
    font-weight: 600;
    text-decoration: underline;
    color: #4f46e5;
}

/* Task item */
.task-item {
    padding: 10px 0;
    border-bottom: 1px solid #eee;
}

/* Completed task */
.completed {
    text-decoration: line-through;
    color: #9ca3af;
}

/* Empty state */
.empty-message {
    color: #6b7280;
    font-style: italic;
    text-align: center;
    padding: 20px 0;
}

/* Pagination */
.pagination {
    margin-top: 20px;
}
</style>
@endsection

@section('content')

<div class="task-page">

    <div class="task-container">

        {{-- Navigation / Add task link --}}
        <nav class="task-nav">
            <a href="{{ route('tasks.create') }}" class="add-task">
                + Add Task
            </a>
        </nav>

        {{-- Loop through tasks --}}
        @forelse ($tasks as $task)

            <div class="task-item">
                <a href="{{ route('tasks.show', $task) }}"
                   @class([
                        'font-bold',
                        'completed' => $task->completed
                   ])>
                    {{ $task->title }}
                </a>
            </div>

        {{-- If no tasks exist --}}
        @empty
            <div class="empty-message">
                There are no tasks
            </div>
        @endforelse

        {{-- Pagination links --}}
        @if ($tasks->count())
            <nav class="pagination">
                {{ $tasks->links() }}
            </nav>
        @endif

    </div>

</div>

@endsection
