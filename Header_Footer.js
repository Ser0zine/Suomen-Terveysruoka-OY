class CustomHeader extends HTMLElement {
    connectedCallback()
    {
        this.innerHTML = 
        `
        <header>
            <div class="Logo">
                <h1>Suomen Terveysruoka OY</h1>
            </div>
            <nav>
                <a href="Koti.php">Koti</a>
                <a href="Tuotteet.php">Tuotteet</a>
            </nav>
            <nav class="Login">
                <a href="" class="">Bonukset</a>
                <a href="Kirjaudu.html" class ="">Kirjaudu</a>
            </nav>
        </header>
        `;
    }
}

customElements.define('custom-header', CustomHeader);

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