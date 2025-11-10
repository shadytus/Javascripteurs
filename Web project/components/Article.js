export default {
    name: 'ArticleList',

    template: `
        <div>
            <!-- Vue de la Liste d'Articles (Page d'accueil) -->
            <main v-show="this.page == 'home'">
                <main class="container">
                    <!-- Article en Une (Breaking News) -->
                    <article class ="breaking-news" v-if="breakingNewsArticle">
                        <a href="#" @click.prevent="showArticleDetails(breakingNewsArticle)">
                            <!-- Correction de l'URL de l'image pour le breaking news -->
                            <img :src="'./media/' + breakingNewsArticle.image + '.jpg'" alt="Breaking News Image">
                            <nav class="text">
                                <h2><strong>{{ breakingNewsArticle.title }}</strong></h2>
                                <h3 v-html="breakingNewsArticle.resume"></h3>
                            </nav>
                        </a>
                    </article>
                    
                    <!-- Colonne Latérale (Portraits) -->
                    <aside class="sidebar" aria-label="Portraits">
                        <a href="#" 
                            v-for="article in portraitArticles" 
                            :key="article.id" 
                            @click.prevent="showArticleDetails(article)">
                            
                            <article class="sidebar-item">
                                <img :src="'./media/' + article.image + '.jpg'" alt="Sidebar Image">
                                <div class="text">
                                    <span class="tag">{{ article.category }}</span>
                                    <h4 v-html="article.resume"></h4>
                                </div>
                            </article>
                        </a>
                    </aside>
                    
                    <!-- Grille du Bas (Culture) -->
                    <section class="bottom-grid" aria-label="Culture">
                        <article class="card" v-for="article in culturelArticles" :key="article.id">
                            <a href="#" @click.prevent="showArticleDetails(article)">
                                <img :src="'./media/' + article.image + '.jpg'" alt="">
                                <span class="tag gray">{{ article.category }}</span>
                                <h4 v-html="article.resume"></h4>
                            </a>
                        </article>
                    </section>
                    
                    <!-- Section Mini (Bibliographie) -->
                    <section class="bottom-mini" aria-label="Bibliographie">
                        <article class="card small" v-for="article in biblioArticles" :key="article.id">
                            <a href="#" @click.prevent="showArticleDetails(article)">
                                <img :src="'./media/' + article.image + '.jpg'" alt="">
                                <h4 v-html="article.resume"></h4>
                            </a>
                        </article>
                    </section>
                </main>
            </main>

            <!-- Vue de l'Article Détaillé -->
            <main v-show="this.page == 'article' && currentArticle" class="article-detail container">
                <article v-if="currentArticle">
                    <!-- Bouton pour revenir à l'accueil -->
                    <button @click="$emit('change-page', 'home')" class="back-button">
                        &larr; Retour à la liste
                    </button>

                    <header class="article-header">
                        <h1 class="text-3xl font-bold">{{ currentArticle.title }}</h1>
                        <p class="text-sm text-gray-600">
                            Par {{ currentArticle.author }} dans la catégorie {{ currentArticle.category }}
                        </p>
                        <img :src="'./media/' + currentArticle.image + '.jpg'" 
                            :alt="currentArticle.title" 
                            class="article-main-image">
                    </header>
                    
                    <div class="article-body" v-html="currentArticle.body">
                        <!-- Le contenu complet de l'article est affiché ici -->
                    </div>

                    <div class="mt-8 pt-4 border-t">
                        <button @click="$emit('change-page', 'home')" class="back-button">
                            &larr; Retour à la liste
                        </button>
                    </div>
                </article>
            </main>
        </div>
        `,
    props : {
        page    :{
            type        :String,
            required    :true,
        },
        searchQuery :{
            type        :String,
            default     :'',
        },
        // Nouvelle prop pour recevoir l'article à afficher
        currentArticle: { 
            type: Object, 
            default: null 
        }
    },
    
    data() {
        return {
            selectedArticle : null, 
            articles: [
                { 
                    id : 1,
                    title : "Ces coins de Belgique dont le cinéma raffole",
                    resume : `
                        <section class="Art">
                        <p><strong>De nombreux tournages se déroulent en Belgique. Petit tour des lieux les plus prisés par le septième art.</strong></p>
                        </section>
                        `,
                    body : `
                        <section class="Art">
                        <p><strong>De nombreux tournages se déroulent en Belgique. Petit tour des lieux les plus prisés par le septième art.</strong></p>
                        </section>
                        <section class="Art">
                        <h3>Les Ardennes</h3>
                        <p>Les forêts immenses et les collines pentues des Ardennes belges inspirent de nombreux cinéastes. C’est bien simple, on ne compte plus les films qui s’y déroulent, ou l’utilisent comme décor. Parmi tous les longs et courts-métrages existants, on peut notamment citer "Les Géants". Le drame de Bouli Lanners place trois adolescents désœuvrés dans son cadre ardennais. Livrés à eux-mêmes, les 3 garçons se retrouvent emportés, et nous avec, dans une grande aventure.
                        </p>
                        <p>Le cinéaste belge Robin Pront semble lui aussi avoir été inspiré par la région, puisqu’il a décidé de baptiser son premier long-métrage "D’Ardennen". Sorti en 2016, ce thriller poisseux fait des Ardennes le cadre fatidique de son drame criminel.
                        </p>
                        </section>
                        <section class="Art">
                        <h3>La Gare de Liège</h3>
                        <p>Le saviez-vous ? La Gare de Liège-Guillemins apparaît dans le premier volet des "Gardiens de la Galaxie" ! Le dôme de Calatrava a tapé dans l’œil du studio Marvel, qui a intégré l’architecture futuriste de la gare au décor de planète Xandar, où les antihéros du film se rencontrent. Mais attention : ni Chris Pratt ni Zoe Saldana ne se sont rendus sur place. Ce sont les équipes des effets spéciaux qui ont scanné l’ensemble de la structure. On aperçoit aussi brièvement la gare dans le film de science-fiction "Gemini Man" où Will Smith joue un double rôle. Là non plus, le tournage ne s’est pas fait en Belgique.
                        </p>
                        <p>En revanche, Jean Dujardin s’est bien rendu à Liège pour tourner une scène de la comédie "Un homme à la hauteur", tout comme Daniel Brühl, dans une séquence du thriller "Le Cinquième Pouvoir" sur Julian Assange. Dans ce dernier film, la gare "joue son propre rôle" : les personnages sont bien dans la station de trains de la cité ardente plutôt que sur une autre planète.
                        </p>
                        </section>
                        <section class="Art">
                        <h3>Bruges</h3>
                        <p>Impossible de parler des lieux de cinéma en Belgique sans parler de Bruges. Et impossible de parler de Bruges, sans parler de "Bons Baisers de Bruges", la comédie criminelle mélancolique portée par Colin Farrell, Brendan Gleeson et Ralph Fiennes. C’est dans cette célèbre ville belge que leurs personnages de tueurs vont se réfugier après une mission ratée. La visite de la Venise du Nord par ces touristes accidentels joue merveilleusement avec le cadre mystérieux et pittoresque de la ville.
                        </p>
                        <p>On peut également citer "Au Risque de se Perdre", mélodrame de 1958 avec Audrey Hepburn, dans lequel celle-ci joue une nonne dans un couvent brugeois, mais aussi la comédie de science-fiction bollywoodienne "PK", qui a été un énorme succès en Inde, ou encore la série britannique "The White Queen".
                        </p>
                        </section>`,  
                    image : "39e98420b5e98bfbdc8a619bef7b8f61-1740665779",
                    author : "Adrien Corbeel",
                    category : "Culture",
                    type : "breaking"
                },
                { id: 2, title: "Portrait d'une artiste", image: "img_portrait_1", resume: "Bref portrait d'une étoile montante...", author: "Auteur B", category: "Art", type: "portrait", body: "Contenu long du portrait..." },
                { id: 3, title: "Le dernier livre de l'année", image: "img_biblio_1", resume: "Un roman incontournable...", author: "Auteur C", category: "Livres", type: "biblio", body: "Critique détaillée du livre..." },
            ]
        }
    },

    computed : {
        filteredArticles() {
            if (!this.searchQuery) {
                return this.articles;
            }
            const query = this.searchQuery.toLowerCase();
            return this.articles.filter(
                article => article.title.toLowerCase().includes(query) || 
                           article.category.toLowerCase().includes(query) ||
                           (article.author && article.author.toLowerCase().includes(query))
            );
        },
        breakingNewsArticle() {
            return this.filteredArticles.find(article => article.type === 'breaking');
        },
        portraitArticles() {
            return this.filteredArticles.filter(article => article.type === 'portrait');
        },
        culturelArticles() {
            return this.filteredArticles.filter(article => article.type === 'culturel');
        },
        biblioArticles() {
            return this.filteredArticles.filter(article => article.type === 'biblio');
        }
    },

    methods: {
        /**
         * Méthode pour sélectionner un article et demander au composant parent d'afficher les détails.
         * @param {Object} article - L'objet article complet à afficher.
         */
        showArticleDetails(article) {
            this.selectedArticle = article;
            this.$emit('show-details', article);
            
            console.log("Détails de l'article demandés : " + article.title);
        }
    }
}
