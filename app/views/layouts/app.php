<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?? 'ACS Transportation'; ?></title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body class="antialiased">
    <main class="min-h-screen">
        <?php
        if (isset($data['content'])) {
            require_once '../app/views/' . $data['content'] . '.php';
        }
        ?>
    </main>
    
    <?php require_once __DIR__."/footer.php" ?>

    <script src="/js/alpine.js" defer></script>
</body>
</html>