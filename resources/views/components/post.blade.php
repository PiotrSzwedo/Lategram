<a href="javascript: open('post-{{ $post->id }}')" class="col-4 pb-3">
    <img class="w-100" src="/storage/{{ $post->image }}" alt="{{ $post->title }}">
</a>

<div class="post" id="post-{{ $post->id }}">
    <a class="post-close" href="javascript: document.getElementById('post-{{ $post->id }}').classList.remove('open');">X</a>
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

            <form id="add-comment-{{ $post->id }}" action="javascript: addComment(document.getElementById('add-comment-{{ $post->id }}'), '{{ route("add_comment") }}')" method="post">
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
</div>

<script>
function addComment(form, action) {
    if (!form || !action) {
        console.error("Form or action URL is missing.");
        return;
    }

    const formData = new FormData(form);

    fetch(action, {
        method: 'POST',
        body: formData,
    })
    .then(response => {
        if (response.ok){
            form.reset();
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
</script>
