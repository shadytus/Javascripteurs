export default {
    name: 'ArticleList',

    template: `
        <main v-show="this.page == 'home'">
        <main class="container">
        
            <!-- Breaking News -->
            
                <article class="breaking-news">
                <a href="article.html">
                <img src="./media/articles.jpg" alt="Breaking News Image">
                <nav class="text">
                    <h2><strong>Ces coins de Belgique dont le cinéma raffole: De nombreux tournages se déroulent en Belgique. Petit tour des lieux les plus prisés par le
                                septième art.</strong></h2>
                </nav>
                </a>
                </article>
            
        
            <!-- Sidebar News -->
            <aside class="sidebar" aria-label="Notícias Laterais">
            <a href="#">
                <article class="sidebar-item">
                <img src="./media/Kamala.jpg" alt="Breaking News Image">
                <div class="text">
                    <span class="tag">EXCLUSIVO · POLÉMICA</span>
                    <h4>Last summer, the City of Boston commissioned 44 local artists to paint City-owned utility boxes across 15.</h4>
                </div>
                </article>
                </a>
                
                <a href="#">
                <article class="sidebar-item">
                <img src="./media/Amazone.jpg" alt="Breaking News Image">
                <div class="text">
                    <span class="tag">SAÚDE</span>
                    <h4>“Não podemos tirar ilações políticas”, conclui ministra sobre relatório da IGAS</h4>
                </div>
                </article>
                </a>
                <a href="#">
                <article class="sidebar-item">
                <img src="./media/Eleven.jpg" alt="Breaking News Image">
                <div class="text">
                    <span class="tag">PROTEÇÃO CIVIL</span>
                    <h4>The Japanese conglomerate would provide immediate growth in the town</h4>
                </div>
                </article>
            </a>

            <a href="#">
                <article class="sidebar-item">
                <img src="./media/rigio.jpg" alt="Breaking News Image">
                <div class="text">
                    <span class="tag">Actualite</span>
                    <h4>Three new Spanish hotel projects are apace for groundbreaking later this year. The projects are expected to pump US$2.2 billion .</h4>
                </div>
                </article>
            </a>
            </aside>
            
        
            <!-- Bottom Left Grid -->
            <section class="bottom-grid" aria-label="Notícias Principais Inferiores">
                <article class="card">
                <a href="#">
                <img src="./media/foot.jpg" alt="">
                <span class="tag gray">ULS</span>
                <h4>Charleroi doit enchaîner à Westerlo après le choc wallon,Charleroi doit enchaîner à Westerlo après le choc wallon.</h4>
                </a>
                </article>
                <article class="card">
                <a href="#">
                <img src="./media/greve.jpg" alt="">
                <span class="tag orange">EM ATUALIZAÇÃO · CRIME</span>
                <h4>Aluno de 13 anos ameaça com faca colegas e professores em escola de Sintra</h4>
                </a>
                </article>
                <article class="card">
                <a href="#">
                <img src="./media/Trump.jpg" alt="">
                <span class="tag gray">ROUBO</span>
                <h4> Tout ce qui vient de Chine coûte désormais deux fois plus cher aux États-Unis</h4>
                </a>
                </article>
                <article class="card">
                <a href="#">
                <img src="./media/Nuclear.jpg" alt="">
                <span class="tag blue">PJ</span>
                <h4> Modernisation du U.S. Nuclear Missile Silos</h4>
                </a>
                </article>
                
            </section>
        
            <!-- Bottom Right Mini Grid -->
            <section class="bottom-mini" aria-label="Autres Actualités">
                <article class="card small">
                <a href="#">
                <img src="./media/climat.jpg" alt="">
                <h4>Tout ce qui vient de Chine coûte désormais deux fois plus cher aux États-Unis</h4>
                </a>
                </article>
                <article class="card small">
                <a href="#">
                <img src="./media/greve2.jpg" alt="">
                <h4>Première victoire syndicale !" : le mouvement de grogne dans l'enseignement se poursuit</h4>
                </a>
                </article>
                <article class="card small">
                <a href="#">
                <img src="./media/festival.jpg" alt="">
                <h4>Un festival pour les amateurs de bière ces vendredi et samedi 11 et 12 Avril</h4>
                </a>
                </article>
            
            </section>
        
    
        </main>
    </main>
    `,

    props : {
        page    :{
            type        :String,
            required    :true,
        },
    },
    
}