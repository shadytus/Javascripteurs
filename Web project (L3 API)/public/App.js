import ArticleList from './components/ArticleList.js';
import Article from './components/Article.js';
import Login from './components/Login.js';
import Search from './components/Search.js';
import Favorites from './components/Favorites.js';
import Footer from './components/Footer.js';

const { createApp } = Vue;

const app = createApp({
    data() {
        return {
            page: 'press', 
            selectedId: null
        }
    },
    components: {
        ArticleList,
        Article,
        Login,
        Search,
        Favorites,
        Footer
    }
});

app.mount('#app');