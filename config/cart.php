<?php
require_once __DIR__ . '/Db.php';

class CartDB
{

    private $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance();
    }


    // Funzione per ottenere l'indirizzo di un utente
    public function getIndirizzoUtente($userID): ?array
    {
        $sql = "SELECT i.*  FROM indirizzo i where i.utente_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return null;
    }

    public function getMetodiPagamento(): ?array{
        $sql = "SELECT m.* FROM metodi_pagamento m";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
                $result = $stmt->get_result();
        if ($result && $result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return null;
    }

    //Funzione per creare un ordine
    public function creaOrdine($utente_id, $metodo_pagamento, $indirizzo_id): int|false
    {
        $sql = "INSERT INTO ordini (utente_id,metodo_pagamento_id,indirizzo_consegna) VALUES (?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iii", $utente_id, $metodo_pagamento, $indirizzo_id);
        $stmt->execute();
        $id = $this->conn->insert_id;
        return $id > 0 ? $id : false;
    }


    //funzione per creare i dettagli dell'ordine
    public function creaDettaglioOrdine(
        int $ordine_id,
        int $prodotto_id,
        int $quantita,
        float $prezzo_unitario
    ): void {
        $sql = "INSERT INTO dettagli_ordine (ordine_id, prodotto_id, quantita, prezzo_unitario_venduto)
            VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iiid", $ordine_id, $prodotto_id, $quantita, $prezzo_unitario);
        $stmt->execute();
    }

    //funzione per eliminare la quantità di un prodotto dall'inventario
    public function decrementaInventario($prodotto_id, $quantita): void
    {
        $sql = "UPDATE inventario
            SET quantita = GREATEST(0, quantita - ?)
            WHERE prodotto_id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $quantita, $prodotto_id);
        $stmt->execute();
    }

    //funzione per svuotare il carrello dopo l'ordine
    public function svuotaCarrello($utente_id): void
    {
        $sql = "DELETE FROM carrello WHERE utente_id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $utente_id);
        $stmt->execute();
    }

    //funzione per ottenere gli articoli del carrello di un utente
    public function getCartItems($user_id)
    {
        $sql = "SELECT c.*, 
                   p.prezzo, 
                   p.codice, 
                   p.descrizione,
                   i.image,
                   COALESCE(m.nome, f.nome_personaggio, cg.brand_carta) as nome,
                   CASE 
                       WHEN m.id_manga IS NOT NULL THEN 'manga'
                       WHEN f.id_figure IS NOT NULL THEN 'figure' 
                       WHEN cg.id_carta IS NOT NULL THEN 'carta'
                   END as tipo_prodotto
            FROM carrello c 
            JOIN prodotti p ON c.prodotto_id = p.ID 
            LEFT JOIN manga m ON p.ID = m.id_manga 
            LEFT JOIN figure f ON p.ID = f.id_figure
            LEFT JOIN carta cg ON p.ID = cg.id_carta
            LEFT JOIN immagine_prodotti i ON p.ID = i.prodotto_id 
            WHERE c.utente_id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $items = [];
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }

        return $items;
    }


    //funzione che aggiunge un prodotto al carrello
    public function addToCart($user_id, $product_id, $quantity = 1)
    {
        // Controlla se il prodotto è già nel carrello
        $check_sql = "SELECT * FROM carrello WHERE utente_id = ? AND prodotto_id = ?";
        $stmt = $this->conn->prepare($check_sql);
        $stmt->bind_param("ii", $user_id, $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Aggiorna la quantità
            $update_sql = "UPDATE carrello SET quantita = quantita + ? WHERE utente_id = ? AND prodotto_id = ?";
            $stmt = $this->conn->prepare($update_sql);
            $stmt->bind_param("iii", $quantity, $user_id, $product_id);
            return $stmt->execute();
        } else {
            // Inserisce nuovo prodotto
            $insert_sql = "INSERT INTO carrello (utente_id, prodotto_id, quantita) VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($insert_sql);
            $stmt->bind_param("iii", $user_id, $product_id, $quantity);
            return $stmt->execute();
        }
    }

    //funzione che rimuove un prodotto dal carrello
    public function removeProductFromCart($user_id, $product_id)
    {
        $sql = "DELETE FROM carrello WHERE utente_id = ? AND prodotto_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $user_id, $product_id);
        return $stmt->execute();
    }

    //funzione per aggiornare la quantità di un prodotto nel carrello
    public function updateCartQuantity($user_id, $product_id, $quantity)
    {
        if ($quantity <= 0) {
            return $this->removeProductFromCart($user_id, $product_id);
        }

        $sql = "UPDATE carrello SET quantita = ? WHERE utente_id = ? AND prodotto_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iii", $quantity, $user_id, $product_id);
        return $stmt->execute();
    }

    public function getCartCount($user_id)
    {
        $sql = "SELECT SUM(quantita) as total FROM carrello WHERE utente_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['total'] ?? 0;
    }
    //funzione che crea un ordine dal carrello eliminando i prodotti dal carrello e aggiornando l'inventario
    public function createOrderFromCart($user_id, $address_id)
    {

        $this->conn->begin_transaction();
        $order_id = false;

        try {

            $cart_items = $this->getCartItems($user_id);

            if (empty($cart_items)) {
                throw new Exception("Carrello vuoto. Impossibile creare l'ordine.");
            }


            $sql_order = "INSERT INTO ordini (utente_id, indirizzo_consegna) VALUES (?, ?)";
            $stmt_order = $this->conn->prepare($sql_order);


            if (!$stmt_order) {
                throw new Exception("Fallimento preparazione SQL Ordine: " . $this->conn->error);
            }

            $stmt_order->bind_param("ii", $user_id, $address_id);

            if (!$stmt_order->execute()) {
                throw new Exception("Fallimento esecuzione SQL Ordine: " . $stmt_order->error);
            }
            $stmt_order->close();

            $order_id = $this->conn->insert_id;


            $sql_details = "INSERT INTO dettagli_ordine (ordine_id, prodotto_id, quantita, prezzo_unitario_venduto) VALUES (?, ?, ?, ?)";
            $stmt_details = $this->conn->prepare($sql_details);


            if (!$stmt_details) {
                throw new Exception("Fallimento preparazione SQL Dettagli Ordine: " . $this->conn->error);
            }

            foreach ($cart_items as $item) {
                $sql_inventari = " UPDATE inventario i JOIN prodotti p ON i.prodotto_id = p.ID SET quantita = GREATEST(0, quantita - ?) 
               WHERE i.prodotto_id = ?
                ";
                $stmt_inventari = $this->conn->prepare($sql_inventari);
                $prodotto_id = $item['prodotto_id'];
                $quantita = $item['quantita'];

                $prezzo = (float) $item['prezzo'];


                $stmt_details->bind_param("iiid", $order_id, $prodotto_id, $quantita, $prezzo);

                if (!$stmt_details->execute()) {
                    throw new Exception("Fallimento esecuzione SQL Dettagli Prodotto ID: $prodotto_id. Errore: " . $stmt_details->error);
                }
                $stmt_inventari->bind_param("ii", $quantita, $prodotto_id);
                $stmt_inventari->execute();
            }
            $stmt_details->close();
            $stmt_inventari->close();



            $sql_clear = "DELETE FROM carrello WHERE utente_id = ?";
            $stmt_clear = $this->conn->prepare($sql_clear);


            if (!$stmt_clear) {
                throw new Exception("Fallimento preparazione SQL Svuota Carrello: " . $this->conn->error);
            }

            $stmt_clear->bind_param("i", $user_id);

            if (!$stmt_clear->execute()) {
                throw new Exception("Fallimento esecuzione SQL Svuota Carrello: " . $stmt_clear->error);
            }
            $stmt_clear->close();


            $this->conn->commit();
            return $order_id;
        } catch (Exception $e) {

            $this->conn->rollback();

            error_log("ERRORE CRITICO TRANSAZIONE ORDINE: " . $e->getMessage());


            return false;
        }
    }
}
