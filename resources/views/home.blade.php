@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p--5">
            <img class="image rounded-circle" src="storage/" alt="">
        </div>
        <div class="col-9">
            <div>
                <div class="d-flex justify-content-between">
                    <h1>{{ $user->name }}</h1>
                    <div>
                        @if ($isCurrentLoginUserProfile)
                        <a class="btn btn-primary small-primary-btn" href="/post/create">Create Post</a>
                        @else
                        <a class="btn btn-primary small-primary-btn" href="/profile/{{ $user->id }}">Follow</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="pe-3"><strong>{{ count($user->posts) }}</strong>posts</div>
                <div class="pe-3"><strong>23K</strong>followers</div>
                <div class="pe-3"><strong>212</strong>following</div>
            </div>
            <div class="pt-5 font-weight-bold">{{ $user->profile->title ?? "" }}</div>
            <div>{{ $user->profile->description ?? ""}}</div>
            <div><a href="{{ $user->profile->webpage ?? "#" }}">{{ $user->profile->webpage ?? "" }}</a></div>
        </div>
    </div>

    <div class="row pt-5 pb-5">
        {!! $posts !!}
    </div>
</div>
@endsection
