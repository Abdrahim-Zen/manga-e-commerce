<?php
/** @var string $site_name */
$this->layout('layout', ['title' => $site_name])
    ?>

<?php $this->start('main_content') ?>


<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Shop in style</h1>
            <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
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
            <h2 class="fw-bolder mb-4"><?= $title ?></h2>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php foreach ($products as $product): ?>
                    <?php
                    $name = (!empty($product['nome']) ? $product['nome'] . (!empty($product['volume']) ? ' Vol.' . $product['volume'] :
                        '')
                        : ($product['nome_personaggio'] ?? $product['brand_carta'] ?? 'Prodotto'));
                    $price = $product['prezzo'];
                    $pcat = !empty($product['nome']) ? 'manga' : (!empty($product['nome_personaggio']) ? 'figure' : 'carta');
                    $image = $product['image'];
                    ?>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top"
                                src="<?= !empty($image) ? $image : 'https://dummyimage.com/450x300/dee2e6/6c757d.jpg' ?>"
                                alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?= $name ?></h5>
                                    <!-- Product price-->
                                    €<?= number_format($price, 2) ?>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto"
                                        href="index.php?id=<?= $product['ID'] ?>&category=<?= $pcat ?>&action=prodotto">View
                                        options</a>
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