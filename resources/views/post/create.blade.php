@extends('layouts.app')

@section('title')
    Nueva publicacion
@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('content')
    <div class="md:flex md:items-center">
        <div class="px-10 md:w-1/2">
            <form action="{{route('imagen.store')}}" method="POST" enctype="multipart/form-data" id="dropzone"
                class="flex flex-col items-center justify-center w-full border-2 border-dashed rounded dropzone h-96">
                @csrf
        </form>
        </div>
        <div class="p-10 mt-10 bg-white rounded-lg shadow-xl md:mt-0 md:w-1/2">
            @auth

            @endauth
            <form action="{{route('posts.store')}}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="title" class="block mb-2 text-gray-500 uppercase">Titulo</label>
                    <input name="title" type="text" class="w-full p-2 border border-gray-200 rounded-md @error('name')
                        border-red-500
                    @enderror " value="{{old('title')}}">
                    @error('title')
                        <p class="p-2 my-2 text-sm text-center text-white bg-red-500 rounded-lg">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="description" class="block mb-2 text-gray-500 uppercase">Descripcion</label>
                    <textarea name="description" type="text" class="w-full p-2 border border-gray-200 rounded-md @error('description')
                        border-red-500
                    @enderror " >{{old('description')}}</textarea>
                    @error('description')
                        <p class="p-2 my-2 text-sm text-center text-white bg-red-500 rounded-lg">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <input name="imagen" type="hidden" value="{{old('imagen')}}"/>
                    @error('imagen')
                        <p class="p-2 my-2 text-sm text-center text-white bg-red-500 rounded-lg">{{$message}}</p>
                    @enderror
                </div>
                <input type="submit"
                    value="Crear publicacion"
                    class="w-full p-2 font-bold text-white transition-colors bg-indigo-600 rounded-lg hover:bg-indigo-800 hover:cursor-pointer">
            </form>
        </div>
    </div>
@endsection
