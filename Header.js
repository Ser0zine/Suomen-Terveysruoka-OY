class CustomHeader extends HTMLElement {
    connectedCallback()
    {
        this.innerHTML = 
        `
        <header>
            <div class="Logo">
                Suomen Terveysruoka OY
            </div>
                <nav>
                    <a href="">Kaupat</a>
                    <a href="">Tuotteet</a>
                </nav>
           <a href="">Kirjaudu</a>
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
        `;
    }
}

customElements.define('custom-footer', CustomFooter);