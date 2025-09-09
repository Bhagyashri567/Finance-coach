<?php
if (session_status()===PHP_SESSION_NONE) session_start();
$auth = isset($_SESSION['uid']);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Financecoach</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap + Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <!-- App styles -->
    <link href="/assets/css/style.css" rel="stylesheet">

    <style>
    :root {
        --brand-primary: #ad0ca8ff;
        /* coral */
        --brand-secondary: #fb24dbff;
        /* amber */
        --brand-accent: #ec4899;
        /* rose */
        --brand-dark: #1e1b4b;
        /* deep indigo */
        --brand-light: #fafaf9;
        /* warm gray */
    }

    .topbar {
        background: var(--brand-dark);
        color: #fff;
    }

    .navbar {
        background: linear-gradient(90deg, var(--brand-primary), var(--brand-accent));
    }

    .navbar-brand span {
        font-weight: 700;
        color: #fff;
    }

    .navbar-nav .nav-link {
        color: #fff !important;
        position: relative;
        transition: color .3s;
    }

    .navbar-nav .nav-link::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -4px;
        width: 0;
        height: 2px;
        background: var(--brand-secondary);
        transition: width .3s;
    }

    .navbar-nav .nav-link:hover::after {
        width: 100%;
    }

    .navbar-nav .nav-link:hover {
        color: var(--brand-secondary) !important;
    }

    .navbar .btn-light {
        background: var(--brand-secondary);
        border: none;
        color: var(--brand-dark);
    }

    .navbar .btn-light:hover {
        background: #fff;
        color: var(--brand-dark);
        box-shadow: 0 2px 6px rgba(0, 0, 0, .2);
    }
    </style>
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/index.php">
                <img src="assets/logo.png" alt="logo" width="100" height="100" class="me-2">
                <span>Financecoach</span>
            </a>
            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#mainnav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="mainnav" class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="budgets.php">Budgets</a></li>
                    <li class="nav-item"><a class="nav-link" href="goals.php">Goals</a></li>
                    <li class="nav-item"><a class="nav-link" href="investment.php">Investment plans </a></li>
                    <li class="nav-item"><a class="nav-link" href="chatbot.php">Chatbot</a></li>
                    <?php if($auth): ?>
                    <li class="nav-item ms-lg-3"><a class="btn btn-light btn-sm" href="/auth/logout.php">Logout</a></li>
                    <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">