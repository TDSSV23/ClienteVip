<?php
// Definição das configurações do banco de dados
define('DB_HOST', 'localhost');
define('DB_PORT', '3307');
define('DB_NAME', 'cliente_vip');
define('DB_USER', 'root');
define('DB_PASS', '');

try {
    // Conectando ao banco de dados com PDO
    $conn = new PDO("mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Tratamento de erro caso a conexão falhe
    echo "Erro na conexão: " . $e->getMessage();
}
