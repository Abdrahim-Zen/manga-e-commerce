<?php

/** @var string $title */
/** @var float $total */
$this->layout('layout', ['title' => $title]) ?>

<?php $this->start('extra_styles') ?>
<style>
    .cart-page {
        padding: 3rem 0 5rem;
    }

    .cart-page-header {
        margin-bottom: 2.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid var(--border);
    }

    .cart-page-header h1 {
        font-family: var(--font-display);
        font-size: 2.8rem;
        letter-spacing: 0.04em;
        color: var(--text);
        margin: 0;
    }

    .cart-count {
        font-size: 0.8rem;
        color: var(--text-dim);
        margin-top: 0.35rem;
    }

    /* Cart item */
    .cart-item {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 8px;
        padding: 1.25rem;
        display: flex;
        align-items: center;
        gap: 1.25rem;
        margin-bottom: 0.75rem;
        transition: border-color 0.2s;
    }

    .cart-item:hover {
        border-color: var(--border2);
    }

    .cart-item-img {
        width: 72px;
        height: 96px;
        object-fit: cover;
        border-radius: 5px;
        flex-shrink: 0;
        background: var(--surface2);
    }

    .cart-item-info {
        flex: 1;
        min-width: 0;
    }

    .cart-item-name {
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--text-dim);
        margin-bottom: 0.25rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .cart-item-code {
        font-size: 0.72rem;
        color: var(--muted);
        text-transform: uppercase;
        letter-spacing: 0.08em;
    }

    .cart-item-type {
        display: inline-block;
        background: var(--surface2);
        border: 1px solid var(--border2);
        border-radius: 3px;
        padding: 0.15em 0.5em;
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--text-dim);
        margin-top: 0.3rem;
    }

    .cart-item-price {
        font-family: var(--font-display);
        font-size: 1.5rem;
        color: var(--text-dim);
        letter-spacing: 0.04em;
        flex-shrink: 0;
        min-width: 80px;
    }

    /* Quantity input */
    .cart-qty-form {
        flex-shrink: 0;
    }

    .cart-qty-input {
        background: var(--surface2);
        border: 1px solid var(--border2);
        border-radius: 5px;
        color: var(--text-dim);
        text-align: center;
        width: 60px;
        height: 36px;
        font-size: 0.88rem;
        font-weight: 600;
        font-family: 'DM Sans', sans-serif;
        padding: 0 0.4rem;
        transition: border-color 0.2s;
    }

    .cart-qty-input:focus {
        border-color: var(--accent);
        outline: none;
        box-shadow: 0 0 0 2px rgba(162, 123, 92, 0.15);
    }

    /* Item subtotal */
    .cart-item-subtotal {
        font-family: var(--font-display);
        font-size: 1.4rem;
        color: var(--accent);
        letter-spacing: 0.04em;
        flex-shrink: 0;
        min-width: 80px;
        text-align: right;
    }

    /* Remove button */
    .btn-remove {
        background: transparent;
        border: 1px solid rgba(220, 53, 69, 0.3);
        border-radius: 5px;
        color: #dc3545;
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        text-decoration: none;
        flex-shrink: 0;
        transition: all 0.2s;
    }

    .btn-remove:hover {
        background: #dc3545;
        border-color: #dc3545;
        color: #fff;
    }

    /* Order summary */
    .order-summary {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 1.75rem;
        position: sticky;
        top: 90px;
    }

    .summary-title {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.18em;
        color: var(--text-dim);
        margin-bottom: 1.5rem;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.5rem 0;
        font-size: 0.88rem;
        color: var(--text-dim);
    }

    .summary-divider {
        border: none;
        border-top: 1px solid var(--border);
        margin: 1rem 0;
    }

    .summary-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 0.5rem;
    }

    .summary-total-label {
        font-size: 0.82rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        color: var(--text);
    }

    .summary-total-amount {
        font-family: var(--font-display);
        font-size: 2.2rem;
        color: var(--accent);
        letter-spacing: 0.04em;
        line-height: 1;
    }

    .btn-checkout {
        display: block;
        width: 100%;
        background: var(--accent);
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 1rem;
        font-size: 0.85rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        text-align: center;
        text-decoration: none;
        margin-top: 1.5rem;
        transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
    }

    .btn-checkout:hover {
        background: var(--accent-dark);
        transform: translateY(-1px);
        box-shadow: 0 8px 24px rgba(162, 123, 92, 0.3);
        color: #fff;
    }

    .btn-continue {
        display: block;
        width: 100%;
        background: transparent;
        border: 1px solid var(--border2);
        border-radius: 6px;
        padding: 0.75rem;
        font-size: 0.8rem;
        font-weight: 600;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        text-align: center;
        color: var(--text-dim);
        text-decoration: none;
        margin-top: 0.75rem;
        transition: all 0.2s;
    }

    .btn-continue:hover {
        border-color: var(--text-dim);
        color: var(--text);
    }

    /* Empty cart */
    .empty-cart {
        text-align: center;
        padding: 6rem 1rem;
    }

    .empty-cart i {
        font-size: 4rem;
        color: var(--muted);
        display: block;
        margin-bottom: 1.5rem;
    }

    .empty-cart h2 {
        font-family: var(--font-display);
        font-size: 2.2rem;
        color: var(--text-dim);
        margin-bottom: 0.75rem;
        letter-spacing: 0.04em;
    }

    .empty-cart p {
        color: var(--muted);
        font-size: 0.9rem;
        margin-bottom: 2rem;
    }

    .cart-qty-input::-webkit-outer-spin-button,
    .cart-qty-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }

    .cart-qty-input {
        -moz-appearance: textfield;
    }

    /* Payment options */
    .payment-option {
        display: flex;
        align-items: center;
        gap: 0.65rem;
        padding: 0.75rem 1rem;
        background: var(--surface2);
        border: 1px solid var(--border2);
        border-radius: 6px;
        cursor: pointer;
        font-size: 0.84rem;
        font-weight: 600;
        color: var(--text-dim);
        transition: all 0.2s;
        user-select: none;
    }

    .payment-option:hover {
        border-color: rgba(162, 123, 92, 0.4);
        color: var(--text);
    }

    .payment-option.selected {
        border-color: var(--accent);
        background: rgba(162, 123, 92, 0.08);
        color: var(--text);
    }

    .payment-option i {
        font-size: 1.1rem;
        color: var(--accent);
    }

    .btn-checkout.disabled-checkout {
        opacity: 0.45;
        pointer-events: none;
        cursor: not-allowed;
    }
</style>
<?php $this->stop() ?>

<?php $this->start('main_content') ?>

<div class="cart-page">
    <div class="container">

        <div class="cart-page-header">
            <h1>Il Tuo Carrello</h1>
            <?php if (!empty($cart_items)): ?>
                <p class="cart-count"><?= count($cart_items) ?> articol<?= count($cart_items) === 1 ? 'o' : 'i' ?></p>
            <?php endif; ?>
        </div>

        <?php if (!empty($cart_items)): ?>
            <div class="row g-4">

                <!-- Items -->
                <div class="col-lg-8">
                    <?php foreach ($cart_items as $item): ?>
                        <div class="cart-item">
                            <img src="<?= $this->e($item['image']) ?>"
                                class="cart-item-img"
                                alt="<?= $this->e($item['nome']) ?>">

                            <div class="cart-item-info">
                                <p class="cart-item-name"><?= $this->e($item['nome']) ?></p>
                                <p class="cart-item-code">COD: <?= $this->e($item['codice']) ?></p>
                                <?php if (isset($item['tipo_prodotto'])): ?>
                                    <span class="cart-item-type"><?= $this->e($item['tipo_prodotto']) ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="cart-item-price">€<?= number_format($item['prezzo'], 2) ?></div>

                            <form action="index.php?action=cart&cart_action=updateQuantity" method="POST" class="cart-qty-form">
                                <input type="number"
                                    name="quantity"
                                    value="<?= $item['quantita'] ?>"
                                    min="1"
                                    class="cart-qty-input"
                                    onchange="this.form.submit()"
                                    title="Quantità">
                                <input type="hidden" name="product_id" value="<?= $item['prodotto_id'] ?>">
                            </form>

                            <div class="cart-item-subtotal">
                                €<?= number_format($item['prezzo'] * $item['quantita'], 2) ?>
                            </div>

                            <a href="index.php?action=cart&cart_action=removeFromCart&product_id=<?= $item['prodotto_id'] ?>"
                                class="btn-remove"
                                title="Rimuovi">
                                <i class="bi bi-trash"></i>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Summary -->
                <div class="col-lg-4">
                    <div class="order-summary">
                        <p class="summary-title">Riepilogo Ordine</p>

                        <?php foreach ($cart_items as $item): ?>
                            <div class="summary-row">
                                <span style="overflow:hidden; text-overflow:ellipsis; white-space:nowrap; max-width:60%;">
                                    <?= $this->e($item['nome']) ?> ×<?= $item['quantita'] ?>
                                </span>
                                <span>€<?= number_format($item['prezzo'] * $item['quantita'], 2) ?></span>
                            </div>
                        <?php endforeach; ?>

                        <hr class="summary-divider">

                        <div class="summary-row">
                            <span>Spedizione</span>
                            <span><?= $total >= 50 ? '<span style="color:#22c55e;">Gratuita</span>' : '€4.90' ?></span>
                        </div>

                        <hr class="summary-divider">

                        <div class="summary-total">
                            <span class="summary-total-label">Totale</span>
                            <span class="summary-total-amount">€<?= number_format($total, 2) ?></span>
                        </div>

                        <!-- Metodo di pagamento -->
                        <div style="margin-top:1.5rem;">
                            <p style="font-size:0.7rem; font-weight:700; text-transform:uppercase; letter-spacing:0.15em; color:var(--text-dim); margin-bottom:0.75rem;">
                                Metodo di Pagamento
                            </p>
                            <div style="display:flex; flex-direction:column; gap:0.5rem;" id="payment-options">
                                <label class="payment-option" data-value="1">
                                    <input type="radio" name="metodo_pagamento" value="1" style="display:none;">
                                    <i class="bi bi-paypal"></i>
                                    PayPal
                                </label>
                                <label class="payment-option" data-value="2">
                                    <input type="radio" name="metodo_pagamento" value="2" style="display:none;">
                                    <i class="bi bi-credit-card"></i>
                                    Carta di Credito
                                </label>
                            </div>
                        </div>

                        <a href="#" class="btn-checkout" id="btn-ordina">
                            <i class="bi bi-bag-check me-2"></i>Procedi all'Acquisto
                        </a>
                        <a href="index.php?action=home" class="btn-continue">
                            ← Continua lo Shopping
                        </a>

                        <?php if ($total < 50): ?>
                            <p style="font-size:0.75rem; color:var(--muted); text-align:center; margin-top:1rem;">
                                Aggiungi €<?= number_format(50 - $total, 2) ?> per la spedizione gratuita
                            </p>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        <?php else: ?>
            <div class="empty-cart">
                <i class="bi bi-bag-x"></i>
                <h2>Carrello Vuoto</h2>
                <p>Non hai ancora aggiunto nessun prodotto al carrello.</p>
                <a href="index.php?action=home" class="btn-checkout" style="display:inline-block; width:auto; padding:0.9rem 2.5rem;">
                    Inizia lo Shopping →
                </a>
            </div>
        <?php endif; ?>

    </div>
</div>

<?php $this->stop() ?>

<?php $this->start('page_scripts') ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const options = document.querySelectorAll('.payment-option');
        const btnOrdina = document.getElementById('btn-ordina');

        // Bottone disabilitato finché non si sceglie un metodo
        if (btnOrdina) btnOrdina.classList.add('disabled-checkout');

        options.forEach(opt => {
            opt.addEventListener('click', function() {
                // Deseleziona tutti
                options.forEach(o => {
                    o.classList.remove('selected');
                    o.querySelector('input[type=radio]').checked = false;
                });

                // Seleziona quello cliccato
                this.classList.add('selected');
                const radio = this.querySelector('input[type=radio]');
                radio.checked = true;

                // Aggiorna href con il metodo scelto
                if (btnOrdina) {
                    btnOrdina.classList.remove('disabled-checkout');
                    btnOrdina.href = 'index.php?action=cart&cart_action=ordina&metodo_pagamento=' + radio.value;
                }
            });
        });
    });
</script>
<?php $this->stop() ?>