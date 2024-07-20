<?php
require_once('conexao.php');

// Verificar e inicializar o contador de downloads, se necessário
$query = $pdo->query("SELECT * FROM quant_download_audio");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if (count($res) == 0) {
    $pdo->query("INSERT INTO quant_download_audio (count) VALUES (0)");
}

if (isset($_GET['videoIdAudio'])) {
    $videoId = escapeshellarg($_GET['videoIdAudio']);
    $outputDir = 'C:/xampp/htdocs/videoDownload/downloads'; // Diretório para downloads
    $ffmpegPath = 'C:/xampp/htdocs/videoDownload/ffmpeg/bin'; // Caminho para o ffmpeg

    // Certifique-se que a pasta 'downloads' existe e tem permissão de escrita
    if (!file_exists($outputDir)) {
        mkdir($outputDir, 0777, true);
    }

    // Comando para baixar o áudio usando yt-dlp
    $command = "yt-dlp --ffmpeg-location \"$ffmpegPath\" --extract-audio --audio-format mp3 -o \"$outputDir%(title)s.%(ext)s\" https://www.youtube.com/watch?v=$videoId 2>&1";
    $output = shell_exec($command);

    // Verifica se o download foi concluído e obtém o caminho do arquivo
    $downloadPath = glob($outputDir . "*.mp3")[0] ?? null;

    if ($downloadPath && file_exists($downloadPath)) {
        incrementarQuantidadeDownloads($pdo);
        
        // Define cabeçalhos para o download do arquivo
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($downloadPath) . '"');
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
        $pdo->query("UPDATE quant_download_audio SET count = count + 1");
    } catch (PDOException $e) {
        // Captura e exibe o erro caso ocorra um problema na atualização
        echo 'Erro ao incrementar quantidade de downloads:<br>' . $e->getMessage();
    }
}
?>
