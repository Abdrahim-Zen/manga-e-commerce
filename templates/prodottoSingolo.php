<?php

/** @var string $title */
/** @var array $prodotto */
$this->layout('layout', ['title' => $title]) ?>

<?php $this->start('extra_styles') ?>
<style>
    .product-page {
        padding: 3rem 0 5rem;
    }

    /* Breadcrumb */
    .breadcrumb-wrap {
        margin-bottom: 2.5rem;
    }

    .breadcrumb-item a {
        color: var(--text-dim);
        text-decoration: none;
        font-size: 0.82rem;
        transition: color 0.2s;
    }

    .breadcrumb-item a:hover {
        color: var(--accent);
    }

    .breadcrumb-item.active {
        color: var(--muted);
        font-size: 0.82rem;
    }

    .breadcrumb-item+.breadcrumb-item::before {
        color: var(--muted);
    }

    /* Image column */


    .product-img-wrap {

        border: 1px solid var(--border);
        border-radius: 10px;
        overflow: hidden;
        position: sticky;
        top: 90px;
    }

    .product-img-wrap img {
        width: 100%;
        max-height: 720px;
        object-fit: contain;
        display: block;
        padding: 1.5rem;

    }

    /* Info column */

    .product-code {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        color: var(--muted);
        margin-bottom: 0.75rem;
    }

    .product-title {
        font-family: var(--font-display);
        font-size: clamp(2rem, 4vw, 3rem);
        letter-spacing: 0.03em;
        color: var(--text);
        line-height: 1.05;
        margin-bottom: 1rem;
    }

    .volume-tag {
        display: inline-block;
        background: var(--surface2);
        border: 1px solid var(--border2);
        border-radius: 4px;
        padding: 0.3em 0.75em;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--text-dim);
        margin-bottom: 1.5rem;
    }

    .price-block {
        padding: 1.5rem 0;
        border-top: 1px solid var(--border);
        border-bottom: 1px solid var(--border);
        margin-bottom: 1.75rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .product-price-main {
        font-family: var(--font-display);
        font-size: 3rem;
        color: var(--accent);
        letter-spacing: 0.04em;
        line-height: 1;
    }

    .stock-indicator {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .stock-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #22c55e;
        flex-shrink: 0;
    }

    .stock-dot.red {
        background: #ef4444;
    }

    /* Description */
    .desc-block {
        margin-bottom: 1.75rem;
    }

    .desc-block h5 {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        color: var(--text);
        margin-bottom: 0.75rem;
    }

    .desc-block p {
        color: var(--text);
        font-size: 0.9rem;
        line-height: 1.75;
    }

    /* Meta chips */
    .meta-chips {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 1.75rem;
    }

    .meta-chip {
        background: var(--surface2);
        border: 1px solid var(--border2);
        border-radius: 4px;
        padding: 0.3em 0.75em;
        font-size: 0.75rem;
        color: var(--text-dim);
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .meta-chip i {
        color: var(--accent);
        font-size: 0.75rem;
    }

    /* Add to cart */
    .purchase-block {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .qty-label {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        color: var(--text-dim);
        margin-bottom: 0.6rem;
    }

    .qty-control {
        display: flex;
        align-items: center;
        gap: 0;
        width: fit-content;
        border: 1px solid var(--border2);
        border-radius: 6px;
        overflow: hidden;
        margin-bottom: 1.25rem;
    }

    .qty-btn {
        background: var(--surface2);
        border: none;
        color: var(--text);
        width: 40px;
        height: 40px;
        font-size: 1.1rem;
        cursor: pointer;
        transition: background 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .qty-btn:hover {
        background: var(--surface3);
    }

    .qty-input {
        background: transparent;
        border: none;
        border-left: 1px solid var(--border2);
        border-right: 1px solid var(--border2);
        color: var(--text-dim);
        text-align: center;
        width: 60px;
        height: 40px;
        font-size: 0.95rem;
        font-weight: 600;
        font-family: 'DM Sans', sans-serif;
        outline: none;
    }

    .btn-add-cart {
        width: 100%;
        background: var(--accent);
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 0.9rem;
        font-size: 0.85rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        font-family: 'DM Sans', sans-serif;
        cursor: pointer;
        transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
    }

    .btn-add-cart:hover {
        background: var(--accent-dark);
        transform: translateY(-1px);
        box-shadow: 0 8px 24px rgba(162, 123, 92, 0.3);
    }

    .btn-login-to-buy {
        width: 100%;
        background: transparent;
        border: 1px solid var(--accent);
        border-radius: 6px;
        padding: 0.9rem;
        font-size: 0.85rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--accent);
        text-decoration: none;
        display: block;
        text-align: center;
        transition: all 0.2s;
    }

    .btn-login-to-buy:hover {
        background: var(--accent);
        color: #fff;
    }

    /* Trust strip */
    .trust-strip {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
    }

    .trust-item {
        text-align: center;
        padding: 1rem 0.5rem;
    }

    .trust-item i {
        font-size: 1.4rem;
        color: var(--accent);
        display: block;
        margin-bottom: 0.5rem;
    }

    .trust-item span {
        font-size: 0.74rem;
        color: var(--text);
        line-height: 1.3;
        display: block;
    }

    /* Related products */
    .related-section {
        padding: 4rem 0;
        border-top: 1px solid var(--border);
    }

    .related-track {
        display: flex;
        gap: 1rem;
        overflow-x: auto;
        padding-bottom: 0.5rem;
        scrollbar-width: none;
    }

    .related-track::-webkit-scrollbar {
        display: none;
    }

    .related-card {
        flex: 0 0 180px;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.3s ease, border-color 0.3s ease;
        text-decoration: none;
    }

    .related-card:hover {
        transform: translateY(-4px);
        border-color: var(--border2);
    }

    .related-card img {
        width: 100%;
        aspect-ratio: 3/4;
        object-fit: cover;
    }

    .related-card .rc-body {
        padding: 0.75rem;
    }

    .related-card .rc-title {
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--text);
        line-height: 1.3;
        margin-bottom: 0.35rem;
    }

    .related-card .rc-price {
        font-family: var(--font-display);
        font-size: 1.2rem;
        color: var(--accent);
    }

    .qty-input::-webkit-outer-spin-button,
    .qty-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }
</style>
<?php $this->stop() ?>

<?php $this->start('main_content') ?>

<div class="product-page">
    <div class="container">

        <!-- Breadcrumb -->
        <nav class="breadcrumb-wrap" aria-label="breadcrumb">
            <ol class="breadcrumb" style="background:transparent; padding:0; margin:0;">
                <li class="breadcrumb-item">
                    <a href="<?= $this->e($base_url) ?>">Home</a>
                </li>
                <?php
                $cat_label = !empty($prodotto['nome']) ? 'Manga' : (!empty($prodotto['nome_personaggio']) ? 'Figure' : 'Carte');
                $cat_slug  = !empty($prodotto['nome']) ? 'manga' : (!empty($prodotto['nome_personaggio']) ? 'figure' : 'carta');
                ?>
                <li class="breadcrumb-item">
                    <a href="index.php?category=<?= $cat_slug ?>&action=prodotti"><?= $cat_label ?></a>
                </li>
                <li class="breadcrumb-item active">
                    <?= $this->e($prodotto['nome'] ?? $prodotto['nome_personaggio'] ?? $prodotto['brand_carta'] ?? 'Prodotto') ?>
                </li>
            </ol>
        </nav>

        <div class="row g-5">

            <!-- Image -->
            <div class="col-lg-5 product-img-col">
                <div class="product-img-wrap">
                    <img src="<?= $this->e($prodotto['image']) ?>" alt="Immagine prodotto">
                </div>
            </div>

            <!-- Details -->
            <div class="col-lg-7 product-info-col">

                <p class="product-code">
                    <i class="bi bi-upc me-1"></i>
                    CODICE: <?= $this->e($prodotto['codice']) ?>
                </p>

                <h1 class="product-title">
                    <?= $this->e($prodotto['nome'] ?? $prodotto['nome_personaggio'] ?? $prodotto['brand_carta'] ?? 'Prodotto') ?>
                </h1>

                <?php if (isset($prodotto['volume'])): ?>
                    <span class="volume-tag">
                        <i class="bi bi-journal-bookmark me-1"></i> Volume <?= $this->e($prodotto['volume']) ?>
                    </span>
                <?php endif; ?>

                <!-- Price -->
                <div class="price-block">
                    <div class="product-price-main">
                        €<?= number_format($prodotto['prezzo'], 2, ',', '.') ?>
                    </div>
                    <?php if ($prodotto['quantita'] > 0): ?>
                        <div class="stock-indicator" style="color:#22c55e;">
                            <span class="stock-dot"></span>
                            Disponibile
                        </div>
                    <?php else: ?>
                        <div class="stock-indicator" style="color:#ef4444;">
                            <span class="stock-dot red"></span>
                            Esaurito
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Description -->
                <div class="desc-block">
                    <h5>Descrizione</h5>
                    <p>
                        <?php
                        if (isset($prodotto['descrizione']) && !empty($prodotto['descrizione'])) {
                            echo $this->e($prodotto['descrizione']);
                        } else {
                            switch ($categoria) {
                                case 'carta':
                                    echo 'Potenzia il tuo mazzo o arricchisci il tuo album con queste carte collezionabili.';
                                    break;
                                case 'figure':
                                    echo 'Arricchisci la tua collezione con questa figure straordinaria.ricca di dettagli fedeli all\'opera originale';
                                    break;
                                default:
                                    echo 'Descrizione non disponibile.';
                                    break;
                            }
                        }
                        ?>
                    </p>
                </div>

                <!-- Meta -->
                <div class="meta-chips">
                    <?php if (!empty($prodotto['altezza']) && !empty($prodotto['larghezza'])): ?>
                        <span class="meta-chip">
                            <i class="bi bi-rulers"></i>
                            <?= $this->e($prodotto['altezza']) ?> × <?= $this->e($prodotto['larghezza']) ?> cm
                        </span>
                    <?php endif; ?>
                    <?php if (!empty($prodotto['brand_carta'])): ?>
                        <span class="meta-chip">
                            <i class="bi bi-tag"></i>
                            <?= $this->e($prodotto['brand_carta']) ?>
                        </span>
                    <?php endif; ?>
                    <?php if (!empty($prodotto['categoria'])): ?>
                        <span class="meta-chip">
                            <i class="bi bi-grid"></i>
                            <?= $this->e($prodotto['categoria']) ?>
                        </span>
                    <?php endif; ?>
                </div>

                <!-- Purchase -->
                <div class="purchase-block">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <form action="index.php?action=cart&cart_action=addToCart" method="POST">
                            <p class="qty-label">Quantità</p>
                            <div class="qty-control">
                                <button type="button" class="qty-btn" id="decrease-qty">−</button>
                                <input type="number" class="qty-input" name="quantity" id="quantity" value="1" min="1" max="50">
                                <button type="button" class="qty-btn" id="increase-qty">+</button>
                            </div>
                            <?php if ($prodotto['quantita'] > 0): ?>
                                <button type="submit" class="btn-add-cart">
                                    <i class="bi bi-bag-plus me-2"></i>Aggiungi al Carrello
                                </button>
                            <?php else: ?>
                                <button type="button" class="btn-add-cart" disabled style="opacity:0.4; cursor:not-allowed;">
                                    Prodotto Esaurito
                                </button>
                            <?php endif; ?>
                            <input type="hidden" name="product_id" value="<?= $prodotto['ID'] ?>">
                            <input type="hidden" name="categoria" value="<?= $categoria ?>">
                        </form>
                    <?php else: ?>
                        <p style="font-size:0.82rem; color:var(--text-dim); margin-bottom:1rem;">
                            Devi essere loggato per aggiungere prodotti al carrello.
                        </p>
                        <a href="index.php?action=showLogin" class="btn-login-to-buy">
                            <i class="bi bi-person me-2"></i>Accedi per Acquistare
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Trust -->
                <div class="trust-strip">
                    <div class="trust-item">
                        <i class="bi bi-truck"></i>
                        <span>Spedizione gratuita oltre €50</span>
                    </div>
                    <div class="trust-item">
                        <i class="bi bi-arrow-counterclockwise"></i>
                        <span>Reso entro 30 giorni</span>
                    </div>
                    <div class="trust-item">
                        <i class="bi bi-shield-lock"></i>
                        <span>Pagamento sicuro</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Related Products -->
<?php if (!empty($novita_products)): ?>
    <section class="related-section">
        <div class="container">
            <div style="display:flex; align-items:flex-end; justify-content:space-between; margin-bottom:2rem;">
                <div>
                    <span style="font-size:0.68rem; font-weight:700; text-transform:uppercase; letter-spacing:0.2em; color:var(--accent); display:block; margin-bottom:0.35rem;">Potrebbe Piacerti</span>
                    <h2 style="font-family:var(--font-display); font-size:2rem; color:var(--text); margin:0; letter-spacing:0.04em;">Prodotti Correlati</h2>
                </div>
                <a href="index.php?action=home" style="font-size:0.78rem; font-weight:700; text-transform:uppercase; letter-spacing:0.1em; color:var(--accent); text-decoration:none; border-bottom:1px solid var(--border2); padding-bottom:2px;">
                    Vedi tutti →
                </a>
            </div>

            <div class="related-track">
                <?php foreach ($novita_products as $product): ?>
                    <?php
                    $n = $product['nome'] ?? $product['nome_personaggio'] ?? $product['brand_carta'] ?? 'Prodotto';
                    if (!empty($product['volume'])) $n .= ' Vol.' . $product['volume'];
                    $c = !empty($product['nome']) ? 'manga' : (!empty($product['nome_personaggio']) ? 'figure' : 'carta');
                    ?>
                    <a href="index.php?id=<?= $this->e($product['ID']) ?>&category=<?= $c ?>&action=prodotto" class="related-card">
                        <img src="<?= $this->e($product['image']) ?>" alt="<?= $this->e($n) ?>" loading="lazy">
                        <div class="rc-body">
                            <p class="rc-title"><?= $this->e($n) ?></p>
                            <?php if ($product['quantita'] > 0): ?>
                                <div class="rc-price">€<?= number_format($product['prezzo'], 2) ?></div>
                            <?php else: ?>
                                <div class="rc-price" style="color:#dc3545; font-size:1rem;">Esaurito</div>
                            <?php endif; ?>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php $this->stop() ?>

<?php $this->start('page_scripts') ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const qty = document.getElementById('quantity');
        const dec = document.getElementById('decrease-qty');
        const inc = document.getElementById('increase-qty');

        if (qty && dec && inc) {
            dec.addEventListener('click', () => {
                if (+qty.value > 1) qty.value = +qty.value - 1;
            });
            inc.addEventListener('click', () => {
                if (+qty.value < 50) qty.value = +qty.value + 1;
            });
        }
    });
</script>
<?php $this->stop() ?>