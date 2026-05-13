<?php
/** @var string $site_name */
/** @var string $message */
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione | <?= $site_name ?? 'Manga E-commerce' ?></title>
    
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
            padding: 3rem 0;
            display: flex;
            align-items: center;
        }

        .card-register {
            border: none;
            border-radius: 1.5rem;
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.1) !important;
            overflow: hidden;
            width: 100%;
            max-width: 700px;
            margin: auto;
        }

        .card-register .card-header {
            background: #212529;
            color: white;
            border: none;
            padding: 2rem 1.5rem;
            text-align: center;
        }

        .card-register .card-header h2 {
            font-family: 'Bebas Neue', sans-serif;
            letter-spacing: 2px;
            margin-bottom: 0;
            font-size: 2.5rem;
        }

        .card-register .card-body {
            padding: 2.5rem;
            background: white;
        }

        .btn-register {
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 1rem;
            border-radius: 0.75rem;
            transition: all 0.3s ease;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .back-to-home {
            position: fixed;
            top: 2rem;
            left: 2rem;
            color: #212529;
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: opacity 0.3s;
            z-index: 1000;
        }

        .back-to-home:hover {
            opacity: 0.7;
            color: #212529;
        }

        .section-title {
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
            color: #6c757d;
            margin-bottom: 1.5rem;
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 0.5rem;
        }
    </style>
</head>
<body>

    <a href="index.php" class="back-to-home">
        <i class="bi bi-arrow-left"></i> Torna alla Home
    </a>

    <div class="container">
        <div class="card card-register">
            <div class="card-header">
                <h2>Crea un Account</h2>
                <p class="text-white-50 mb-0 small">Unisciti alla community di <?= $site_name ?? 'Manga Xeno' ?></p>
            </div>
            <div class="card-body">
                
                <?php if (!empty($message)): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= htmlspecialchars($message) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <form action="index.php?action=register" method="POST">
                    
                    <div class="section-title">Informazioni Personali</div>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required>
                                <label for="nome">Nome</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="cognome" name="cognome" placeholder="Cognome" required>
                                <label for="cognome">Cognome</label>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                                <label for="email">Email</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Telefono" required>
                                <label for="telefono">Telefono</label>
                            </div>
                        </div>
                    </div>

                    <div class="section-title">Sicurezza</div>
                    <div class="row g-3 mb-4">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                <label for="password">Password</label>
                            </div>
                        </div>
                    </div>

                    <div class="section-title">Indirizzo di Spedizione</div>
                    <div class="row g-3 mb-4">
                        <div class="col-md-8">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="via" name="via" placeholder="Via" required>
                                <label for="via">Via / Piazza</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="civico" name="civico" placeholder="Civico" required>
                                <label for="civico">N° Civico</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="citta" name="citta" placeholder="Città" required>
                                <label for="citta">Città</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 pt-3">
                        <button type="submit" class="btn btn-dark btn-register">
                            Registrati Ora
                        </button>
                    </div>
                    
                </form>

                <div class="text-center mt-4">
                    <p class="small mb-0 text-muted">
                        Hai già un account? 
                        <a href="index.php?action=showLogin" class="text-dark fw-bold text-decoration-none">Accedi</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
