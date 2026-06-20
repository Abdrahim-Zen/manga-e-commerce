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

    public function getStoricoByUserId($userId)
    {
        $sql = "SELECT  o.ID AS ordine_id,
    o.data_ordine,
    mp.nome_metodo AS metodo_pagamento,
    -- Dettagli dell'indirizzo di consegna
    CONCAT(ind.via, ' ', ind.civico, ', ', ind.citta) AS indirizzo_spedizione,
    -- Dettagli del prodotto generico
    p.ID AS prodotto_id,
    p.codice AS codice_prodotto,
    -- Identifica automaticamente il nome in base al tipo di prodotto
    COALESCE(m.nome, f.nome_personaggio, c.brand_carta) AS nome_prodotto,
    p.descrizione AS descrizione_prodotto,
    -- Dettagli specifici dell'acquisto (storicizzati nell'ordine)
    do.quantita,
    do.prezzo_unitario_venduto,
    (do.quantita * do.prezzo_unitario_venduto) AS totale_riga
   FROM ordini o
-- Collegamento ai dettagli dell'ordine e ai prodotti
   JOIN dettagli_ordine do ON o.ID = do.ordine_id
     JOIN prodotti p ON do.prodotto_id = p.ID
-- Left Join sulle tabelle specifiche per estrarre il nome corretto
LEFT JOIN manga m ON p.ID = m.id_manga
LEFT JOIN figure f ON p.ID = f.id_figure
LEFT JOIN carta c ON p.ID = c.id_carta
-- Collegamento a tabelle di supporto dell'ordine
JOIN metodi_pagamento mp ON o.metodo_pagamento_id = mp.ID
JOIN indirizzo ind ON o.indirizzo_consegna = ind.indirizzo_id
        WHERE o.utente_id = $userId
        ORDER BY o.data_ordine DESC, o.ID DESC;";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $storico = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $storico[] = $row;
            }
        }
        $stmt->close();
        return $storico;
    }
}
