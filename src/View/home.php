<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= isset($title) ? $title : 'Elden Ring Game' ?></title>
    <link rel="stylesheet" href="public/styles/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Elden Ring Game</h1>
            <nav>
                <ul>
                    <li><a href="combat">Démarrer un combat</a></li>
                    <li><a href="inventory">Inventaire</a></li>
                    <li><a href="stats">Statistiques</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <section class="intro">
                <h2>Bienvenue dans l'univers d'Elden Ring-like</h2>
                <p>Choisissez votre destinée et affrontez les ténèbres pour forger votre légende.</p>
                <a href="combat" class="btn">Commencer l'aventure</a>
            </section>
        </main>
        <footer>
            <p>&copy; 2025 Elden Ring Game - Tous droits réservés</p>
        </footer>
    </div>
</body>
</html>
