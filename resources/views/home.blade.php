@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p--5">
            <img class="image rounded-circle" src="{{ asset('storage' . $user->profile->getProfilePhoto()) }}" alt="">
        </div>
        <div class="col-9">
            <div>
                <div class="d-flex justify-content-between">
                    <h1>{{ $user->name }}</h1>
                    <div>
                        @if ($isCurrentLoginUserProfile)
                        <a class="btn btn-primary small-primary-btn" href="{{ route('create-post') }}">Create Post</a>
                        @else
                        <followbutton></followbutton>
                        @endif
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="pe-3"><strong>{{ count($user->posts) }}</strong>posts</div>
                <div class="pe-3"><strong>---</strong>followers</div>
                <div class="pe-3"><strong>---</strong>following</div>
            </div>
            <div class="pt-5 font-weight-bold">{{ $user->profile->title ?? "" }}</div>
            <div>{{ $user->profile->description ?? ""}}</div>
            <div><a href="{{ $user->profile->webpage ?? "#" }}">{{ $user->profile->webpage ?? "" }}</a></div>
        </div>
    </div>

    <div class="row pt-5">
        @foreach ($user->posts as $post)
            @include('components.post', ['post' => $post])
        @endforeach
    </div>
</div>

@vite(['resources/js/src/showPost.js'])
@vite(['resources/js/src/addComment.js'])
@endsection
