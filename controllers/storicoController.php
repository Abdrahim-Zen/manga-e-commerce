<?php
require_once __DIR__ . '/../config/ordini.php';
require_once __DIR__ . '/../vendor/autoload.php';
class storicoController
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


            $this->db = new OrdiniDB();
        } catch (Exception $e) {
            die("Errore inizializzazione: " . $e->getMessage());
        }
    }
    public function getStoricoData($id)
    {
        $storico = $this->db->getStoricoByUserId($id);
        return [
            'title' => 'Storico Ordini - Manga Xeno',
            'storico' => $storico,
            'has_storico' => !empty($storico)
        ];
    }

    public function render($id)
    {
        $data = $this->getStoricoData($id);
        return $this->templates->render('storico', $data);
    }

    public function display($id)
    {
        try {
            echo $this->render($id);
        } catch (Exception $e) {
            echo "Errore nel rendering: " . $e->getMessage();
        }
    }
}
