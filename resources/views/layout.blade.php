<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Invoice project | @yield('title')</title>
    <link rel="stylesheet" href="/app.css">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

</head>
<body>
  <div class="divide-y divide-gray-500">
  <nav class="bg-gray-900 px-3 py-2 flex items-center">
    <div class="h-12 w-full flex items-center text-2xl"> <a href="/" class="w-full text-gray-300">Laravel Invoices App</a> </div>
    <div class="flex justify-end">
      <ul class="flex text-gray-200 text-sm">
        @auth
        <a href="/profile"><li class="cursor-pointer px-4 py-2 hover:underline">{{ auth()->user()->username }}</li></a>
        <a href="/logout"><li class="cursor-pointer px-4 py-2 hover:underline">Logout</li></a>

        @else
        <a href="/login"><li class="cursor-pointer px-4 py-2 hover:underline">Login</li></a>
        <a href="/register"><li class="cursor-pointer px-4 py-2 hover:underline">SignUp</li></a>
        @endauth

      </ul>


    </div>

  </nav>

  @auth

  <div class="flex">
  <aside class="bg-gray-900 text-gray-700 w-1/5">
    <ul class="text-gray-200 text-lg">
      <a href="/clients/create"> <li class="cursor-pointer px-6 py-2 mt-8 hover:bg-gray-800">Add new client</li></a>
      <a href="/clients"> <li class="cursor-pointer px-6 py-2 my-4 hover:bg-gray-800">List all clients</li></a>
      <a href="/invoices/create"> <li class="cursor-pointer px-6 py-2 my-4 hover:bg-gray-800">Add new invoice</li></a>
      <a href=""> <li class="cursor-pointer px-6 py-2 my-4 hover:bg-gray-800">List all invoices</li></a>
      <a href="/profile"> <li class="cursor-pointer px-6 py-2 my-4 hover:bg-gray-800">Profile</li></a>
    </ul>

  </aside>
  @endauth
  <main class="bg-gray-100 p-12 min-h-screen w-full "> 
    <div class="absoulte right-5 top-5 rounded bg-gray-200">
      <p class="text-xs font-semibold text-green-600">{{ session('success')}}  </p>
      
      </div>
    @yield('content') 

  </main>

  @if (session()->has('success'))
    
@endif
</div>
</div>

 
    
</body>
</html>