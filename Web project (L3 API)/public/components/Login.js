export default {
    name: 'Login',
    props: ['page'], // Pour savoir si on affiche ce composant,
    data() {
        return {
            loginInput: '',
            passInput: '',
            currentUser: null, // Stockera le nom de l'utilisateur si connecté
            authMessage: ''
        }
    },
    methods: {
        submitLogin() {
            // Appel à l'API pour tenter de se connecter
            fetch('/app/controller/auth_fetch.php?action=login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    login: this.loginInput,
                    password: this.passInput
                })
            })
            .then(response => response.json())  
            .then(data => {
                if (data.success) {
                    this.currentUser = data.username; // Stocke le nom de l'utilisateur connecté
                    this.authMessage = '';
                } else {
                    this.authMessage = data.message || 'Échec de la connexion.';
                }
            })
            .catch(error => {
                console.error('Erreur lors de la connexion :', error);
                this.authMessage = 'Une erreur est survenue. Veuillez réessayer.';
            });
        },
        logout() {
            // Appel à l'API pour se déconnecter
            fetch('/app/controller/auth_fetch.php?action=logout', {
                method: 'POST'
            })  
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    this.currentUser = null; // Réinitialise l'utilisateur connecté
                    this.authMessage = '';
                } else {
                    this.authMessage = data.message || 'Échec de la déconnexion.';
                }
            })
            .catch(error => {
                console.error('Erreur lors de la déconnexion :', error);
                this.authMessage = 'Une erreur est survenue. Veuillez réessayer.';
            });
        }
    },
    template: `
    <div v-show="page == 'login'">
        <h2>{{ currentUser ? 'Mon Profil' : 'Connexion' }}</h2>

        <div class="search-page">
            <div v-if="currentUser" style="text-align: center;">
                <h3>Bienvenue, {{ currentUser }} !</h3>
                <p>Vous êtes identifié.</p>
                <button @click="logout" class="search-submit">Se déconnecter</button>
            </div>

            <div v-else class="search-form">
                <p v-if="authMessage" class="error-msg">{{ authMessage }}</p>
                
                <div class="search-row">
                    <label>Login :</label>
                    <input type="text" v-model="loginInput" placeholder="Entrez votre identifiant">
                </div>
                
                <div class="search-row">
                    <label>Mot de passe :</label>
                    <input type="password" v-model="passInput" placeholder="Entrez votre mot de passe">
                </div>
                
                <button type="button" @click="submitLogin" class="search-submit" style="margin-top: 10px;">
                    Se connecter
                </button>
            </div>
        </div>
    </div>
    `
}