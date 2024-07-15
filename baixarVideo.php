<?php

require_once('conexao.php');

$query = $pdo->query("SELECT * FROM quant_download");
$res = $query->FetchAll(PDO::FETCH_ASSOC);
if (count($res) == 0) {
    
    $pdo->query("INSERT INTO quant_download set count ='0'");
}

if (isset($_GET['videoId'])) {
    $videoId = $_GET['videoId'];
    $outputDir =  'C:/xampp/htdocs/videoDownload/downloads'; // Diretório para downloads

    // Certifique-se que a pasta 'downloads' existe e tem permissão de escrita
    if (!file_exists($outputDir)) {
        mkdir($outputDir, 0777, true);
    }

    // Comando para baixar o vídeo usando yt-dlp com formato específico
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
        // Caso o arquivo não tenha sido encontrado ou o download tenha falhado
        echo "Erro: Não foi possível baixar o vídeo. Verifique se o vídeo está disponível para download.";
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