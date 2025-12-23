<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Browser tab title --}}
    <title>@yield('title', 'Task List App')</title>
    
    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Custom styles for child pages --}}
    @yield('styles')
</head>

{{-- Warm background color for the entire site --}}
<body class="bg-stone-50 min-h-screen text-stone-800 antialiased">

    <div class="container mx-auto">
        
        {{-- Success Flash Message --}}
        @if (session('success'))
            <div id="flash-message" class="fixed top-4 right-4 z-50 max-w-md">
                <div class="bg-emerald-100 border-2 border-emerald-200 text-emerald-800 px-6 py-4 rounded-2xl shadow-lg flex items-center gap-3">
                    <span class="text-xl">✨</span>
                    <p class="font-bold tracking-tight">{{ session('success') }}</p>
                </div>
            </div>

            {{-- Script to make the message disappear after 3 seconds --}}
            <script>
                setTimeout(() => {
                    document.getElementById('flash-message').style.display = 'none';
                }, 3000);
            </script>
        @endif

        {{-- Main Content Injection --}}
        <main>
            @yield('content')
        </main>
        
    </div>

</body>
</html>