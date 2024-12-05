@foreach ($posts as $post)
    @include("components.post", ["post" => $post])
@endforeach