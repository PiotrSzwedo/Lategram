@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <img class="w-100" src="/storage/{{$post->image}}" alt="">
        </div>

        <div class="col-4">
            <div>
                <h1 class="mb-0" >{{ $post->user->name }}</h1>
                <h2>{{ $post->title }}</h2>
            </div>

            <div>
                <p>{{ $post->body }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
