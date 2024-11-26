@extends('layouts.app')

@section('content')

<div class="container">

    <form action="/profile/search" method="post" id="searchForm">
        @csrf
        <div class="row">
            <div class="col-8 offset-2">
                <input id="userFind"
                    type="text"
                    class="form-control{{ $errors->has('caption') ? ' is-invalid' : '' }}"
                    name="data"
                    value="{{ old('caption') }}"
                    autocomplete="caption" autofocus placeholder="search user">
            </div>
        </div>
    </form>

    <div id="searchResults">

    </div>

    <script>
    </script>
</div>

@vite(['resources/js/src/searchUser.js'])
@endsection
