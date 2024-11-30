@extends('layouts.app')

@section('content')
<div class="container">
        @foreach ($follows as $follow)
            <div class="col-1">
                @include("components.profileIcon", ["profile" => $follow->profile])
            </div>
        @endforeach
</div>
@endsection
