<!DOCTYPE html>
<html lang="it">
<?php
/** @var string $title */
/** @var array $storico */
$this->layout('layout', ['title' => $title]) ?>
<?php $this->start('main_content') ?>

<body class="bg-light">

    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">Cronologia Prodotti Ordinati</h3>
                    </div>
                    <div class="card-body">

                        <?php if (count($storico) > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>ID Ordine</th>
                                            <th>Data</th>
                                            <th>Codice</th>
                                            <th>Prodotto</th>
                                            <th class="text-center">Q.tà</th>
                                            <th class="text-end">Prezzo Un.</th>
                                            <th class="text-end">Totale</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($storico as $prodotto): ?>
                                            <tr style="background-color: white;">
                                                <td><strong>#<?php echo $prodotto['ordine_id']; ?></strong></td>
                                                <td><?php echo date('d/m/Y H:i', strtotime($prodotto['data_ordine'])); ?></td>
                                                <td><code class="text-secondary"><?php echo $prodotto['codice_prodotto']; ?></code></td>
                                                <td><?= ($prodotto['descrizione_prodotto']); ?></td>
                                                <td class="text-center"><?php echo $prodotto['quantita']; ?></td>
                                                <td class="text-end">€<?php echo number_format($prodotto['prezzo_unitario_venduto'], 2, ',', '.'); ?></td>
                                                <td class="text-end fw-bold text-success">€<?php echo number_format($prodotto['totale_riga'], 2, ',', '.'); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>


                        <?php else: ?>
                            <div class="alert alert-info mb-0 text-center" role="alert">
                                Non è stato trovato alcun prodotto nella cronologia ordini di questo utente.
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>





</body>
<?php $this->stop() ?>


</html>