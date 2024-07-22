<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @stack('styles')
        <title>Laravel - @yield('title')</title>
        @vite('resources/js/app.js')
    </head>
    <body class="bg-gray-100">
        <header class="p-5 bg-white border-b shadow">
            <div class="container flex justify-between mx-auto">
                <h1 class="text-3xl font-black">SocialApp</h1>
                <nav class="flex items-center gap-6">
                    @guest
                    <a href="{{route('register.index')}}"
                    class="text-sm font-bold text-gray-600 uppercase hover:text-indigo-600">Registrarse</a>
                    <a href="{{route('login.index')}}"
                    class="text-sm font-bold text-gray-600 uppercase hover:text-indigo-600">Iniciar sesion</a>
                    @endguest
                    @auth
                    <a href="{{route('home')}}"
                    class="flex items-center gap-3 text-sm font-bold text-gray-600 uppercase hover:text-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        Inicio
                    </a>
                    <a href="{{route('posts.create')}}" class="flex items-center gap-3 text-sm font-bold text-gray-600 uppercase hover:text-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Crear
                    </a>
                    <div class="flex items-center gap-2">
                        <a href="{{route('profile.index', auth()->user()->username)}}" class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300">
                            <img class="w-8 h-8 rounded-full" src="#">
                        </a>
                        <p class="text-sm font-bold text-gray-600 uppercase">{{auth()->user()->username}}</p>
                    </div>
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <a href="{{route('logout')}}" type="submit"
                        class="flex items-center text-sm font-bold text-gray-600 uppercase hover:text-indigo-600">Cerrar sesion</a>
                    </form>

                    @endauth
                </nav>
            </div>
        </header>
        <main class="container min-h-screen mx-auto mt-10">
            @yield('content')
        </main>
        <footer class="p-5 text-sm font-bold text-center text-gray-600 uppercase bg-white border-t shadow">
            &copy; Todo los derechos reservados - Juan David Galindo
        </footer>
    </body>
</html>
