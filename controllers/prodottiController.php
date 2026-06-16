<?php
require_once __DIR__ . '/../config/prodotti.php';
require_once __DIR__ . '/../vendor/autoload.php';

class ProdottiController
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
    //metodo per ottenere i dati dei prodotti
    public function getProdottiData($category, $sort)
    {
        switch ($category) {
            case 'manga':
                $category_name = 'manga';
                $title = 'Manga';
                $prodotti = $this->db->getProdottibyCategoria('manga', $sort);
                break;
            case 'figure':
                $category_name = 'figure';
                $title = 'Figure';
                $prodotti = $this->db->getProdottibyCategoria('figure', $sort);
                break;
            case 'carta':
                $category_name = 'carta';
                $title = 'Carte Collezionabili';
                $prodotti = $this->db->getProdottibyCategoria('carta', $sort);
                break;
            default:
                $category_name = 'Categoria Sconosciuta';
        }
        return [
            'title' => $title,
            'category_name' => $category_name,
            'category_products' => $prodotti,
            'category_slug_passed_from_controller' => $category
        ];
    }

    public function render($category, $sort)
    {
        $data = $this->getProdottiData($category, $sort);
        return $this->templates->render('prodotti', $data);
    }

    public  function  display($category, $sort)
    { {
            try {
                echo $this->render($category, $sort);
            } catch (Exception $e) {
                echo "Errore nel rendering: " . $e->getMessage();
            }
        }
    }
}
