<?php
require_once __DIR__ . '/../config/user.php';
require_once __DIR__ . '/../vendor/autoload.php';

class LoginController
{
    private $templates;
    private $db;

    public function __construct()
    {

        $this->templates = new League\Plates\Engine(__DIR__ . '/../templates');
    }

    // Mostra login
    public function showLogin()
    {
        $message = $_GET['message'] ?? '';

        $data = [
            'title' => 'Login - Manga Xeno',
            'message' => $message
        ];
        echo $this->templates->render('login', $data);
    }

    // Gestisce login
    public function handleLogin()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $this->db = new UserDB();
        $data = $this->db->getUserWithRoleByEmail($email, $password);
        if ($data) {
            $user = $data['user'];
            $ruolo = $data['role'];
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nome'];
            $_SESSION['user_role'] = $ruolo;
            if ($ruolo === 'admin') {
                header('Location: index.php?action=dashboard');
            } else {
                header('Location: index.php');
            }
            exit;
        }
        header('Location: index.php?action=showLogin&message=Credenziali+non+valide');
    }

    // Mostra registrazione
    public function showRegister()
    {
        $message = $_GET['message'] ?? '';
        $data = [
            'title' => 'Registrazione - Manga Xeno',
            'message' => $message
        ];
        echo $this->templates->render('register', $data);
    }

    // Gestisce registrazione
    public function handleRegister()
    {
        $nome = $_POST['nome'];
        $cognome = $_POST['cognome'];
        $email = $_POST['email'];
        $via = $_POST['via'];
        $civico = $_POST['civico'];
        $citta = $_POST['citta'];
        $telefono = $_POST['telefono'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $this->db = new UserDB();
        // Controlla se email esiste
        if ($this->db->getUserByEmail($email)) {
            header('Location: index.php?action=showRegister&message=Email+gia+registrata');
            return;
        }

        // Crea utente
        $this->db->createUser($nome, $cognome, $email, $password, $via, $civico, $citta, $telefono);
        header('Location: index.php?action=showLogin&message=Registrazione+completata');
    }

    // Logout
    public function handleLogout()
    {
        session_destroy();
        header('Location: index.php');
    }
}
