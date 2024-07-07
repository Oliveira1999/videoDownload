<?php
$usuario = "root";
$senha = "";
$banco = "video_baixar";
$servidor = "localhost";

try {
    // Tenta conectar ao banco de dados usando PDO
    $pdo = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Define o modo de erro para lançar exceções

    //echo "Conexão com o banco de dados estabelecida com sucesso.";
} catch (PDOException $e) {
    // Captura e exibe o erro caso a conexão falhe
    echo 'Erro ao conectar com o banco de dados:<br>' . $e->getMessage();
}

// Aqui você pode continuar com outras configurações ou variáveis do sistema
$tel_sistema = '(31) 00000-0000';
$nome_sistema = 'Portal Bruno';
$email_sistema = 'silvarecordz99@gmail.com';
?>
