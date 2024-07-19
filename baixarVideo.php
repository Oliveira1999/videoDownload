<?php
require_once('conexao.php'); // Certifique-se de que este arquivo está corretamente incluído

if (isset($_GET['videoId'])) {
    $videoId = $_GET['videoId'];
    $outputDir = 'downloads/'; // Diretório para downloads

    // Certifique-se que a pasta 'downloads' existe e tem permissão de escrita
    if (!file_exists($outputDir)) {
        mkdir($outputDir, 0777, true);
    }

    // Comando para baixar o vídeo usando yt-dlp (ajustado para yt-dlp)
    $command = "yt-dlp -o \"$outputDir%(title)s.%(ext)s\" https://www.youtube.com/watch?v=$videoId 2>&1";
    
    // Executa o comando e captura a saída
    $output = shell_exec($command);

    // Verifica se o download foi concluído e obtém o caminho do arquivo
    $downloadPath = glob($outputDir . "*.mp4")[0] ?? null;

    if ($downloadPath && file_exists($downloadPath)) {
        // Incrementa a quantidade de downloads
        incrementarQuantidadeDownloads($pdo);

        // Define o nome do arquivo para download
        $downloadFilename = basename($downloadPath);

        // Define cabeçalhos para o download do arquivo
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $downloadFilename . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($downloadPath));

        // Envia o arquivo para o cliente
        readfile($downloadPath);

        // Remove o arquivo após o download
        unlink($downloadPath);

        exit;
    } else {
        echo "Erro: Arquivo não encontrado.";
    }
} else {
    echo "ID do vídeo não fornecido corretamente.";
}

function incrementarQuantidadeDownloads($pdo) {
    try {
        // Incrementa a quantidade de downloads para o vídeo especificado
        $pdo->query("UPDATE quant_download SET count = count + 1");
    } catch (PDOException $e) {
        // Captura e exibe o erro caso ocorra um problema na atualização
        echo 'Erro ao incrementar quantidade de downloads:<br>' . $e->getMessage();
    }
}
?>
