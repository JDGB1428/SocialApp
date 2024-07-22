@extends('layouts.app')

@section('title')
 {{$post->title}}
@endsection

@section('content')
    <div class="container mx-auto md:flex md:justify-center">
        <div class="md:w-1/2">
            <img src="{{asset('uploads'. '/' . $post->imagen)}}" alt="">
        </div>
        <div class="bg-white md:w-1/2">
            <div class="flex items-center justify-between gap-2 p-2">
                <div class="flex items-center">
                    <img class="w-8 h-8 rounded-full" src="#">
                    <a href="{{route('profile.index', $user)}}" class="font-bold">{{$user->username}}</a>
                </div>
                @auth
                    @if ($post->user_id === auth()->user()->id)
                        <div class="flex items-center">
                            <form action="{{route('posts.destroy', $post)}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <input type="submit" value="Eliminar publicacion" class="p-2 text-sm font-bold text-white uppercase bg-red-500 rounded-md cursor-pointer hover:bg-red-600">
                            </form>
                        </div>
                    @endif
                @endauth
            </div>
            <div class="mb-5 max-h-[20.2rem] p-4 border-t-2 border-gray-300 overflow-y-auto">
                @if ($post->comment->count())
                    @foreach ($post->comment as  $comment)
                    <div class="p-5 border-b border-gray-300">
                        <a href="{{route('profile.index', $comment->user)}}" class="font-bold">
                            {{$comment->user->username}}
                        </a>
                        <p>{{$comment->comment}}</p>
                        <p class="text-sm text-gray-500">{{$comment->created_at->diffForHumans()}}</p>
                    </div>
                    @endforeach
                @else
                    <p>aqui puedes los comentarios de tu post</p>
                @endif
            </div>
            <div class="h-[8.7rem] flex-col p-2 border-t-2 border-gray-300">
                <div class="flex items-center">
                    @auth
                        <livewire:like-post :post="$post" />
                    @endauth
                </div>
                <div>
                    @guest
                        <p>les gusta a {{$post->user->count()}} personas</p>
                        <p class="text-sm text-gray-500">
                            {{$post->created_at->diffForHumans()}}
                        </p>
                    @endguest
                </div>
            </div>
            <div class="border-t-2 border-gray-300">
                @auth
                @if(session('mensaje'))
                    <div class="p-2 mb-6 font-bold text-center text-white uppercase bg-green-500 rounded-lg">{{session('mensaje')}}</div>
                @endif
                    <form action="{{route('comment.store', ['user'=> $user, 'post'=> $post])}}" method="POST">
                        @csrf
                        <div class="mb-5">
                            <textarea name="comment" placeholder="Añadir comentario" class="w-full h-32 p-2 border-gray-600 resize-none">{{old('comment')}}</textarea>
                        </div>
                        <input type="submit" class="w-full p-2 font-bold text-white transition-colors bg-indigo-600 rounded-lg hover:bg-indigo-800 hover:cursor-pointer" value="Agregar comentario">
                    </form>
                @endauth
            </div>
        </div>
    </div>
@endsection
