
<?php /** @var string $title */
 $this->layout('layout', ['title' => $title]) ?>

<?php $this->start('extra_styles') ?>
<style>
    /* ── HERO ── */
    .hero {
        position: relative;
        min-height: max(500px, 52vw);
        display: flex;
        align-items: center;
        overflow: hidden;
        border-bottom: 1px solid var(--border);
    }

    .hero-bg-img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center center;
        display: block;
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        background:
            linear-gradient(90deg, rgba(13, 13, 13, 0.95) 0%, rgba(13, 13, 13, 0.75) 55%, rgba(13, 13, 13, 0.2) 100%),
            linear-gradient(to bottom, rgba(13, 13, 13, 0.2) 0%, rgba(13, 13, 13, 0.6) 100%);
    }

    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 620px;
        padding: 5rem 0;
    }

    .hero-eyebrow {
        display: flex;
        align-items: center;
        gap: 1rem;
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3em;
        color: var(--accent);
        margin-bottom: 2rem;
    }

    .hero-eyebrow::before {
        content: '';
        display: block;
        width: 40px;
        height: 1px;
        background: var(--accent);
        flex-shrink: 0;
    }

    .hero-title {
        font-family: var(--font-display);
        font-size: clamp(3rem, 6vw, 5.5rem);


        line-height: 1.0;
        color: var(--text-dim);
        margin-bottom: 1.75rem;
        letter-spacing: 0.03em;
    }

    .hero-title strong {
        font-style: normal;
        font-weight: 700;
        display: block;
        color: var(--text);
    }

    .hero-title em {
        color: var(--accent);

    }

    .hero-sub {
        font-size: 0.95rem;
        color: var(--text-dim);
        line-height: 1.8;
        max-width: 400px;
        margin-bottom: 2.5rem;
    }

    .hero-actions {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .btn-primary-arch {
        background: var(--accent);
        color: #fff;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        padding: 1rem 2.25rem;
        border-radius: 3px;
        text-decoration: none;
        transition: background 0.2s, transform 0.15s;
        display: inline-block;
    }

    .btn-primary-arch:hover {
        background: var(--accent-dark);
        transform: scale(0.97);
        color: #fff;
    }

    .btn-outline-arch {
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: var(--text-dim);
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        padding: 1rem 2.25rem;
        border-radius: 3px;
        text-decoration: none;
        transition: all 0.2s;
        display: inline-block;
    }

    .btn-outline-arch:hover {
        border-color: var(--text-dim);
        color: var(--text);
    }

    /* ── CATEGORY CARDS ── */
    .cat-section {
        padding: 5rem 0;
        border-bottom: 1px solid var(--border);
    }

    .section-eyebrow {
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3em;
        color: var(--accent);
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 0.75rem;
    }

    .section-eyebrow::before {
        content: '';
        width: 32px;
        height: 1px;
        background: var(--accent);
    }

    .section-title-display {
        font-family: var(--font-display);
        font-size: clamp(2rem, 3.5vw, 2.8rem);
        letter-spacing: 0.04em;
        color: var(--text);
        line-height: 1;
    }

    .section-head-row {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 3rem;
        gap: 1.5rem;
        flex-wrap: wrap;
    }

    .link-underline {
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: var(--text-hover2);
        text-decoration: none;
        border-bottom: 1px solid var(--text-hover2);
        padding-bottom: 2px;
        transition: color 0.2s, border-color 0.2s;
        white-space: nowrap;
    }

    .link-underline:hover {
        color: var(--accent);
        border-color: var(--accent);
    }

    .cat-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
    }

    .cat-card {
        position: relative;
        aspect-ratio: 3/4;
        overflow: hidden;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
        display: block;
        background: var(--surface2);
    }

    .cat-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.75;
        transition: transform 0.7s ease, opacity 0.4s ease;
    }

    .cat-card:hover img {
        transform: scale(1.08);
        opacity: 0.95;
    }

    .cat-card-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(13, 13, 13, 0.88) 0%, rgba(13, 13, 13, 0.2) 60%, transparent 100%);
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 1.75rem;
    }

    .cat-card-num {
        font-size: 0.62rem;
        font-weight: 700;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: var(--accent);
        margin-bottom: 0.5rem;
    }

    .cat-card-title {
        font-family: var(--font-display);
        font-size: 1.9rem;
        letter-spacing: 0.04em;
        color: #fff;
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    .cat-card-desc {
        font-size: 0.78rem;
        color: rgba(255, 255, 255, 0.65);
        line-height: 1.5;
        transform: translateY(8px);
        opacity: 0;
        transition: all 0.35s ease;
    }

    .cat-card:hover .cat-card-desc {
        transform: translateY(0);
        opacity: 1;
    }

    .cat-card-arrow {
        position: absolute;
        top: 1.5rem;
        right: 1.5rem;
        font-size: 0.75rem;
        color: rgba(255, 255, 255, 0.4);
        transition: color 0.2s, transform 0.2s;
    }

    .cat-card:hover .cat-card-arrow {
        color: var(--accent);
        transform: translate(2px, -2px);
    }

    /* ── PRODUCT SECTIONS — "Curator's Choice" style ── */
    .prod-section {
        padding: 5rem 0;
        border-bottom: 1px solid var(--border);
    }

    .prod-grid {
        display: grid;
        grid-auto-flow: column;
        grid-auto-columns: 200px;
        gap: 1.25rem;
        overflow-x: auto;
        scrollbar-width: none;
        scroll-behavior: smooth;
        border: 1px solid var(--border);
        border-radius: 4px;
        overflow: hidden;
    }

    .prod-grid::-webkit-scrollbar {
        display: none;
    }

    .pcard {
        background: var(--text);
        display: flex;
        flex-direction: column;
        transition: background 0.25s;
        text-decoration: none;
        border-radius: 4px;
    }

    .pcard:hover {
        background: var(--surface2);
    }

    .pcard-img {
        width: 100%;
        aspect-ratio: 3/4;
        object-fit: cover;
        display: block;
        transition: transform 0.4s ease;
        filter: brightness(0.92);
    }

    .pcard:hover .pcard-img {
        transform: scale(1.04);
        filter: brightness(1);
    }

    .pcard-body {
        padding: 1rem;
        border-top: 1px solid var(--border);
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .pcard-meta {
        font-size: 0.62rem;
        font-weight: 700;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: var(--muted);
        margin-bottom: 0.35rem;
    }

    .pcard-name {
        font-family: var(--font-body);
        font-size: 0.84rem;
        font-weight: 600;
        color: var(--text-dim);
        line-height: 1.35;
        margin-bottom: 0.75rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        flex: 1;
    }

    .pcard-price {
        font-size: 0.88rem;
        font-weight: 700;
        color: var(--accent);
        letter-spacing: 0.04em;
        margin-bottom: 0.65rem;
    }

    .pcard-price.oos {
        color: var(--muted);
        font-size: 0.78rem;
    }

    .pcard-btn {
        display: block;
        width: 100%;
        padding: 0.5rem;
        background: transparent;
        border: 1px solid var(--border2);
        border-radius: 3px;
        color: var(--muted);
        font-size: 0.62rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.14em;
        text-align: center;
        text-decoration: none;
        transition: all 0.2s;
    }

    .pcard-btn:hover {
        background: var(--accent);
        border-color: var(--accent);
        color: #fff;
    }

    .c-outer {
        position: relative;
    }

    .c-btn {
        position: absolute;
        top: 35%;
        transform: translateY(-50%);
        width: 32px;
        height: 32px;
        background: var(--surface2);
        border: 1px solid var(--border2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 5;
        color: var(--text-dim);
        font-size: 0.75rem;
        transition: all 0.2s;
    }

    .c-btn:hover {
        background: var(--accent);
        border-color: var(--accent);
        color: #fff;
    }

    .c-btn.left {
        left: -14px;
    }

    .c-btn.right {
        right: -14px;
    }

    /* ── FULL BLEED BANNER (ispirato alla sezione dark del riferimento) ── */
    .fullbleed {
        position: relative;
        padding: 6rem 0;
        overflow: hidden;
        border-bottom: 1px solid var(--border);
    }

    .fullbleed-bg {
        position: absolute;
        inset: 0;
        background: var(--surface);
    }

    .fullbleed-accent {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, var(--accent) 0%, transparent 60%);
    }

    .fullbleed-content {
        position: relative;
        z-index: 2;
        text-align: center;
    }

    .fullbleed-label {
        font-size: 0.65rem;
        font-weight: 700;
        letter-spacing: 0.35em;
        text-transform: uppercase;
        color: var(--accent);
        margin-bottom: 1.5rem;
        display: block;
    }

    .fullbleed-title {
        font-family: var(--font-display);
        font-size: clamp(2.5rem, 5vw, 5rem);
        letter-spacing: 0.04em;
        color: var(--text);
        line-height: 1;
        margin-bottom: 1.5rem;
    }

    .fullbleed-sub {
        font-size: 0.9rem;
        color: var(--text-dim);
        max-width: 480px;
        margin: 0 auto 2.5rem;
        line-height: 1.75;
    }

    /* ── PROCESS STRIP ── */
    .process-strip {
        padding: 4rem 0;
        border-bottom: 1px solid var(--border);
    }

    .process-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0;
        border: 1px solid var(--border);
        border-radius: 4px;
        overflow: hidden;
    }

    .process-item {
        padding: 2.5rem 2rem;
        border-right: 1px solid var(--border);
    }

    .process-item:last-child {
        border-right: none;
    }

    .process-item i {
        font-size: 1.5rem;
        color: var(--accent);
        display: block;
        margin-bottom: 1.25rem;
    }

    .process-item h3 {
        font-family: var(--font-display);
        font-size: 1.4rem;
        letter-spacing: 0.04em;
        color: var(--text);
        margin-bottom: 0.75rem;
    }

    .process-item p {
        font-size: 0.82rem;
        color: var(--muted);
        line-height: 1.7;
    }

    /* ── REVEAL ── */
    .reveal {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s ease, transform 0.6s ease;
    }

    .reveal.in {
        opacity: 1;
        transform: none;
    }

    @media (max-width: 768px) {
        .cat-grid {
            grid-template-columns: 1fr;
        }

        .process-grid {
            grid-template-columns: 1fr;
        }

        .process-item {
            border-right: none;
            border-bottom: 1px solid var(--border);
        }

        .process-item:last-child {
            border-bottom: none;
        }
    }
</style>
<?php $this->stop() ?>

<?php $this->start('main_content') ?>

<!-- TRUST BAR -->


<!-- HERO -->
<section class="hero">
    <img src="img/steel.jpg" alt="" class="hero-bg-img" aria-hidden="true">
    <div class="hero-overlay"></div>
    <div class="container">
        <div class="hero-content">
            <p class="hero-eyebrow">MangaXeno — Il tuo store</p>
            <h1 class="hero-title">
                Manga, Figure<br>
                e <em>Carte Rare.</em>
            </h1>
            <p class="hero-sub">
                Una selezione curata di manga, statuette da collezione e carte rare.
                Spedizioni veloci in tutta Italia.
            </p>
            <div class="hero-actions">
                <a href="index.php?category=manga&action=prodotti" class="btn-primary-arch">Sfoglia il catalogo</a>
                <a href="#products" class="btn-outline-arch">Vedi le novità</a>
            </div>
        </div>
    </div>
</section>

<!-- CATEGORY CARDS -->
<section class="cat-section reveal">
    <div class="container">
        <div class="section-head-row">
            <div>
                <p class="section-eyebrow">Esplora</p>
                <h2 class="section-title-display">Le nostre categorie</h2>
            </div>
            <a href="index.php?action=home" class="link-underline">Vedi tutto il catalogo</a>
        </div>

        <div class="cat-grid">
            <a href="index.php?category=manga&action=prodotti" class="cat-card">
                <img src="img/manga/jjk11.JPG" alt="Manga" loading="lazy">
                <div class="cat-card-overlay">
                    <h3 class="cat-card-title">Manga</h3>
                    <p class="cat-card-desc">Shonen, Seinen, Isekai e molto altro. Centinaia di titoli disponibili.</p>
                </div>
                <i class="bi bi-arrow-up-right cat-card-arrow"></i>
            </a>
            <a href="index.php?category=figure&action=prodotti" class="cat-card">
                <img src="img/figure/SV Era 5.jpg" alt="Figure" loading="lazy">
                <div class="cat-card-overlay">
                    <h3 class="cat-card-title">Figure</h3>
                    <p class="cat-card-desc">Statuette da collezione, scale 1/7 e 1/4. Personaggi iconici.</p>
                </div>
                <i class="bi bi-arrow-up-right cat-card-arrow"></i>
            </a>
            <a href="index.php?category=carta&action=prodotti" class="cat-card">
                <img src="img/steel.jpg" alt="Carte" loading="lazy">
                <div class="cat-card-overlay">
                    <h3 class="cat-card-title">Carte</h3>
                    <p class="cat-card-desc">Trading card game e set rari. Edizioni limitate e varianti speciali.</p>
                </div>
                <i class="bi bi-arrow-up-right cat-card-arrow"></i>
            </a>
        </div>
    </div>
</section>

<!-- PRODUCT SECTIONS -->
<div id="products">
    <?php
    $renderSection = function ($eyebrow, $title, $products, $cat) {
        if (empty($products))
            return;
        ?>
        <section class="prod-section reveal">
            <div class="container">
                <div class="section-head-row">
                    <div>
                        <p class="section-eyebrow"><?= $eyebrow ?></p>
                        <h2 class="section-title-display"><?= $title ?></h2>
                    </div>
                    <a href="index.php?category=<?= $cat ?>&action=prodotti" class="link-underline">
                        Vedi tutti <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>

                <div class="c-outer">
                    <button class="c-btn left"><i class="bi bi-chevron-left"></i></button>
                    <div class="prod-grid">
                        <?php foreach ($products as $product): ?>
                            <?php
                            $name = trim(!empty($product['nome'])
                                ? $product['nome'] . (!empty($product['volume']) ? ' Vol.' . $product['volume'] : '')
                                : ($product['nome_personaggio'] ?? $product['brand_carta'] ?? 'Prodotto'));
                            $pcat = !empty($product['nome']) ? 'manga' : (!empty($product['nome_personaggio']) ? 'figure' : 'carta');
                            $oos = $product['quantita'] <= 0;

                            $meta = match ($pcat) {
                                'manga' => 'Manga' . (!empty($product['volume']) ? ' · Vol.' . $product['volume'] : ''),
                                'figure' => 'Figura da collezione',
                                'carta' => 'Trading Card',
                                default => 'Prodotto'
                            };
                            ?>
                            <div class="pcard">
                                <div style="overflow:hidden; position:relative;">
                                    <img src="<?= $this->e($product['image']) ?>" class="pcard-img" alt="<?= $this->e($name) ?>"
                                        loading="lazy">
                                    <?php if ($oos): ?>
                                        <div
                                            style="position:absolute;top:0.6rem;right:0.6rem;background:rgba(220,53,69,0.85);color:#fff;font-size:0.58rem;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;padding:0.2em 0.55em;border-radius:2px;">
                                            Esaurito
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="pcard-body">
                                    <p class="pcard-meta"><?= $meta ?></p>
                                    <p class="pcard-name"><?= $this->e($name) ?></p>

                                    <div class="pcard-price">€<?= number_format($product['prezzo'], 2) ?></div>

                                    <a href="index.php?id=<?= $this->e($product['ID']) ?>&category=<?= $pcat ?>&action=prodotto"
                                        class="pcard-btn">Vedi prodotto</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button class="c-btn right"><i class="bi bi-chevron-right"></i></button>
                </div>
            </div>
        </section>
    <?php }; ?>

    <?php
    $renderSection("Ultime Novità", "Manga in evidenza", $novita_products ?? [], "manga");
    $renderSection("Collezionismo", "Figure & Statuette", $figure_products ?? [], "figure");
    $renderSection("Trading Cards", "Carte Collezionabili", $cardgame_products ?? [], "carta");
    ?>
</div>

<!-- FULL BLEED BANNER -->
<section class="fullbleed reveal">
    <div class="fullbleed-bg"></div>
    <div class="fullbleed-accent"></div>
    <div class="container">
        <div class="fullbleed-content">
            <span class="fullbleed-label">Spedizione veloce</span>
            <h2 class="fullbleed-title">
                Consegna gratuita<br>su ordini sopra <em>€50</em>
            </h2>
            <p class="fullbleed-sub">
                Spediamo in tutta Italia in 24/48h. Ogni ordine viene imballato con cura per proteggere i tuoi acquisti.
            </p>
            <a href="index.php?category=manga&action=prodotti" class="btn-primary-arch">Inizia lo shopping →</a>
        </div>
    </div>
</section>

<!-- PROCESS STRIP -->
<section class="process-strip reveal">
    <div class="container">
        <div class="process-grid">
            <div class="process-item">
                <i class="bi bi-patch-check"></i>
                <h3>Prodotti Autentici</h3>
                <p>Tutti i prodotti sono originali e provengono direttamente dai distributori ufficiali italiani e
                    giapponesi.</p>
            </div>
            <div class="process-item">
                <i class="bi bi-box-seam"></i>
                <h3>Imballaggio Sicuro</h3>
                <p>Ogni ordine viene imballato con cura per proteggere manga, figure e carte durante il trasporto.</p>
            </div>
            <div class="process-item">
                <i class="bi bi-arrow-counterclockwise"></i>
                <h3>Reso Garantito</h3>
                <p>Non sei soddisfatto? Hai 30 giorni di tempo per restituire il prodotto. Il reso è semplice e
                    gratuito.</p>
            </div>
        </div>
    </div>
</section>

<div style="padding-bottom:1rem;"></div>

<?php $this->stop() ?>

<?php $this->start('page_scripts') ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        // Carousel
        document.querySelectorAll('.c-outer').forEach(outer => {
            const track = outer.querySelector('.prod-grid');
            const btnL = outer.querySelector('.c-btn.left');
            const btnR = outer.querySelector('.c-btn.right');
            if (!track || !btnL || !btnR) return;

            btnL.addEventListener('click', () => track.scrollBy({
                left: -620,
                behavior: 'smooth'
            }));
            btnR.addEventListener('click', () => track.scrollBy({
                left: 620,
                behavior: 'smooth'
            }));

            const sync = () => {
                btnL.style.opacity = track.scrollLeft <= 0 ? '0.3' : '1';
                btnR.style.opacity = track.scrollLeft >= track.scrollWidth - track.clientWidth - 4 ? '0.3' : '1';
            };
            track.addEventListener('scroll', sync, {
                passive: true
            });
            sync();
        });

        // Reveal on scroll
        const io = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('in');
                    io.unobserve(e.target);
                }
            });
        }, {
            threshold: 0.07
        });
        document.querySelectorAll('.reveal').forEach(el => io.observe(el));
    });
</script>
<?php $this->stop() ?>