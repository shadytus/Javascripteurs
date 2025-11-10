// js/components/Conception.js

export default {
    name: 'Conception',
    
    props: {
        page: {
            type: String,
            required: true
        }
    },

    template: `
        <main class="conception-page" v-show="this.page == 'conception'">
            
            <h1>Parcours de Conception du Site</h1>
            <p>
                Ce site a été développé dans le cadre du cours de Projet Web 
                par Shady Darwish et Vanessa Ndountio Somkwe (Team JAVASCRIPTEURS).
            </p>
            
            <h2>Objectif</h2>
            <p>
                L'objectif était de transformer un site HTML/CSS statique en une 
                application web dynamique (Single Page Application) en utilisant 
                Vue.js (via CDN et modules ES).
            </p>
            
            <h2>Fonctionnalités Implémentées</h2>
            <ul>
                <li><strong>Composants Vue :</strong> L'application est découpée en composants réutilisables (Menu, ArticleList, Footer).</li>
                <li><strong>État Centralisé :</strong> Un fichier app.js sert de "cerveau" et gère l'état global.</li>
                <li><strong>Affichage Dynamique :</strong> Les listes d'articles sont générées avec v-for à partir d'un tableau de données.</li>
                <li><strong>Interactivité :</strong> Implémentation de filtres, de changement de thème (light/dark) et de police.</li>
                <li><strong>Affichage/Masquage :</strong> Logique pour masquer/afficher des catégories d'articles avec v-show.</li>
            </ul>
            <h3><a href="https://github.com/shadytus/Javascripteurs/tree/main" target="_blank">Github du projet</a></h3>
            
            </main>
    `
}