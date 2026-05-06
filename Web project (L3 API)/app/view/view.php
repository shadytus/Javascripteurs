function main_press(): string 
{
    $menu_a = get_menu(); 
    $user = $_SESSION['user'] ?? null;
    $current_page = $_GET['page'] ?? 'press';
    
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

    return html_head($menu_a, $user, $current_page) . $content . html_foot();
}