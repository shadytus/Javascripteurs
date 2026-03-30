<?php
function main_logout() {
    // Si la session n'est pas encore lancée sur cette page, on la lance
    if(session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // On détruit tout !
    session_destroy();
    unset($_SESSION['user']);
    
    // On redirige proprement vers la page login
    header('Location: index.php?page=login');
    exit;
}
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
            @change-page="goToPage">

        </article-list>

        <article-detail 
            v-if="currentPage === 'article'"
            :page="currentPage" 
            :article-id="selectedId"
            @change-page="goToPage">
        </article-detail>

        <login-view 
            v-if="currentPage === 'login'"
            :page="currentPage"
            @change-page="goToPage">
        </login-view>

        <favorites-view 
            v-if="currentPage === 'favoris'"
            :page="currentPage"
            @change-page="goToPage">    
        </favorites-view>
        
        
    </div>
    HTML;

    return html_head($menu_a) . $content . html_foot();
}