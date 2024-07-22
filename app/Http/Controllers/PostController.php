<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public static function middleware(){
        return [
            'auth',
            new Middleware('post.show', except:['show'])
        ];
    }
    public function create(){
        return view('post.create');
    }

    public function store(PostRequest $request){
        // Post::create([
        //     'title' => $request->title,
        //     'description' => $request->description,
        //     'imagen' => $request->imagen
        // ]);

        $request->user()->posts()->create([
            'title' => $request->title,
            'description' => $request->description,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        return to_route('profile.index', auth()->user()->username);
    }

    public function show(User $user, Post $post){

        return view('post.show',[
            'post' => $post,
            'user' => $user
        ]);
    }

    public function destroy(Post $post){
        Gate::allows('delete', $post);
        $post->delete();
        //Eliminando la imagen
        $imagenPath = public_path('uploads/'. $post->imagen);
        if(File::exists($imagenPath)){
            unlink($imagenPath);
        }
        return to_route('profile.index', auth()->user()->username);
    }
}
