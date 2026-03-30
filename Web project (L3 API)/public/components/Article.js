export default {
    name: 'Article',
    props: ['page', 'articleId'], // On reçoit l'ID via les props
    data() {
        return {
            article: null
        }
    },
    watch: {
        // Dès que l'ID change (clic sur un autre article), on recharge
        articleId(newId) { if(newId) this.fetchArticle(newId); }
    },
    mounted() {
        if (this.articleId) this.fetchArticle(this.articleId); // Si on a déjà un ID au départ
    },
    methods: {
        fetchArticle(id) {
            fetch(`../app/controller/article_fetch.php?id=${id}`)
                .then(r => r.json())
                .then(data => {;
                if (data !== "inconnu") {
                        this.article = data;
                    }
                })
                .catch(err => console.error("Erreur chargement article:", err));
        }
    },
    template: `
    <div v-if="page == 'article' && article">
        <article class="article-detail" style="max-width: 800px; margin: 0 auto; padding: 20px;">
            <span class="tag" style="background: yellow; color: black; padding: 5px;">
                {{ article.name_cat }}
            </span>
            
            <h1>{{ article.title_art }}</h1>
            <p><em>Publié le {{ article.date_art }}</em></p>
            
            <img :src="'./media/' + article.image_art" alt="Illustration" style="width: 100%; border-radius: 8px; margin: 20px 0;">
            <p><em>Reporteur : {{ article.name_rep || 'Anonyme' }}</em></p>

            <div class="contenu-texte" style="font-size: 1.1rem; line-height: 1.6;" v-html="article.content_art">
            </div>
            
            <button @click="$emit('change-page', {name: 'press'})" style="margin-top: 20px; background:none; border:none; color:blue; cursor:pointer;">
                ⬅ Retour aux articles
            </button>
        </article>
    </div>

    <div v-else-if="page == 'article' && !article" style="text-align:center; padding:50px;">
        <p>Chargement de l'article en cours...</p>
    </div>
    `    
}