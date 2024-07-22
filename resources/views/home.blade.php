@extends('layouts.app')

@section('title')
    Hola
@endsection

@section('content')
    @if ($posts->count())
        @foreach ($posts as $post )
        <div class="flex flex-col items-center justify-center">
            <a class="w-4/12" href="{{route('posts.show', ['post'=> $post , 'user'=>$post->user])}}">
                <img src="{{asset('/uploads') . "/" . $post->imagen}}" alt="Imagen del post">
            </a>
        </div>
        @endforeach
    @else
        <p>Aqui puedes ver los post de tus seguidores</p>
    @endif

@endsection
