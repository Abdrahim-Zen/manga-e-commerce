<?php
require_once __DIR__ . '/Db.php';

class ProdottiDB
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance();
    }

    //restituisce i prodotti che sono con tag Novita
    public function getProdottiNovita($limit = 8)
    {
        $sql = "SELECT 
    p.ID,
    p.codice,
    p.descrizione,
    p.prezzo,
    p.creato,
    inv.quantita,
    i.image,
    m.nome ,
    m.volume,
    m.stato,
    f.nome_personaggio,
    c.brand_carta
FROM 
    prodotti p
INNER JOIN 
    inventario inv ON p.ID = inv.prodotto_id
INNER JOIN 
    immagine_prodotti i ON p.ID = i.prodotto_id
LEFT JOIN 
    manga m ON p.ID = m.id_manga
LEFT JOIN 
    figure f ON p.ID = f.id_figure
LEFT JOIN 
    carta c ON p.ID = c.id_carta
ORDER BY 
    p.creato DESC
LIMIT 
    ?;";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Errore preparazione statement: " . $this->conn->error);
        }

        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();

        $products = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }

        $stmt->close();
        return $products;
    }


    public function getProductsByCategory($limit = 8)
    {
        $sql = "SELECT 
    p.ID,
    p.codice,
    p.descrizione,
    p.prezzo,
    p.creato,
    inv.quantita,
    i.image,
    m.nome ,
    m.volume,
    m.stato,
    f.nome_personaggio,
    c.brand_carta
FROM 
    prodotti p
INNER JOIN 
    inventario inv ON p.ID = inv.prodotto_id
INNER JOIN 
    immagine_prodotti i ON p.ID = i.prodotto_id
LEFT JOIN 
    manga m ON p.ID = m.id_manga
LEFT JOIN 
    figure f ON p.ID = f.id_figure
LEFT JOIN 
    carta c ON p.ID = c.id_carta
ORDER BY 
    p.creato DESC
LIMIT 
    ?;";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Errore preparazione statement: " . $this->conn->error);
        }

        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();

        $products = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }

        $stmt->close();
        return $products;
    }
    //metodo per ottenere prodotti per categoria ordinati in base al parametro sort
    public function getProdottibyCategoria($category, $sort)
    {
        $sort_by = "";
        switch ($sort) {
            case 'price_asc':
                $sort_by = "ORDER BY p.prezzo ASC";
                break;
            case 'price_desc':
                $sort_by = "ORDER BY p.prezzo DESC";
                break;
            case 'availability':
                $sort_by = "availability";
                break;
            default:
                $sort_by = "ORDER BY p.creato DESC";
                break;
        }
        if ($sort_by === 'availability') {
            $sql = "SELECT c.* , p.* , i.image, inv.quantita  FROM $category c INNER JOIN prodotti p ON c.id_$category = p.ID INNER JOIN immagine_prodotti i ON p.ID = i.prodotto_id INNER  JOIN inventario inv ON p.ID = inv.prodotto_id WHERE inv.quantita > 0";
        } else {
            $sql = "SELECT c.* , p.* , i.image, inv.quantita  FROM $category c INNER JOIN prodotti p ON c.id_$category = p.ID INNER JOIN immagine_prodotti i ON p.ID = i.prodotto_id INNER  JOIN inventario inv ON p.ID = inv.prodotto_id $sort_by";
        }
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Errore preparazione statement: " . $this->conn->error);
        }


        $stmt->execute();
        $result = $stmt->get_result();

        $products = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }

        $stmt->close();
        return $products;
    }

    //metodo per ottenere figure in homepage
    public function getFigureHomepage($limit = 4)
    {
        $sql = "SELECT f.* , p.* , i.image, inv.quantita FROM figure f INNER JOIN prodotti p ON f.id_figure = p.ID INNER JOIN immagine_prodotti i ON p.ID = i.prodotto_id INNER JOIN inventario inv ON p.ID = inv.prodotto_id LIMIT ?";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Errore preparazione statement: " . $this->conn->error);
        }

        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();

        $products = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }

        $stmt->close();
        return $products;
    }
    //metodo per ottenere carte in homepage
    public function getCardHomepage($limit = 4)
    {
        $sql = "SELECT f.* , p.* , i.image , inv.quantita FROM carta f INNER JOIN prodotti p ON f.id_carta = p.ID INNER JOIN  immagine_prodotti i ON p.ID = i.prodotto_id INNER JOIN inventario inv ON p.ID = inv.prodotto_id LIMIT ?";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Errore preparazione statement: " . $this->conn->error);
        }

        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();

        $products = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }

        $stmt->close();
        return $products;
    }
    //metodo per ottenere un manga tramite id
    public function getProductById($id)
    {
        $sql = "SELECT m.*, p.*, i.image, inv.quantita FROM manga m Inner join immagine_prodotti i on m.id_manga=i.prodotto_id inner join prodotti p on m.id_manga=p.ID inner join inventario inv on p.ID = inv.prodotto_id WHERE id_manga = ?";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Errore preparazione statement: " . $this->conn->error);
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $product = null;
        if ($result && $result->num_rows > 0) {
            $product = $result->fetch_assoc();
        }

        $stmt->close();
        return $product;
    }
    //metodo per ottenere una carta tramite id
    public function getProductCardById($id)
    {
        $sql = "SELECT p.*,c.*,i.image, inv.quantita FROM carta c inner join immagine_prodotti i on c.id_carta=i.prodotto_id inner join prodotti p on c.id_carta=p.ID inner join inventario inv on p.ID = inv.prodotto_id  WHERE id_carta = ?";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Errore preparazione statement: " . $this->conn->error);
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $product = null;
        if ($result && $result->num_rows > 0) {
            $product = $result->fetch_assoc();
        }

        $stmt->close();
        return $product;
    }

    //metodo per ottenere una figura tramite id
    public function getProductFigureById($id)
    {
        $sql = "SELECT p.*, f.*, i.image, inv.quantita FROM figure f inner join immagine_prodotti i on f.id_figure=i.prodotto_id inner join prodotti p on f.id_figure=p.ID inner join inventario inv on p.ID = inv.prodotto_id WHERE id_figure = ?";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Errore preparazione statement: " . $this->conn->error);
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $product = null;
        if ($result && $result->num_rows > 0) {
            $product = $result->fetch_assoc();
        }

        $stmt->close();
        return $product;
    }


    //metodo per ottenere un utente tramite email
    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM utente WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        $user = null;
        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
        }

        $stmt->close();
        return $user;
    }
    //metodo per ottenere un admin tramite email
    public function getAdminByEmail($email)
    {
        $sql = "SELECT * FROM Amministratore WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        $admin = null;
        if ($result && $result->num_rows > 0) {
            $admin = $result->fetch_assoc();
        }

        $stmt->close();
        return $admin;
    }
    //metodo per aggiungere un manga
    public function insertManga(
        $codice,
        $descrizione,
        $prezzo,
        $quantita,
        $nome_manga,
        $volume,
        $categoria,
        $stato,
        $img,

    ) {

        $this->conn->begin_transaction();

        try {

            $sql_prodotti = "INSERT INTO prodotti (codice, descrizione, prezzo) VALUES (?, ?, ?)";
            $stmt_prodotti = $this->conn->prepare($sql_prodotti);
            $stmt_prodotti->bind_param("ssd", $codice, $descrizione, $prezzo);
            $stmt_prodotti->execute();
            $prodotto_id = $this->conn->insert_id;
            $stmt_prodotti->close();


            $sql_manga = "INSERT INTO manga (id_manga, nome, volume, categoria, stato,prezzo) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt_manga = $this->conn->prepare($sql_manga);

            $stmt_manga->bind_param("isissd", $prodotto_id, $nome_manga, $volume, $categoria, $stato, $prezzo);
            $stmt_manga->execute();
            $stmt_manga->close();


            $sql_inventario = "INSERT INTO inventario (prodotto_id, quantita, ultimo_restock) VALUES (?, ?, CURDATE())";
            $stmt_inventario = $this->conn->prepare($sql_inventario);
            $stmt_inventario->bind_param("ii", $prodotto_id, $quantita);
            $stmt_inventario->execute();
            $stmt_inventario->close();



            $sql_img = "INSERT INTO immagine_prodotti (prodotto_id, image) VALUES (?, ?)";
            $stmt_img = $this->conn->prepare($sql_img);
            $public_path_db = 'img/manga/';
            $extension = pathinfo($img['name'], PATHINFO_EXTENSION);
            $unique_filename = $img['name'];


            $db_image_path = $public_path_db . $unique_filename;

            $stmt_img->bind_param("is", $prodotto_id, $db_image_path);

            $stmt_img->execute();
            $stmt_img->close();

            $this->conn->commit();
            return true;
        } catch (Exception $e) {

            $this->conn->rollback();

            error_log("Errore durante l'inserimento del Manga: " . $e->getMessage());
            return false;
        }
    }
    //metodo per aggiungere una carta
    public function addCarta(
        $codice,
        $descrizione,
        $prezzo,
        $quantita,
        $brand_carta,
        $img
    ) {

        $this->conn->begin_transaction();

        try {

            $sql_prodotti = "INSERT INTO prodotti (codice, descrizione, prezzo) VALUES (?, ?, ?)";
            $stmt_prodotti = $this->conn->prepare($sql_prodotti);
            $stmt_prodotti->bind_param("ssd", $codice, $descrizione, $prezzo);
            $stmt_prodotti->execute();
            $prodotto_id = $this->conn->insert_id;
            $stmt_prodotti->close();


            $sql_figure = "INSERT INTO carta (id_carta, brand_carta) VALUES (?, ?)";
            $stmt_figure = $this->conn->prepare($sql_figure);

            $stmt_figure->bind_param("is", $prodotto_id, $brand_carta);
            $stmt_figure->execute();
            $stmt_figure->close();


            $sql_inventario = "INSERT INTO inventario (prodotto_id, quantita, ultimo_restock) VALUES (?, ?, CURDATE())";
            $stmt_inventario = $this->conn->prepare($sql_inventario);
            $stmt_inventario->bind_param("ii", $prodotto_id, $quantita);
            $stmt_inventario->execute();
            $stmt_inventario->close();



            $sql_img = "INSERT INTO immagine_prodotti (prodotto_id, image) VALUES (?, ?)";
            $stmt_img = $this->conn->prepare($sql_img);
            $public_path_db = 'img/carte/';
            $extension = pathinfo($img['name'], PATHINFO_EXTENSION);
            $unique_filename = $img['name'];


            $db_image_path = $public_path_db . $unique_filename;

            $stmt_img->bind_param("is", $prodotto_id, $db_image_path);

            $stmt_img->execute();
            $stmt_img->close();

            $this->conn->commit();
            return true;
        } catch (Exception $e) {

            $this->conn->rollback();

            error_log("Errore durante l'inserimento del Manga: " . $e->getMessage());
            return false;
        }
    }
    //metodo per aggiungere una figure
    public function addFigure(
        $codice,
        $descrizione,
        $prezzo,
        $quantita,
        $nome_personaggio,
        $nome_serie,
        $altezza,
        $larghezza,
        $img
    ) {

        $this->conn->begin_transaction();

        try {

            $sql_prodotti = "INSERT INTO prodotti (codice, descrizione, prezzo) VALUES (?, ?, ?)";
            $stmt_prodotti = $this->conn->prepare($sql_prodotti);
            $stmt_prodotti->bind_param("ssd", $codice, $descrizione, $prezzo);
            $stmt_prodotti->execute();
            $prodotto_id = $this->conn->insert_id;
            $stmt_prodotti->close();


            $sql_figure = "INSERT INTO figure (id_figure, nome_personaggio, nome_serie, larghezza, altezza) VALUES (?, ?, ?, ?, ?)";
            $stmt_figure = $this->conn->prepare($sql_figure);

            $stmt_figure->bind_param("issdd", $prodotto_id, $nome_personaggio, $nome_serie, $larghezza, $altezza);
            $stmt_figure->execute();
            $stmt_figure->close();


            $sql_inventario = "INSERT INTO inventario (prodotto_id, quantita, ultimo_restock) VALUES (?, ?, CURDATE())";
            $stmt_inventario = $this->conn->prepare($sql_inventario);
            $stmt_inventario->bind_param("ii", $prodotto_id, $quantita);
            $stmt_inventario->execute();
            $stmt_inventario->close();



            $sql_img = "INSERT INTO immagine_prodotti (prodotto_id, image) VALUES (?, ?)";
            $stmt_img = $this->conn->prepare($sql_img);
            $public_path_db = 'img/figure/';
            $extension = pathinfo($img['name'], PATHINFO_EXTENSION);
            $unique_filename = $img['name'];


            $db_image_path = $public_path_db . $unique_filename;

            $stmt_img->bind_param("is", $prodotto_id, $db_image_path);

            $stmt_img->execute();
            $stmt_img->close();

            $this->conn->commit();
            return true;
        } catch (Exception $e) {

            $this->conn->rollback();

            error_log("Errore durante l'inserimento del Manga: " . $e->getMessage());
            return false;
        }
    }
    //metodo per creare un utente
    public function createUser($nome, $cognome, $email, $password, $via, $civico, $citta, $telefono)
    {
        $sql_user = "INSERT INTO utente (nome, cognome, email, password) VALUES (?, ?, ?, ?)";
        $stmt_user = $this->conn->prepare($sql_user);
        $stmt_user->bind_param("ssss", $nome, $cognome, $email, $password);
        $stmt_user->execute();
        $stmt_user->close();
        $user_id = $this->conn->insert_id;
        $sql_indirizzo = "INSERT INTO indirizzo (indirizzo_id,via,civico,citta,telefono) VALUES (?,?,?,?,?)";
        $stmt_indirizzo = $this->conn->prepare($sql_indirizzo);
        $stmt_indirizzo->bind_param("isssi", $user_id, $via, $civico, $citta, $telefono);
        $success = $stmt_indirizzo->execute();
        return $success;
    }
    //metodo per aggiornare la quantità di un prodotto
    public function updateInventarioQuantita($prodotto_id, $new_quantita)
    {
        $sql = "UPDATE inventario SET quantita = ?, ultimo_restock = CURDATE() WHERE prodotto_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $new_quantita, $prodotto_id);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }
    //metodo per eliminare un prodotto tramite id
    public function deleteProductById($product_id)
    {
        $sql = "DELETE FROM prodotti WHERE ID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $product_id);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }
    public function getAllProduct()
    {
        $sql = "SELECT
    
    p.ID,
    p.codice,
    p.descrizione,
    p.prezzo,

  
    i.quantita AS stock_disponibile,
    i.ultimo_restock,

 
    m.nome AS manga_nome,
    m.volume AS manga_volume,
    m.categoria AS manga_genere,
    m.stato AS manga_stato,

   
    c.brand_carta AS carta_set,


    f.nome_personaggio AS nome_personaggio,
    f.nome_serie AS nome_serie,
    f.altezza AS altezza_figure,
    f.larghezza AS larghezza_figure,
    i.quantita

    FROM
    prodotti p

 
    INNER JOIN inventario i ON p.ID = i.prodotto_id 

   
    LEFT JOIN manga m ON p.ID = m.id_manga
    LEFT JOIN carta c ON p.ID = c.id_carta
    LEFT JOIN figure f ON p.ID = f.id_figure";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $products = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }

        $stmt->close();
        return $products;
    }
}
