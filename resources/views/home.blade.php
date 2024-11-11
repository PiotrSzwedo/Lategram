@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p--5">
            <img class="image rounded-circle" src="https://play-lh.googleusercontent.com/MoaYYQjGtmGLhG9HbjCDKyj44kwHj1HfbCI2Am70elRm35vJ-u4y4X5uEJjP97MAAsU" alt="">
        </div>
        <div class="col-9">
            <div>
                <h1>{{ $user->name }}</h1>
            </div>
            <div class="d-flex">
                <div class="pe-3"><strong>153</strong>posts</div>
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
