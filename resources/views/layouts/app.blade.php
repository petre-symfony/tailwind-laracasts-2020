<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel Video Games</title>
        <link rel="stylesheet" href="/css/app.css">
        @livewireStyles
    </head>
    <body class="bg-gray-900 text-white">
    <header class="border-b border-gray-800">
        <nav class="container mx-auto flex flex-col lg:flex-row items-center justify-between px-4 py-6">
            <div class="flex flex-col lg:flex-row items-center">
                <a href="">
                    <img src="/laracasts-logo.svg" alt="laracasts" class="w-32 flex-none">
                </a>
                <ul class="flex ml-0 lg:ml-16 space-x-8 mt-6 lg:mt-0">
                    <li><a href="" class="hover:text-gray-400">Games</a></li>
                    <li><a href="" class="hover:text-gray-400">Reviews</a></li>
                    <li><a href="" class="hover:text-gray-400">Coming Soon</a></li>
                </ul>
            </div>
            <div class="flex items-center mt-6 lg:mt-0">
                <div class="relative">
                    <input type="text"
                        class="
                            bg-gray-800 text-sm rounded-full px-3 py-1
                            focus:outline-none focus:ring w-64 pl-8
                        "
                        placeholder="Search..."
                    >
                    <div class="absolute top-0 flex items-center h-full ml-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor"
                            class="text-gray-400 w-4"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </div>
                </div>
                <div class="ml-6">
                    <a href=""><img src="/avatar.jpg" alt="avatar" class="rounded-full w-8"></a>
                </div>
            </div>
        </nav>
    </header>

    <main class="py-8">
        @yield('content')
    </main>

    <footer class="border-t border-gray-800">
        <div class="container mx-auto px-4 py-6">
            Powered By <a href="" class="underline hover:text-gray-400">IGDB API</a>
        </div>
    </footer>
    @livewireScripts
    </body>
</html>
