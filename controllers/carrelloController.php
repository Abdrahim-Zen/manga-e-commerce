<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/cart.php';

class CarelloController
{
    private $templates;
    private $db;

    public function __construct()
    {
        $this->templates = new League\Plates\Engine(__DIR__ . '/../templates');
        $this->db = new CartDB();
    }

    public function ordina()
    {
        if (!(isset($_SESSION['user_id']))) {
            header('Locatiom:index.php?action=home');
            exit;
        }
        $utente_id = $_SESSION['user_id'];
        $metodo_pagamento_id = $_GET['metodo_pagamento'] ?? 0;

        $db = new CartDB();

        $carrello = $db->getCartItems($utente_id);
        $indirizzo = $db->getIndirizzoUtente($utente_id);
        $ordine_id = $db->creaOrdine($utente_id, $metodo_pagamento_id, (int) $indirizzo['indirizzo_id']);

        foreach ($carrello as $item) {
            $db->creaDettaglioOrdine(
                $ordine_id,
                (int) $item['prodotto_id'],
                (int) $item['quantita'],
                (float) $item['prezzo']
            );
            $db->decrementaInventario((int) $item['prodotto_id'], (int) $item['quantita']);
        }


        $db->svuotaCarrello($utente_id);

        header('Location: index.php?action=home&ordine=confermato&id=' . $ordine_id);
        exit();
    }
    // Aggiungi prodotto al carrello
    public function addToCart()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=showLogin&message=Devi+accedere+per+aggiungere+al+carrello');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product_id = $_POST['product_id'] ?? null;
            $quantity = $_POST['quantity'] ?? 1;
            $categoria = $_POST['categoria'] ?? null;
            if (!$product_id) {
                header('Location: index.php?id=' . $product_id . '&message=Prodotto+non+valido&category=' . $categoria . '&action=prodotto');
                exit;
            }

            $success = $this->db->addToCart($_SESSION['user_id'], $product_id, $quantity);

            if ($success) {
                header('Location: index.php?id=' . $product_id . '&message=Prodotto+aggiunto+al+carrello&category=' . $categoria . '&action=prodotto');
            } else {
                header('Location: index.php?id=' . $product_id . '&message=Errore+nell+aggiunta+al+carrello&category=' . $categoria . '&action=prodotto');
            }
            exit;
        }
    }

    // Mostra il carrello
    public function showCart()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=showLogin&message=Devi+accedere+per+vedere+il+carrello');
            exit;
        }
        //fix
        $cart_items = $this->db->getCartItems($_SESSION['user_id']);
        $total = 0;

        foreach ($cart_items as $item) {
            $total += $item['prezzo'] * $item['quantita'];
        }

        $data = [
            'title' => 'Carrello - Manga Xeno',
            'cart_items' => $cart_items,
            'total' => $total
        ];

        echo $this->templates->render('carrello', $data);
    }

    // Rimuovi prodotto dal carrello
    public function removeFromCart()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=showLogin');
            exit;
        }

        $product_id = $_GET['product_id'] ?? null;

        if ($product_id) { //fix
            $this->db->removeProductFromCart($_SESSION['user_id'], $product_id);
        }

        header('Location: index.php?action=cart&cart_action=showCart');
        exit;
    }

    // Aggiorna quantità
    public function updateQuantity()
    {
        if (!isset($_SESSION['user_id'])) {
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product_id = $_POST['product_id'] ?? null;
            $quantity = $_POST['quantity'] ?? 1;

            if ($product_id) {
                //fix
                $this->db->updateCartQuantity($_SESSION['user_id'], $product_id, $quantity);
            }
        }

        header('Location: index.php?action=cart&cart_action=showCart');
        exit;
    }
}
