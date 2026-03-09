export default {
    name: 'Footer',

    template: `
        <footer>

            <hr>
            <section class="bonus-history">
            
                <button @click="showHistory = !showHistory">
                    {{ showHistory ? 'Cacher' : 'Afficher' }} les 5 derniers choix
                </button>
                
                <ul v-if="showHistory">
                
                    <li v-for="(item, index) in history" :key="index">
                        {{ item.type }} changé en : <strong>{{ item.value }}</strong>
                    </li>
                    
                    <li v-if="history.length === 0">
                        Aucun changement n'a encore été fait.
                    </li>
                </ul>
            </section>
            <section class="container-footer">
            <section class="row">
                <section class="cont1">
                    <hr class="a-separator visible-xs">
                    <h5>About Us</h5>
                    <ul>
                        <li>About 1</li>
                        <li>About 2</li>
                        <li>About 3</li>
                    </ul>
                    
                </section>
                <section class="cont1">
                    <hr class="a-separator visible-xs">
                    <h5>Distribution</h5>
                    <ul>
                        <li>distribution 1</li>
                        <li>distribution 2</li>
                        <li>distribution 3</li>
                    </ul>
                    
                </section>
                <section class="cont1">
                    <hr class="a-separator visible-xs">
                    <h5>Resources</h5>
                    <ul>
                        <li>Mobile App</li>
                        <li>RSS Feeds</li>
                        <li>News Plugin</li>
                        
                    </ul>
                    
                </section>
            <section class="cont1">
                <hr class="a-separator visible-xs">
                <h5>About</h5>
                <ul>
                    <li>News Home</li>
                    <li>Follow us</li>
                    <li>Caree</li>
                    
                </ul>
                
            </section>
            <section class="cont1">
                <hr class="a-separator visible-xs">
                <h5>Help/ Support</h5>
                <ul>
                    <li>FAQ</li>
                    <li>Video Tuto</li>
                    <li>Report</li>
                </ul>
                
            </section>
            <section class="footer-section social">
                <h3>Suivez-nous</h3>
                <a href="#"><img src="./media/facebook.jpg" alt="Facebook"></a>
                <a href="#"><img src="./media/Twitter.jpg" alt="Twitter"></a>
                <a href="#"><img src="./media/Linkedin.jpg" alt="Instagram"></a>
            </section>
            
            </section>

            </section>
        </footer>
    `,
    props : {
        history: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            showHistory: false
        }
    } 
}