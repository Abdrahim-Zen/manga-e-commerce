<?php
/** @var string $site_name */
/** @var string $category */
$this->layout('layout', ['title' => $site_name])?>
<?php $this->start('extra_styles')?>
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
</style>
<?php $this->stop() ?>

<?php 
$this->start('main_content')?>
<section class="py-4 bg-light">
    <div class="container">
         <h3 class="mb-3" >Catalogo <?=$category?></h3>
        <?php if (!empty($prodotti)): ?>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-5 g-4">
                <?php foreach ($prodotti as $product): ?>
                    <?php
                    $nome = $product['nome'] ?? $product['nome_personaggio'] ?? $product['brand_carta'] ?? 'Prodotto';
                    $price=$product['prezzo'];
                    $pcat = !empty($product['nome']) ? 'manga' : (!empty($product['nome_personaggio']) ? 'figure' : 'carta');
                    $image=$product['image'];
                    if (!empty($product['volume'])) $nome .= ' Vol. ' . $product['volume'];
                    $esaurito = $product['quantita'] <= 0;
                    ?>
                    <div class="col">
                        <div class="card pcard h-100">
                            <!-- Product image-->
                            <img class="pcard-img"
                                src="<?= !empty($image) ? $image : 'https://dummyimage.com/450x300/dee2e6/6c757d.jpg' ?>"
                                alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4 text-center">
                                <h5 class="fw-bolder text-truncate"><?= $nome ?></h5>
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
        <?php else: ?>
            <div class="text-center py-5">
                <i class="bi bi-box-seam display-1 text-muted"></i>
                <h3 class="mt-3">Nessun Prodotto</h3>
                <p class="text-secondary">Nessun prodotto trovato in questa categoria. Prova a esplorare le altre sezioni.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php $this->stop() ?>




