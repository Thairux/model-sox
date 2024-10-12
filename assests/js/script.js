// C:\xampp\htdocs\project-ai-gen\model-sox\assests\js\script.js
const postFeed = document.querySelector('.post-feed');
const suggestedModels = document.querySelector('.suggested-models');

// Load more posts when user reaches end of page
postFeed.addEventListener('scroll', () => {
    if (postFeed.scrollTop + postFeed.offsetHeight >= postFeed.scrollHeight) {
        loadMorePosts();
    }
});

function loadMorePosts() {
    // Make AJAX request to load more posts
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'load-more-posts.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            const response = xhr.responseText;
            const newPosts = document.createElement('div');
            newPosts.innerHTML = response;
            postFeed.appendChild(newPosts);
        }
 };
    xhr.send();
}