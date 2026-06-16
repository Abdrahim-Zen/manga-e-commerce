<?php
require_once __DIR__ . '/Db.php';

class OrdiniDB
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance();
    }
    //metodo per ottenere il ricavo totale dei manga
    public function getVenditeManga()
    {
        $sql = "SELECT 
    SUM(d.quantita * d.prezzo_unitario_venduto) AS ricavo_totale_manga
    FROM  ordini o JOIN  dettagli_ordine d ON o.ID = d.ordine_id JOIN prodotti p ON d.prodotto_id = p.ID  JOIN  manga m ON p.ID = m.id_manga;  ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $row = $result->fetch_assoc();

        $stmt->close();

        return (float)($row['ricavo_totale_manga'] ?? 0.00);
    }
    //metodo per ottenere il ricavo totale delle carte
    public function getVenditeCarte()
    {
        $sql = "SELECT 
    SUM(d.quantita * d.prezzo_unitario_venduto) AS ricavo_totale_carte
    FROM  ordini o JOIN  dettagli_ordine d ON o.ID = d.ordine_id JOIN prodotti p ON d.prodotto_id = p.ID  JOIN  carta c ON p.ID = c.id_carta;  ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $row = $result->fetch_assoc();

        $stmt->close();

        return (float)($row['ricavo_totale_carte'] ?? 0.00);
    }
    //metodo per ottenere il ricavo totale delle figure
    public function getVenditeFigure()
    {
        $sql = "SELECT 
    SUM(d.quantita * d.prezzo_unitario_venduto) AS ricavo_totale_figure
    FROM  ordini o JOIN  dettagli_ordine d ON o.ID = d.ordine_id JOIN prodotti p ON d.prodotto_id = p.ID  JOIN  figure f ON p.ID = f.id_figure;  ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $row = $result->fetch_assoc();

        $stmt->close();

        return (float)($row['ricavo_totale_figure'] ?? 0.00);
    }
    //metodo per ottenere gli ordini
    public function getOrdini()
    {
        $sql = "SELECT * FROM ordini JOIN dettagli_ordine d WHERE d.ordine_id=ordini.ID ORDER BY data_ordine DESC LIMIT 10";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $ordini = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $ordini[] = $row;
            }
        }

        $stmt->close();
        return $ordini;
    }
}
