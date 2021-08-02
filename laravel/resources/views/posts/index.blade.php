@extends('layouts.app')




@section('content')
<div class="container">
    @foreach($posts as $post)
    <div class="row">
        <div class="col-6 offset-3 " style="border-bottom:1px solid gray;">
            <div class="d-flex pb-2 pt-2">
                <img src="{{ $post->user->profile->profileImage()}}" class="rounded-circle "
                    style="width:30px;height:40px">
                <p class="pt-2 pb-2">
                    <a href="/profile/{{$post->user->id}}"> &nbsp;<span
                            class="text-dark">{{$post->user->name }}</span></a>
                    <span class="text-muted">@ {{$post->user->username }}</span>
                     <a href="" class="text-danger">Edit</a>
                </p>
               
                <button class="btn btn-transparent ml-5"><i class="fas fa-trash-alt text-info"></i></button>
            </div>
            <p> {{$post->caption}}</p>

            <a href="/profile/{{$post->user->id}}">
                <img src="/storage/{{$post->image}}" class="w-75 h-50">
            </a>
            <div class="d-flex pt-3">
                <react-button :post="{{$post}}" :user_id="{{auth()->user()->id}}"></react-button>
            </div>
        </div>

    </div>
    @endforeach
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{$posts->links()}}
        </div>
    </div>
</div>
@endsection