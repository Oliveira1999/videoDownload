<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Video Downloader</title>
  <!-- Fonte -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700&display=swap" rel="stylesheet">
  <!-- Estilos -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
  <!-- Scripts (jQuery não pode ser o slim que vem do Boostrap) -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/bf7e05c402.js" crossorigin="anonymous"></script>
  <!-- Moment.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-duration-format/2.3.2/moment-duration-format.min.js"></script>
</head>
<body>
  <header>
    <div class="container" id="nav-container">
      <nav class="navbar navbar-expand-lg fixed-top navbar-dark">
        <a class="navbar-brand" href="index.html">
          <img id="logo" src="img/hdcagency_logo.svg" alt="hDC Agency"> hDC Agency
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-links" aria-controls="navbar-links" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbar-links">
          <div class="navbar-nav">
            <a class="nav-item nav-link" id="home-menu" href="#">Video Download</a>
            <a class="nav-item nav-link" id="contact-menu" data-toggle="modal" data-target="#modal-contato" href="#">Contato</a>
          </div>
        </div>
      </nav>
    </div>
  </header>

  <div class="form-container">
    <form id="video-form" method="post">
      <div class="form-group d-flex">
        <input type="text" class="form-control form-control-lg flex-grow-1 mr-2" id="video-url" placeholder="Cole o link aqui">
        <button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-check"></i></button>
      </div>
    </form>
  </div>

  <div class="card" id="video-card" style="display: none;">
    <div class="card-body d-flex">
      <div class="flex-grow-1">
        <h5 class="card-title" id="video-title"></h5>
        <a href="#" id="video-link" target="_blank" style="display: none; color: #FF0000;"><i class="fab fa-youtube"></i> Assistir ao Vídeo no YouTube</a> <!-- Novo elemento de link -->
        <div class="d-flex align-items-start">
          <img id="video-thumbnail" class="img-fluid mr-3" src="" alt="Thumbnail do vídeo">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Ficheiro</th>
                <th>Tamanho</th>
                <th>Download</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>MP4 (Vídeo)</td>
                <td id="video-size"></td>
                <td><button type="button" id="download-video" class="btn btn-outline-danger btn-lg btn-block"><i class="fas fa-download"></i> Baixar Vídeo</button></td>
              </tr>
              <tr>
                <td>MP3 (Áudio)</td>
                <td id="audio-size"></td>
                <td><button type="button" id="download-audio" class="btn btn-outline-danger btn-lg btn-block"><i class="fas fa-download"></i> Baixar Áudio</button></td>
              </tr>
            </tbody>
          </table>
        </div>
        <p class="card-text" id="video-description"></p>
      </div>
    </div>
    <!-- Barra de progresso -->
    <div class="progress" id="progress" style="margin-top: 10px; margin-bottom: 5px; display: none;">
      <div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
    </div>

    <!-- Mensagem de aguarde -->
    <div id="loading-message" class="text-center mt-2" style="display: none;">
      <i class="fas fa-spinner fa-spin fa-2x"></i>
      <p>Aguarde um momento...</p>
    </div>
    <!-- Mensagem de download concluído -->
    <div id="downloaded-message" class="alert alert-success text-center mt-2" style="display: none;">
      <strong>Download concluído!</strong>
    </div>
  </div>

  <footer class="d-flex justify-content-center align-items-center">
    <p class="mb-0">&copy; 2024 Seu Site. Todos os direitos reservados.</p>
    <a href="#" data-toggle="modal" data-target="#modal-politica" style="color: #FFF; font-size: 15px; text-decoration: underline; margin-left: 10px;">Política de Privacidade</a>
  </footer>

 
 <!-- MODAL POLÍTICA -->
 <div class="modal fade" id="modal-politica" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Política de Privacidade</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Aqui vai a sua política de privacidade...</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi euismod, quam ac volutpat tempor, velit erat ultricies lectus, id luctus quam purus sit amet libero. Nullam eget ligula a nisl consectetur rhoncus. Sed in ipsum orci. Phasellus nec libero odio. In vehicula purus nec justo ultrices, ut ultrices velit luctus.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL CONTATO -->
  <div class="modal fade" id="modal-contato" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Contato</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="contact-form" method="post">
            <div class="form-group">
              <label for="name">Nome:</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
              <label for="email">E-mail:</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
              <label for="message">Mensagem:</label>
              <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar Mensagem</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts personalizados -->
  <script src="js/main.js"></script>
</body>
</html>

  <script>
    const API_KEY = 'AIzaSyC7TMz0gFDq6OOSak_Q94SlmMsfgqGgwI8';

    // Função para obter o ID do vídeo do YouTube
    function getYouTubeVideoId(url) {
      const urlObj = new URL(url);
      return urlObj.searchParams.get('v');
    }

    function fetchYouTubeVideo(videoId) {
  $.ajax({
    url: `https://www.googleapis.com/youtube/v3/videos?id=${videoId}&key=${API_KEY}&part=snippet,contentDetails`,
    method: 'GET',
    success: function(response) {
      if (response.items.length > 0) {
        const video = response.items[0];
        const snippet = video.snippet;
        const duration = moment.duration(video.contentDetails.duration).asSeconds();

        $('#video-title').text(snippet.title);
        $('#video-thumbnail').attr('src', snippet.thumbnails.high.url);
        $('#video-card').show();

        // Adicionar link do vídeo
        const videoUrl = `https://www.youtube.com/watch?v=${videoId}`;
        $('#video-link').attr('href', videoUrl).show();

        calculateFileSize(duration);

        // Modificado para buscar o melhor formato de vídeo disponível
        $('#download-video').data('href', `baixarVideo.php?videoId=${videoId}&quality=best`);
        $('#download-audio').data('href', `baixarAudio.php?videoIdAudio=${videoId}`); // Adiciona link para baixar áudio
      } else {
        alert('Vídeo não encontrado');
      }
    },
    error: function() {
      alert('Erro ao buscar o vídeo');
    }
  });
}


    // Função para calcular o tamanho do arquivo de vídeo
    function calculateFileSize(duration) {
      // Considerando um bitrate médio para cálculo do tamanho aproximado
      const bitrate = 2500; // Exemplo de bitrate em kbps (kilobits por segundo)
      const sizeInMegabytes = (bitrate * duration) / (8 * 1024); // Convertendo para MB
      $('#video-size').text(sizeInMegabytes.toFixed(2) + ' MB');
      $('#audio-size').text((sizeInMegabytes / 3).toFixed(2) + ' MB'); // Tamanho aproximado do arquivo de áudio
    }

    // Função para buscar e exibir informações do vídeo quando o formulário é enviado
    function searchVideo() {
      const videoUrl = $('#video-url').val();
      const videoId = getYouTubeVideoId(videoUrl);
      if (videoId) {
        fetchYouTubeVideo(videoId);
      } else {
        alert('Link do vídeo inválido');
      }
    }

    // Evento de submissão do formulário para buscar o vídeo
    $('#video-form').on('submit', function(e) {
      e.preventDefault();
      searchVideo();
    });

    // Evento de input no campo de URL para esconder o card se o campo estiver vazio
    $('#video-url').on('input', function() {
      if (!$(this).val()) {
        $('#video-card').hide();
      } else {
        searchVideo();
      }
    });

    // Evento de clique no botão de download de vídeo
    $('#download-video').click(function(e) {
      e.preventDefault();
      var videoUrl = $(this).data('href');
      var videoTitle = $('#video-title').text(); // Obtém o título do vídeo
      startDownload(videoUrl, `${videoTitle}.mp4`);
    });

    // Evento de clique no botão de download de áudio
    $('#download-audio').click(function(e) {
      e.preventDefault();
      var audioUrl = $(this).data('href');
      var videoTitle = $('#video-title').text(); // Obtém o título do vídeo
      startDownload(audioUrl, `${videoTitle}.mp3`);
    });


function startDownload(url, filename) {
  // Mostra mensagem de "Aguarde um momento"
  $('#progress').show();
  $('#loading-message').show();
  // Esconde mensagem de "Download concluído" e reseta a barra de progresso
  $('#downloaded-message').hide();
  $('#progress-bar').addClass('progress-bar-animated').css('width', '0%').text('0%');

  var xhr = new XMLHttpRequest();
  xhr.open('GET', url, true);
  xhr.responseType = 'blob';

  xhr.onprogress = function(e) {
    if (e.lengthComputable) {
      var percentComplete = (e.loaded / e.total) * 100;
      // Arredonda a porcentagem para o múltiplo de 20 mais próximo
      var roundedPercent = Math.floor(percentComplete / 20) * 20;
      $('#progress-bar').css('width', roundedPercent + '%');
      $('#progress-bar').attr('aria-valuenow', roundedPercent);
      $('#progress-bar').text(roundedPercent.toFixed(2) + '%');
    }
  };

  xhr.onload = function() {
    if (this.status === 200) {
      var blob = new Blob([this.response], { type: 'video/mp4' });
      var downloadUrl = window.URL.createObjectURL(blob);
      var a = document.createElement('a');
      a.style.display = 'none';
      a.href = downloadUrl;
      a.download = filename;
      document.body.appendChild(a);
      a.click();
      window.URL.revokeObjectURL(downloadUrl);

      // Esconde mensagem de "Aguarde um momento" e mostra "Download concluído"
      $('#loading-message').hide();
      $('#downloaded-message').show();

      // Remove a classe de animação da barra de progresso ao concluir o download
      $('#progress-bar').removeClass('progress-bar-animated');
    }
  };

  xhr.send();
}


  </script>
</body>
</html>
