<?php
require_once __DIR__ . '/../config/prodotti.php';
class HomepageController
{
    private $db;
    private $templates;
    public function __construct()
    {
        try {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $this->templates = new League\Plates\Engine('../templates');
            $this->templates->addData([
                'base_url' => 'index.php',
                'site_name' => 'Manga xeno',
            ]);
            $this->db = new ProdottiDB();
        } catch (Exception $e) {
            die("Errore inizializzazione: " . $e->getMessage());
        }
    }
    public function getHomepageData()
    {
        try {
            $novitaProducts = $this->db->getProductsByCategory(8);
            $cardGameProducts = $this->db->getCardHomepage(5);
            $figureProducts = $this->db->getFigureHomepage(5);

            return [
                'title' => 'Manga Xeno - Homepage',
                'novita_products' => $novitaProducts,
                'cardgame_products' => $cardGameProducts,
                'figure_products' => $figureProducts,
                'has_products' => !empty($novitaProducts) || !empty($cardGameProducts) || !empty($figureProducts)
            ];
        } catch (Exception $e) {
            error_log("Errore caricamento dati: " . $e->getMessage());
            return [
                'title' => 'Manga Xeno - Homepage',
                'novita_products' => [],
                'cardgame_products' => [],
                'figure_products' => [],
                'has_products' => false,
                'error' => 'Errore nel caricamento dei prodotti'
            ];
        }
    }
    public function render()
    {
        $data = $this->getHomepageData();
        return $this->templates->render('homepage', $data);
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

