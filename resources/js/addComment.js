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
        console.log('Raw response:', response);

        const contentType = response.headers.get('content-type');
        if (contentType && contentType.includes('application/json')) {
            return response.json();
        } else {
            return response.text().then(text => {
                throw new Error(`Expected JSON but got: ${text}`);
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
