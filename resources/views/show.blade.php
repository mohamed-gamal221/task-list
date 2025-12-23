@extends('layouts.app')

{{-- 
    SEO & Accessibility: Set the page title dynamically. 
    Experienced devs always ensure the tab name matches the content. 
--}}
@section('title', $task->title)

@section('content')
  {{-- Main Container: max-width for readability on large screens --}}
  <div class="max-w-2xl mx-auto py-8 px-4">
    
    {{-- Navigation Header --}}
    <nav class="mb-8">
        <a href="{{ route('tasks.index') }}" 
           class="flex items-center text-amber-700 hover:text-amber-900 transition-colors duration-200 font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="Arrow-Left-Path..." />
            </svg>
            ← Back to all tasks
        </a>
    </nav>

    {{-- Task Main Card --}}
    <div class="bg-white rounded-2xl shadow-sm border-2 border-orange-50 overflow-hidden">
        
        {{-- Card Header: Task Title and Status --}}
        <div class="p-8 pb-4 border-b border-orange-50 bg-orange-50/30">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <h1 class="text-4xl font-extrabold text-stone-800 tracking-tight">
                    {{ $task->title }}
                </h1>
                
                {{-- Status Badge: Using warm Greens/Ambers --}}
                @if($task->completed)
                    <span class="inline-flex items-center px-4 py-1 rounded-full text-sm font-bold bg-emerald-100 text-emerald-700 border border-emerald-200">
                        ✨ Task Finished
                    </span>
                @else
                    <span class="inline-flex items-center px-4 py-1 rounded-full text-sm font-bold bg-amber-100 text-amber-700 border border-amber-200">
                        ⏳ Work in Progress
                    </span>
                @endif
            </div>
        </div>

        {{-- Card Body: Descriptions --}}
        <div class="p-8 space-y-6">
            <div>
                <h3 class="text-xs uppercase tracking-widest text-stone-400 font-bold mb-2">Short Summary</h3>
                <p class="text-xl text-stone-700 leading-relaxed font-medium">
                    {{ $task->description }}
                </p>
            </div>

            @if ($task->long_description)
                <div class="bg-stone-50 p-6 rounded-xl border-l-4 border-orange-200">
                    <h3 class="text-xs uppercase tracking-widest text-stone-400 font-bold mb-2">Detailed Notes</h3>
                    <p class="text-stone-600 leading-relaxed">
                        {{ $task->long_description }}
                    </p>
                </div>
            @endif
        </div>

        {{-- Card Footer: Timestamps formatted for humans --}}
        <div class="px-8 py-4 bg-stone-50/50 flex flex-wrap gap-x-6 gap-y-2 text-xs font-semibold text-stone-400 uppercase">
            <div class="flex items-center">
                📅 Created {{ $task->created_at->format('M d, Y') }} 
                <span class="ml-1 text-stone-300">({{ $task->created_at->diffForHumans() }})</span>
            </div>
            <div class="flex items-center">
                🔄 Last update: {{ $task->updated_at->diffForHumans() }}
            </div>
        </div>
    </div>

    {{-- Action Bar: Grouped buttons with warm, distinct colors --}}
    <div class="mt-8 flex flex-wrap items-center justify-center sm:justify-start gap-4">
        
        {{-- 1. Edit Button (Amber/Gold) --}}
        <a href="{{ route('tasks.edit', ['task' => $task]) }}" 
           class="inline-flex items-center px-6 py-3 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-xl transition-all shadow-lg shadow-amber-200 active:scale-95">
            Edit Details
        </a>

        {{-- 2. Toggle Status Button (Sunset Orange) --}}
        <form method="POST" action="{{ route('tasks.toggle-complete', ['task' => $task]) }}">
            @csrf
            @method('PUT')
            <button type="submit" 
                class="inline-flex items-center px-6 py-3 bg-orange-100 hover:bg-orange-200 text-orange-700 font-bold rounded-xl transition-all active:scale-95">
                Mark as {{ $task->completed ? 'Not Finished' : 'Complete' }}
            </button>
        </form>

        {{-- 3. Delete Action (Soft Rose/Red for warning but still warm) --}}
        <form action="{{ route('tasks.destroy', ['task' => $task]) }}" method="POST" 
              onsubmit="return confirm('Wait! Are you sure you want to delete this task?')">
            @csrf
            @method('DELETE')
            <button type="submit" 
                class="inline-flex items-center px-6 py-3 text-rose-500 hover:text-rose-700 font-bold underline underline-offset-4 transition-colors">
                Remove Task
            </button>
        </form>
    </div>
  </div>
@endsection