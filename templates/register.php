<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --accent: #A27B5C;
            --accent-dark: #8B6A4F;
            --dark: #DCD7C9;
            --surface: #FFFFFF;
            --surface2: #F5F5F5;
            --surface3: #E8E8E8;
            --border: rgba(0, 0, 0, 0.08);
            --border2: rgba(0, 0, 0, 0.12);
            --text: #2C3639;
            --text-dim: #666;
            --muted: #888;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background: var(--dark);
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2.5rem 1rem;
        }

        .register-container {
            width: 100%;
            max-width: 640px;
        }

        /* Header */
        .page-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .logo-text {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2.4rem;
            color: var(--text);
            letter-spacing: 0.05em;
        }

        .logo-text span {
            color: var(--accent);
        }

        .page-subtitle {
            font-size: 0.85rem;
            color: var(--text-dim);
            margin-top: 0.3rem;
        }

        /* Form card */
        .form-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 2.5rem;
        }

        /* Section dividers */
        .form-section-label {
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            color: var(--accent);
            margin-bottom: 1.25rem;
            margin-top: 1.75rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .form-section-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        .form-section-label:first-child {
            margin-top: 0;
        }

        /* Form elements */
        .form-label {
            display: block;
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--text-dim);
            margin-bottom: 0.4rem;
        }

        .form-input {
            width: 100%;
            background: var(--surface2);
            border: 1px solid var(--border2);
            border-radius: 6px;
            padding: 0.7rem 0.9rem;
            font-size: 0.9rem;
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }

        .form-input::placeholder {
            color: var(--muted);
        }

        .form-input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(162, 123, 92, 0.14);
            background: var(--surface3);
        }

        .form-row {
            display: grid;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .form-row.cols-2 {
            grid-template-columns: 1fr 1fr;
        }

        .form-row.cols-3-1 {
            grid-template-columns: 3fr 1fr;
        }



        /* Submit */
        .btn-register {
            width: 100%;
            background: var(--accent);
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 0.9rem;
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            font-family: 'DM Sans', sans-serif;
            cursor: pointer;
            margin-top: 1.75rem;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
        }

        .btn-register:hover {
            background: var(--accent-dark);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(162, 123, 92, 0.3);
        }

        /* Alert */
        .alert-custom {
            background: rgba(162, 123, 92, 0.1);
            border: 1px solid rgba(162, 123, 92, 0.2);
            border-radius: 6px;
            padding: 0.75rem 1rem;
            font-size: 0.85rem;
            color: var(--text);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: flex-start;
            gap: 0.6rem;
        }

        .alert-custom i {
            color: var(--accent);
            flex-shrink: 0;
            margin-top: 2px;
        }

        /* Footer links */
        .form-footer {
            text-align: center;
            margin-top: 1.75rem;
        }

        .footer-link {
            font-size: 0.85rem;
            color: var(--text-dim);
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer-link:hover {
            color: var(--text);
        }

        .footer-link.accent {
            color: var(--accent);
            font-weight: 600;
        }

        /* Responsive */
        @media (max-width: 540px) {

            .form-row.cols-2,
            .form-row.cols-3-1 {
                grid-template-columns: 1fr;
            }

            .form-card {
                padding: 1.75rem 1.25rem;
            }
        }
    </style>
</head>

<body>
    <div class="register-container">

        <div class="page-header">
            <div class="logo-text">MANGA<span>XENO</span></div>
            <p class="page-subtitle">Crea il tuo profilo per iniziare a fare acquisti</p>
        </div>

        <?php if (!empty($message)): ?>
            <div class="alert-custom">
                <i class="bi bi-info-circle"></i>
                <span><?= $message ?></span>
            </div>
        <?php endif; ?>

        <div class="form-card">
            <form method="POST" action="index.php?action=handleRegister">

                <!-- Account -->
                <p class="form-section-label">Dati Account</p>

                <div class="form-row cols-2">
                    <div class="form-group">
                        <label class="form-label">Nome</label>
                        <input type="text" name="nome" class="form-input" placeholder="Mario" required autocomplete="given-name">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Cognome</label>
                        <input type="text" name="cognome" class="form-input" placeholder="Rossi" required autocomplete="family-name">
                    </div>
                </div>

                <div class="form-row cols-2">
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-input" placeholder="mario@esempio.it" required autocomplete="email">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-input" placeholder="••••••••" required autocomplete="new-password">
                    </div>
                </div>

                <!-- Spedizione -->
                <p class="form-section-label">Indirizzo di Spedizione</p>

                <div class="form-row cols-3-1">
                    <div class="form-group">
                        <label class="form-label">Via / Piazza</label>
                        <input type="text" name="via" class="form-input" placeholder="Via Roma" required autocomplete="street-address">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Civico</label>
                        <input type="text" name="civico" class="form-input" placeholder="10" inputmode="numeric" required>
                    </div>
                </div>

                <div class="form-row cols-2">
                    <div class="form-group">
                        <label class="form-label">Città</label>
                        <input type="text" name="citta" class="form-input" placeholder="Milano" required autocomplete="address-level2">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Telefono</label>
                        <input type="tel" name="telefono" class="form-input" placeholder="+39 333 000 0000" required autocomplete="tel">
                    </div>
                </div>

                <button type="submit" class="btn-register">
                    <i class="bi bi-person-check me-2"></i>Completa Registrazione
                </button>
            </form>
        </div>

        <div class="form-footer">
            <p style="font-size:0.85rem; color:var(--muted); margin-bottom:0.5rem;">
                Hai già un account?
                <a href="index.php?action=showLogin" class="footer-link accent ms-1">Accedi →</a>
            </p>
            <a href="index.php" class="footer-link" style="font-size:0.78rem; color:var(--muted);">
                <i class="bi bi-arrow-left me-1"></i>Torna alla Home
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>