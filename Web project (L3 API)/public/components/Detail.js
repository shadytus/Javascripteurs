export default {
    name: 'detail',

    props: {
        page: {
            type: String,
            required: true
        }
    },
    methods: {
        showDetail(id) {
            let url = `/app/controller/detail_fetch.php?id=${id}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    this.articleDetails = data;
                }) 
                .catch(error => {
                    console.error('Erreur lors de la récupération des détails :', error);
                });
            }
    },
            

    template: `
        <main class="article-card" v-if="articleDetails">
            <h3>{{ articleDetails.title_art }}</h3>
            <p>{{ articleDetails.hook_art }}</p>
            
            <div class="infos-sup" style="background: #f9f9f9; padding: 10px; border-radius: 5px;">
                <p><strong>Détails supplémentaires :</strong></p>
                <ul>
                    <li>Nombre de mots : {{ articleDetails.nb_mots }}</li>
                    <li>Catégorie : {{ articleDetails.categorie }}</li>
                    <li>Temps de lecture : {{ articleDetails.duree }} min</li>
                    <li v-if="articleDetails.auteur">Auteur : {{ articleDetails.auteur }}</li>
                </ul>
            </div>
        </main>
    `
}

