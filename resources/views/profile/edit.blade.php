@extends('layouts.app')

@section('title')
    Editar perfil
@endsection

@section('content')
<div class="md:flex md:justify-center">
    <div class="p-6 bg-white shadow md:w-1/2">
        <form action="{{route('profile.update', ['user' => $user, 'id' => auth()->user()->id ])}}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-5">
                <label for="username" class="block text-sm font-bold text-gray-600 uppercase">Username</label>
                <input id="username" name="username" type="text"
                    class="w-full p-2 border border-gray-300 rounded-md
                    @error('description')
                        border-red-500
                    @enderror" value="{{old('username', $user->username)}}">
                @error('username')
                    <p class="p-2 my-2 text-sm text-center text-white bg-red-500 rounded-lg">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="presentation" class="block text-sm font-bold text-gray-600 uppercase">Presentacion</label>
                <textarea id="presentation" name="presentation"
                    class="w-full p-2 border border-gray-300 rounded-md
                    @error('presentation')
                        border-red-500
                    @enderror" rows="8">{{old('presentation', $user->presentation)}}</textarea>
                @error('presentation')
                    <p class="p-2 my-2 text-sm text-center text-white bg-red-500 rounded-lg">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="imagen" class="block text-sm font-bold text-gray-600 uppercase">Imagen del perfil</label>
                <input id="imagen" name="imagen" type="file" accept=".jpg, .jpeg, .png" class="w-full p-2 border border-gray-300 rounded-md
                @error('description')
                    border-red-500
                @enderror">
            </div>
            <input type="submit" value="Guardando cambios" class="w-full p-2 font-bold text-white transition-colors bg-indigo-600 rounded-lg hover:bg-indigo-800 hover:cursor-pointer">
        </form>
    </div>
</div>
@endsection
