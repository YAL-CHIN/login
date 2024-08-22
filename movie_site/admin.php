<?php
include 'includes/db.php';
include 'includes/auth.php';

if (!isAdmin()) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        $stmt = $pdo->prepare("INSERT INTO movies (title, image, year, genre, cast, language) VALUES (:title, :image, :year, :genre, :cast, :language)");
        $stmt->execute([
            'title' => $_POST['title'],
            'image' => $_POST['image'],
            'year' => $_POST['year'],
            'genre' => $_POST['genre'],
            'cast' => $_POST['cast'],
            'language' => $_POST['language']
        ]);
    } elseif (isset($_POST['delete'])) {
        $stmt = $pdo->prepare("DELETE FROM movies WHERE id = :id");
        $stmt->execute(['id' => $_POST['movie_id']]);
    }
}

$movies = $pdo->query("SELECT * FROM movies")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Page</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">MovieSite</a>
        <!-- Include your navigation bar here -->
    </nav>

    <div class="container">
        <h2>Admin Page</h2>

        <h3>Add Movie</h3>
        <form method="post">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="image">Image Filename</label>
                <input type="text" id="image" name="image" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="year">Year</label>
                <input type="number" id="year" name="year" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="genre">Genre</label>
                <input type="text" id="genre" name="genre" class="form-control">
            </div>
            <div class="form-group">
                <label for="cast">Cast</label>
                <textarea id="cast" name="cast" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="language">Language</label>
                <input type="text" id="language" name="language" class="form-control">
            </div>
            <button type="submit" name="add" class="btn btn-primary">Add Movie</button>
        </form>

        <h3 class="mt-5">Manage Movies</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Year</th>
                    <th>Genre</th>
                    <th>Cast</th>
                    <th>Language</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($movies as $movie): ?>
                    <tr>
                        <td><?= htmlspecialchars($movie['title']) ?></td>
                        <td><img src="assets/images/<?= htmlspecialchars($movie['image']) ?>" width="100"></td>
                        <td><?= htmlspecialchars($movie['year']) ?></td>
                        <td><?= htmlspecialchars($movie['genre']) ?></td>
                        <td><?= htmlspecialchars($movie['cast']) ?></td>
                        <td><?= htmlspecialchars($movie['language']) ?></td>
                        <td>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="movie_id" value="<?= htmlspecialchars($movie['id']) ?>">
                                <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
