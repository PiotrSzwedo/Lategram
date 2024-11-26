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
            if (response.ok) {
                form.reset();
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}
