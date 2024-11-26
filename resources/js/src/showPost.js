function open(postId, event) {
    if (event) event.preventDefault();
    const post = document.getElementById(postId);

    if (post.classList.contains("open")) {
        post.classList.remove("open");
    } else {
        post.classList.add("open");
    }
}
