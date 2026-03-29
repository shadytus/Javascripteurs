export default {
    name: 'ArticleList',
    props: ['page'],
    data() {
        return {
            articles: [],
            mes_favoris: [] // On stockera les IDs des favoris ici
        }
    },
    methods: {
        // Charge les articles et les favoris au démarrage
        loadData() {
            fetch('app/controller/list_articles_fetch.php')
                .then(r => r.json())
                .then(data => {
                    this.articles = data.articles;
                    this.mes_favoris = data.favoris;
                });
        },
        // Gestion des favoris sans recharger la page
        toggleFavorite(action, id) {
            fetch(`app/controller/favorite_fetch.php?action=${action}&id=${id}`)
                .then(r => r.json())
                .then(data => {
                    // On met à jour la liste locale des IDs favoris
                    if (action === 'add') this.mes_favoris.push(id);
                    else this.mes_favoris = this.mes_favoris.filter(f => f !== id);
                    
                    // On peut aussi émettre un événement pour le compteur global
                    this.$emit('update-fav-count', data.count);
                });
        },
    
        handleMouseOver(id) {
            // L'appel au serveur ne se fait qu'au moment précis du survol
            fetch(`app/controller/article_fetch.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data !== "inconnu") {
                        this.activeDetails = data; // On affiche les détails
                    }
                })
                .catch(err => console.error("Erreur au survol:", err));
        }
    },

    mounted() { this.loadData(); },
    template: `
    <div v-show="page == 'press'" class="articles-list">
        <h2>Tous les articles</h2>
        
        <article v-for="art in articles" :key="art.id_art" 
                 class="article-card sidebar-item"
                @mouseover="handleMouseOver(art.id_art)">
            
            <img :src="'./media/' + art.image_art" alt="Miniature">
            
            <div class="text">
                <span class="tag">{{ art.name_cat || 'Général' }}</span>
                <h3>
                    <a href="#" @click.prevent="$emit('change-page', {name: 'article', id: art.id_art})">
                        {{ art.title_art }}
                    </a>
                </h3>
                <p class="accroche">{{ art.hook_art }}</p>
                
                <div class="favorite-action">
                    <button v-if="mes_favoris.includes(art.id_art)" @click="toggleFavorite('remove', art.id_art)">
                        ❌ Retirer
                    </button>
                    <button v-else @click="toggleFavorite('add', art.id_art)">
                        ⭐ Ajouter aux favoris
                    </button>
                </div>
            </div>
        </article>
    </div>
    `
}