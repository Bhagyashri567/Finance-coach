<?php
if (session_status()===PHP_SESSION_NONE) session_start();

// If user is already logged in
if (isset($_SESSION['uid'])) {
    header("Location: index.php");
    exit;
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Login - Financecoach</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    :root {
        --brand-primary: #ad0ca8ff;
        --brand-accent: #ec4899;
        --brand-dark: #1e1b4b;
    }

    body {
        background: linear-gradient(135deg, var(--brand-dark), #3b2f77);
        font-family: 'Inter', system-ui, sans-serif;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-card {
        background: #fff;
        border-radius: 1rem;
        box-shadow: 0 12px 24px rgba(0, 0, 0, .2);
        padding: 2rem;
        width: 100%;
        max-width: 400px;
    }

    .btn-primary {
        background: linear-gradient(90deg, var(--brand-primary), var(--brand-accent));
        border: none;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 18px rgba(0, 0, 0, .25);
    }
    </style>
</head>

<body>

    <div class="login-card">
        <h3 class="fw-bold mb-3 text-center" style="color:var(--brand-dark)">Financecoach Login</h3>

        <!-- No real auth for now: redirects to index.php -->
        <form method="post" action="index.php">
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>