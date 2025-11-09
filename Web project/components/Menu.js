export default {
    name: 'Menu',

    template: `
        <header class="jn-header">
        <section class="header-logo">
            <a>
                <img src="media/noticias.jpg">
            </a>
        </section>
        <section class="header-top">
            <section class="header-left">
            
                <nav>
                    <a href="#">JN</a>
                    <a href="#">TSF</a>
                    <a href="#">O Jogo</a>
                    <a href="#">Evasões</a>
                    <a href="#">Volta ao Mundo</a>
                    <a href="#">NM</a>
                    <a href="#">N-TV</a>
                    <a href="#">Delas</a>
                </nav>
                
            </section>
            
            <section class="header-right">
                <nav>
                    <a href="#">Classificados</a>
                    <a href="#"><strong>ASSINAR</strong></a>
            
                </nav>
            </section>
        </section>
        <section class="logo-submit-section container d-flex justify-content-between align-items-center py-3">
            <section class="logo">
                <a href="index.html">
                    <img src="media/logo.jpg">
                </a>
            </section>
            
            <section class="header-left-2">
            <div class="mouse-tracker">
                Stats -> X: {{ mouseX }} | Y: {{ mouseY }}
            </div>
                <nav>
                    <a href="#"><strong>ÚLTIMAS</strong></a>
                    <a href="#"><strong>JN DIRETO</strong></a>
                    <a href="index.html"><strong>HOME</strong></a>
                </nav>
            </section>
            <section class="nav-actions">
                <button class="audio-btn"><a href="#" @click.prevent="$parent.showPage('home')">ARTICLES</a></button>
                <button class="read-btn"><a href="#" @click.prevent="$parent.showPage('custom')">CUSTOM_ARTICLES</a></button>

                <input 
                    type="text" 
                    class="search-input" 
                    placeholder="🔍"
                    v-model="localSearchTerm"
                    @input="onSearchInput">

                <select class="font-select" v-model="selectedFont" @change="onFontChange">
                    <option value="" disabled>Aa</option>
                    <option value="font-arial">Arial</option>
                    <option value="font-times">Times</option>
                    <option value="font-consolas">Consolas</option>
                </select>
                <select class="theme-select" v-model="selectedTheme" @change="onThemeChange">
                    <option value="theme-light">☀️</option>
                    <option value="theme-dark">🌙</option>
                    <option value="theme-rose">🌹</option>
                </select>
            </section>
        </section>
    </header>
    `,
    props : {
        mouseX : Number,
        mouseY : Number
    },
    data(){
        return {
            localSearchTerm : '',
            selectedTheme : 'theme-light',
            selectedFont : ''
        }
    },

    methods: {
        onSearchInput() {
        // Émet un événement "update-search" avec la valeur de l'input
            this.$emit('update-search', this.localSearchTerm);
        },
        // Appelé quand tu changes le <select> de thème
        onThemeChange() {
            this.$emit('update-theme', this.selectedTheme);
        },
        // Appelé quand tu changes le <select> de police
        onFontChange() {
            this.$emit('update-font', this.selectedFont);
        }
    }

}