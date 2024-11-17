<div class="b-eeeeee rounded p-1">
    <a class="text-dark" href="{{ route("show-profile", ["name" => $comment->user->id]) }}"><sub>{{ $comment->user->name }}</sub></a>
    <p class="m-0">{{ $comment->body }}</p>
</div>
