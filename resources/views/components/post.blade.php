<a href="javascript: open('post-{{ $post->id }}')" class="col-4 pb-3">
    <img class="w-100" src="/storage/{{ $post->image }}" alt="{{ $post->title }}">
</a>

<div class="post" id="post-{{ $post->id }}">
    <a  class="post-close" href="javascript: document.getElementById('post-{{ $post->id }}').classList.remove('open');">X</a>
    <div class="row bg-white rounded">
        <div class="col-7">
            <img class="w-100" src="/storage/{{ $post->image }}" alt="">
        </div>

        <div class="col-3 border-start">
            <div>
                <h1 class="mb-0">{{ $post->user->name }}</h1>
            </div>

            <div>
                <p>{{ $post->body }}</p>
            </div>

            <div>
                @foreach ($post->comments as $comment)
                    @include("components.comment", ["comment" => $comment])
                @endforeach
            </div>
        </div>
    </div>
</div>
