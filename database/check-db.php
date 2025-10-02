<?php

try {
    $host = getenv('DB_HOST');
    $port = getenv('DB_PORT');
    $database = getenv('DB_DATABASE');
    $username = getenv('DB_USERNAME');
    $password = getenv('DB_PASSWORD');

    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$database",
        $username,
        $password
    );
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check if services table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'services'");
    if ($stmt->rowCount() > 0) {
        echo "Services table exists\n";
        
        // Check services table content
        $stmt = $pdo->query("SELECT COUNT(*) FROM services");
        $count = $stmt->fetchColumn();
        echo "Services count: $count\n";
    } else {
        echo "Services table does not exist\n";
        
        // Show all tables
        $stmt = $pdo->query("SHOW TABLES");
        echo "Existing tables:\n";
        while ($row = $stmt->fetch()) {
            echo $row[0] . "\n";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}