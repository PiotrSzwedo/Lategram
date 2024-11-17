<div>
    <a class="text-dark" href="{{ route("show-profile", ["name" => $comment->user->id]) }}"><sub>{{ $comment->user->name }}</sub></a>
    <p>{{ $comment->body }}</p>
</div>
