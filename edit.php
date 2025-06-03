<?php
require 'config.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    die("ID du podcast manquant.");
}

$stmt = $pdo->prepare("SELECT * FROM podcasts WHERE id = ?");
$stmt->execute([$id]);
$podcast = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$podcast) {
    die("Podcast introuvable.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $url = $_POST['url'];

    $stmt = $pdo->prepare("UPDATE podcasts SET title = ?, url = ? WHERE id = ?");
    $stmt->execute([$title, $url, $id]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Modifier Podcast</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">

<div class="container py-5" style="max-width: 600px;">
    <h1 class="mb-4 text-primary">Modifier Podcast</h1>
    <form method="post" novalidate>
        <div class="mb-3">
            <label for="title" class="form-label">Titre</label>
            <input 
                type="text" 
                class="form-control" 
                id="title" 
                name="title" 
                required 
                value="<?= htmlspecialchars($podcast['title']) ?>"
                placeholder="Titre du podcast"
            >
        </div>
        <div class="mb-4">
            <label for="url" class="form-label">URL du fichier audio</label>
            <input 
                type="url" 
                class="form-control" 
                id="url" 
                name="url" 
                required 
                value="<?= htmlspecialchars($podcast['url']) ?>"
                placeholder="https://exemple.com/podcast.mp3"
            >
        </div>
        <button type="submit" class="btn btn-primary w-100">Modifier</button>
        <a href="index.php" class="btn btn-secondary w-100 mt-2">Annuler</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
