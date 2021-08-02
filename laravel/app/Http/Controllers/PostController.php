<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        $users = auth()->user() ->following()->pluck('profiles.user_id');
        // $posts = \App\Models\Post::wherein('user_id', $users)->latest()->get();
            $posts= \App\Models\Post::with('reacts')->withCount('reacts')->latest()->paginate(10);
            // dd($posts);
        return view('posts.index', compact('posts'));
    }

    public function create(){
        return view ('posts.create');
    }

    public function store(){
        $data = request()->validate([
            'caption' => 'required',
            'image' => 'required | file |image:*'
        ]);
        $imagePath = request('image')->store('uploads','public');
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);  
        $image->save();

        auth()->user()->posts()->create([
            'caption' =>$data['caption'],
            'image' => $imagePath
        ]);

        return redirect('/profile/'. auth()->user()->id);
    }

    public function show(\App\Models\Post $post){
        // dd($post);
        return view("posts.show", compact ('post'));
    }

}
