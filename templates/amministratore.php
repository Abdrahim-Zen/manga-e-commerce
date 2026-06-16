<?php $this->layout('layout', ['title' => 'Dashboard Amministratore - Manga Xeno']) ?>

<?php $this->start('extra_styles') ?>
<style>
    /* ─── ADMIN LAYOUT ─── */
    .admin-wrap {
        display: flex;
        min-height: calc(100vh - 64px);
    }

    /* Sidebar */
    .admin-sidebar {
        width: 220px;
        flex-shrink: 0;
        background: var(--surface);
        border-right: 1px solid var(--border);
        padding: 1.75rem 0;
        position: sticky;
        top: 64px;
        height: calc(100vh - 64px);
        overflow-y: auto;
    }

    .sidebar-label {
        font-size: 0.62rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.2em;
        color: var(--muted);
        padding: 0 1.25rem;
        margin-bottom: 0.6rem;
        margin-top: 1.5rem;
    }

    .sidebar-label:first-child {
        margin-top: 0;
    }

    .sidebar-link {
        display: flex;
        align-items: center;
        gap: 0.65rem;
        padding: 0.6rem 1.25rem;
        font-size: 0.84rem;
        font-weight: 500;
        color: var(--text-dim);
        text-decoration: none;
        transition: all 0.18s;
        border-left: 2px solid transparent;
        cursor: pointer;
        background: none;
        border-top: none;
        border-right: none;
        border-bottom: none;
        width: 100%;
        text-align: left;
    }

    .sidebar-link:hover {
        color: var(--text);
        background: rgba(255, 255, 255, 0.04);
    }

    .sidebar-link.active {
        color: var(--accent);
        border-left-color: var(--accent);
        background: rgba(162, 123, 92, 0.07);
    }

    .sidebar-link i {
        font-size: 0.95rem;
        flex-shrink: 0;
    }

    .sidebar-link.danger {
        color: #ef4444;
    }

    .sidebar-link.danger:hover {
        background: rgba(239, 68, 68, 0.08);
    }

    /* Main content */
    .admin-main {
        flex: 1;
        min-width: 0;
        padding: 2.5rem;
    }

    /* Page title */
    .admin-page-title {
        font-family: var(--font-display);
        font-size: 2.4rem;
        letter-spacing: 0.04em;
        color: var(--text);
        margin-bottom: 2.5rem;
    }

    /* Section titles */
    .admin-section-title {
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.2em;
        color: var(--accent);
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .admin-section-title::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--border);
    }

    /* KPI Cards */
    .kpi-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 3rem;
    }

    .kpi-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 8px;
        padding: 1.25rem 1.5rem;
        transition: border-color 0.2s, transform 0.2s;
    }

    .kpi-card:hover {
        border-color: var(--border2);
        transform: translateY(-2px);
    }

    .kpi-label {
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        color: var(--muted);
        margin-bottom: 0.75rem;
    }

    .kpi-value {
        font-family: var(--font-display);
        font-size: 2.2rem;
        letter-spacing: 0.04em;
        color: var(--text-dim);
        line-height: 1;
    }

    .kpi-icon {
        float: right;
        font-size: 1.8rem;
        opacity: 0.2;
        margin-top: -0.25rem;
    }

    .kpi-card.manga .kpi-icon {
        color: var(--text-dim);
    }

    .kpi-card.figure .kpi-icon {
        color: var(--text-dim);
    }

    .kpi-card.carte .kpi-icon {
        color: var(--text-dim);
    }

    .kpi-sub {
        font-size: 0.75rem;
        color: var(--text-dim);
        margin-top: 0.5rem;
    }

    /* Table */
    .admin-table-wrap {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 3rem;
    }

    .admin-table {
        width: 100%;
        border-collapse: collapse;
    }

    .admin-table thead th {
        background: var(--surface2);
        padding: 0.75rem 1rem;
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        color: var(--muted);
        border-bottom: 1px solid var(--border);
        white-space: nowrap;
    }

    .admin-table tbody td {
        padding: 0.85rem 1rem;
        font-size: 0.84rem;
        color: var(--text-dim);
        border-bottom: 1px solid var(--border);
        vertical-align: middle;
    }

    .admin-table tbody tr:last-child td {
        border-bottom: none;
    }

    .admin-table tbody tr:hover td {
        background: rgba(255, 255, 255, 0.02);
    }

    .table-id {
        font-family: monospace;
        font-size: 0.78rem;
        color: var(--muted);
    }

    .table-amount {
        font-family: var(--font-display);
        font-size: 1.25rem;
        color: var(--text-dim);
        letter-spacing: 0.04em;
    }

    .table-date {
        font-size: 0.78rem;
    }

    /* Products list */
    .products-toolbar {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex-wrap: wrap;
        margin-bottom: 1.25rem;
    }

    .filter-chip {
        background: var(--surface2);
        border: 1px solid var(--border2);
        border-radius: 4px;
        padding: 0.35em 0.9em;
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: var(--text-dim);
        cursor: pointer;
        transition: all 0.2s;
    }

    .filter-chip:hover {
        border-color: var(--accent);
        color: var(--accent);
    }

    .filter-chip.active {
        background: rgba(162, 123, 92, 0.12);
        border-color: var(--accent);
        color: var(--accent);
    }

    .btn-add-product {
        margin-left: auto;
        background: var(--accent);
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 0.45rem 1rem;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        cursor: pointer;
        transition: background 0.2s;
        font-family: 'DM Sans', sans-serif;
    }

    .btn-add-product:hover {
        background: var(--accent-dark);
    }

    /* Product row */
    .product-row {
        display: flex;
        align-items: center;
        gap: 1rem;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 7px;
        padding: 0.85rem 1rem;
        margin-bottom: 0.5rem;
        transition: border-color 0.2s;
    }

    .product-row:hover {
        border-color: var(--border2);
    }

    .product-row .pr-name {
        flex: 1;
        min-width: 0;
    }

    .product-row .pr-title {
        font-size: 0.88rem;
        font-weight: 600;
        color: var(--text-dim);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .product-row .pr-sub {
        font-size: 0.72rem;
        color: var(--muted);
        margin-top: 0.1rem;
    }

    .product-row .pr-price {
        font-family: var(--font-display);
        font-size: 1.3rem;
        color: var(--text-dim);
        letter-spacing: 0.04em;
        flex-shrink: 0;
        min-width: 90px;
    }

    .pr-badge {
        flex-shrink: 0;
        font-size: 0.62rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        padding: 0.25em 0.65em;
        border-radius: 3px;
    }

    .pr-badge.manga {
        background: rgba(34, 197, 94, 0.15);
        color: #22c55e;
    }

    .pr-badge.figure {
        background: rgba(56, 189, 248, 0.15);
        color: #38bdf8;
    }

    .pr-badge.carta {
        background: rgba(245, 158, 11, 0.15);
        color: #f59e0b;
    }

    .pr-badge.default {
        background: var(--surface2);
        color: var(--text-dim);
    }

    .pr-actions {
        display: flex;
        gap: 0.4rem;
        flex-shrink: 0;
    }

    .btn-pr-edit {
        background: var(--surface2);
        border: 1px solid var(--border2);
        border-radius: 4px;
        color: var(--text-dim);
        font-size: 0.72rem;
        padding: 0.3em 0.7em;
        cursor: pointer;
        font-family: 'DM Sans', sans-serif;
        transition: all 0.2s;
    }

    .btn-pr-edit:hover {
        border-color: var(--accent);
        color: var(--accent);
    }

    .btn-pr-delete {
        background: transparent;
        border: 1px solid rgba(239, 68, 68, 0.3);
        border-radius: 4px;
        color: #ef4444;
        font-size: 0.72rem;
        padding: 0.3em 0.7em;
        cursor: pointer;
        font-family: 'DM Sans', sans-serif;
        transition: all 0.2s;
    }

    .btn-pr-delete:hover {
        background: rgba(239, 68, 68, 0.1);
        border-color: #ef4444;
    }

    /* Modal */
    .modal-content {
        background: var(--surface) !important;
        border: 1px solid var(--border2) !important;
        border-radius: 10px !important;
        color: var(--text-dim);
    }

    .modal-header {
        border-bottom: 1px solid var(--border) !important;
        padding: 1.25rem 1.5rem !important;
    }

    .modal-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--text-dim) !important;
    }

    .modal-body {
        padding: 1.5rem !important;
    }

    .modal-footer {
        border-top: 1px solid var(--border) !important;
        padding: 1rem 1.5rem !important;
    }

    .btn-close {
        filter: invert(1) brightness(0.6);
    }

    .modal-section-label {
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.18em;
        color: var(--accent);
        margin: 1.25rem 0 0.75rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid var(--border);
    }

    /* Empty state */
    .admin-empty {
        text-align: center;
        padding: 3rem;
        color: var(--muted);
    }

    .admin-empty i {
        font-size: 2.5rem;
        display: block;
        margin-bottom: 0.75rem;
    }

    .form-control[type="number"]::-webkit-outer-spin-button,
    .form-control[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }
</style>
<?php $this->stop() ?>

<?php $this->start('main_content') ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        /* ─ Category toggle ─ */
        function toggleFieldsBlock(block, selected) {
            const fields = {
                'manga': block.querySelector('.mangaFields'),
                'figure': block.querySelector('.figureFields'),
                'carta': block.querySelector('.carteFields')
            };
            const allInputs = block.querySelectorAll('.mangaFields input, .mangaFields select, .figureFields input, .figureFields select, .carteFields input, .carteFields select');

            allInputs.forEach(i => {
                i.removeAttribute('required');
                if (i.type === 'text' || i.type === 'number') i.value = '';
            });

            for (const key in fields) {
                if (!fields[key]) continue;
                if (key === selected) {
                    fields[key].style.display = 'block';
                    const reqCls = {
                        manga: '.req-manga',
                        figure: '.req-figure',
                        carta: '.req-carta'
                    } [key];
                    const el = block.querySelector(reqCls);
                    if (el) el.required = true;
                } else {
                    fields[key].style.display = 'none';
                }
            }
        }

        document.getElementById('productsContainer')?.addEventListener('change', function(e) {
            if (e.target.classList.contains('category-select')) {
                const block = e.target.closest('.product-entry');
                toggleFieldsBlock(block, e.target.value);
            }
        });

        /* Dynamic form adding */
        let productIndex = 1;
        document.getElementById('btnAddProductRow')?.addEventListener('click', function() {
            const container = document.getElementById('productsContainer');
            const template = container.querySelector('.product-entry').cloneNode(true);

            template.querySelectorAll('input, select, textarea').forEach(el => {
                if (el.name) {
                    el.name = el.name.replace(/prodotti\[\d+\]/, `prodotti[${productIndex}]`);
                }
                if (el.type !== 'button' && el.type !== 'submit' && el.tagName !== 'SELECT' && el.type !== 'file') {
                    el.value = '';
                }
                if (el.type === 'file') {
                    el.value = null;
                }
                if (el.tagName === 'SELECT') {
                    el.selectedIndex = 0;
                }
                if (el.type === 'number' && el.classList.contains('default-one')) {
                    el.value = '1';
                }
            });

            template.querySelectorAll('.mangaFields, .figureFields, .carteFields').forEach(el => el.style.display = 'none');

            const btnRemove = template.querySelector('.btn-remove-product');
            if (btnRemove) btnRemove.style.display = 'block';

            container.appendChild(template);
            productIndex++;
        });

        const firstSelect = document.querySelector('.category-select');
        if (firstSelect && firstSelect.value) {
            toggleFieldsBlock(firstSelect.closest('.product-entry'), firstSelect.value);
        }

        /* ─ Product filter ─ */
        const filterChips = document.querySelectorAll('.filter-chip[data-filter]');
        const productRows = document.querySelectorAll('.product-item');

        function applyFilter(filter) {
            filterChips.forEach(c => c.classList.remove('active'));
            document.querySelector(`.filter-chip[data-filter="${filter}"]`)?.classList.add('active');
            productRows.forEach(row => {
                row.style.display = (filter === 'all' || row.dataset.category === filter) ? '' : 'none';
            });
        }

        filterChips.forEach(chip => chip.addEventListener('click', () => applyFilter(chip.dataset.filter)));
        applyFilter('all');
    });
</script>

<div class="admin-wrap">

    <!-- Sidebar -->
    <aside class="admin-sidebar">
        <p class="sidebar-label">Dashboard</p>
        <a href="#analytics" class="sidebar-link active">
            <i class="bi bi-bar-chart"></i> Analytics
        </a>
        <a href="#orders" class="sidebar-link">
            <i class="bi bi-receipt"></i> Ordini
        </a>

        <p class="sidebar-label">Prodotti</p>
        <a href="#products" class="sidebar-link">
            <i class="bi bi-grid"></i> Gestione
        </a>
        <button class="sidebar-link" data-bs-toggle="modal" data-bs-target="#addObjectModal">
            <i class="bi bi-plus-square"></i> Aggiungi
        </button>

        <p class="sidebar-label">Account</p>
        <a href="index.php?action=handleLogout" class="sidebar-link danger">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </aside>

    <!-- Main -->
    <main class="admin-main">

        <h1 class="admin-page-title">Dashboard</h1>


        <!-- ─ Analytics ─ -->
        <section id="analytics">
            <p class="admin-section-title">Performance Vendite</p>

            <div class="kpi-grid">
                <?php
                $kpis = [
                    ['label' => 'Ricavo Manga', 'val' => $ricavomanga, 'icon' => 'book', 'cls' => 'manga'],
                    ['label' => 'Ricavo Figure', 'val' => $ricavofigure, 'icon' => 'person-badge', 'cls' => 'figure'],
                    ['label' => 'Ricavo Carte', 'val' => $ricavocarte, 'icon' => 'card-text', 'cls' => 'carte'],
                ];
                foreach ($kpis as $k): ?>
                    <div class="kpi-card <?= $k['cls'] ?>">
                        <div class="kpi-label">
                            <?= $k['label'] ?>
                            <i class="bi bi-<?= $k['icon'] ?> kpi-icon float-end"></i>
                        </div>
                        <div class="kpi-value">€ <?= number_format($k['val'], 2, ',', '.') ?></div>
                        <div class="kpi-sub">Entrate totali</div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Orders table -->
            <p class="admin-section-title" id="orders">Ordini Recenti</p>

            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID Ordine</th>
                            <th>Importo</th>
                            <th>Quantità</th>
                            <th>Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($ordini)): ?>
                            <?php foreach ($ordini as $ordine): ?>
                                <tr>
                                    <td><span class="table-id">#<?= $this->e($ordine['ID']) ?></span></td>
                                    <td><span class="table-amount">€ <?= number_format($ordine['prezzo_unitario_venduto'] ?? 0, 2, ',', '.') ?></span></td>
                                    <td style="color:var(--text-dim);"><?= $ordine['quantita'] ?></td>
                                    <td class="table-date"><?= date('d/m/Y H:i', strtotime($ordine['data_ordine'])) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4">
                                    <div class="admin-empty">
                                        <i class="bi bi-inbox"></i>
                                        Nessun ordine trovato
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- ─ Products ─ -->
        <section id="products">
            <p class="admin-section-title">Gestione Prodotti</p>

            <div class="products-toolbar">
                <button class="filter-chip active" data-filter="all">Tutti</button>
                <button class="filter-chip" data-filter="manga">Manga</button>
                <button class="filter-chip" data-filter="figure">Figure</button>
                <button class="filter-chip" data-filter="carta">Carte</button>
                <button class="btn-add-product" data-bs-toggle="modal" data-bs-target="#addObjectModal">
                    <i class="bi bi-plus me-1"></i>Aggiungi Prodotto
                </button>
            </div>

            <?php if (!empty($prodotti)): ?>
                <?php foreach ($prodotti as $product): ?>
                    <?php
                    $categoria = '';
                    $nome_prodotto = '';
                    $dettagli = '';
                    $badgeCls = 'default';

                    if (!empty($product['manga_nome'])) {
                        $categoria = 'manga';
                        $nome_prodotto = $product['manga_nome'] . (!empty($product['manga_volume']) ? ' Vol. ' . $product['manga_volume'] : '');
                        $badgeCls = 'manga';
                        $dettagli = 'Genere: ' . htmlspecialchars($product['manga_genere'] ?? '—');
                    } elseif (!empty($product['nome_personaggio'])) {
                        $categoria = 'figure';
                        $nome_prodotto = htmlspecialchars($product['nome_personaggio']) . (!empty($product['nome_serie']) ? ' (' . htmlspecialchars($product['nome_serie']) . ')' : '');
                        $badgeCls = 'figure';
                        $dettagli = htmlspecialchars($product['altezza_figure'] ?? '') . '×' . htmlspecialchars($product['larghezza_figure'] ?? '') . ' cm';
                    } elseif (!empty($product['carta_set'])) {
                        $categoria = 'carta';
                        $nome_prodotto = htmlspecialchars($product['carta_set']);
                        $badgeCls = 'carta';
                    } else {
                        $categoria = 'non-classificato';
                        $nome_prodotto = 'Prodotto ID ' . htmlspecialchars($product['ID']);
                    }
                    ?>
                    <div class="product-row product-item" data-category="<?= htmlspecialchars($categoria) ?>">

                        <div class="pr-name">
                            <div class="pr-title">
                                <span style="font-size:0.7rem; color:var(--muted); margin-right:0.4rem;">#<?= htmlspecialchars($product['ID']) ?></span>
                                <?= $nome_prodotto ?>
                            </div>
                            <?php if ($dettagli): ?>
                                <div class="pr-sub"><?= $dettagli ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="pr-price">€ <?= number_format($product['prezzo'], 2) ?></div>

                        <div style="font-size:0.78rem; color:var(--text-dim); flex-shrink:0;">
                            <?php $stock = (int)($product['stock_disponibile'] ?? 0); ?>
                            <?php if ($stock === 0): ?>
                                <span style="display:inline-flex; align-items:center; gap:0.3rem; background:rgba(239,68,68,0.12); border:1px solid rgba(239,68,68,0.4); color:#ef4444; font-size:0.68rem; font-weight:700; text-transform:uppercase; letter-spacing:0.08em; padding:0.25em 0.65em; border-radius:3px;">
                                    <i class="bi bi-x-circle-fill"></i> Esaurito
                                </span>
                            <?php elseif ($stock <= 5): ?>
                                <span style="display:inline-flex; align-items:center; gap:0.3rem; background:rgba(245,158,11,0.12); border:1px solid rgba(245,158,11,0.4); color:#f59e0b; font-size:0.68rem; font-weight:700; text-transform:uppercase; letter-spacing:0.08em; padding:0.25em 0.65em; border-radius:3px;">
                                    <i class="bi bi-exclamation-triangle-fill"></i> Solo <?= $stock ?> rimasti
                                </span>
                            <?php else: ?>
                                Stock: <strong style="color:var(--text-dim);"><?= $stock ?></strong>
                            <?php endif; ?>
                        </div>

                        <span class="pr-badge <?= $badgeCls ?>"><?= ucfirst($categoria) ?></span>

                        <div class="pr-actions">
                            <button class="btn-pr-edit" data-bs-toggle="modal" data-bs-target="#editObjectModal-<?= htmlspecialchars($product['ID']) ?>">
                                <i class="bi bi-pencil me-1"></i>Modifica
                            </button>
                            <button class="btn-pr-delete" data-bs-toggle="modal" data-bs-target="#deleteObjectModal-<?= htmlspecialchars($product['ID']) ?>">
                                <i class="bi bi-trash me-1"></i>Elimina
                            </button>
                        </div>

                        <!-- Delete modal -->
                        <div class="modal fade" id="deleteObjectModal-<?= htmlspecialchars($product['ID']) ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"><i class="bi bi-exclamation-triangle me-2" style="color:#ef4444;"></i>Conferma Eliminazione</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="index.php?id=<?= $product['ID'] ?>&action=dashboard&sub_action=eliminaProdotto" method="POST">
                                        <div class="modal-body">
                                            <p style="font-size:0.9rem; color:var(--text-dim);">
                                                Stai per eliminare definitivamente il prodotto
                                                <strong style="color:var(--text);"><?= $nome_prodotto ?></strong>
                                                (ID: <?= htmlspecialchars($product['ID']) ?>).
                                            </p>
                                            <p style="font-size:0.82rem; color:#ef4444; margin-top:0.5rem;">Questa azione è irreversibile.</p>
                                            <input type="hidden" name="prodotto_id" value="<?= htmlspecialchars($product['ID']) ?>">
                                            <input type="hidden" name="action" value="delete">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm" style="background:var(--surface2); border:1px solid var(--border2); color:var(--text-dim); border-radius:5px;" data-bs-dismiss="modal">Annulla</button>
                                            <button type="submit" class="btn btn-sm" style="background:#ef4444; color:#fff; border:none; border-radius:5px; font-weight:600;">Elimina</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Edit modal -->
                        <div class="modal fade" id="editObjectModal-<?= htmlspecialchars($product['ID']) ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"><i class="bi bi-pencil-square me-2" style="color:var(--accent);"></i>Modifica Inventario</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="index.php?id=<?= $product['ID'] ?>&action=dashboard&sub_action=updateQuantita" method="POST">
                                        <div class="modal-body">
                                            <p style="font-size:0.85rem; color:var(--text-dim); margin-bottom:1.25rem;">
                                                Prodotto: <strong style="color:var(--text-dim);"><?= $nome_prodotto ?></strong><br>
                                                Quantità attuale: <strong style="color:var(--text-dim);"><?= htmlspecialchars($product['quantita'] ?? 0) ?></strong>
                                            </p>
                                            <input type="hidden" name="prodotto_id" value="<?= htmlspecialchars($product['ID']) ?>">
                                            <div>
                                                <label class="form-label">Nuova Quantità</label>
                                                <input type="number" class="form-control" name="nuova_quantita"
                                                    value="<?= htmlspecialchars($product['quantita'] ?? 0) ?>"
                                                    min="0" required
                                                    onwheel="this.blur()">
                                                <p style="font-size:0.75rem; color:var(--text-dim); margin-top:0.4rem;">Inserisci la quantità totale disponibile.</p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm" style="background:var(--surface2); border:1px solid var(--border2); color:var(--text-dim); border-radius:5px;" data-bs-dismiss="modal">Annulla</button>
                                            <button type="submit" class="btn btn-sm btn-primary" style="border-radius:5px;">Salva</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="admin-empty" style="background:var(--surface); border:1px solid var(--border); border-radius:8px;">
                    <i class="bi bi-box-seam"></i>
                    <p>Nessun prodotto nel database</p>
                </div>
            <?php endif; ?>
        </section>

    </main>
</div>

<!-- ─ Add Product Modal ─ -->
<div class="modal fade" id="addObjectModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-plus-square me-2" style="color:var(--accent);"></i>Nuovo Prodotto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="index.php?action=dashboard&sub_action=addProduct" method="POST" enctype="multipart/form-data">

                    <!-- Products Container -->
                    <div id="productsContainer">
                        <div class="product-entry" style="border: 1px solid var(--border2); padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem; position: relative;">
                            <button type="button" class="btn-remove-product" style="position: absolute; top: 10px; right: 10px; background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.3); color: #ef4444; border-radius: 4px; padding: 0.2rem 0.5rem; display: none;"><i class="bi bi-trash"></i></button>

                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Nome Prodotto / Volume</label>
                                    <input type="text" class="form-control" name="prodotti[0][name]" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Descrizione</label>
                                    <textarea class="form-control" name="prodotti[0][description]" rows="3"></textarea>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Categoria</label>
                                    <select class="form-select category-select" name="prodotti[0][category]" required>
                                        <option value="" selected disabled>Seleziona...</option>
                                        <option value="manga">Manga</option>
                                        <option value="figure">Figure</option>
                                        <option value="carta">Carte</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Prezzo (€)</label>
                                    <input type="number" step="0.01" class="form-control" name="prodotti[0][price]" min="0" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Stock</label>
                                    <input type="number" class="form-control default-one" name="prodotti[0][stock]" min="1" value="1" required>
                                </div>
                            </div>

                            <!-- Manga fields -->
                            <div class="mangaFields" style="display:none;">
                                <p class="modal-section-label">Dettagli Manga</p>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Genere</label>
                                        <select class="form-select" name="prodotti[0][manga_genre]">
                                            <option value="Shonen">Shonen</option>
                                            <option value="Seinen">Seinen</option>
                                            <option value="Isekai">Isekai</option>
                                            <option value="Spokon">Spokon</option>
                                            <option value="Slice of Life">Slice of Life</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Volume</label>
                                        <input type="number" class="form-control req-manga" name="prodotti[0][volume]" min="1" value="1">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Stato</label>
                                        <select class="form-select" name="prodotti[0][manga_status]">
                                            <option value="normale">Normale</option>
                                            <option value="novita">Novità</option>
                                            <option value="in_sconto">In Sconto</option>
                                            <option value="esaurito">Esaurito</option>
                                            <option value="in_arrivo">In Arrivo</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Figure fields -->
                            <div class="figureFields" style="display:none;">
                                <p class="modal-section-label">Dettagli Figura</p>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Nome Personaggio</label>
                                        <input type="text" class="form-control req-figure" name="prodotti[0][nome_personaggio]">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Serie / Anime</label>
                                        <input type="text" class="form-control" name="prodotti[0][nome_serie]">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Altezza (cm)</label>
                                        <input type="number" step="0.1" class="form-control" name="prodotti[0][altezza_figure]" min="0">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Larghezza (cm)</label>
                                        <input type="number" step="0.1" class="form-control" name="prodotti[0][larghezza_figure]" min="0">
                                    </div>
                                </div>
                            </div>

                            <!-- Carte fields -->
                            <div class="carteFields" style="display:none;">
                                <p class="modal-section-label">Dettagli Carta</p>
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label">Brand / Set della Carta</label>
                                        <input type="text" class="form-control req-carta" name="prodotti[0][brand_carta]">
                                    </div>
                                </div>
                            </div>

                            <p class="modal-section-label">Immagine & Codice</p>
                            <div class="row g-3">
                                <div class="col-md-8">
                                    <label class="form-label">Immagine Principale</label>
                                    <input type="file" class="form-control" name="prodotti[0][image]" accept="image/*" required>
                                    <p style="font-size:0.72rem; color:var(--muted); margin-top:0.3rem;">Formati supportati: JPG, PNG</p>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Codice / ISBN</label>
                                    <input type="text" class="form-control" name="prodotti[0][sku]">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="margin-top: 1rem;">
                        <button type="button" id="btnAddProductRow" class="btn btn-sm" style="background: rgba(56, 189, 248, 0.1); border: 1px dashed rgba(56, 189, 248, 0.4); color: #38bdf8; border-radius: 6px; width: 100%; padding: 0.6rem; font-weight: 600;"><i class="bi bi-plus me-1"></i> Aggiungi un altro prodotto in questo inserimento</button>
                    </div>

                    <div class="modal-footer" style="padding:1.25rem 0 0; margin-top:1.5rem;">
                        <button type="button" class="btn btn-sm" style="background:var(--surface2); border:1px solid var(--border2); color:var(--text-dim); border-radius:5px;" data-bs-dismiss="modal">Annulla</button>
                        <button type="submit" class="btn btn-sm btn-primary" style="border-radius:5px; padding:0.5rem 1.5rem;">Salva Prodotto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $this->stop() ?>