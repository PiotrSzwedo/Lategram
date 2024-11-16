<a href="javascript: open('post-{{ $post->id }}')" class="col-4 pb-3">
    <img class="w-100" src="/storage/{{ $post->image }}" alt="{{ $post->title }}">
</a>

<div class="post" id="post-{{ $post->id }}">
    <a  class="post-close" href="javascript: document.getElementById('post-{{ $post->id }}').classList.remove('open');">X</a>
    <div class="row bg-white rounded">
        <div class="col-8">
            <img class="w-100" src="/storage/{{$post->image}}" alt="">
        </div>

        <div class="col-4 border-start">
            <div>
                <h1 class="mb-0">{{ $post->user->name }}</h1>
                <h3>{{ $post->title }}</h3>
            </div>

            <div>
                <p>{{ $post->body }}</p>
            </div>
        </div>
    </div>
</div>
