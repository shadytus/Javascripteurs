export default {
    name: 'Favorite',
    
    props: {
        page: {
            type: String,
            required: true
        }
    },

    data() {
        return {
            nb_words: 0,
            favorites: []
        }
    },

    methods: {
        toggleFavori(action, id = null) {
            let url = `Web project (L3 API)/app/controller/fetch_favoris.php?action=${action}`;
            if (id) url += '&id=' + id;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    this.favorites = data.favorites;
                    this.nb_words = data.nb_words;
                })
                .catch(error => console.error('Erreur:', error));
        },
        showDetail(id) {
            let url = `Web project (L3 API)/app/controller/detail_fetch.php?id=${id}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    document.getElementById('detail-title').innerHTML = `
                    <p>Nombre de mots : ${data.nb_mots}</p>
                `;
                })
                .catch(error => console.error('Erreur:', error));
        }
    },


    template: `
        <div v-show="page == 'favorite'">
            <h2>Mes Favoris ({{ nb_words }})</h2>
            
            <div class="favoris-summary" v-if="favorites.length > 0">
                <p>Derniers ajouts :</p>
                <ul>
                    <li v-for="title in favorisTitles">{{ title }}</li>
                </ul>
                <button type="button" @click="toggleFavori('clear')">🗑️ Tout effacer</button>
            </div>

            <main class="article-card">
                <h3>Titre de l'article</h3> 
                <p>Accroche de l'article...</p>
                <button type="button" @click="toggleFavori('remove', 123)">🗑️ Retirer</button>
            </main>
        </div>
    `
}

