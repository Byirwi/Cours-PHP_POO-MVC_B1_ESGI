<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultat du Combat - Elden Ring Game</title>
    <link rel="stylesheet" href="public/styles/style.css">
</head>
<body>
    <div class="container combat-container">
        <header class="combat-header">
            <h1>Résultat du Combat</h1>
        </header>
        <main class="combat-main">
            <section class="combat-log">
                <?php if (isset($result) && is_array($result) && !empty($result)): ?>
                    <?php foreach($result as $line): ?>
                        <div class="log-entry"><?= htmlspecialchars($line ?? '') ?></div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="no-result">Aucun résultat de combat à afficher.</p>
                <?php endif; ?>
            </section>
            <section class="combat-navigation">
                <a class="btn" href="index.php">Retour à l'accueil</a>
            </section>
        </main>
        <footer class="combat-footer">
            <p>&copy; 2025 Elden Ring Game</p>
        </footer>
    </div>
</body>
</html>
