@extends('layouts.app')

@section('title')
    Inicio de sesion
@endsection

@section('content')
<div class="md:flex md:justify-center md:gap-10 md:items-center">
    <div class="p-5 md:w-6/12">
        <img src="{{ asset('img/Login.png') }}" alt="imagen inicio sesion">
    </div>
    <div class="p-6 bg-white rounded-lg shadow-xl md:w-4/12">
        <form action="{{route('login.store')}}" method="POST" novalidate>
            @csrf
            @if (session('mensaje'))
                <p class="p-2 my-2 text-sm text-center text-white bg-red-500 rounded-lg">
                    {{session('mensaje')}}
                </p>
            @endif
            <div class="mb-5">
                <label for="email" class="block mb-2 font-bold text-gray-500 uppercase">Correo</label>
                <input name="email" type="text" class="w-full p-2 border border-gray-200 rounded-md @error('email')
                    border-red-500
                @enderror " value="{{old('email')}}">
                @error('email')
                    <p class="p-2 my-2 text-sm text-center text-white bg-red-500 rounded-lg">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="password" class="block mb-2 font-bold text-gray-500 uppercase">Contraseña</label>
                <input name="password" type="password" class="w-full p-2 border border-gray-200 rounded-md @error('password')
                    border-red-500
                @enderror " value="{{old('password')}}">
                @error('password')
                    <p class="p-2 my-2 text-sm text-center text-white bg-red-500 rounded-lg">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-5">
                <input type="checkbox" name="remember"> <label class="text-sm font-bold text-gray-500 uppercase">Mantener mi sesion abierta</label>
            </div>
            <input type="submit"
                    value="Iniciar sesion"
                    class="w-full p-2 font-bold text-white transition-colors bg-indigo-600 rounded-lg hover:bg-indigo-800 hover:cursor-pointer">
        </form>
    </div>
</div>
@endsection
