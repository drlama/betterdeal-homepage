<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>BetterDeal – Wir renovieren. Sie profitieren.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="bg-light text-center py-5">
        <img src="logo.png" alt="BetterDeal Logo" class="mb-3" style="width:180px;">
        <h1 class="display-4 fw-bold">BetterDeal</h1>
        <p class="lead">Wir renovieren. Sie profitieren.</p>
    </header>
    <main class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Willkommen bei BetterDeal</h2>
                <p>
                    Wir bieten Ihnen professionelle Renovierungsdienstleistungen, damit Sie von Ihrem Immobilienwert optimal profitieren können.
                </p>
                <button class="btn btn-primary" id="kontaktBtn">Kontaktieren Sie uns</button>
                <div id="kontaktForm" class="mt-4" style="display:none;">
                    <form id="ajaxForm">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">E-Mail</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="nachricht" class="form-label">Nachricht</label>
                            <textarea class="form-control" id="nachricht" name="nachricht" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Absenden</button>
                    </form>
                    <div id="formResponse" class="mt-3"></div>
                </div>
            </div>
        </div>
    </main>
    <footer class="bg-dark text-light text-center py-4">
        &copy; <?php echo date("Y"); ?> BetterDeal. Alle Rechte vorbehalten.
    </footer>
    <!-- Bootstrap JS + Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="app.js"></script>
</body>
</html>
