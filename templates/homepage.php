<?php

/** @var string $site_name */
$this->layout('layout', ['title' => $site_name])
?>
<?php $this->start('extra_styles') ?>
<style>
    .pcard {
        overflow: hidden;
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

    .scroll-row {
        display: flex;
        flex-wrap: nowrap;
        overflow-x: auto;
        scroll-behavior: smooth;
        gap: 1rem;
        padding-bottom: 1rem;
    }

    .scroll-row::-webkit-scrollbar {
        height: 6px;
    }

    .scroll-row::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 10px;
    }

    .scroll-item {
        flex: 0 0 auto;
        width: 280px;
    }
</style>
<?php $this->stop() ?>
<?php $this->start('main_content') ?>


<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">MangaXeno</h1>
            <p class="lead fw-normal text-white-50 mb-0">Action figure, manga e carte collezionabili dei tuoi anime preferiti</p>
        </div>
    </div>
</header>
<!-- Section-->

<?php

$renderFunction = function ($eyebrow, $title, $products, $cat) {
    if (empty($products)) {
        return;
    }
?>
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bolder mb-0"><?= $title ?></h2>
            </div>

            <div class="scroll-row">
                <?php foreach ($products as $product): ?>
                    <?php
                    $name = (!empty($product['nome']) ? $product['nome'] . (!empty($product['volume']) ? ' Vol.' . $product['volume'] :
                        '')
                        : ($product['nome_personaggio'] ?? $product['brand_carta'] ?? 'Prodotto'));
                    $price = $product['prezzo'];
                    $pcat = !empty($product['nome']) ? 'manga' : (!empty($product['nome_personaggio']) ? 'figure' : 'carta');
                    $image = $product['image'];
                    ?>
                    <div class="scroll-item">
                        <div class="card pcard h-100">
                            <!-- Product image-->
                            <img class="pcard-img"
                                src="<?= !empty($image) ? $image : 'https://dummyimage.com/450x300/dee2e6/6c757d.jpg' ?>"
                                alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4 text-center">
                                <h5 class="fw-bolder text-truncate"><?= $name ?></h5>
                                <div>€<?= number_format($price, 2) ?></div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a class="btn btn-outline-dark btn-sm mt-auto"
                                        href="index.php?id=<?= $product['ID'] ?>&category=<?= $pcat ?>&action=prodotto">Dettagli</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php
}; ?>

<?php $renderFunction("Ultime Novità", "Manga in evidenza", $novita_products ?? [], "manga"); ?>
<?php $renderFunction("Figure", "Figure in primo piano", $figure_products ?? [], "figure"); ?>
<?php $renderFunction("Card Game", "Le nostre Carte", $cardgame_products ?? [], "carta"); ?>

<?php $this->stop() ?>