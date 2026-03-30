import ArticleList from './components/ArticleList.js';
import Article from './components/Article.js';
import Login from './components/Login.js';
import Favorite from './components/Favorite.js';

const { createApp } = Vue;

const app = createApp({
    data() {
        // 1. On lit l'URL au démarrage pour ne plus forcer l'accueil
        const urlParams = new URLSearchParams(window.location.search);
        const pageDemandee = urlParams.get('page') || 'press';
        const idDemande = urlParams.get('id') || null;

        return {
            currentPage: pageDemandee, 
            selectedId: idDemande,
            activeDetails: null 
        }
    },
    components: {
        // 2. On fait le pont EXACT entre tes imports et tes balises HTML
        'article-list': ArticleList,
        'article-detail': Article,
        'login-view': Login,
        'favorites-view': Favorite,
    },
    methods: {  
        goToPage(payload, id = null) {
            // 3. On gère les objets envoyés par $emit({name: '...', id: ...})
            const targetPage = payload.name || payload;
            const targetId = payload.id || id;

            this.currentPage = targetPage;
            if (targetId) this.selectedId = targetId;

            window.history.pushState({}, '', `index.php?page=${targetPage}${targetId ? '&id='+targetId : ''}`);
        }
    }
});

app.mount('#app');