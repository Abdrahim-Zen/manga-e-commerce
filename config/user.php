<?php
require_once __DIR__ . '/Db.php';

class UserDB
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance();
    }
    //metodo per ottenere l'utente con il suo ruolo
    public function getUserWithRoleByEmail($email, $password)
    {
        $sql = "SELECT u.*, g.nome AS role_name 
            FROM users u
            LEFT JOIN users_has_groups uhg ON u.id = uhg.users_id
            LEFT JOIN gruppo g ON uhg.groups_id = g.id
            WHERE u.email = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $role = $row['role_name'] ?? 'nessun_ruolo';
                unset($row['password']); // rimuovo la password dall'array dei dati
                return [
                    "user" => $row,
                    "role" => $role
                ];
            }
        }

        return null;
    }
    //metodo per verificare se l'utente ha accesso a un servizio
    public function canUserAccess($userId, $serviceName)
    {
        $sql = "SELECT COUNT(*) as permesso
            FROM users_has_groups uhg
            JOIN services_has_groups shg ON uhg.groups_id = shg.groups_id
            WHERE uhg.users_id = ? 
            AND shg.services_username = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("is", $userId, $serviceName);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_assoc();


        return $res['permesso'] > 0;
    }
    //metodo per ottenere l'utente tramite email
    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = ?";
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
    //metodo per creare un utente
    public function createUser($nome, $cognome, $email, $password, $via, $civico, $citta, $telefono)
    {
        $sql_user = "INSERT INTO users (nome, cognome, email, password) VALUES (?, ?, ?, ?)";
        $stmt_user = $this->conn->prepare($sql_user);
        $stmt_user->bind_param("ssss", $nome, $cognome, $email, $password);
        $stmt_user->execute();
        $stmt_user->close();
        $user_id = $this->conn->insert_id;
        $sql_indirizzo = "INSERT INTO indirizzo (utente_id,via,civico,citta,telefono) VALUES (?,?,?,?,?)";
        $stmt_indirizzo = $this->conn->prepare($sql_indirizzo);
        $stmt_indirizzo->bind_param("isssi", $user_id, $via, $civico, $citta, $telefono);
        $stmt_indirizzo->execute();
        $stmt_indirizzo->close();
        $sql_role = "INSERT INTO users_has_groups (users_id, groups_id) VALUES (?, 2)";
        $stmt_role = $this->conn->prepare($sql_role);
        $stmt_role->bind_param("i", $user_id);
        $stmt_role->execute();
        $stmt_role->close();
    }
    //metodo per ottenere l'admin tramite email
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
    //metodo per ottenere l'indirizzo di default dell'utente
    public function getUserDefaultAddressId($user_id)
    {

        $sql = "SELECT indirizzo_id FROM indirizzo WHERE indirizzo_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        return $row['indirizzo_id'] ?? null;
    }
}
