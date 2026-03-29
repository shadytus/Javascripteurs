<?php
function main_press(): string 
{
    // On récupère le menu depuis le modèle
    $menu_a = get_menu(); 
    
    // On prépare le contenu HTML "coquille"
    $content = <<<HTML
    <div id="app">
        <div v-if="activeDetails" class="detail-tooltip">
            <p>Mots : {{ activeDetails.wordCount }} | Lecture : {{ activeDetails.readtime }} min</p>
        </div>

        <article-list 
            v-if="currentPage === 'press'" 
            :page="currentPage" 
            @mouseover-article="handleMouseOver">
        </article-list>

        <article-detail 
            v-if="currentPage === 'article'" 
            :article-id="selectedArticleId">
        </article-detail>
        
        <search-view v-if="currentPage === 'search'"></search-view>
    </div>
    HTML;

    return html_head($menu_a) . $content . html_foot();
}