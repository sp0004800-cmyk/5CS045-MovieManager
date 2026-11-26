<?php
header('Content-Type: text/plain');

echo "Starting diagnostic test...\n\n";

// Test Twig
try {
    require_once __DIR__ . '/../vendor/autoload.php';

    $loader = new \Twig\Loader\ArrayLoader([
        'test' => 'Twig is working successfully!'
    ]);

    $twig = new \Twig\Environment($loader);

    echo $twig->render('test');
    echo "\n";

} catch (Throwable $e) {
    echo "Twig test FAILED\n";
}

// Test database
try {
    require_once __DIR__ . '/db_connect.php';

    $result = $mysqli->query("SELECT COUNT(*) FROM movie");
    $row = $result->fetch_row();

    echo "Database connected successfully!\n";
    echo "Total movies: " . $row[0] . "\n";

} catch (Throwable $e) {
    echo "Database test FAILED\n";
}