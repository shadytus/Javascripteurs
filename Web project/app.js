import { createApp} from "vue";

import ArticleList from "./components/ArticleList.js";
import Menu from "./components/Menu.js";
import About from "./components/Footer.js";
import SiteFooter from "./components/Footer.js";

createApp ({
    name: "App",

    components: {
        ArticleList,
        About,
        'press-menu': Menu,
        SiteFooter,
    },

    data() {
        return{
            currentPage: 'home',
            localSearchTerm : '',
            currentTheme : 'theme-light',
            currentFont : ''
        }
    },

    methods: {
        showPage(page) {
            this.currentPage = page;
        },
        handleSearch(newSearchTerm){
            this.localSearchTerm = newSearchTerm
        },
        handleTheme(newTheme){
            this.currentTheme = newTheme
        },
        handleFont(newFont){
            this.currentFont = newFont
        }
    },

}).mount("#app");