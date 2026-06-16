<style>
    .site-footer {
        background: var(--surface);
        border-top: 1px solid var(--border);
        padding: 3.5rem 0 1.5rem;
        flex-shrink: 0;
    }

    .footer-logo {
        font-family: var(--font-display);
        font-size: 1.7rem;
        color: var(--text);
        letter-spacing: 0.05em;
    }

    .footer-logo span {
        color: var(--accent);
    }

    .footer-label {
        font-size: 0.68rem;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        color: var(--muted);
        font-weight: 700;
        margin-bottom: 0.75rem;
    }

    .footer-link {
        display: block;
        font-size: 0.85rem;
        color: var(--text-dim);
        text-decoration: none;
        padding: 0.2rem 0;
        transition: color 0.2s;
    }

    .footer-link:hover {
        color: var(--text);
    }

    .footer-divider {
        border: none;
        border-top: 1px solid var(--border);
        margin: 2rem 0 1.5rem;
    }
</style>
<footer class="site-footer">
    <div class="container">
        <div class="row g-5">
            <div class="col-md-5">
                <div class="footer-logo">MANGA<span>XENO</span></div>
                <p style="color:var(--text-dim); font-size:0.88rem; margin-top:0.75rem; max-width:300px;">
                    Il tuo negozio di riferimento per manga, figure e carte collezionabili. Spedizioni in tutta Italia.
                </p>
            </div>
            <div class="col-md-2">
                <p class="footer-label">Catalogo</p>
                <a href="index.php?category=manga&action=prodotti" class="footer-link">Manga</a>
                <a href="index.php?category=figure&action=prodotti" class="footer-link">Figure</a>
                <a href="index.php?category=carta&action=prodotti" class="footer-link">Carte</a>
            </div>
            <div class="col-md-2">
                <p class="footer-label">Account</p>
                <a href="index.php?action=showLogin" class="footer-link">Accedi</a>
                <a href="index.php?action=showRegister" class="footer-link">Registrati</a>
                <a href="index.php?action=cart" class="footer-link">Carrello</a>
            </div>
            <div class="col-md-3">
                <p class="footer-label">Info</p>
                <p style="font-size:0.82rem; color:var(--text-dim); margin-bottom:0.25rem;">
                    <i class="bi bi-truck me-2" style="color:var(--accent);"></i>Spedizione gratis oltre €50
                </p>
                <p style="font-size:0.82rem; color:var(--text-dim); margin-bottom:0.25rem;">
                    <i class="bi bi-arrow-counterclockwise me-2" style="color:var(--accent);"></i>Reso entro 30 giorni
                </p>
                <p style="font-size:0.82rem; color:var(--text-dim);">
                    <i class="bi bi-shield-lock me-2" style="color:var(--accent);"></i>Pagamento sicuro
                </p>
            </div>
        </div>
        <hr class="footer-divider">
        <p style="text-align:center; font-size:0.78rem; color:var(--muted); margin:0;">
            © <?= date('Y') ?> MangaXeno — Tutti i diritti riservati
        </p>
    </div>
</footer>