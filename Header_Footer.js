class CustomHeader extends HTMLElement {
    connectedCallback()
    {
        this.innerHTML = 
        `
        <header>
            <div class="Logo">
                <a href="Koti.php">
                    <h1>Suomen Terveysruoka OY</h1>
                </a>
            </div>
            <nav>
                <a href="Koti.php">Koti</a>
                <a href="Tuotteet.php">Tuotteet</a>
                <a href="Bonukset.php">Bonukset</a>
            </nav>
            <div class="Login">
                <a href="Kirjaudu.php">Kirjaudu</a>
            </div>
            <div class="burger-menu" onclick="toggleMobileMenu()">
                <div class="burger-line"></div>
                <div class="burger-line"></div>
                <div class="burger-line"></div>
            </div>
        </header>
        <div class="mobile-menu" id="mobileMenu">
            <a href="Koti.php">Koti</a>
            <a href="Tuotteet.php">Tuotteet</a>
            <a href="Bonukset.php">Bonukset</a>
            <a href="Kirjaudu.php" class="login-mobile">Kirjaudu</a>
        </div>
        `;
    }
}

customElements.define('custom-header', CustomHeader);

// Mobile menu toggle function
function toggleMobileMenu() {
    const mobileMenu = document.getElementById('mobileMenu');
    const burgerMenu = document.querySelector('.burger-menu');
    
    mobileMenu.classList.toggle('active');
    burgerMenu.classList.toggle('active');
}

// Close mobile menu when clicking on a link
document.addEventListener('click', function(e) {
    if (e.target.tagName === 'A' && e.target.closest('.mobile-menu')) {
        const mobileMenu = document.getElementById('mobileMenu');
        const burgerMenu = document.querySelector('.burger-menu');
        
        mobileMenu.classList.remove('active');
        burgerMenu.classList.remove('active');
    }
});

class CustomFooter extends HTMLElement {
    connectedCallback()
    {
        this.innerHTML = 
        `
        <footer>
            <p>&copy; 2025 Suomen Terveysruoka OY. Kaikki oikeudet pidätetään.</p>
            <div>
                <h1>Yhteystiedot</h1>
                <ul>
                    <li>Mikonkatu 5, 00100 Helsinki</li>
                    <li>Puhelin: +358 123 45 647</li>
                    <li>Sähköposti: Info@Terveysruoka.fi</li>
                </ul>
            </div>
        </footer>
        `;
    }
}

customElements.define('custom-footer', CustomFooter);