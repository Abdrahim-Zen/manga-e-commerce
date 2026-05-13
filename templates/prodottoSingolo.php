<?php
/** @var string $site_name */
$this->layout('layout', ['title' => $site_name])
    ?>

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
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="<?= $prodotto['image'] ?>" alt="..." />
            </div>
            <div class="col-md-6">
                <div class="small mb-1">
                    <?= $prodotto['codice'] ?>
                </div>
                <h1 class="display-5 fw-bolder"><?= $name ?></h1>
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h3>Prezzo:</h3>
                        <div class="fs-5 mb-5">
                            <span>$
                                <?= $price ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1"
                        style="max-width: 3rem" />
                    <button class="btn btn-outline-dark flex-shrink-0" type="button">
                        <i class="bi-cart-fill me-1"></i>
                        Add to cart
                    </button>
                </div>
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
                <h2 class="fw-bolder mb-4">
                    <?= $title ?>
                </h2>
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
                                        <h5 class="fw-bolder">
                                            <?= $name ?>
                                        </h5>
                                        <!-- Product price-->
                                        €
                                        <?= number_format($price, 2) ?>
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

</section>




<?php $this->stop() ?>