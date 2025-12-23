<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Task App')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @yield('styles')

    {{-- Custom styles for the mesh background --}}
    <style>
        .mesh-bg {
            background-color: #fafaf9; /* Stone 50 */
            background-image: 
                radial-gradient(at 0% 0%, rgba(254, 243, 199, 0.5) 0px, transparent 50%), 
                radial-gradient(at 100% 0%, rgba(255, 237, 213, 0.5) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(254, 243, 199, 0.5) 0px, transparent 50%),
                radial-gradient(at 0% 100%, rgba(255, 237, 213, 0.5) 0px, transparent 50%);
        }
    </style>
</head>

<body class="mesh-bg min-h-screen text-stone-800 antialiased font-sans">

    {{-- Top Navigation Bar --}}
    <header class="max-w-2xl mx-auto pt-6 px-4 flex justify-between items-center">
        {{-- Digital Clock Widget --}}
        <div class="bg-white/60 backdrop-blur-md border border-orange-100 px-4 py-2 rounded-2xl shadow-sm flex items-center gap-3">
            <span class="text-orange-500 animate-pulse text-xl">☀️</span>
            <div id="clock" class="text-lg font-bold text-stone-700 tracking-tight">00:00:00</div>
        </div>

        {{-- Small App Label --}}
        <div class="text-xs font-black uppercase tracking-widest text-orange-300">
            Task.App
        </div>
    </header>

    <div class="container mx-auto">
        
        {{-- Success message --}}
        @if (session('success'))
            <div id="flash-message" class="fixed top-20 right-4 z-50">
                <div class="bg-white border-l-4 border-emerald-400 text-stone-800 px-6 py-4 rounded-xl shadow-xl flex items-center gap-3">
                    <span class="bg-emerald-100 rounded-full p-1 text-emerald-600 font-bold">✓</span>
                    <p class="font-bold text-sm">{{ session('success') }}</p>
                </div>
            </div>

            <script>
                setTimeout(() => {
                    document.getElementById('flash-message').style.opacity = '0';
                    setTimeout(() => document.getElementById('flash-message').remove(), 500);
                }, 3000);
            </script>
        @endif

        {{-- Page Content --}}
        <main>
            @yield('content')
        </main>
        
    </div>

    {{-- Clock Script --}}
    <script>
        function updateClock() {
            const now = new Date();
            const timeString = now.toLocaleTimeString([], { 
                hour: '2-digit', 
                minute: '2-digit', 
                second: '2-digit',
                hour12: true 
            });
            document.getElementById('clock').textContent = timeString;
        }

        // Update clock every second
        setInterval(updateClock, 1000);
        updateClock(); // Run immediately
    </script>

</body>
</html>