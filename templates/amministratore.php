<?php
/** @var string $site_name */
/** @var array $recent_orders */
/** @var array $inventory_items */
$this->layout('layout', ['title' => $site_name])
    ?>

<?php $this->start('main_content') ?>

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-5 pb-3 border-bottom">
        <div>
            <h1 class="display-5 fw-bold mb-0">Dashboard Admin</h1>
            <p class="text-muted">Gestione vendite e magazzino</p>
        </div>
        <div>
            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addProductModal">
                <i class="bi bi-plus-lg me-1"></i> Nuovo Prodotto
            </button>
        </div>
    </div>


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
                                                <button class="btn btn-sm btn-light edit-product-btn" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#editProductModal"
                                                    data-id="<?= $product['ID'] ?>"
                                                    data-nome="<?= $product['manga_nome'] ?? $product['nome_personaggio'] ?? $product['carta_set'] ?? 'Prodotto' ?>"
                                                    data-quantita="<?= $product['quantita'] ?>">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
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

<!-- modulo Nuovo Prodotto -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title fw-bold" id="addProductModalLabel">Aggiungi Nuovo Prodotto</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="index.php?action=dashboard&sub_action=addProduct" method="POST" enctype="multipart/form-data">
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <!-- Campi Comuni -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nome Prodotto</label>
                            <input type="text" name="prodotti[0][name]" class="form-control" placeholder="es. One Piece"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Codice (SKU)</label>
                            <input type="text" name="prodotti[0][sku]" class="form-control" placeholder="es. MANG001"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Tipo Prodotto</label>
                            <select name="prodotti[0][category]" id="productTypeSelect" class="form-select" required>
                                <option value="" selected disabled>Seleziona tipo...</option>
                                <option value="manga">Manga</option>
                                <option value="figure">Figure</option>
                                <option value="carta">Carte</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Immagine</label>
                            <input type="file" name="prodotti[0][image]" class="form-control" accept="image/*" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Descrizione</label>
                            <textarea name="prodotti[0][description]" class="form-control" rows="2"
                                placeholder="Descrizione del prodotto..."></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Prezzo (€)</label>
                            <input type="number" step="0.01" min="0" name="prodotti[0][price]" class="form-control"
                                placeholder="0.00" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Stock (Quantità)</label>
                            <input type="number" step="1" min="1" name="prodotti[0][stock]" class="form-control"
                                placeholder="0" required>
                        </div>

                        <hr class="my-4">

                        <!-- Campi Specifici Manga -->
                        <div id="mangaFields" class="specific-fields" style="display: none;">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Volume</label>
                                    <input type="number" name="prodotti[0][volume]" class="form-control"
                                        placeholder="1">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Genere</label>
                                    <input type="text" name="prodotti[0][manga_genre]" class="form-control"
                                        placeholder="es. Shonen">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Stato</label>
                                    <select name="prodotti[0][manga_status]" class="form-select">
                                        <option value="normale">Normale</option>
                                        <option value="novita">Novità</option>
                                        <option value="in_sconto">In Sconto</option>
                                        <option value="esaurito">Esaurito</option>
                                        <option value="in_arrivo">In Arrivo</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Campi Specifici Figure -->
                        <div id="figureFields" class="specific-fields" style="display: none;">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Nome Personaggio</label>
                                    <input type="text" name="prodotti[0][nome_personaggio]" class="form-control"
                                        placeholder="es. Monkey D. Luffy">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Nome Serie</label>
                                    <input type="text" name="prodotti[0][nome_serie]" class="form-control"
                                        placeholder="es. One Piece">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Altezza (cm)</label>
                                    <input type="number" step="0.1" name="prodotti[0][altezza_figure]"
                                        class="form-control" placeholder="0.0">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Larghezza (cm)</label>
                                    <input type="number" step="0.1" name="prodotti[0][larghezza_figure]"
                                        class="form-control" placeholder="0.0">
                                </div>
                            </div>
                        </div>


                        <div id="cardFields" class="specific-fields" style="display: none;">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label fw-bold">Brand Carta</label>
                                    <input type="text" name="prodotti[0][brand_carta]" class="form-control"
                                        placeholder="es. Pokémon, Yu-Gi-Oh!">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                    <button type="submit" class="btn btn-dark">Salva Prodotto</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- Modal Modifica Prodotto -->
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title fw-bold" id="editProductModalLabel">Gestisci Prodotto</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <h6 class="mb-3">Prodotto: <span id="editProductName" class="fw-bold"></span></h6>
                    
                    <!-- Form Aggiorna Quantità -->
                    <form action="index.php?action=dashboard&sub_action=updateQuantita" method="POST" class="mb-4">
                        <input type="hidden" name="prodotto_id" id="editProductId">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nuova Quantità</label>
                            <input type="number" name="nuova_quantita" id="editProductQty" class="form-control" min="0" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Aggiorna Quantità</button>
                    </form>

                    <hr>

                    <!-- Form Elimina Prodotto -->
                    <form action="index.php?action=dashboard&sub_action=eliminaProdotto" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare definitivamente questo prodotto?');">
                        <input type="hidden" name="prodotto_id" id="deleteProductId">
                        <div class="text-center">
                            <p class="text-muted small mb-3">Attenzione: l'eliminazione è irreversibile.</p>
                            <button type="submit" class="btn btn-outline-danger w-100">Elimina Prodotto</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Logica per il Modal Nuovo Prodotto (Gia' esistente)
        const typeSelect = document.getElementById('productTypeSelect');
        const mangaFields = document.getElementById('mangaFields');
        const figureFields = document.getElementById('figureFields');
        const cardFields = document.getElementById('cardFields');

        if(typeSelect) {
            typeSelect.addEventListener('change', function () {
                mangaFields.style.display = 'none';
                figureFields.style.display = 'none';
                cardFields.style.display = 'none';

                if (this.value === 'manga') {
                    mangaFields.style.display = 'block';
                } else if (this.value === 'figure') {
                    figureFields.style.display = 'block';
                } else if (this.value === 'carta') {
                    cardFields.style.display = 'block';
                }
            });
        }

        // Logica per il Modal Modifica Prodotto
        const editModal = document.getElementById('editProductModal');
        if (editModal) {
            editModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const id = button.getAttribute('data-id');
                const nome = button.getAttribute('data-nome');
                const quantita = button.getAttribute('data-quantita');

                document.getElementById('editProductId').value = id;
                document.getElementById('deleteProductId').value = id;
                document.getElementById('editProductName').textContent = nome;
                document.getElementById('editProductQty').value = quantita;
            });
        }
    });
</script>

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

    .specific-fields {
        animation: fadeIn 0.3s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<?php $this->stop() ?>