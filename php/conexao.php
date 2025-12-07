<?php
// Arquivo de Configuração de Credenciais

$host = 'localhost'; 
$port = 3306; 
$dbname = 'db_katchau'; 
$username = 'root'; 
$password = 'root'; // <<< Confirme este valor no seu ambiente

$charset = 'utf8mb4';

// 1. DSN (Data Source Name): Agora inclui a porta
$dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=$charset";

// 2. OPÇÕES PDO
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, 
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
    PDO::ATTR_EMULATE_PREPARES   => false, 
];

// 3. ESTABELECIMENTO DA CONEXÃO
try {
    // Usamos $username e $password
    $pdo = new PDO($dsn, $username, $password, $options);
    
} catch (\PDOException $e) {
    // Em produção, nunca mostre a mensagem de erro detalhada!
    error_log("Erro Fatal de Conexão com o Banco: " . $e->getMessage());
    die("Erro interno do servidor. Tente novamente mais tarde.");
}

// A variável $pdo contém a conexão ativa.
?>