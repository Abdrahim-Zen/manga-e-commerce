<?php
/** @var string $site_name */
/** @var array $recent_orders */
/** @var array $inventory_items */
$this->layout('layout', ['title' => $site_name])
    ?>

<?php $this->start('main_content') ?>

<div class="container py-5">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-5 pb-3 border-bottom">
        <div>
            <h1 class="display-5 fw-bold mb-0">Dashboard Admin</h1>
            <p class="text-muted">Gestione vendite e magazzino</p>
        </div>
        <div>
            <button class="btn btn-dark">
                <i class="bi bi-plus-lg me-1"></i> Nuovo Prodotto
            </button>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-3 me-3">
                            <i class="bi bi-cart-check fs-4"></i>
                        </div>
                        <h6 class="card-subtitle text-muted mb-0">Vendite Manga</h6>
                    </div>
                    <h3 class="card-title fw-bold mb-0">
                        <?= number_format($ricavomanga, 2) ?> €
                    </h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-3 me-3">
                            <i class="bi bi-cart-check fs-4"></i>
                        </div>
                        <h6 class="card-subtitle text-muted mb-0">Vendite Figure</h6>
                    </div>
                    <h3 class="card-title fw-bold mb-0">
                        <?= number_format($ricavofigure, 2) ?> €
                    </h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-3 me-3">
                            <i class="bi bi-cart-check fs-4"></i>
                        </div>
                        <h6 class="card-subtitle text-muted mb-0">Vendite Carte</h6>
                    </div>
                    <h3 class="card-title fw-bold mb-0">
                        <?= number_format($ricavocarte, 2) ?> €
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Inventory Tracker -->
        <div class="col-lg-12">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">Stato Magazzino</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">Prodotto</th>
                                    <th>Quantità</th>
                                    <th class="text-end pe-4">Azione</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($prodotti)): ?>
                                    <!-- Esempio di riga dati se l'array è vuoto -->
                                    <?php foreach ($prodotti as $product): ?>
                                        <tr>
                                            <td class="ps-4">
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <div class="small fw-bold">
                                                            <?= $product['manga_nome'] ?? $product['nome_personaggio'] ?? $product['carta_set'] ?? 'Prodotto' ?>
                                                        </div>
                                                        <div class="text-muted x-small">
                                                            <?= isset($product['manga_nome']) && $product['manga_nome'] ? 'Manga' : (isset($product['nome_personaggio']) && $product['nome_personaggio'] ? 'Figure' : (isset($product['carta_set']) && $product['carta_set'] ? 'Carta' : 'Prodotto')) ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-danger"><?= $product['quantita'] ?> rimasti</span>
                                            </td>
                                            <td class="text-end pe-4">
                                                <button class="btn btn-sm btn-light"><i class="bi bi-pencil"></i></button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3" class="text-center py-4 text-muted">
                                            Nessun prodotto trovato nel magazzino.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .x-small {
        font-size: 0.75rem;
    }

    .card {
        transition: transform 0.2s;
    }

    .card:hover {
        transform: translateY(-3px);
    }
</style>

<?php $this->stop() ?>