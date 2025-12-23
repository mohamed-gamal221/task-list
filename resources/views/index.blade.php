@extends('layouts.app')

{{-- Browser tab title --}}
@section('title', 'My Task List')

@section('content')
<div class="max-w-2xl mx-auto py-8 px-4">
    
    {{-- Header Section: Title and Add Button --}}
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-extrabold text-stone-800 tracking-tight">My Tasks</h1>
        
        <a href="{{ route('tasks.create') }}" 
           class="inline-flex items-center px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-xl transition shadow-lg shadow-amber-100 active:scale-95">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
            </svg>
            Add Task
        </a>
    </div>

    {{-- Main Container Card --}}
    <div class="bg-white rounded-2xl shadow-sm border-2 border-orange-50 overflow-hidden">
        
        {{-- Task Loop --}}
        @forelse ($tasks as $task)
            <div class="group border-b border-orange-50 last:border-0">
                <a href="{{ route('tasks.show', $task) }}" 
                   class="flex items-center justify-between p-5 hover:bg-orange-50/50 transition duration-200">
                    
                    <div class="flex items-center gap-4">
                        {{-- Status Dot --}}
                        <div class="h-3 w-3 rounded-full {{ $task->completed ? 'bg-emerald-400' : 'bg-amber-400 animate-pulse' }}"></div>
                        
                        {{-- Task Title --}}
                        <span @class([
                            'text-lg font-semibold transition-colors',
                            'text-stone-700 group-hover:text-amber-700',
                            'line-through text-stone-400' => $task->completed
                        ])>
                            {{ $task->title }}
                        </span>
                    </div>

                    {{-- Right-side arrow icon --}}
                    <div class="text-stone-300 group-hover:text-amber-500 transition-transform group-hover:translate-x-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="9 5l7 7-7 7" />
                        </svg>
                    </div>
                </a>
            </div>

        {{-- Empty State --}}
        @empty
            <div class="p-12 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-orange-100 text-orange-500 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                </div>
                <p class="text-stone-500 font-medium">No tasks found. Time to relax or start something new!</p>
            </div>
        @endforelse

    </div>

    {{-- Pagination Section --}}
    @if ($tasks->count())
        <div class="mt-8 px-2">
            {{ $tasks->links() }}
        </div>
    @endif

</div>
@endsection