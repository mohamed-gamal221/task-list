<!DOCTYPE html>
<html>

<head>

    <title> Laravel 10 Task List app </title>
    <script src="https://cdn.tailwindcss.com"></script>
    @yield('styles')

    @if (session('success'))
    <div style="
        background: #d1fae5;
        color: #065f46;
        padding: 10px 16px;
        margin: 16px auto;
        max-width: 600px;
        border-radius: 6px;
        text-align: center;
        font-weight: 600;
    ">
        {{ session('success') }}
    </div>
    
@endif







</head>



<body> 

    <h1 class="mb-4 text-2xl">@yield('title')</h1>

    {{-- @if (session()->has('success'))
    <divs>{{ session('success')}}</div>
    @endif  --}}
    <div>
   @yield('content')

</div>

</body>

</html>