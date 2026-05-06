export default {
    name: 'ArticleList',
    props: ['page'],
    data() {
        return {
            articles: [],
            mes_favoris: [],
            activeDetails: null,
            searchQuery: '',
            searchAuthor: '',
            searchMessage: ''
        }
    },
    methods: {
        loadData() {
            fetch(`index.php?page=list_articles_fetch`, { credentials: 'include' })
                .then(r => { if (!r.ok) throw new Error('Erreur réseau'); return r.json(); })
                .then(data => {
                    this.articles = data.articles;
                    this.mes_favoris = data.favoris;
                })
                .catch(err => console.error('Erreur chargement articles:', err));
        },
        
            // Dans ArticleList.js, remplace executeSearch par ça :
        executeSearch() {
            const q = this.searchQuery.toLowerCase();
            const auth = this.searchAuthor.toLowerCase();

            // Si tout est vide, on recharge la liste complète depuis le serveur
            if (q === "" && auth === "") {
                this.loadData();
                this.searchMessage = "";
                return;
            }

            // Sinon on filtre
            this.articles = this.articles.filter(a => 
                (a.title_art.toLowerCase().includes(q) || a.hook_art.toLowerCase().includes(q)) &&
                (a.name_rep || '').toLowerCase().includes(auth)
            );
            
            this.searchMessage = this.articles.length + " article(s) trouvé(s).";
        },

        toggleFavorite(action, id) {
            fetch(`index.php?page=favorite_fetch&action=${action}&id=${id}`, { credentials: 'include' })
                .then(r => { if (!r.ok) throw new Error('Erreur réseau'); return r.json(); })
                .then(data => {
                    if (action === 'add') this.mes_favoris.push(id);
                    else this.mes_favoris = this.mes_favoris.filter(f => f !== id);
                    this.$emit('update-fav-count', data.count);
                })
                .catch(err => console.error('Erreur favoris:', err));
        },

        handleMouseOver(id) {
            fetch(`index.php?page=article_fetch&id=${id}`, { credentials: 'include' })
                .then(r => { if (!r.ok) throw new Error('Erreur réseau'); return r.json(); })
                .then(data => { if (data !== "inconnu") this.activeDetails = data; })
                .catch(err => console.error('Erreur détails:', err));
        },
        handleMouseOut() { this.activeDetails = null; }
    },
    mounted() { this.loadData(); },
    template: `
    <div v-show="page == 'press'" class="search-page-split">

        <div v-if="activeDetails" class="detail-tooltip" style="position: fixed; top: 20px; right: 20px; background: white; padding: 15px; border: 1px solid #cc0000; z-index: 1000; box-shadow: 0 4px 10px rgba(0,0,0,0.2); border-radius: 8px;">
            <h4 style="margin:0 0 10px 0;">📊 Statistiques</h4>
            <p style="margin:5px 0;"><strong>Mots :</strong> {{ activeDetails.wordCount }}</p>
            <p style="margin:5px 0;"><strong>Temps de lecture :</strong> {{ activeDetails.readtime }} min</p>
        </div>

        <aside class="search-sidebar">
            <h2 style="color: #cc0000; margin-bottom: 20px;">Rechercher</h2>
            <div class="search-form-vue">
                <div class="search-row">
                    <label>Par mot-clé :</label>
                    <input type="text" 
                           v-model="searchQuery" 
                           @input="executeSearch" 
                           placeholder="Ex: Sport, NASA...">
                </div>

                <div class="search-row">
                    <label>Par auteur :</label>
                    <input type="text" 
                           v-model="searchAuthor" 
                           @input="executeSearch" 
                           placeholder="Nom de l'auteur...">
                </div>
                
                <p v-if="searchMessage" style="font-size: 0.85rem; color: #666; font-style: italic;">
                    {{ searchMessage }}
                </p>
            </div>
        </aside>

        <section class="search-results">
            <div class="articles-list">
                <article v-for="art in articles" :key="art.id_art" 
                         class="article-card"
                         @mouseover="handleMouseOver(art.id_art)"
                         @mouseout="handleMouseOut()">
                    
                    <img :src="'./media/' + art.image_art" alt="Image">
                    
                    <div class="text">
                        <span class="tag">{{ art.name_cat || 'Article' }}</span>
                        <h3>
                            <a href="#" @click.prevent="$emit('change-page', {name: 'article', id: art.id_art})">
                                {{ art.title_art }}
                            </a>
                        </h3>
                        <p class="accroche">{{ art.hook_art }}</p>
                        
                        <div class="favorite-action">
                            <button v-if="mes_favoris.includes(art.id_art)" @click="toggleFavorite('remove', art.id_art)" style="background:#ff4d4d; color:white; border:none; padding:5px 10px; border-radius:4px; cursor:pointer;">
                                ❌ Retirer
                            </button>
                            <button v-else @click="toggleFavorite('add', art.id_art)" style="background:#f5c000; color:black; border:none; padding:5px 10px; border-radius:4px; cursor:pointer;">
                                ⭐ Favoris
                            </button>
                        </div>
                    </div>
                </article>
            </div>
        </section>

    </div>
    `
}