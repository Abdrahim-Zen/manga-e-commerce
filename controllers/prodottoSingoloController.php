<?php
require_once __DIR__ . '/../config/prodotti.php';
require_once __DIR__ . '/../vendor/autoload.php';

class prodottoSingoloController
{
    private $templates;
    private $db;

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


            $this->db = new ProdottiDB();
        } catch (Exception $e) {
            die("Errore inizializzazione: " . $e->getMessage());
        }
    }
    //metodo per ottenere i dati del prodotto singolo
    public function getProdottoData($id, $category)
    {
        $novitaProducts = $this->db->getProductsByCategory(8);
        switch ($category) {
            case 'novita':
                $prodotto = $this->db->getProductById($id);
                $categoria = 'novita';
                break;
            case 'figure':
                $prodotto = $this->db->getProductFigureById($id);
                $categoria = 'figure';
                break;
            case 'manga':
                $prodotto = $this->db->getProductById($id);
                $categoria = 'manga';
                break;
            case 'carta':
                $prodotto = $this->db->getProductCardById($id);
                $categoria = 'carta';
        }
        if (!empty($prodotto['nome'])) {
            return [
                'title' => $prodotto['nome'] . ' - Manga Xeno',
                'prodotto' => $prodotto,
                'novita_products' => $novitaProducts,
                'has_prodotto' => !empty($prodotto),
                'categoria' => $categoria
            ];
        } else {
            return [
                'prodotto' => $prodotto,
                'novita_products' => $novitaProducts,
                'has_prodotto' => !empty($prodotto),
                'categoria' => $categoria
            ];
        }
    }

    public function render($id, $category)
    {
        $data = $this->getProdottoData($id, $category);
        return $this->templates->render('prodottoSingolo', $data);
    }

    public function display($id, $category)
    {
        try {
            echo $this->render($id, $category);
        } catch (Exception $e) {
            echo "Errore nel rendering: " . $e->getMessage();
        }
    }
}
