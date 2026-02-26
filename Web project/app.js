import { createApp} from "vue";

import ArticleList from "./components/ArticleList.js";
import Menu from "./components/Menu.js";
import About from "./components/Footer.js";
import SiteFooter from "./components/Footer.js";
import Conception from "./components/Conception.js";

createApp ({
    name: "App",

    components: {
        ArticleList,
        About,
        'press-menu': Menu,
        SiteFooter,
        Conception
    },

    data() {
        return{
            currentPage: 'home',
            searchTerm : '',
            currentTheme : 'theme-light',
            currentFont : '',

            historyLog: [],
            mouseX: 0,
            mouseY: 0
        }
    },

    methods: {
        showPage(page) {
            this.currentPage = page;
        },
        handleSearch(newSearchTerm){
            this.searchTerm = newSearchTerm
        },
        handleTheme(newTheme){
            this.currentTheme = newTheme;

            document.body.classList.remove('theme-light', 'theme-dark', 'theme-rose');
            document.body.classList.add(newTheme);
            this.addHistoryLog({type :'Thème', value : newTheme})
        },
        handleFont(newFont){
            this.currentFont = newFont;

            document.body.classList.remove('font-arial', 'font-times', 'font-consolas');
            
            if (newFont) {
                document.body.classList.add(newFont)
            } 
            this.addHistoryLog({type :'Police', value : newFont})
        },
        addHistoryLog(logEntry){
            this.historyLog.unshift(logEntry);
            this.historyLog = this.historyLog.slice(0,5)
        },
        updateMouseCoordinates(event){
            this.mouseX = event.clientX;
            this.mouseY = event.clientY;
        }
    },

    mounted(){
        document.body.classList.add(this.currentTheme);
        if (this.currentFont){
            document.body.classList.add(this.currentFont);
        }

        window.addEventListener('mousemove',this.updateMouseCoordinates);
    },
    unmounted(){
        window.removeEventListener('mousemove', this.updateMouseCoordinates);
    }
    

}).mount("#app");