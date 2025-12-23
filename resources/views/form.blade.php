@extends('layouts.app')

{{-- Tab title changes based on whether we are editing or adding --}}
@section('title', isset($task) ? 'Edit Task' : 'Add Task')

@section('content')
<div class="max-w-2xl mx-auto py-8 px-4">
    
    {{-- Back navigation --}}
    <nav class="mb-8">
        <a href="{{ route('tasks.index') }}" 
           class="flex items-center text-amber-700 hover:text-amber-900 transition font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back to list
        </a>
    </nav>

    {{-- Main form card --}}
    <div class="bg-white rounded-2xl shadow-sm border-2 border-orange-50 overflow-hidden">
        
        {{-- Form Header --}}
        <div class="p-6 border-b border-orange-50 bg-orange-50/30 text-center">
            <h2 class="text-xl font-bold text-stone-700 uppercase tracking-wide">
                {{ isset($task) ? 'Modify Task' : 'Create New Task' }}
            </h2>
        </div>

        {{-- Form body --}}
        <form method="POST" 
              action="{{ isset($task) ? route('tasks.update', $task) : route('tasks.store') }}" 
              class="p-8 space-y-6">
            @csrf
            @isset($task)
                @method('PUT')
            @endisset

            {{-- Title input --}}
            <div>
                <label for="title" class="block text-stone-600 font-bold mb-2">Title</label>
                <input type="text" name="title" id="title"
                       value="{{ old('title', $task->title ?? '') }}"
                       class="w-full rounded-xl border-2 border-orange-100 p-3 focus:border-amber-400 focus:ring-4 focus:ring-amber-100 transition outline-none"
                       placeholder="What needs to be done?">
                @error('title')
                    <p class="text-rose-500 text-sm mt-2 font-semibold italic">{{ $message }}</p>
                @enderror
            </div>

            {{-- Short Description --}}
            <div>
                <label for="description" class="block text-stone-600 font-bold mb-2">Short Summary</label>
                <textarea name="description" id="description" rows="3"
                          class="w-full rounded-xl border-2 border-orange-100 p-3 focus:border-amber-400 focus:ring-4 focus:ring-amber-100 transition outline-none"
                          placeholder="A quick overview...">{{ old('description', $task->description ?? '') }}</textarea>
                @error('description')
                    <p class="text-rose-500 text-sm mt-2 font-semibold italic">{{ $message }}</p>
                @enderror
            </div>

            {{-- Long Description --}}
            <div>
                <label for="long_description" class="block text-stone-600 font-bold mb-2">Detailed Notes</label>
                <textarea name="long_description" id="long_description" rows="6"
                          class="w-full rounded-xl border-2 border-orange-100 p-3 focus:border-amber-400 focus:ring-4 focus:ring-amber-100 transition outline-none"
                          placeholder="Any extra details?">{{ old('long_description', $task->long_description ?? '') }}</textarea>
                @error('long_description')
                    <p class="text-rose-500 text-sm mt-2 font-semibold italic">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit button --}}
            <div class="pt-4">
                <button type="submit" 
                        class="w-full py-4 bg-amber-500 hover:bg-amber-600 text-white font-extrabold rounded-xl transition shadow-lg shadow-amber-100 active:scale-[0.98]">
                    {{ isset($task) ? '✨ Update Task' : '🚀 Save New Task' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection