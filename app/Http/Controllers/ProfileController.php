<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use App\Http\Requests\UserUpdateRequest;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Routing\Controllers\Middleware;

class ProfileController extends Controller
{

    public static function middleware(){
        return [
            'auth',
            new Middleware('profile.profile',except:['show'])
        ];
    }

    public function index(User $user){
        $posts = Post::where('user_id', $user->id)->paginate(5);
        return view('profile.profile',[
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function edit(User $user){
        return view('profile.edit',[
            'user' => $user,
        ]);
    }

    public function update(UserUpdateRequest $request){
        $request->request->add(['username' =>  Str::slug($request->username)]);

        if($request->imagen){
            $manager = new ImageManager(new Driver());

            $imagen = $request->file('imagen');

            //generar un id unico para las imagenes
            $nombreImagen = Str::uuid() . "." . $imagen->extension();

            //guardar la imagen al servidor
            $imagenServidor = $manager->read($imagen);
            //agregamos efecto a la imagen con intervention
            $imagenServidor->scale(1000, 1000);
            // la unidad de mide en PX 1= 1pixiel

            //agregamos la imagen a la  carpeta en public donde se guardaran las imagenes
            $imagenesPath = public_path('perfiles') . '/' . $nombreImagen;
            //Una vez procesada la imagen entonces guardamos la imagen en la carpeta que creamos
            $imagenServidor->save($imagenesPath);
        }


        $usuario = User::find(auth()->user()->id);

        $usuario->username = $request->username;
        $usuario->presentation = $request->presentation;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;

        $usuario->save();

        return to_route('profile.index', $usuario->username);
    }
}
