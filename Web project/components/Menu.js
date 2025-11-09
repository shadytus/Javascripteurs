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
                <nav>
                    <a href="#"><strong>ÚLTIMAS</strong></a>
                    <a href="#"><strong>JN DIRETO</strong></a>
                    <a href="index.html"><strong>HOME</strong></a>
                </nav>
            </section>
            <section class="nav-actions">
                <button class="audio-btn"><a href="article.html">ARTICLES</a></button>
                <button class="read-btn"><a href="custom.html">CUSTOM_ARTICLES</a></button>
                <button class="search-btn">🔍</button>
                <button class="accessibility-btn">Aa</button>
                <button class="theme-btn">🌙</button>
                <button class="menu-btn">☰</button>
            </section>
        </section>
    </header>
    `,
    data(){
        return {
            localSearchTerm : '',
            
        }
    }
}