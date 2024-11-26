document.getElementById('userFind').addEventListener('input', function() {
    const userInput = this.value;

    if (userInput.length >= 1) {
        fetchResults(userInput);
    } else {
        document.getElementById('searchResults').innerHTML = '';
    }
});

const showProfileRoute = "/profile/__USER_ID__";

function fetchResults(query) {
    fetch('/profile/search', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ data: query })
    })
    .then(response => response.json())
    .then(data => {
        const resultsDiv = document.getElementById('searchResults');
        if (data.length > 0) {
            let html = '<ul class="p-0">';
            data.forEach(user => {
                let profileUrl = showProfileRoute.replace('__USER_ID__', user.id);

                html += `<li class="rounded mt-2 bg-white p-2 list-group-item"><a class="w-100 text-decoration-none text-dark" href="${profileUrl}">${user.name} (${user.email})</a></li>`;
            });
            html += '</ul>';
            resultsDiv.innerHTML = html;
        } else {
            resultsDiv.innerHTML = '<p></p>';
        }
    })
    .catch(error => console.error('Error fetching results:', error));
}
