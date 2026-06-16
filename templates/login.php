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
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        /* Left panel - decorative */
        .login-panel-left {
            background:
                radial-gradient(ellipse 70% 70% at 30% 50%, rgba(162, 123, 92, 0.12) 0%, transparent 70%),
                var(--surface2);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem;
            position: relative;
            overflow: hidden;
            border-right: 1px solid var(--border);
        }

        .login-panel-left::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(0, 0, 0, 0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 0, 0, 0.02) 1px, transparent 1px);
            background-size: 50px 50px;
        }

        .brand-display {
            position: relative;
            text-align: center;
        }

        .brand-display .logo-text {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(3.5rem, 6vw, 5.5rem);
            color: var(--text);
            letter-spacing: 0.05em;
            line-height: 1;
            display: block;
        }

        .brand-display .logo-text span {
            color: var(--accent);
        }

        .brand-display .tagline {
            margin-top: 1rem;
            font-size: 0.82rem;
            color: var(--text-dim);
            letter-spacing: 0.06em;
        }

        .brand-features {
            margin-top: 2.5rem;
            display: flex;
            flex-direction: column;
            gap: 0.85rem;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.85rem;
            color: var(--text-dim);
        }

        .feature-item i {
            color: var(--accent);
            font-size: 1rem;
            flex-shrink: 0;
        }

        /* Right panel - form */
        .login-panel-right {
            background: var(--surface);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 2rem;
        }

        .login-form-wrap {
            width: 100%;
            max-width: 360px;
        }

        .form-title {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 0.4rem;
        }

        .form-subtitle {
            font-size: 0.85rem;
            color: var(--text-dim);
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--text-dim);
            margin-bottom: 0.45rem;
        }

        .form-input {
            width: 100%;
            background: var(--surface2);
            border: 1px solid var(--border2);
            border-radius: 6px;
            padding: 0.75rem 1rem;
            font-size: 0.92rem;
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
            box-shadow: 0 0 0 3px rgba(162, 123, 92, 0.15);
        }

        .btn-login {
            width: 100%;
            background: var(--accent);
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 0.85rem;
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            font-family: 'DM Sans', sans-serif;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
            margin-top: 0.5rem;
        }

        .btn-login:hover {
            background: var(--accent-dark);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(162, 123, 92, 0.3);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 1.75rem 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        .divider span {
            font-size: 0.72rem;
            color: var(--muted);
            white-space: nowrap;
        }

        .alt-links {
            text-align: center;
        }

        .alt-link {
            display: block;
            font-size: 0.85rem;
            color: var(--text-dim);
            text-decoration: none;
            padding: 0.35rem 0;
            transition: color 0.2s;
        }

        .alt-link:hover {
            color: var(--text);
        }

        .alt-link.accent {
            color: var(--accent);
            font-weight: 600;
        }

        .alt-link.accent:hover {
            color: var(--accent-dark);
        }

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
            margin-top: 1px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            body {
                grid-template-columns: 1fr;
            }

            .login-panel-left {
                display: none;
            }

            .login-panel-right {
                padding: 2rem 1.5rem;
            }
        }
    </style>
</head>

<body>

    <!-- Left decorative panel -->
    <div class="login-panel-left">
        <div class="brand-display">
            <span class="logo-text">MANGA<span>XENO</span></span>
            <p class="tagline">Manga · Figure · Carte Collezionabili</p>

            <div class="brand-features">
                <div class="feature-item">
                    <i class="bi bi-truck"></i>
                    <span>Spedizione gratuita oltre €50</span>
                </div>
                <div class="feature-item">
                    <i class="bi bi-shield-lock"></i>
                    <span>Pagamenti sicuri e protetti</span>
                </div>
                <div class="feature-item">
                    <i class="bi bi-arrow-counterclockwise"></i>
                    <span>Reso facile entro 30 giorni</span>
                </div>
                <div class="feature-item">
                    <i class="bi bi-collection"></i>
                    <span>Migliaia di prodotti disponibili</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Right form panel -->
    <div class="login-panel-right">
        <div class="login-form-wrap">
            <h1 class="form-title">Bentornato</h1>
            <p class="form-subtitle">Accedi al tuo account per continuare</p>

            <?php if (!empty($message)): ?>
                <div class="alert-custom">
                    <i class="bi bi-info-circle"></i>
                    <span><?= $message ?></span>
                </div>
            <?php endif; ?>

            <form method="POST" action="index.php?action=handleLogin">
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-input" placeholder="mario@esempio.it" required autocomplete="email">
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-input" placeholder="••••••••" required autocomplete="current-password">
                </div>

                <button type="submit" class="btn-login">Accedi</button>
            </form>

            <div class="divider"><span>oppure</span></div>

            <div class="alt-links">
                <a href="index.php?action=showRegister" class="alt-link accent">Crea un nuovo account →</a>
                <a href="index.php" class="alt-link" style="margin-top:0.5rem; font-size:0.78rem; color:var(--muted);">
                    <i class="bi bi-arrow-left me-1"></i>Torna alla Home
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>