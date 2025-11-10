export default {
    name: 'ArticleList',

    template: `
        <main v-show="this.page == 'home'">
        
            <main class="container">

                <article class ="breaking-news" v-if="breakingNewsArticle">
                    <a href="#" @click.prevent="showArticleDetails(breakingNewsArticle)">
                        <img :src="breakingNewsArticle.image" alt="Breaking News Image">
                        <nav class="text">
                            <h2><strong>{{ breakingNewsArticle.title }}</strong></h2>
                            <h3 v-html="breakingNewsArticle.resume"></h3>
                        </nav>
                    </a>
                </article>
            </main>
        </main>

        `,
    props : {
        page    :{
            type        :String,
            required    :true,
        },
        searchQuery :{
            type        :String,
            default     :'',
        }
    },
    data() {
        
        return {
            selectedArticle : null,
            articles : [
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
                    <p>Les forÃªts immenses et les collines pentues des Ardennes belges inspirent de nombreux cinÃ©astes. Câ€™est bien simple, on ne compte plus les films qui sâ€™y dÃ©roulent, ou lâ€™utilisent comme dÃ©cor. Parmi tous les longs et courts-mÃ©trages existants, on peut notamment citer "Les GÃ©ants". Le drame de Bouli Lanners place trois adolescents dÃ©sÅ“uvrÃ©s dans son cadre ardennais. LivrÃ©s Ã  eux-mÃªmes, les 3 garÃ§ons se retrouvent emportÃ©s, et nous avec, dans une grande aventure.
                    </p>
                    <p>Le cinÃ©aste belge Robin Pront semble lui aussi avoir Ã©tÃ© inspirÃ© par la rÃ©gion, puisquâ€™il a dÃ©cidÃ© de baptiser son premier long-mÃ©trage "Dâ€™Ardennen". Sorti en 2016, ce thriller poisseux fait des Ardennes le cadre fatidique de son drame criminel.
                    </p>
                    </section>
                    <section class="Art">
                    <h3>La Gare de LiÃ¨ge
                    </h3>
                    <p>Le saviez-vous ? La Gare de LiÃ¨ge-Guillemins apparaÃ®t dans le premier volet des "Gardiens de la Galaxie" ! Le dÃ´me de Calatrava a tapÃ© dans lâ€™Å“il du studio Marvel, qui a intÃ©grÃ© lâ€™architecture futuriste de la gare au dÃ©cor de planÃ¨te Xandar, oÃ¹ les antihÃ©ros du film se rencontrent. Mais attention : ni Chris Pratt ni Zoe Saldana ne se sont rendus sur place. Ce sont les Ã©quipes des effets spÃ©ciaux qui ont scannÃ© lâ€™ensemble de la structure. On aperÃ§oit aussi briÃ¨vement la gare dans le film de science-fiction "Gemini Man" oÃ¹ Will Smith joue un double rÃ´le. LÃ  non plus, le tournage ne sâ€™est pas fait en Belgique.
                    </p>
                    <p>En revanche, Jean Dujardin sâ€™est bien rendu Ã  LiÃ¨ge pour tourner une scÃ¨ne de la comÃ©die "Un homme Ã  la hauteur", tout comme Daniel BrÃ¼hl, dans une sÃ©quence du thriller "Le CinquiÃ¨me Pouvoir" sur Julian Assange. Dans ce dernier film, la gare "joue son propre rÃ´le" : les personnages sont bien dans la station de trains de la citÃ© ardente plutÃ´t que sur une autre planÃ¨te.
                    </p>
                    </section>
                    <section class="Art">
                    <h3>Bruges</h3>
                    <p>Impossible de parler des lieux de cinÃ©ma en Belgique sans parler de Bruges. Et impossible de parler de Bruges, sans parler de "Bons Baisers de Bruges", la comÃ©die criminelle mÃ©lancolique portÃ©e par Colin Farrell, Brendan Gleeson et Ralph Fiennes. Câ€™est dans cette cÃ©lÃ¨bre ville belge que leurs personnages de tueurs vont se rÃ©fugier aprÃ¨s une mission ratÃ©e. La visite de la Venise du Nord par ces touristes accidentels joue merveilleusement avec le cadre mystÃ©rieux et pittoresque de la ville.
                    </p>
                    <p>On peut Ã©galement citer "Au Risque de se Perdre", mÃ©lodrame de 1958 avec Audrey Hepburn, dans lequel celle-ci joue une nonne dans un couvent brugeois, mais aussi la comÃ©die de science-fiction bollywoodienne "PK", qui a Ã©tÃ© un Ã©norme succÃ¨s en Inde, ou encore la sÃ©rie britannique "The White Queen".
                    </p>
                    </section>`,  
                    image : "39e98420b5e98bfbdc8a619bef7b8f61-1740665779",
                    author : "Adrien Corbeel",
                    category : "Culture" ,
                    type : "breaking"
                },
                {
                    id : 2,
                    title : "<section class="Art">
                    resume:`<section class="Art">
                            <h2>Les frères Dardenne, fierté du cinéma belge</h2>
                            <p>Jean-Pierre et Luc Dardenne sont des figures emblématiques du cinéma belge et mondial. Leur approche réaliste et sociale, caractérisée par des plans longs, un son naturel et peu de musique, a valu à leurs films de nombreuses récompenses, dont deux Palmes d'Or à Cannes. À travers des œuvres comme <em>Rosetta</em>, <em>L'Enfant</em> ou <em>Le Jeune Ahmed</em>, ils explorent des thèmes sociaux profonds tels que la pauvreté, l'immigration et la résilience, confirmant leur rôle de pionniers du cinéma d'auteur.</p>
                            </section>`,
                    body: `
                    <section class="Art">
                    <p><strong>Jean-Pierre et Luc Dardenne sont les cinéastes belges les plus primés au monde. Retour sur un parcours exceptionnel.</strong></p>
                    </section>
                    <section class="Art">
                    <h3>Palmes d'or et reconnaissance internationale</h3>
                    <p>Les frères Dardenne ont remporté deux Palmes d'or au Festival de Cannes : une première en 1999 pour "Rosetta", et une seconde en 2005 pour "L'Enfant". Cette reconnaissance internationale a mis la Belgique sur la carte du cinéma d'auteur européen.</p>
                    <p>Leur cinéma social, ancré dans la réalité liégeoise, capture avec justesse les difficultés des classes populaires. Leur style documentaire et leur approche naturaliste ont influencé toute une génération de cinéastes.</p>
                    </section>
                    <section class="Art">
                    <h3>Un cinéma engagé</h3>
                    <p>Films après films, les Dardenne explorent les thèmes de la précarité, de l'immigration et de la rédemption. "Le Gamin au vélo", "Deux jours, une nuit" avec Marion Cotillard, ou encore "Le Jeune Ahmed" témoignent de leur engagement constant pour un cinéma humaniste et social.</p>
                    </section>`,
                    // image :,
                    // author : "Benoît Poelvoorde",
                    // category : "cinema",
                    // type : "portrait"
                },
                {
                    id: 3,
                    title: "Benoît Poelvoorde, l'acteur qui fait rire l'Europe",
                    resume
                    <section class="Art">
                   <h2>Benoît Poelvoorde, figure singulière du cinéma belge</h2>
                   <p>Benoît Poelvoorde est un acteur, scénariste et humoriste belge né à Namur en 1964. Révélé par le film culte <em>C’est arrivé près de chez vous</em>, il s’impose rapidement comme une figure incontournable du cinéma comique franco-belge. Son style excentrique et son jeu intense séduisent autant dans la comédie que dans le drame, comme en témoignent ses rôles dans <em>Podium</em>, <em>Entre ses mains</em> ou <em>Coco avant Chanel</em>. Reconnu pour sa personnalité attachante et imprévisible, il reste l’un des artistes les plus marquants et atypiques du cinéma francophone.</p>
                   </section>
                    body: `
                    <section class="Art">
                    <p><strong>De "C'est arrivé près de chez vous" aux comédies françaises, Benoît Poelvoorde s'est imposé comme l'une des figures majeures du cinéma francophone.</strong></p>
                    </section>
                    <section class="Art">
                    <h3>Une révélation culte</h3>
                    <p>En 1992, "C'est arrivé près de chez vous" fait scandale et révèle un acteur hors norme. Ce faux documentaire sur un tueur en série, réalisé par Rémy Belvaux, André Bonzel et Benoît Poelvoorde lui-même, devient rapidement un film culte du cinéma belge.</p>
                    <p>Son personnage de Ben, tueur en série décontracté, marque les esprits par son audace et son humour noir. Le film remporte le Prix de la Critique à Cannes et lance la carrière internationale de Poelvoorde.</p>
                    </section>
                    <section class="Art">
                    <h3>Entre Belgique et France</h3>
                    <p>Poelvoorde navigue ensuite entre productions belges et françaises, incarnant des personnages décalés dans "Les Convoyeurs attendent", "Le Tout Nouveau Testament", ou côté français dans "Podium", "Rien à déclarer" ou "Au service de la France".</p>
                    </section>`,
                    // image :,
                    // author : "Benoît Poelvoorde" ,
                    // category : "cinema",
                    // type : "portrait"
                },
                {
                    id: 4,
                    title: "Le cinéma d'animation belge en pleine effervescence",
                    resume
                    <section class="Art">
                    <h2>Le cinéma d'animation belge en pleine effervescence</h2>
                    <p>Le cinéma d’animation belge connaît depuis plusieurs années un essor remarquable, porté par une nouvelle génération de réalisateurs et de studios innovants. Des œuvres originales, souvent marquées par une identité visuelle forte et un humour singulier, se distinguent sur la scène internationale. Des films comme <em>Ernest et Célestine</em>, <em>Panique au village</em> ou <em>Le Chat du Rabbin</em> témoignent de la créativité et de la diversité de la production belge. Grâce à la collaboration entre artistes, écoles d’animation et studios de renom, la Belgique s’affirme aujourd’hui comme l’un des pôles les plus dynamiques du cinéma d’animation européen.</p>
                    </section> 
                    body: 
                    <section class="Art">
                    <p><strong>Des studios d'animation belges connaissent un succès grandissant, tant au niveau national qu'international.</strong></p>
                    </section>
                    <section class="Art">
                    <h3>NWave et la 3D</h3>
                    <p>Le studio bruxellois Nwave s'est spécialisé dans l'animation 3D avec des films comme "Fly Me to the Moon", premier film d'animation en 3D projeté dans l'espace. Le studio produit également des contenus pour parcs d'attractions et salles IMAX.</p>
                    </section>
                    <section class="Art">
                    <h3>Stop-motion et animation artisanale</h3>
                    <p>La Belgique excelle également dans l'animation en stop-motion. Des réalisateurs comme Vincent Patar et Stéphane Aubier ont créé "Panique au village", série et film au succès critique remarquable. Leur univers décalé et poétique a conquis un large public.</p>
                    <p>"Ernest et Célestine", adapté des albums de Gabrielle Vincent, a été nommé aux Oscars en 2014. Ce film d'animation traditionnel célèbre la douceur et l'amitié entre un ours et une souris.</p>
                    </section>`,
                    // image :,
                    // author : "Ernest et Célestine" ,
                    // category : "cinema",
                    // type : "article bibliographique"
                },
                {
                    id: 5,
                    title: "Matthias Schoenaerts, l'étoile montante du cinéma belge",
                    resume
                    <section class="Art">
                    <h2>Matthias Schoenaerts, l'étoile montante du cinéma belge</h2>
                    <p>Matthias Schoenaerts, né à Anvers en 1977, est un acteur belge reconnu pour son intensité et sa polyvalence. Il s'est imposé sur la scène internationale grâce à des rôles puissants dans des films tels que <em>De Rouille et d’Os</em>, <em>Bullhead</em> et <em>The Danish Girl</em>. Sa capacité à incarner des personnages complexes et nuancés fait de lui une figure montante du cinéma belge et européen, saluée par la critique et le public.</p>
                    </section>
                    body: `
                    <section class="Art">
                    <p><strong>De la Belgique à Hollywood, Matthias Schoenaerts s'impose comme l'un des acteurs les plus demandés de sa génération.</strong></p>
                    </section>
                    <section class="Art">
                    <h3>Révélé par "Bullhead"</h3>
                    <p>C'est avec "Rundskop" (Bullhead) de Michaël R. Roskam que Matthias Schoenaerts se fait remarquer en 2011. Son interprétation intense d'un éleveur de bétail impliqué dans un trafic d'hormones lui vaut une nomination aux Oscars dans la catégorie meilleur film étranger.</p>
                    <p>Sa transformation physique et son jeu puissant impressionnent la critique internationale. Le film remporte de nombreux prix et ouvre les portes d'Hollywood à l'acteur flamand.</p>
                    </section>
                    <section class="Art">
                    <h3>Une carrière internationale</h3>
                    <p>Schoenaerts enchaîne ensuite les productions prestigieuses : "De rouille et d'os" avec Marion Cotillard, "The Danish Girl", "Red Sparrow" avec Jennifer Lawrence, ou encore "The Old Guard" sur Netflix. Il reste néanmoins attaché au cinéma européen, tournant régulièrement en Belgique et en France.</p>
                    </section>`,
                    // image :,
                    // author : "contricuteurs",
                    // category : "cinema",
                    // type : "article bibliographique"
                },
                {
                    id: 6,
                    title: "Jaco Van Dormael et le cinéma fantastique belge",
                    resume
                    <section class="Art">
                    <h2>Jaco Van Dormael et le cinéma fantastique belge</h2>
                    <p>Jaco Van Dormael, né à Ixelles en 1957, est un réalisateur belge renommé pour ses films mêlant fantastique, poésie et humanisme. Auteur d’œuvres emblématiques telles que <em>Toto le héros</em>, <em>Le Huitième Jour</em> et <em>Mr. Nobody</em>, il se distingue par un style visuel unique, une narration inventive et des thèmes universels sur l’existence et l’imaginaire. Son cinéma contribue à affirmer la Belgique sur la scène internationale et à renouveler le genre fantastique avec sensibilité et originalité.</p>
                    </section>
                    body: `
                    <section class="Art">
                    <p><strong>Jaco Van Dormael a su créer un univers cinématographique unique, mêlant poésie, fantastique et réflexions existentielles.</strong></p>
                    </section>
                    <section class="Art">
                    <h3>"Toto le héros", un premier film remarqué</h3>
                    <p>En 1991, Jaco Van Dormael remporte la Caméra d'or à Cannes pour "Toto le héros". Ce conte philosophique sur la jalousie et les regrets d'un vieil homme séduit par son originalité narrative et sa mise en scène inventive.</p>
                    </section>
                    <section class="Art">
                    <h3>"Mr. Nobody" et les univers parallèles</h3>
                    <p>"Mr. Nobody", sorti en 2009, est une œuvre ambitieuse avec Jared Leto explorant les choix de vie et les destins multiples. Le film, tourné en Belgique et en Allemagne, devient un film culte pour toute une génération grâce à sa profondeur philosophique.</p>
                    <p>"Le Tout Nouveau Testament" en 2015 propose une relecture décalée et humoristique de la religion, où Dieu vit à Bruxelles et se comporte comme un despote mesquin. Le film rencontre un succès international et confirme le talent unique de Van Dormael.</p>
                    </section>`,
                    // image :,
                    // author : "contributeurs",
                    // category : "cinema",
                    // type : "article bibliographique"
                },
                {
                    id: 7,
                    title: "Le Festival du Film de Gand, vitrine du cinéma mondial",
                    resume
                    <section class="Art">
                    <h2>Le Festival du Film de Gand, vitrine du cinéma mondial</h2>
                    <p>Le Festival du Film de Gand, fondé en 1974, est l’un des événements cinématographiques les plus importants de Belgique et de l’Europe. Il met en avant une sélection variée de films internationaux, allant du cinéma d’auteur aux œuvres expérimentales. Le festival se distingue par sa reconnaissance des compositeurs de musique de film et son engagement pour la promotion de talents émergents. Grâce à sa programmation éclectique et prestigieuse, il constitue une véritable vitrine du cinéma mondial et un rendez-vous incontournable pour professionnels et passionnés.</p>
                    </section>
                    body: `
                    <section class="Art">
                    <p><strong>Chaque année, le Film Fest Gent attire cinéphiles et professionnels du monde entier dans la capitale flamande.</strong></p>
                    </section>
                    <section class="Art">
                    <h3>Un festival majeur</h3>
                    <p>Créé en 1974, le Festival du Film de Gand est devenu l'un des événements cinématographiques les plus importants de Belgique. Il se distingue par sa programmation éclectique, mêlant cinéma d'auteur, découvertes et hommages à de grands cinéastes.</p>
                    <p>Le festival décerne chaque année plusieurs prix, dont le Grand Prix pour le meilleur film et le World Soundtrack Award, récompensant les meilleures musiques de films. Cette dimension musicale unique attire compositeurs et mélomanes.</p>
                    </section>
                    <section class="Art">
                    <h3>Focus sur le cinéma mondial</h3>
                    <p>Chaque édition met à l'honneur le cinéma d'un pays ou d'une région spécifique, permettant au public belge de découvrir des œuvres rares et des cinématographies méconnues. Le festival organise également des masterclasses et des rencontres avec des réalisateurs de renom.</p>
                    </section>`,
                    // image :,
                    // author : "contricuteurs",
                    // category : "cinema",
                    // type : "article" 
                },
                {
                    id: 8,
                    title: "Cécile de France, l'actrice aux mille visages",
                    resume
                    <section class="Art">
                    <h2>Cécile de France, l'actrice aux mille visages</h2>
                    <p>Cécile de France, née à Namur en 1975, est une actrice belge reconnue pour sa polyvalence et sa présence à l’écran. Elle s’est imposée grâce à des rôles marquants dans des films comme <em>L’Auberge espagnole</em>, <em>Le Goût des autres</em> et <em>La Vie en rose</em>. Sa capacité à incarner des personnages très différents lui a valu l’admiration du public et de la critique, faisant d’elle l’une des actrices les plus emblématiques du cinéma belge et européen.</p>
                    </section>
                    body: `
                    <section class="Art">
                    <p><strong>De la Belgique à la France, Cécile de France s'est imposée comme l'une des actrices les plus talentueuses de sa génération.</strong></p>
                    </section>
                    <section class="Art">
                    <h3>Des débuts prometteurs</h3>
                    <p>Révélée dans "L'Auberge espagnole" de Cédric Klapisch en 2002, Cécile de France incarne Isabelle, une jeune femme libre et attachante. Son naturel et sa fraîcheur séduisent immédiatement le public français et international.</p>
                    <p>Elle retrouve Klapisch pour les suites "Les Poupées russes" et "Casse-tête chinois", confirmant son statut de figure incontournable du cinéma français contemporain.</p>
                    </section>
                    <section class="Art">
                    <h3>Une filmographie éclectique</h3>
                    <p>De "Haute tension" à "Hereafter" de Clint Eastwood, de "Möbius" à "Django", Cécile de France navigue entre registres et genres avec une aisance remarquable. Elle n'hésite pas à revenir au cinéma belge, comme dans "Le Gamin au vélo" des frères Dardenne, où elle livre une prestation sobre et émouvante.</p>
                    </section>`,
                    // image :,
                    // author: "contributeurs":,
                    // category : "cinema",
                    // type : "article"
                },
                {
                    id: 9,
                    title: "Le cinéma belge et la bande dessinée, une histoire d'amour",
                    resume
                    <section class="Art">
                    <h2>Le cinéma belge et la bande dessinée, une histoire d'amour</h2>
                    <p>Le cinéma belge entretient depuis longtemps des liens étroits avec la bande dessinée, un art majeur de la culture belge. De nombreuses œuvres cinématographiques s’inspirent de héros et d’univers BD emblématiques, tels que <em>Tintin</em> ou <em>Les Schtroumpfs</em>, tandis que les adaptations modernes explorent de nouvelles formes narratives et visuelles. Cette relation entre cinéma et bande dessinée témoigne de la richesse créative de la Belgique et de sa capacité à marier humour, imagination et storytelling visuel.</p>
                    </section>
                    body: `
                    <section class="Art">
                    <p><strong>La Belgique, terre de la BD, a vu plusieurs de ses héros passer du papier au grand écran avec des fortunes diverses.</strong></p>
                    </section>
                    <section class="Art">
                    <h3>Tintin à l'écran</h3>
                    <p>Le plus célèbre reporter belge a connu plusieurs adaptations, de la série animée des années 90 au film de Steven Spielberg "Les Aventures de Tintin : Le Secret de La Licorne" en 2011. Si le film en motion capture divise, il témoigne de l'attrait international pour l'œuvre d'Hergé.</p>
                    </section>
                    <section class="Art">
                    <h3>Des adaptations variées</h3>
                    <p>"Largo Winch", créé par Jean Van Hamme et Philippe Francq, a donné lieu à deux films d'action avec Tomer Sisley. "Le Chat" de Geluck a inspiré plusieurs courts-métrages animés diffusés à la télévision.</p>
                    <p>Plus récemment, "Valérian et la Cité des mille planètes" de Luc Besson, adapté de la série franco-belge de Christin et Mézières, a bénéficié d'un budget colossal, même si le résultat commercial fut décevant. Ces adaptations montrent la richesse du patrimoine BD belge et son potentiel cinématographique.</p>
                    </section>`,
                    // image :,
                    // author : "contributeurs",
                    // category : "bande dessinée belge",
                    // type : "culturel"
                },
                {
                    id: 10,
                    title: " la nouvelle realisation des acteurs belges francophones"
                    resume
                    <section class="Art">
                    <h2>Le renouveau du cinéma belge francophone</h2>
                    <p>Une nouvelle génération de réalisateurs belges francophones émerge, apportant des regards neufs et audacieux sur le monde et la société. Bouli Lanners, acteur devenu réalisateur, signe des films empreints de mélancolie et d'humanité avec <em>Les Géants</em> et <em>Les Premiers, les Derniers</em>. Joachim Lafosse explore les tensions familiales dans <em>À perdre la raison</em> et <em>L'Économie du couple</em>, tandis que Lucas Belvaux tisse des récits complexes à travers sa trilogie <em>Cavale</em>, <em>Un couple épatant</em> et <em>Après la vie</em>, et aborde plus récemment des sujets sociopolitiques comme dans <em>Chez nous</em>. D'autres cinéastes comme Fien Troch ou Fabrice Du Welz contribuent également à dessiner les contours d'un cinéma belge contemporain riche, diversifié et reconnu à l’international.</p>
                    </section>   
                    body: `
                    <section class="Art">
                    <p><strong>Une nouvelle génération de réalisateurs belges francophones émerge, apportant des regards neufs et audacieux.</strong></p>
                    </section>
                    <section class="Art">
                    <h3>Bouli Lanners et son cinéma sensible</h3>
                    <p>Acteur devenu réalisateur, Bouli Lanners signe des films empreints de mélancolie et d'humanité. "Les Géants" et "Les Premiers, les Derniers" ont confirmé son talent pour capter la beauté dans l'ordinaire et les marges de la société.</p>
                    </section>
                    <section class="Art">
                    <h3>Une jeune garde prometteuse</h3>
                    <p>Joachim Lafosse explore les tensions familiales dans "À perdre la raison" et "L'Économie du couple". Son cinéma intimiste et psychologique a été salué dans de nombreux festivals internationaux.</p>
                    <p>Lucas Belvaux, avec sa trilogie "Cavale", "Un couple épatant" et "Après la vie", a démontré sa capacité à tisser des récits complexes. Plus récemment, "Chez nous" aborde la montée du populisme avec finesse.</p>
                    <p>Ces réalisateurs, aux côtés d'autres comme Fien Troch ou Fabrice Du Welz, dessinent les contours d'un cinéma belge contemporain riche et diversifié, capable de rivaliser avec les plus grandes cinématographies européennes.</p>
                    </section>`,
                    // image :,
                    // author : "contricuteurs",
                    // category : "cinema",
                    // type : "culturel"
                }
            ]
        }
    },

    computed : {
        nombreArticles(){
            return this.articles.length
        },
        filteredArticles(){
            if (!this.searchQuery){
                return this.articles
            };
        const query = this.searchQuery.toLowerCase();
        return this.articles.filter(
                article => article.title.toLowerCase().includes(query)
            );
        },
        media_path(){
            if (this.selectedArticle){
                return `/media/${this.selectedArticle.image}`
            }
            else return null;
        },
        breakingNewsArticle(){
            return this.filteredArticles.find(article => article.type === 'breaking');
        }
    },

    methods: {
        showArticle(article) {
            console.log("lire article " + article.id),
            this.selectedArticle = article
        },
        hideArticle(article) {
            console.log("cacher article "+ article.id),
            this.selectedArticle = null
        },
    }

}

