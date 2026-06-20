<?php
require_once __DIR__ . '/../config/prodotti.php';
require_once __DIR__ . '/../config/ordini.php';
require_once __DIR__ . '/../vendor/autoload.php';

class DashboardController
{
    private $templates;
    private $prodottiDb;
    private $ordiniDb;
    public function __construct()
    {
        try {

            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }


            $this->templates = new League\Plates\Engine(__DIR__ . '/../templates');


            $this->templates->addData([
                'base_url' => 'index.php',
                'site_name' => 'Manga Xeno',
                'current_year' => date('Y')
            ]);

            // Connessione al database
            $this->prodottiDb = new ProdottiDB();
            $this->ordiniDb = new OrdiniDB();
        } catch (Exception $e) {
            die("Errore inizializzazione: " . $e->getMessage());
        }
    }

    //metodo per ottenere le info del dashboard
    public function getInfo()
    {
        $prodotti = $this->prodottiDb->getAllProduct();
        $ricavomanga = $this->ordiniDb->getVenditeManga();
        $ricavofigure = $this->ordiniDb->getVenditeFigure();
        $ricavocarte = $this->ordiniDb->getVenditeCarte();
        $ordini = $this->ordiniDb->getOrdini();
        return [
            'ricavomanga' => $ricavomanga,
            'ricavofigure' => $ricavofigure,
            'ricavocarte' => $ricavocarte,
            'ordini' => $ordini,
            'prodotti' => $prodotti
        ];
    }
    //metodo per aggiornare la quantità
    public function updateQuantita()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = filter_var($_POST['prodotto_id'], FILTER_VALIDATE_INT);
            $nuovaQuantita = filter_var($_POST['nuova_quantita'], FILTER_VALIDATE_INT);

            if ($productId && $nuovaQuantita !== false && $nuovaQuantita >= 0) {
                $success = $this->prodottiDb->updateInventarioQuantita($productId, $nuovaQuantita);

                if ($success) {
                    $_SESSION['success_message'] = "Quantità aggiornata con successo.";
                } else {
                    $_SESSION['error_message'] = "Errore durante l'aggiornamento della quantità.";
                }
            } else {
                $_SESSION['error_message'] = "Dati non validi per l'aggiornamento della quantità.";
            }
        }

        header('Location: index.php?action=dashboard');
        exit;
    }
    //metodo per eliminare un prodotto
    public function eliminaProdotto()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = filter_var($_POST['prodotto_id'], FILTER_VALIDATE_INT);

            if ($productId) {
                $success = $this->prodottiDb->deleteProductById($productId);

                if ($success) {
                    $_SESSION['success_message'] = "Prodotto eliminato con successo.";
                } else {
                    $_SESSION['error_message'] = "Errore durante l'eliminazione del prodotto.";
                }
            } else {
                $_SESSION['error_message'] = "ID prodotto non valido per l'eliminazione.";
            }
        }

        header('Location: index.php?action=dashboard');
        exit;
    }
    //metodo per aggiungere un prodotto
    public function addProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $prodotti = $_POST['prodotti'] ?? [];
            if (!is_array($prodotti) || empty($prodotti)) {
                $_SESSION['error_message'] = "Errore: Nessun dato inviato.";
                header('Location: index.php?action=dashboard');
                exit;
            }

            $successCount = 0;
            $errorCount = 0;

            foreach ($prodotti as $index => $prodData) {
                // Recupero campi per singola iterazione
                $nome = trim($prodData['name'] ?? '');
                $descrizione = trim($prodData['description'] ?? '');
                $tipo_prodotto = $prodData['category'] ?? '';
                $prezzo = filter_var($prodData['price'] ?? 0, FILTER_VALIDATE_FLOAT);
                $stock = filter_var($prodData['stock'] ?? 0, FILTER_VALIDATE_INT);
                $codice = trim($prodData['sku'] ?? '');

                // Formatta l'immagine se esiste per questo indice
                $image_file = null;
                if (isset($_FILES['prodotti']['name'][$index]['image']) && $_FILES['prodotti']['error'][$index]['image'] === UPLOAD_ERR_OK) {
                    $image_file = [
                        'name' => $_FILES['prodotti']['name'][$index]['image'],
                        'type' => $_FILES['prodotti']['type'][$index]['image'],
                        'tmp_name' => $_FILES['prodotti']['tmp_name'][$index]['image'],
                        'error' => $_FILES['prodotti']['error'][$index]['image'],
                        'size' => $_FILES['prodotti']['size'][$index]['image']
                    ];
                }

                $nome_personaggio = trim($prodData['nome_personaggio'] ?? '');
                $nome_serie = trim($prodData['nome_serie'] ?? '');
                $altezza = filter_var($prodData['altezza_figure'] ?? 0, FILTER_VALIDATE_FLOAT);
                $larghezza = filter_var($prodData['larghezza_figure'] ?? 0, FILTER_VALIDATE_FLOAT);

                $brand_carta = trim($prodData['brand_carta'] ?? '');

                if (!$nome || !$codice || !$tipo_prodotto || $prezzo === false || $prezzo < 0 || $stock === false || $stock < 1) {
                    $errorCount++;
                    continue; // Passa al prossimo prodotto se mancano campi obbligatori
                }

                $result = false;

                if ($tipo_prodotto === 'manga') {
                    $nome_manga = $nome;
                    $volume = filter_var($prodData['volume'] ?? 1, FILTER_VALIDATE_INT);
                    $categoria = $prodData['manga_genre'] ?? 'non specificata';
                    $stato = $prodData['manga_status'] ?? 'in corso';

                    if ($volume === false || $volume < 1) {
                        $errorCount++;
                        continue;
                    }

                    $result = $this->prodottiDb->insertManga(
                        $codice,
                        $descrizione,
                        $prezzo,
                        $stock,
                        $nome_manga,
                        $volume,
                        $categoria,
                        $stato,
                        $image_file
                    );
                } elseif ($tipo_prodotto === 'figure') {
                    $result = $this->prodottiDb->addFigure(
                        $codice,
                        $descrizione,
                        $prezzo,
                        $stock,
                        $nome_personaggio,
                        $nome_serie,
                        $larghezza,
                        $altezza,
                        $image_file
                    );
                    $result = true;
                } elseif ($tipo_prodotto === 'carta') {
                    $result = $this->prodottiDb->addCarta(
                        $codice,
                        $descrizione,
                        $prezzo,
                        $stock,
                        $brand_carta,
                        $image_file
                    );
                    $result = true;
                }



                if ($result === true) {
                    $successCount++;
                } else {
                    $errorCount++;
                }
            }

            if ($successCount > 0 && $errorCount === 0) {
                $_SESSION['success_message'] = "$successCount prodotto/i inseriti con successo!";
            } else if ($successCount > 0 && $errorCount > 0) {
                $_SESSION['success_message'] = "Inseriti parzialmente ($successCount ok, $errorCount errori).";
            } else {
                $_SESSION['error_message'] = "Errore durante l'inserimento. Riprova controllando i campi.";
            }

            header('Location: index.php?action=dashboard');
            exit;
        }

        return $this->templates->render('admin/add_product_form', ['title' => 'Aggiungi Prodotto']);
    }
    public function render()
    {
        $data = $this->getInfo();
        return $this->templates->render('amministratore', $data);
    }
    public function display()
    {
        try {
            echo $this->render();
        } catch (Exception $e) {
            echo "Errore nel rendering: " . $e->getMessage();
        }
    }
}
