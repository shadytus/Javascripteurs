export default {
    name: 'Favorite',
    props: ['page'],
    data() {
        return {
            nb_favorites: 0,
            favoriteArticles: [] // On stockera les articles ici
        }
    },
    methods: {
        // Nouvelle méthode pour charger les données dès qu'on ouvre la page
        loadFavorites() {
            fetch(`index.php?page=favorite_fetch&action=list`, { credentials: 'include' })
                .then(r => { if (!r.ok) throw new Error('Erreur réseau'); return r.json(); })
                .then(data => {
                    this.nb_favorites = data.count;
                    this.favoriteArticles = data.articles;
                })
                .catch(err => console.error("Erreur de chargement:", err));
        },

        toggleFavori(action, id = null) {
            let url = `index.php?page=favorite_fetch&action=${action}`;
            if (id) url += '&id=' + id;

            fetch(url, { credentials: 'include' })
                .then(r => { if (!r.ok) throw new Error('Erreur réseau'); return r.json(); })
                .then(data => {
                    this.nb_favorites = data.count;
                    this.favoriteArticles = data.articles;
                    this.$emit('update-fav-count', data.count);
                })
                .catch(err => console.error("Erreur d'action:", err));
        }
    },
    
    // Au moment où le composant apparaît, on lance la requête
    mounted() {
        this.loadFavorites();
    },

    template: `
        <div v-show="page == 'favoris'" class="favorites-page">
            <h2>Mes Favoris ({{ nb_favorites }})</h2>
            
            <div class="favoris-actions" v-if="nb_favorites > 0">
                <button type="button" @click="toggleFavori('clear')">🗑️ Tout effacer</button>
            </div>

            <div v-if="nb_favorites === 0">
                <p>Vous n'avez aucun article dans vos favoris pour le moment.</p>
            </div>

            <div class="articles-list" v-else>
                <article v-for="art in favoriteArticles" :key="art.id_art" class="article-card">
                    
                    <img :src="'./media/' + art.image_art" alt="Miniature" v-if="art.image_art">
                    
                    <div class="text">
                        <h3>{{ art.title_art }}</h3>
                        <p class="accroche">{{ art.hook_art }}</p>
                        
                        <div class="favorite-action">
                            <button @click="$emit('change-page', {name: 'article', id: art.id_art})">
                                Lire
                            </button>
                            <button @click="toggleFavori('remove', art.id_art)">
                                ❌ Retirer
                            </button>
                        </div>
                    </div>

                </article>
            </div>
        </div>
    `
}