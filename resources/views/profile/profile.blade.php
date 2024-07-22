@extends('layouts.app')

@section('title')
    Tu cuenta
@endsection

@section('content')
    <div class="items-center grid-rows-4 gap-4 md:w-8/12 md:grid-flow-col md:grid md:mx-80">
        <div class="flex justify-center row-span-4">
            <img class="w-[18.75rem] h-[18.75rem] rounded-full" src="{{$user->imagen ? asset('/perfiles'). '/'. $user->imagen : asset('img/usuario.svg') }}" alt="">
        </div>
        <div class="flex justify-center col-span-1 gap-4 py-3 item-center">
            <p class="text-3xl text-gray-700">{{$user->username}}</p>
            @auth
                @if ($user->id === auth()->user()->id)
                    <a href="{{route('profile.edit', ['user' =>$user->username, 'id' => $user->id])}}" class="px-4 py-2 text-sm font-bold text-white uppercase bg-indigo-600 rounded-lg">Editar</a>
                @endif
            @endauth
            @auth
                @if ($user->id !== auth()->user()->id)
                    @if(!$user->Checkfollowing(auth()->user()))
                        <form action="{{route('users.follow', $user)}}" method="POST">
                            @csrf
                            <input type="submit" class="w-full px-5 py-2 font-bold text-white transition-colors bg-indigo-600 rounded-lg hover:bg-indigo-800 hover:cursor-pointer" value="Seguir">
                        </form>
                    @else
                        <form action="{{route('users.unfollow', $user)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="w-full px-5 py-2 font-bold text-white transition-colors bg-red-600 rounded-lg hover:bg-red-800 hover:cursor-pointer" value="Dejar de seguir">
                        </form>
                    @endif
                @endif
            @endauth
        </div>
        <div class="flex items-center justify-center col-span-1 gap-6 py-3">
            <p class="mb-3 text-sm font-bold text-gray-800">{{$user->posts->count()}}<span>publicaciones</span> </p>
            <p class="mb-3 text-sm font-bold text-gray-800">{{$user->followers->count()}}<span>@choice('Seguidor|Seguidores', $user->followers->count())</span></p>
            <p class="mb-3 text-sm font-bold text-gray-800">{{$user->following->count()}}<span>@choice('Seguido|Seguidos', $user->following->count())</span></p>
        </div>
        <div class="col-span-1 py-3">
            <p>{{$user->presentation}}</p>
        </div>
    </div>

    <section class="container mx-auto mt-10">
        <h2 class="my-10 text-4xl font-bold text-center">Publicaciones</h2>
        @if ($posts->count())
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($posts as $post)
                    <div>
                        <a href="{{route('posts.show', ['user'=>$user, 'post'=>$post])}}">
                            <img src="{{asset('uploads'). '/' . $post->imagen}}" alt="Imagen del post {{$post->title}}">
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="my-10">
                {{$posts->links()}}
            </div>
        @else
            <p class="text-sm font-bold text-center text-gray-600 uppercase">No hay posts</p>
        @endif
    </section>
@endsection
