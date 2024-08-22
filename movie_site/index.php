<?php
include 'includes/db.php';
include 'includes/auth.php';

$search_query = '';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['search'])) {
    $search_query = $_GET['search'];
}

$stmt = $pdo->prepare("SELECT * FROM movies WHERE title LIKE :search_query");
$stmt->execute(['search_query' => '%' . $search_query . '%']);
$movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/css/style.css" rel="stylesheet">

</head>
<body>




    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">MovieSite</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <?php if (isLoggedIn()): ?>
                    <li class="nav-item"><a class="nav-link" href="search.php">Search Movies</a></li>
                    <?php if (isAdmin()): ?>
                        <li class="nav-item"><a class="nav-link" href="admin.php">Admin Page</a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
                <?php endif; ?>
            </ul>
            <form class="form-inline my-2 my-lg-0" method="get" action="index.php">
                <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search movies" aria-label="Search" value="<?= htmlspecialchars($search_query) ?>">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <div class="container">
        <h2>Movies</h2>
        <div class="row">
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
        </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./assets/js/script.js"></script>
</body>
</html>
