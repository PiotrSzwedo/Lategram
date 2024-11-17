<a href="javascript: open('post-{{ $post->id }}')" class="col-4 pb-3">
    <img class="w-100" src="/storage/{{ $post->image }}" alt="{{ $post->title }}">
</a>

<div class="post" id="post-{{ $post->id }}">
    <a  class="post-close" href="javascript: document.getElementById('post-{{ $post->id }}').classList.remove('open');">X</a>
    <div class="w-100 row bg-white rounded">
        <div class="col-7">
            <img class="pt-2 w-100" src="/storage/{{ $post->image }}" alt="">
        </div>

        <div class="position-relative col-5 border-start">
            <div>
                <h1 class="mb-0">{{ $post->user->name }}</h1>
            </div>

            <div>
                <p>{{ $post->body }}</p>
            </div>

            <div class="comment">
                @foreach ($post->comments as $comment)
                    @include("components.comment", ["comment" => $comment])
                @endforeach
            </div>

            <form action="{{ route("add_comment") }}"  method="post" id="add-comment">
                @csrf
                <input type="hidden" name="post_id" value="{{$post->id}}">
                <div class="row">
                    <input type="text" class="form-control-file" id="body" name="body"></input>

                    @if ($errors->has('body'))
                        <strong>{{ $errors->first('body') }}</strong>
                    @endif
                </div>
            </form>
        </div>
    </div>
    <script @vite('resources/js/addComment.js')></script>
</div>
