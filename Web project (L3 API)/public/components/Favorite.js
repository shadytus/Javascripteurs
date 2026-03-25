function toggleFavori(articleId) {
    fetch('index.php?action=fetch_article&id=' + articleId)
    .then(response => response.json())
    .then(data => {
        console.log("Liste mise à jour !", data.favoris);
    })
    .catch(error => console.error('Error fetching article:', error));
}