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
    // data() {
    //     return {
    //         selectedArticle : null,
            
    //         articles : [
    //             {
    //                 id : 1,
    //                 title : "Ces coins de Belgique dont le cinéma raffole: De nombreux tournages se déroulent en Belgique. Petit tour des lieux les plus prisés par le septième art.",
    //                 body : `
                        // <section class="Art">
                        // <p><strong>De nombreux tournages se déroulent en Belgique. Petit tour des lieux les plus prisés par le septième art.</strong></p>
                        // </section>
                        // <section class="Art">
                        // <h3>Les Ardennes</h3>
                        // <p>Les forÃªts immenses et les collines pentues des Ardennes belges inspirent de nombreux cinÃ©astes. Câ€™est bien simple, on ne compte plus les films qui sâ€™y dÃ©roulent, ou lâ€™utilisent comme dÃ©cor. Parmi tous les longs et courts-mÃ©trages existants, on peut notamment citer "Les GÃ©ants". Le drame de Bouli Lanners place trois adolescents dÃ©sÅ“uvrÃ©s dans son cadre ardennais. LivrÃ©s Ã  eux-mÃªmes, les 3 garÃ§ons se retrouvent emportÃ©s, et nous avec, dans une grande aventure.
                        // </p>
                        // <p>Le cinÃ©aste belge Robin Pront semble lui aussi avoir Ã©tÃ© inspirÃ© par la rÃ©gion, puisquâ€™il a dÃ©cidÃ© de baptiser son premier long-mÃ©trage "Dâ€™Ardennen". Sorti en 2016, ce thriller poisseux fait des Ardennes le cadre fatidique de son drame criminel.
                        // </p>
                        // </section>
                        // <section class="Art">
                        // <h3>La Gare de LiÃ¨ge
                        // </h3>
                        // <p>Le saviez-vous ? La Gare de LiÃ¨ge-Guillemins apparaÃ®t dans le premier volet des "Gardiens de la Galaxie" ! Le dÃ´me de Calatrava a tapÃ© dans lâ€™Å“il du studio Marvel, qui a intÃ©grÃ© lâ€™architecture futuriste de la gare au dÃ©cor de planÃ¨te Xandar, oÃ¹ les antihÃ©ros du film se rencontrent. Mais attention : ni Chris Pratt ni Zoe Saldana ne se sont rendus sur place. Ce sont les Ã©quipes des effets spÃ©ciaux qui ont scannÃ© lâ€™ensemble de la structure. On aperÃ§oit aussi briÃ¨vement la gare dans le film de science-fiction "Gemini Man" oÃ¹ Will Smith joue un double rÃ´le. LÃ  non plus, le tournage ne sâ€™est pas fait en Belgique.
                        // </p>
                        // <p>En revanche, Jean Dujardin sâ€™est bien rendu Ã  LiÃ¨ge pour tourner une scÃ¨ne de la comÃ©die "Un homme Ã  la hauteur", tout comme Daniel BrÃ¼hl, dans une sÃ©quence du thriller "Le CinquiÃ¨me Pouvoir" sur Julian Assange. Dans ce dernier film, la gare "joue son propre rÃ´le" : les personnages sont bien dans la station de trains de la citÃ© ardente plutÃ´t que sur une autre planÃ¨te.
                        // </p>
                        // </section>
                        // <section class="Art">
                        // <h3>Bruges</h3>
                        // <p>Impossible de parler des lieux de cinÃ©ma en Belgique sans parler de Bruges. Et impossible de parler de Bruges, sans parler de "Bons Baisers de Bruges", la comÃ©die criminelle mÃ©lancolique portÃ©e par Colin Farrell, Brendan Gleeson et Ralph Fiennes. Câ€™est dans cette cÃ©lÃ¨bre ville belge que leurs personnages de tueurs vont se rÃ©fugier aprÃ¨s une mission ratÃ©e. La visite de la Venise du Nord par ces touristes accidentels joue merveilleusement avec le cadre mystÃ©rieux et pittoresque de la ville.
                        // </p>
                        // <p>On peut Ã©galement citer "Au Risque de se Perdre", mÃ©lodrame de 1958 avec Audrey Hepburn, dans lequel celle-ci joue une nonne dans un couvent brugeois, mais aussi la comÃ©die de science-fiction bollywoodienne "PK", qui a Ã©tÃ© un Ã©norme succÃ¨s en Inde, ou encore la sÃ©rie britannique "The White Queen".
                        // </p>
                        // </section>`,
    //                 author : "Adrien Corbeel",
    //                 image : "./media/...",
    //                 category : "placeholder",
    //                 type : "placeholder"   
    //             },
    //             {
                    //    id : 2,
                    //    title : "titre",
                    //    body : `"lorem ipsum"`,
                    //    author : "Me",
                    //    image : "./media/...",
                    //    category : "placeholder",
                    //    type : "placeholder"  
    //             },
    //         ]
    //     }
    // },
    
}