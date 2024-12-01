function open(postId, event) {
    if (event) event.preventDefault(); // Zapobiega domyślnemu działaniu zdarzenia (np. dla linków)

    const post = document.getElementById(postId); // Szukamy elementu po ID

    if (post) { 
        const parentElement = post.parentNode; 
        
        if (parentElement) { // Sprawdzamy, czy element nadrzędny istnieje
            parentElement.remove(); // Usuwamy element nadrzędny z DOM
        } else {
            console.warn('Element nadrzędny nie istnieje.');
        }
    } else {
        console.warn(`Nie znaleziono elementu o ID: ${postId}`);
    }

    this.parentNode.remove
}