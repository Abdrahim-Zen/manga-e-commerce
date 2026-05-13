<?php
/** @var string $site_name */
/** @var string $message */
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accedi | <?= $site_name ?? 'Manga E-commerce' ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .card-login {
            border: none;
            border-radius: 1.5rem;
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.1) !important;
            overflow: hidden;
            width: 100%;
            max-width: 400px;
            margin: auto;
        }

        .card-login .card-header {
            background: #212529;
            color: white;
            border: none;
            padding: 2.5rem 1.5rem;
            text-align: center;
        }

        .card-login .card-header h2 {
            font-family: 'Bebas Neue', sans-serif;
            letter-spacing: 2px;
            margin-bottom: 0;
            font-size: 2.5rem;
        }

        .card-login .card-body {
            padding: 2.5rem;
            background: white;
        }

        .form-floating mb-4 > label {
            padding-left: 1rem;
        }

        .btn-login {
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 1rem;
            border-radius: 0.75rem;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .back-to-home {
            position: absolute;
            top: 2rem;
            left: 2rem;
            color: #212529;
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: opacity 0.3s;
        }

        .back-to-home:hover {
            opacity: 0.7;
            color: #212529;
        }
    </style>
</head>
<body>

    <a href="index.php" class="back-to-home">
        <i class="bi bi-arrow-left"></i> Torna alla Home
    </a>

    <div class="container">
        <div class="card card-login">
            <div class="card-header">
                <h2>Accedi</h2>
                <p class="text-white-50 mb-0 small">Bentornato su <?= $site_name ?? 'Manga Xeno' ?></p>
            </div>
            <div class="card-body">
                
                <?php if (!empty($message)): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= htmlspecialchars($message) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <!-- 
                    BACKEND POST:
                    Punta alla rotta gestita dal handleLogin() del tuo controller.
                -->
                <form action="index.php?action=handleLogin" method="POST">
                    
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                        <label for="email">Indirizzo Email</label>
                    </div>
                    
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        <label for="password">Password</label>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-dark btn-login">
                            Entra ora
                        </button>
                    </div>
                    
                </form>

                <div class="text-center mt-4">
                    <p class="small mb-0 text-muted">
                        Non hai un account? 
                        <a href="index.php?action=showRegister" class="text-dark fw-bold text-decoration-none">Registrati</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
