@extends('layouts.app')

@section('title')
    Registro
@endsection

@section('content')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="p-5 md:w-4/12">
            <img src="{{ asset('img/register.png') }}" alt="imagen formulario registro">
        </div>
        <div class="p-6 bg-white rounded-lg shadow-xl md:w-6/12">
            <form action="{{route('register.store')}}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="name" class="block mb-2 text-gray-500 uppercase">Tu nombre</label>
                    <input name="name" type="text" class="w-full p-2 border border-gray-200 rounded-md @error('name')
                        border-red-500
                    @enderror " value="{{old('name')}}">
                    @error('name')
                        <p class="p-2 my-2 text-sm text-center text-white bg-red-500 rounded-lg">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="username" class="block mb-2 text-gray-500 uppercase">Username</label>
                    <input name="username" type="text" class="w-full p-2 border border-gray-200 rounded-md @error('username')
                        border-red-500
                    @enderror " value="{{old('username')}}">
                    @error('username')
                        <p class="p-2 my-2 text-sm text-center text-white bg-red-500 rounded-lg">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="email" class="block mb-2 text-gray-500 uppercase">Correo</label>
                    <input name="email" type="text" class="w-full p-2 border border-gray-200 rounded-md @error('email')
                        border-red-500
                    @enderror " value="{{old('email')}}">
                    @error('email')
                        <p class="p-2 my-2 text-sm text-center text-white bg-red-500 rounded-lg">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="block mb-2 text-gray-500 uppercase">Contraseña</label>
                    <input name="password" type="password" class="w-full p-2 border border-gray-200 rounded-md @error('password')
                        border-red-500
                    @enderror " value="{{old('password')}}">
                    @error('password')
                        <p class="p-2 my-2 text-sm text-center text-white bg-red-500 rounded-lg">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password_confirmation" class="block mb-2 text-gray-500 uppercase">Repetir contraseña</label>
                    <input name="password_confirmation" type="password" class="w-full p-2 border border-gray-200 rounded-md">
                </div>
                <input type="submit"
                        value="Registrar"
                        class="w-full p-2 font-bold text-white transition-colors bg-indigo-600 rounded-lg hover:bg-indigo-800 hover:cursor-pointer">
            </form>
        </div>
    </div>
@endsection
