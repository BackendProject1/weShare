@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="{{ $user->profile->profileImage()}}" class="w-100  rounded-circle">
        </div>
        <div class="col-9 p-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-center pb-4">
        <h1>{{$user->username}}</h1>
        <follow-button user-id = "{{ $user->id }}" follows="{{ $follows }}"></follow-button>
        </div> 
              @can('update', $user -> profile)
            <a href="/p/create" class="btn btn-primary p-3">Add new post</a>
            @endcan 
        </div>
            @can('update', $user -> profile)
            <a href="/profile/{{$user->id}}/edit">Edit Profile</a>
            @endcan
            <div class="d-flex">
            <div class="pr-5"> <strong>{{$user->posts->count()}} </strong>posts</div>
            <div class="pr-5"><strong>{{$user->profile->followers->count()}} </strong>followers</div>
            <div class="pr-5"><strong>{{$user->following->count()}} </strong>following</div>
        </div>
        <div class="pt-4 font-weight-bold">{{$user->profile ->title}}</div>
        <div> {{$user->profile->description}} </div>
        <div><a href="#">{{$user->profile -> url}}</a></div>
        </div>
    </div>

         @foreach($user ->posts as $post)
    <div class="row" style="border-bottom: 1px solid gray;border-top: 1px solid gray;">
        <div class="align-items-center pt-5 pb-5">
            <img src="{{ $user->profile->profileImage()}}" class="rounded-circle" style="width:40px">
            <a href="/profile/{{$post->user->id}}">
            <span class="text-dark">{{$post->user->username }}</span> </a></p>
                <p> {{$post->caption}}</p>
            <a href="/p/{{$post->id}}">
             <img src="/storage/{{$post->image}}"  class=" w-25 h-75">          
            </a>
            <react-button :post="{{$post}}" :user_id="{{auth()->user()->id}}"></react-button>
    </div> 
        </div>
        @endforeach
        
   
</div>
@endsection