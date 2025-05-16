<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title ?? 'Literary Repo') ?></title>
    <link rel="stylesheet" href="/css/style.css">
    <script src="/js/app.js" defer></script>
</head>
<body>
    <?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
    <?php include __DIR__ . '/../partials/header.php'; ?>

    <main>
        <?php include __DIR__ . '/../components/alert.php'; ?>
        <?php if (isset($content) && file_exists($content)) include $content; ?>
    </main>

    <?php include __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>