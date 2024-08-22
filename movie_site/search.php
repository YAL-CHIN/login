<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['search'])) {
    $search_query = $_GET['search'];

    $stmt = $pdo->prepare("SELECT * FROM movies WHERE title LIKE :search_query");
    $stmt->execute(['search_query' => '%' . $search_query . '%']);
    $movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Results</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">MovieSite</a>
        <!-- Include your navigation bar here -->
    </nav>

    <div class="container">
        <h2>Search Results</h2>
        <div class="row">
            <?php if (isset($movies) && count($movies) > 0): ?>
                <?php foreach ($movies as $movie): ?>
                    <div class="col-md-3">
                        <div class="card mb-4">
                            <img src="assets/images/<?= htmlspecialchars($movie['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($movie['title']) ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($movie['title']) ?></h5>
                                <p class="card-text"><?= htmlspecialchars($movie['genre']) ?> (<?= htmlspecialchars($movie['year']) ?>)</p>
                                <p class="card-text">Cast: <?= htmlspecialchars($movie['cast']) ?></p>
                                <p class="card-text">Language: <?= htmlspecialchars($movie['language']) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No movies found.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
