document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.fa-heart').forEach(heart => {
        heart.addEventListener('click', () => {
            const idfoto = heart.getAttribute('data-idfoto');
            const liked = heart.getAttribute('data-liked') === 'true';

            if (!liked) {
                fetch('like_action.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ idfoto })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        heart.nextElementSibling.textContent = data.num_likes;
                        heart.setAttribute('data-liked', 'true');
                    }
                });
            }
        });
    });
});
