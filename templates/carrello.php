<?php
/** @var array $cart_items */
/** @var float $total */
/** @var string $site_name */
$this->layout('layout', ['title' => $site_name])
    ?>
<?php $this->start('main_content') ?>
<div class="container py-5">
    <!-- Page Header -->
    <h2 class="mb-4 fw-bold">Il tuo Carrello</h2>

    <div class="row">
        <!-- Left Side: Product List -->
        <div class="col-md-8">
            <?php if (empty($cart_items)): ?>
                <div class="alert alert-light text-center border py-5">
                    <i class="bi bi-cart-x fs-1 text-muted d-block mb-3"></i>
                    <p class="fs-5 text-muted">Il tuo carrello è vuoto.</p>
                    <a href="index.php?action=home" class="btn btn-secondary mt-2">Torna allo shopping</a>
                </div>
            <?php else: ?>
                <div class="card shadow-sm mb-4">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" class="ps-4">Prodotto</th>
                                        <th scope="col" class="text-center" style="width: 150px;">Quantità</th>
                                        <th scope="col" class="text-end" style="width: 120px;">Prezzo</th>
                                        <th scope="col" class="text-center" style="width: 80px;">Elimina</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($cart_items as $item): ?>
                                        <tr>
                                            <!-- Product Details -->
                                            <td class="ps-4 py-3">
                                                <div class="d-flex align-items-center">
                                                    <?php if (!empty($item['image'])): ?>
                                                        <img src="<?= htmlspecialchars($item['image']) ?>" alt="Immagine prodotto"
                                                            class="img-thumbnail me-3"
                                                            style="width: 60px; height: 80px; object-fit: contain;">
                                                    <?php endif; ?>
                                                    <div>
                                                        <h6 class="mb-1 fw-bold text-dark">
                                                            <?= htmlspecialchars($item['nome'] ?? 'Prodotto') ?>
                                                        </h6>
                                                        <small class="text-muted d-block">Codice:
                                                            <?= htmlspecialchars($item['codice'] ?? 'N/D') ?></small>
                                                    </div>
                                                </div>
                                            </td>

                                            <!-- Quantity Form -->
                                            <td class="text-center">
                                                <form action="index.php?action=cart&cart_action=updateQuantity" method="POST"
                                                    class="d-flex justify-content-center">
                                                    <input type="hidden" name="product_id" value="<?= $item['prodotto_id'] ?>">
                                                    <input type="number" name="quantity" value="<?= $item['quantita'] ?>"
                                                        min="1" class="form-control form-control-sm text-center"
                                                        style="width: 70px;" onchange="this.form.submit()">
                                                </form>
                                            </td>

                                            <!-- Line Item Price -->
                                            <td class="text-end fw-semibold text-dark">
                                                €<?= number_format($item['prezzo'] * $item['quantita'], 2, ',', '.') ?>
                                            </td>

                                            <!-- Remove Action Button -->
                                            <td class="text-center">
                                                <a href="index.php?action=cart&cart_action=removeFromCart&product_id=<?= $item['prodotto_id'] ?>"
                                                    class="btn btn-outline-danger btn-sm border-0"
                                                    onclick="return confirm('Vuoi rimuovere questo prodotto dal carrello?')">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Right Side: Order Summary & Checkout Button -->
        <div class="col-md-4">
            <div class="card shadow-sm border">
                <div class="card-header bg-dark text-white py-3">
                    <h5 class="card-title mb-0 fw-bold text-uppercase"
                        style="font-size: 0.95rem; letter-spacing: 0.5px;">Riepilogo Ordine</h5>
                </div>
                <div class="card-body">
                    <!-- Totals breakdown -->
                    <div class="d-flex justify-content-between mb-3 text-muted">
                        <span>Articoli nel carrello:</span>
                        <span class="fw-semibold text-dark"><?= count($cart_items ?? []) ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-3 text-muted">
                        <span>Spedizione:</span>
                        <span class="text-success fw-semibold">Gratuita</span>
                    </div>

                    <!-- Grand Total -->
                    <div class="d-flex justify-content-between mb-4 border-top pt-3">
                        <span class="h5 mb-0 fw-bold">Totale:</span>
                        <span class="h5 mb-0 fw-bold text-dark">€<?= number_format($total ?? 0, 2, ',', '.') ?></span>
                    </div>

                    <!-- Checkout Button -->
                    <?php if (!empty($cart_items)): ?>
                        <a href="index.php?action=cart&cart_action=checkout"
                            class="btn btn-dark w-100 py-2 fw-bold text-uppercase">
                            Procedi all'acquisto <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    <?php else: ?>
                        <button class="btn btn-secondary w-100 py-2 fw-bold text-uppercase" disabled>
                            Carrello vuoto
                        </button>
                    <?php endif; ?>

                    <!-- Continue Shopping Link -->
                    <div class="text-center mt-3">
                        <a href="index.php?action=home" class="text-decoration-none text-muted small">
                            <i class="bi bi-arrow-left me-1"></i> Continua lo shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->stop() ?>