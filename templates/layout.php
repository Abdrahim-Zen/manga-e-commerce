<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title><?= $this->e($title) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,700;1,9..40,400&display=swap" rel="stylesheet">

    <style>
        :root {
            /*colore principale*/
            --accent: #A27B5C;
            --accent-dark: #8B6A4F;
            /*sfondo sito*/
            --dark: #DCD7C9;
            /*sfondo contenitori*/
            --surface: #181818;
            --surface2: #222222;
            --surface3: #2a2a2a;
            /*confini*/
            --border: rgba(255, 255, 255, 0.07);
            --border2: rgba(255, 255, 255, 0.12);
            /*testo*/
            --text: #2C3639;
            --text-dim: #aaa;
            --muted: #666;
            /*hover testo*/
            --text-hover: #43766C;
            --text-hover2: #A27B5C;
            /*font*/
            --font-display: 'Bebas Neue', sans-serif;
            --font-body: 'DM Sans', sans-serif;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background: var(--dark);
            color: var(--text);
            font-family: var(--font-body);
            font-size: 15px;
            line-height: 1.65;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ─── MAIN ─── */
        main {
            flex: 1 0 auto;
        }

        /* ─── GLOBAL COMPONENT STYLES ─── */

        /* Buttons */
        .btn-primary {
            background: var(--accent) !important;
            border-color: var(--accent) !important;
            color: #fff !important;
            font-weight: 600;
            font-size: 0.82rem;
            letter-spacing: 0.06em;
            border-radius: 4px;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
        }

        .btn-primary:hover {
            background: var(--accent-dark) !important;
            border-color: var(--accent-dark) !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 16px rgba(162, 123, 92, 0.3);
        }

        .btn-outline-primary {
            border-color: rgba(162, 123, 92, 0.5) !important;
            color: var(--accent) !important;
            font-weight: 600;
            font-size: 0.82rem;
            letter-spacing: 0.06em;
            border-radius: 4px;
            transition: all 0.2s;
        }

        .btn-outline-primary:hover {
            background: var(--accent) !important;
            border-color: var(--accent) !important;
            color: #fff !important;
        }

        .btn-outline-danger {
            border-color: rgba(220, 53, 69, 0.4) !important;
            color: #dc3545 !important;
            border-radius: 4px;
            font-size: 0.82rem;
        }

        .btn-outline-danger:hover {
            background: #dc3545 !important;
            color: #fff !important;
        }

        /* Cards */
        .card {
            background: var(--surface) !important;
            border: 1px solid var(--border) !important;
            border-radius: 8px;
        }

        .card-body {
            padding: 1.25rem;
        }

        /* Form controls */
        .form-control,
        .form-select {
            background: var(--surface2) !important;
            border: 1px solid var(--border2) !important;
            color: var(--text-dim) !important;
            border-radius: 6px;
            font-family: var(--font-body);
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-control:focus,
        .form-select:focus {
            background: var(--surface3) !important;
            border-color: var(--accent) !important;
            box-shadow: 0 0 0 3px rgba(162, 123, 92, 0.15) !important;
            color: var(--text-dim) !important;
            outline: none;
        }

        .form-control::placeholder {
            color: var(--muted) !important;
        }

        .form-label {
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--text-dim);
            margin-bottom: 0.4rem;
        }

        /* Utilities */
        .text-primary {
            color: var(--accent) !important;
        }

        .text-muted {
            color: var(--text-dim) !important;
        }

        .badge {
            font-size: 0.68rem;
            font-weight: 600;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            border-radius: 3px;
            padding: 0.3em 0.65em;
        }

        /* Product cards global */
        .product-card {
            transition: transform 0.3s cubic-bezier(0.25, 0.8, 0.25, 1), box-shadow 0.3s ease, border-color 0.3s ease;
            overflow: hidden;
        }

        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 48px rgba(0, 0, 0, 0.5) !important;
            border-color: var(--border2) !important;
        }

        .product-card .card-img-top {
            aspect-ratio: 3/4;
            object-fit: cover;
            transition: transform 0.5s ease;
            background: var(--surface2);
        }

        .product-card:hover .card-img-top {
            transform: scale(1.05);
        }

        .product-card .card-title {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text);
            line-height: 1.3;
            margin-bottom: 0.5rem;
        }

        .price {
            font-family: var(--font-display);
            font-size: 1.6rem !important;
            letter-spacing: 0.04em;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: var(--dark);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--surface3);
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--border2);
        }

        /* Section headings */
        .section-heading {
            font-family: var(--font-display);
            font-size: 2.2rem;
            letter-spacing: 0.04em;
            color: var(--text);
            line-height: 1;
        }

        .section-label {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            color: var(--accent);
        }
    </style>

    <?= $this->section('extra_styles') ?>
</head>

<body>
    <?php
    if (session_status() === PHP_SESSION_NONE) session_start();
    $base_url = 'index.php';
    $site_name = 'Manga Xeno';
    $user = null;
    $role = null;
    if (isset($_SESSION['user_id'])) {
        $user = ['id' => $_SESSION['user_id'], 'name' => $_SESSION['user_name'] ?? 'Utente', 'email' => $_SESSION['user_email'] ?? ''];
        $role = $_SESSION['user_role'] ?? null;
    }


    /*
    $admin = null;
    if (isset($_SESSION['user_id'])) {
        $user = ['id' => $_SESSION['user_id'], 'name' => $_SESSION['user_name'] ?? 'Utente', 'email' => $_SESSION['user_email'] ?? ''];
    }
    if (isset($_SESSION['admin_id'])) {
        $admin = ['id' => $_SESSION['admin_id'], 'name' => $_SESSION['admin_name'] ?? 'Amministratore', 'email' => $_SESSION['admin_email'] ?? ''];
    }
        */
    ?>

    <!-- ─── HEADER ─── -->
    <header class="site-header">
        <div class="container">
            <?php
            $is_admin = (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin');
            $brand_url = $is_admin ? $this->e($base_url) . '?action=dashboard' : $this->e($base_url);
            ?>
            <?= $this->fetch('partials/header', [
                'base_url' => $base_url,
                'site_name' => $site_name,
                'user' => $user,
                'role' => $role,
                'brand_url' => $brand_url
            ]) ?>
        </div>
    </header>

    <!-- ─── MAIN ─── -->
    <main>
        <?= $this->section('main_content') ?>
    </main>

    <!-- ─── FOOTER ─── -->
    <?= $this->fetch('partials/footer') ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <?= $this->section('page_scripts') ?>
</body>

</html>