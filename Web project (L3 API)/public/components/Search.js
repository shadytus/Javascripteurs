export default {
    name: 'Search',
    props: ['page'],
    data() {
        return {
            q: '',
            author: '',
            results: [],
            message: ''
        }
    },
    methods: {
        async executeSearch() {
            if (this.q.length < 2) {
                this.results = [];
                return;
            }
            
            const response = await fetch(`app/controller/search_fetch.php?q=${this.q}&author=${this.author}`);
            const data = await response.json();

            if (data === "inconnu") {
                this.results = [];
                this.message = `Aucun résultat pour "${this.q}"`;
            } else {
                this.results = data;
                this.message = `${data.length} résultat(s) trouvé(s)`;
            }
        }
    },
    template: `
    <section v-show="page == 'search'" class="search-page-split">
        <h2>🔍 Recherche d'articles</h2>

        <div style="display: flex; gap: 40px;">
            <aside style="flex: 1; border-right: 1px solid #eee; padding-right: 20px;">
                <div class="search-form-vue">
                    <div class="search-row">
                        <label>Mot-clé :</label>
                        <input type="text" v-model="q" @input="executeSearch" placeholder="Titre ou texte...">
                    </div>

                    <div class="search-row" style="margin-top: 15px;">
                        <label>Auteur (optionnel) :</label>
                        <input type="text" v-model="author" @input="executeSearch" placeholder="Nom de l'auteur...">
                    </div>
                </div>
            </aside>

            <section style="flex: 2;">
                <p v-if="message" class="search-info">{{ message }}</p>
                
                <div class="articles-list-vertical">
                    <article v-for="art in results" :key="art.id_art" class="article-card-mini">
                        <h3>{{ art.title_art }}</h3>
                        <p>{{ art.hook_art }}</p>
                        <button @click="$emit('change-page', {name: 'article', id: art.id_art})">
                            Lire la suite →
                        </button>
                    </article>
                </div>
            </section>
        </div>
    </section>
    `
}