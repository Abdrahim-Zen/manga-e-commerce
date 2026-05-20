<?php

require_once __DIR__ . '/../config/prodotti.php';
class ProdottiByCategoryController
{
    private $db;
    private $templates;
    public function __construct()
    {
        $this->templates = new League\Plates\Engine('../templates');
        $this->templates->addData([
            'base_url' => 'index.php',
            'site_name' => 'Manga xeno',
        ]);
        $this->db = new ProdottiDB();
    }
    public function getProductsByCategory(string $category)
    {
        switch ($category) {
            case 'manga':
                $prodotti = $this->db->getProdottibyCategoria('manga', '');
                break;
            case 'figure':
                $prodotti = $this->db->getProdottibyCategoria('figure', '');
                break;
            case 'carta':
                $prodotti = $this->db->getProdottibyCategoria('carta', '');
                break;
        }
        return [
            'prodotti' => $prodotti,
            'category' => $category
        ];

    }
    public function render(string $category)
    {
        $data = $this->getProductsByCategory($category);
        return $this->templates->render('prodottiByCategory', $data);
    }
    public function display(string $category)
    {
        try {
            echo $this->render($category);
        } catch (Exception $e) {
            echo "Errore nel rendering: " . $e->getMessage();

        }
    }
}
?>