@extends('layouts.app')

@section('title', isset($task) ? 'Edit Task' : 'Add Task')

@section('styles')
<style>
.form-page {
    min-height: 100vh;
    background: linear-gradient(135deg, #667eea, #764ba2);
    display: flex;
    justify-content: center;
    align-items: center;
}

.form-card {
    background: white;
    width: 100%;
    max-width: 600px;
    padding: 24px;
    border-radius: 10px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.back-link {
    display: inline-block;
    margin-bottom: 16px;
    color: #4f46e5;
    font-weight: 600;
    text-decoration: none;
}

.back-link:hover {
    text-decoration: underline;
}

input, textarea {
    width: 100%;
    padding: 8px;
    margin-top: 4px;
    border-radius: 6px;
    border: 1px solid #ccc;
}

label {
    font-weight: 600;
}

button {
    margin-top: 1rem;
    padding: 10px 16px;
    border: none;
    border-radius: 6px;
    background-color: #4f46e5;
    color: white;
    cursor: pointer;
}

button:hover {
    background-color: #4338ca;
}

.error-message {
    color: red;
    font-size: 0.8rem;
    margin-top: 4px;
}
</style>
@endsection

@section('content')

<div class="form-page">

    <div class="form-card">

        {{-- Back to tasks --}}
        <a href="{{ route('tasks.index') }}" class="back-link">
            ← Back to Tasks
        </a>

        <form method="POST"
              action="{{ isset($task)
                    ? route('tasks.update', $task)
                    : route('tasks.store') }}">

            @csrf

            @isset($task)
                @method('PUT')
            @endisset

            <div>
                <label for="title">Title</label>
                <input type="text" name="title" id="title"
                       value="{{ old('title', $task->title ?? '') }}">

                @error('title')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="5">{{ old('description', $task->description ?? '') }}</textarea>

                @error('description')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="long_description">Long Description</label>
                <textarea name="long_description" id="long_description" rows="8">{{ old('long_description', $task->long_description ?? '') }}</textarea>

                @error('long_description')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit">
                {{ isset($task) ? 'Update Task' : 'Add Task' }}
            </button>

        </form>

    </div>

</div>

@endsection
