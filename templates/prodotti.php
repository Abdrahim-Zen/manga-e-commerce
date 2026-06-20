<?php

/** @var string $title */
/** @var string $category_name */
$this->layout('layout', ['title' => $title]) ?>

<?php $this->start('extra_styles') ?>
<style>
    .page-banner {
        background: var(--dark);
        border-bottom: 1px solid var(--border);
        padding: 3.5rem 0 1.0rem;
    }

    .page-banner .category-tag {
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.2em;
        color: var(--accent);
        margin-bottom: 0.6rem;
        display: block;
    }

    .page-banner h1 {
        font-family: var(--font-display);
        font-size: clamp(2.5rem, 5vw, 4rem);
        letter-spacing: 0.03em;
        line-height: 1;
        color: var(--text);
    }

    .page-banner .result-count {
        font-size: 0.82rem;
        color: var(--text-dim);
        margin-top: 0.75rem;
    }

    /* Product grid */
    .products-grid-section {
        padding: 3rem 0 5rem;
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
        gap: 1.25rem;
    }

    .product-grid-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .product-grid-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 16px 48px rgba(0, 0, 0, 0.45);
        border-color: var(--border2);
    }

    .product-grid-card .img-wrap {
        position: relative;
        overflow: hidden;
        background: var(--surface2);
    }

    .product-grid-card img {
        width: 100%;
        aspect-ratio: 3/4;
        object-fit: cover;
        display: block;
        transition: transform 0.4s ease;
    }

    .product-grid-card:hover img {
        transform: scale(1.05);
    }

    .out-of-stock-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.55);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .out-of-stock-overlay span {
        background: rgba(220, 53, 69, 0.9);
        color: #fff;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        padding: 0.35em 0.9em;
        border-radius: 3px;
    }

    .product-grid-card .card-content {
        padding: 1rem;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .product-grid-card .product-name {
        font-size: 0.88rem;
        font-weight: 600;
        color: var(--text);
        line-height: 1.3;
        margin-bottom: 0.5rem;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .product-grid-card .product-price {
        font-family: var(--font-display);
        font-size: 1.55rem;
        letter-spacing: 0.04em;
        color: var(--accent);
        margin-bottom: 0.75rem;
    }

    .product-grid-card .product-price.sold-out {
        color: #dc3545;
        font-size: 1.2rem;
    }

    .btn-details {
        display: block;
        width: 100%;
        background: transparent;
        border: 1px solid var(--border2);
        border-radius: 4px;
        color: var(--text-dim);
        font-size: 0.78rem;
        font-weight: 600;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        text-align: center;
        padding: 0.55rem;
        text-decoration: none;
        transition: all 0.2s;
        margin-top: auto;
    }

    .btn-details:hover {
        background: var(--accent);
        border-color: var(--accent);
        color: #fff;
    }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 5rem 1rem;
        grid-column: 1 / -1;
    }

    .empty-state i {
        font-size: 3.5rem;
        color: var(--muted);
        display: block;
        margin-bottom: 1rem;
    }

    .empty-state h3 {
        font-family: var(--font-display);
        font-size: 1.8rem;
        color: var(--text-dim);
        margin-bottom: 0.5rem;
    }

    .empty-state p {
        color: var(--muted);
        font-size: 0.9rem;
    }

    /* Sort bar */
    .sort-btn {
        display: inline-flex;
        align-items: center;
        background: transparent;
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 4px;
        color: #aaa;
        font-size: 0.72rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        padding: 0.35rem 0.8rem;
        text-decoration: none;
        transition: all 0.2s;
        white-space: nowrap;
    }

    .sort-btn:hover {
        border-color: rgba(67, 118, 108, 0.5);
        color: var(--text-hover);
    }

    .sort-btn.active {
        background: rgba(67, 118, 108, 0.12);
        border-color: var(--text-hover);
        color: var(--text-hover);
    }
</style>
<?php $this->stop() ?>

<?php $this->start('main_content') ?>


<!-- Sort bar -->
<div style="background:var(--surface); border-bottom:1px solid var(--border); padding:0.85rem 0;">
    <div class="container">
        <div style="display:flex; align-items:center; gap:0.5rem; flex-wrap:wrap;">
            <span style="font-size:0.68rem; font-weight:700; text-transform:uppercase; letter-spacing:0.15em; color:var(--muted); margin-right:0.25rem; flex-shrink:0;">Ordina per</span>

            <a href="?action=prodotti&category=<?= $this->e($category_name) ?>&sort=default"
                class="sort-btn <?= (!isset($_GET['sort']) || $_GET['sort'] === 'default') ? 'active' : '' ?>">
                Predefinito
            </a>
            <a href="?action=prodotti&category=<?= $this->e($category_name) ?>&sort=price_asc"
                class="sort-btn <?= (isset($_GET['sort']) && $_GET['sort'] === 'price_asc') ? 'active' : '' ?>">
                <i class="bi bi-arrow-up me-1"></i>Prezzo crescente &uarr;
            </a>
            <a href="?action=prodotti&category=<?= $this->e($category_name) ?>&sort=price_desc"
                class="sort-btn <?= (isset($_GET['sort']) && $_GET['sort'] === 'price_desc') ? 'active' : '' ?>">
                <i class="bi bi-arrow-down me-1"></i>Prezzo decrescente &darr;
            </a>
            <a href="?action=prodotti&category=<?= $this->e($category_name) ?>&sort=availability"
                class="sort-btn <?= (isset($_GET['sort']) && $_GET['sort'] === 'availability') ? 'active' : '' ?>">
                <i class="bi bi-check-circle me-1"></i>Disponibili
            </a>

            <?php if (!empty($category_products)): ?>
                <span style="margin-left:auto; font-size:0.78rem; color:var(--muted);">
                    <?= count($category_products) ?> prodotti trovati
                </span>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- Page banner -->
<div class="page-banner">
    <div class="container" style="text-align: center;">
        <span class="category-tag">Catalogo</span>
        <h1><?= $this->e($title ?? 'Prodotti') ?></h1>
        <p style="color: var(--text); font-size: 0.95rem; margin-top: 0.75rem; max-width: 480px; margin-left: auto; margin-right: auto; line-height: 1.7;">
            Scopri il nostro vasto catalogo di <?= $this->e($title ?? 'prodotti') ?>.
            Trova quello che cerchi tra centinaia di titoli disponibili.
        </p>
    </div>
</div>


<!-- Grid -->
<section class="products-grid-section">
    <div class="container">
        <div class="product-grid">
            <?php if (!empty($category_products)): ?>
                <?php foreach ($category_products as $product): ?>
                    <?php
                    $nome = $product['nome'] ?? $product['nome_personaggio'] ?? $product['brand_carta'] ?? 'Prodotto';
                    if (!empty($product['volume'])) $nome .= ' Vol. ' . $product['volume'];
                    $esaurito = $product['quantita'] <= 0;
                    ?>
                    <div class="product-grid-card">
                        <div class="img-wrap">
                            <img src="<?= $this->e($product['image']) ?>"
                                alt="<?= $this->e($nome) ?>"
                                loading="lazy">
                            <?php if ($esaurito): ?>
                                <div class="out-of-stock-overlay">
                                    <span>Esaurito</span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-content">
                            <p class="product-name"><?= $this->e($nome) ?></p>

                            <div class="product-price">€<?= number_format($product['prezzo'], 2) ?></div>

                            <a href="index.php?id=<?= $this->e($product['ID']) ?>&category=<?= $this->e($category_name) ?>&action=prodotto"
                                class="btn-details">Vedi Dettagli</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="empty-state">
                    <i class="bi bi-box-seam"></i>
                    <h3>Nessun Prodotto</h3>
                    <p>Nessun prodotto trovato in questa categoria. Prova a esplorare le altre sezioni.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php $this->stop() ?>