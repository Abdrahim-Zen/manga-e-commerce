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

    .product-img-wrap {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 10px;
        overflow: hidden;
        position: sticky;
        top: 90px;
    }

    .product-img-wrap img {
        width: 100%;
        max-height: 520px;
        object-fit: contain;
        display: block;
        padding: 1.5rem;
        background: var(--surface);
    }
</style>
<?php $this->stop() ?>

<?php $this->start('main_content') ?>



<!-- Product section-->
<?php /** @var array $prodotto */
/** @var string $categoria */ ?>
<?php switch ($categoria) {
    case 'manga':
        $name = $prodotto['nome'] . $prodotto['volume'];
        $price = $prodotto['prezzo'];
        break;
    case 'figure':
        $name = $prodotto['nome_personaggio'];
        $price = $prodotto['prezzo'];
        break;
    case 'carta':
        $name = $prodotto['brand_carta'];
        $price = $prodotto['prezzo'];
        break;

} ?>
<section class="py-5">
    <div class="container px-3 px-lg-4 my-5">
        <div class="row g-5">
            <div class="col-lg-5 product-img-col">
                <div class="product-img-wrap">
                    <img src="<?= $prodotto['image'] ?>" alt="Immagine prodotto">
                </div>
            </div>
            <div class="col-lg-6 offset-lg-1 pt-5">

                <h1 class="display-5 fw-bolder"><?= $name ?></h1>
                <div class="small mb-2">
                    <span style="font-weight:bold">CODICE:</span>
                    <?= $prodotto['codice'] ?>
                </div>

                <div class="row align-items-center">
                    <div class="row-md-2">
                        <h3>Prezzo:</h3>
                        <div class="fs-5 mb-5">
                            <span>$
                                <?= $price ?>
                            </span>
                        </div>
                    </div>
                </div>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="d-flex">
                        <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1"
                            style="max-width: 3rem" />
                        <button class="btn btn-outline-dark flex-shrink-0" type="button">
                            <i class="bi-cart-fill me-1"></i>
                            Add to cart
                        </button>
                    </div>
                <?php else: ?>
                    <a class="btn btn-outline-dark flex-shrink-0" href="index.php?action=showLogin">Accedi per
                        acquistare</a>
                <?php endif ?>
            </div>
        </div>
    </div>
</section>
<!-- Related items section-->
<section class="py-5 bg-light">
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

</section>




<?php $this->stop() ?>