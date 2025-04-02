<!-- <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My MVC starter template</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <div class="container">
        <div class="banner">
            <img src="../public/images/banner.png" alt="Bannière">
            <h1>Bienvenue sur My MVC starter template</h1>
        </div>
    </div>
</body>
</html> -->

<?php require VIEWS . 'includes/header.inc.php'; ?>

<h1><?= $title ?? 'Page sans titre' ?></h1>
<p><?= $message ?? '' ?></p>

<?php require VIEWS . 'includes/footer.inc.php'; ?>
