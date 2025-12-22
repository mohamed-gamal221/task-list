@extends('layouts.app')

@section('title', 'View Task')

@section('styles')
<style>
.page-bg {
    min-height: 100vh;
    background: linear-gradient(135deg, #667eea, #764ba2);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.task-card {
    background: #fff;
    padding: 2rem;
    border-radius: 14px;
    width: 100%;
    max-width: 720px;
    box-shadow: 0 20px 35px rgba(0,0,0,0.2);
}

/* Sections */
.task-section {
    margin-bottom: 28px;
}

.section-label {
    font-size: 0.8rem;
    color: #6b7280;
    margin-bottom: 6px;
    text-transform: uppercase;
    letter-spacing: 0.8px;
}

.task-title {
    font-size: 1.6rem;
    font-weight: 700;
    color: #111827;
}

.task-text {
    font-size: 1rem;
    color: #374151;
    line-height: 1.7;
}

/* Status badge */
.status-badge {
    display: inline-block;
    padding: 6px 14px;
    border-radius: 999px;
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 20px;
}

.status-completed {
    background: #dcfce7;
    color: #166534;
}

.status-pending {
    background: #fee2e2;
    color: #991b1b;
}

/* Buttons */
.actions {
    display: flex;
    gap: 12px;
    margin-top: 24px;
    flex-wrap: wrap;
}

button,
.action-link {
    padding: 10px 18px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    border: none;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
}

.toggle {
    background-color: #2563eb;
    color: white;
}

.toggle:hover {
    background-color: #1e40af;
}

.edit {
    background-color: #f59e0b;
    color: white;
}

.edit:hover {
    background-color: #d97706;
}

.delete {
    background-color: #dc2626;
    color: white;
}

.delete:hover {
    background-color: #b91c1c;
}

.back {
    background-color: #6b7280;
    color: white;
}

.back:hover {
    background-color: #4b5563;
}

/* Flash message */
.flash-success {
    background-color: #dcfce7;
    color: #166534;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-weight: 600;
}
</style>
</style>
@endsection

@section('content')
<div class="page-bg">
    <div class="task-card">

        {{-- Flash message --}}
        @if (session('success'))
            <div class="flash-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Title --}}
        <div class="task-section">
            <div class="section-label">Title</div>
            <div class="task-title">{{ $task->title }}</div>
        </div>

        {{-- Created At --}}

        <div class="task-section">
            <p class="section-label">Created at</p>
            <p class="task-text">
        {{ $task->created_at->format('F d, Y · h:i A') }}
        </p>
</div>




        
        

        {{-- Description --}}
        <div class="task-section">
            <div class="section-label">Description</div>
            <p class="task-text">{{ $task->description }}</p>
        </div>

        {{-- Long Description --}}
        @if ($task->long_description)
            <div class="task-section">
                <div class="section-label">Long Description</div>
                <p class="task-text">{{ $task->long_description }}</p>
            </div>
        @endif

        {{-- Status --}}
        <p class="status {{ $task->completed ? 'completed' : 'not-completed' }}">
            {{ $task->completed ? 'Completed ✅' : 'Not completed ❌' }}
        </p>

        {{-- Toggle completed --}}
        <form method="POST" action="{{ route('tasks.toggle', $task) }}">
            @csrf
            @method('PATCH')
            <button class="toggle" type="submit">
                {{ $task->completed ? 'Mark as incomplete' : 'Mark as completed' }}
            </button>
        </form>

        {{-- Actions --}}
        <div class="actions">
            <a href="{{ route('tasks.edit', $task) }}" class="button edit">Edit</a>

            <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                @csrf
                @method('DELETE')
                <button class="delete" type="submit"
                        onclick="return confirm('Are you sure you want to delete this task?')">
                    Delete
                </button>
            </form>

            <a href="{{ route('tasks.index') }}" class="button back">Back to tasks</a>
        </div>

    </div>
</div>
@endsection
