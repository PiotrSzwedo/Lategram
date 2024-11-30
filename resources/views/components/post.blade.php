<a href="javascript: open('post-{{ $post->id }}')" class="col-4 pb-3">
    <img class="w-100" src="/storage/{{ $post->image }}" alt="{{ $post->title }}">
    <likebutton></likebutton>
</a>

<div class="post" id="post-{{ $post->id }}">
    <a class="post-close" href="javascript: document.getElementById('post-{{ $post->id }}').classList.remove('open');">X</a>
    <div class="w-100 row bg-white rounded">
        <div class="col-7">
            <img class="pt-2 w-100" src="/storage/{{ $post->image }}" alt="">
        </div>

        <div class="position-relative col-5 border-start" style="overflow: hidden;">
            <div>
                <h1 class="mb-0">{{ $post->user->name }}</h1>
            </div>

            <div class="d-flex flex-column h-100">
                <div class="h-25">
                    <p class="overflow-auto">{{ $post->body }}</p>
                </div>

                <div class="comment" style="height: 63% !important;">
                    @foreach ($post->comments as $comment)
                    @include("components.comment", ["comment" => $comment])
                    @endforeach
                </div>

                <div class="comment-filed">
                    <form
                        id="add-comment-{{ $post->id }}"
                        action="javascript: addComment(document.getElementById('add-comment-{{ $post->id }}'), '{{ route("add_comment") }}')"
                        method="post">
                        @csrf
                        <input type="hidden" name="post_id" value="{{$post->id}}">
                        <div>
                            <input type="text" class="form-control-file w-100 p-0" id="body" name="body"></input>

                            @if ($errors->has('body'))
                            <strong>{{ $errors->first('body') }}</strong>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
