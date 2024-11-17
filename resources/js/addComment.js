document.getElementById('add-comment').addEventListener('submit', function (event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);

    const userInput = formData.get('body');
    if (userInput.trim().length === 0) {
        displayError("Comment cannot be empty");
        return;
    }

    fetch(form.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData,
    })
});
