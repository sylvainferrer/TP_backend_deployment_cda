<?php
// CORS
header("Access-Control-Allow-Origin: *"); // Remplace * par l'URL de ton front-end en production (ex: https://monfrontend.com)
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json");

// Gérer la requête OPTIONS préliminaire (préflight)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

require_once "../config.php";

// Vérifie si un ID est passé en paramètre GET
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $pdo->prepare("SELECT * FROM podcasts WHERE id = ?");
    $stmt->execute([$id]);
    $podcast = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($podcast) {
        echo json_encode($podcast);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Podcast non trouvé']);
    }
} else {
    // Récupère tous les podcasts
    $stmt = $pdo->query("SELECT * FROM podcasts ORDER BY created_at DESC");
    $podcasts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($podcasts);
}
?>
